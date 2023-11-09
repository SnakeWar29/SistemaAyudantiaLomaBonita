<?php

namespace App\Http\Controllers\Backend\Accounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CitizenYear;
use App\Models\CitizenClass;
use App\Models\CitizenGroup;
use App\Models\CitizenShift;
use App\Models\AssignCitizen;
use App\Models\DiscountCitizen;
use App\Models\FeeCategoryAmount;
use App\Models\FeeCategory;
use App\Models\AccountCitizenFee;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;


class CiudadanoTarifaControlador extends Controller
{
    public function CitizenFeeView(){
        $data['allData'] = AccountCitizenFee::all(); // Recuperamos todos los datos de la tabla de tarifas de ciudadanos
        return view('backend.account.citizen_fee.citizen_fee_view',$data);
    }

    public function CitizenFeeAdd(){
        $data['years'] = CitizenYear::all(); // Recuperamos todos los años
        $data['classes'] = CitizenClass::all(); // Recuperamos todas las clases
        $data['fee_categories'] = FeeCategory::all(); // Recuperamos todas las tarifas
        return view('backend.account.citizen_fee.citizen_fee_add',$data);
    }

    public function CitizenFeeGet(Request $request){
        $year_id = $request->year_id; // Recuperamos el año en el campo
        $class_id = $request->class_id; // Recuperamos la clase en el campo
        $fee_category_id = $request->fee_category_id; // Recuperamos la categoria en el campo
        $date = date('Y-m',strtotime($request->date)); // Recuperamos la fecha en el campo

        $data = AssignCitizen::with(['discount'])->where('year_id',$year_id)->where('class_id',$class_id)->get(); // Usando los datos adquiridos, filtramos una busqueda por coincidencias
                $html['thsource']  = '<th>ID Identificativo</th>';  // Empezamos a poner los encabezados de la tabla
                $html['thsource'] .= '<th>Nombre</th>';
                $html['thsource'] .= '<th>Contacto de emergencia A</th>';
                $html['thsource'] .= '<th>Tarifa original </th>';
                $html['thsource'] .= '<th>Total de descuento</th>';
                $html['thsource'] .= '<th>Tarifa final </th>';
                $html['thsource'] .= '<th>¿Pagado?</th>';

    foreach ($data as $key => $fee) { // Por cada registro del ciudadano encontrado...
        // Recuperamos el total de la tarifa dependiendo de su clase
        $registrationfee = FeeCategoryAmount::where('fee_category_id',$fee_category_id)->where('class_id',$fee->class_id)->first();
        //Recuperamos todos los datos en nuestro modelo de la tabla para guardar los datos
        $accountcitizensfees = AccountCitizenFee::where('citizen_id',$fee->citizen_id)->where('year_id',$fee->year_id)->where('class_id',$fee->class_id)->where('fee_category_id',$fee_category_id)->where('date',$date)->first();

        if($accountcitizensfees !=null) { // Si se recuperaron registros con exito..... (no es nulo)
                $checked = 'checked'; // Se marca como revisado
        }else{ // Si no se encontraron registros ...
                $checked = ''; // No se marca como revisado
        }
            $color = 'success';  // Empezamos a llenar los campos de los encabezados
            $html[$key]['tdsource']  = '<td>'.$fee['citizen']['id_no']. '<input type="hidden" name="fee_category_id" value= " '.$fee_category_id.' " >'.'</td>';

            $html[$key]['tdsource']  .= '<td>'.$fee['citizen']['name']. '<input type="hidden" name="year_id" value= " '.$fee->year_id.' " >'.'</td>';

            $html[$key]['tdsource']  .= '<td>'.$fee['citizen']['fname']. '<input type="hidden" name="class_id" value= " '.$fee->class_id.' " >'.'</td>';

            $html[$key]['tdsource']  .= '<td>'.$registrationfee->amount.'$'.'<input type="hidden" name="date" value= " '.$date.' " >'.'</td>';

            $html[$key]['tdsource'] .= '<td>'.$fee['discount']['discount'].'%'.'</td>';

            $originalfee = $registrationfee->amount; // Recuperamos la tarifa original
            $discount = $fee['discount']['discount']; // Usando el modelo en nuestro controlador [AccountCitizenFee], recuperamos el descuento
            $discountablefee = $discount/100*$originalfee; // Sacamos ese % de descuento de la tarifa original
            $finalfee = (int)$originalfee-(int)$discountablefee; // Declaramos la tarifa final restandole a la tarifa original, el descuento

            $html[$key]['tdsource'] .='<td>'. '<input type="text" readonly="readonly" name="amount[]" value="'.$finalfee.' " class="form-control" readonly'.'</td>';
            $html[$key]['tdsource'] .='<td>'.'<input type="hidden" name="citizen_id[]" value="'.$fee->citizen_id.'">'.'<input type="checkbox" name="checkmanage[]" id="'.$key.'" value="'.$key.'" '.$checked.' style="transform: scale(1.5);margin-left: 10px;"> <label for="'.$key.'"> </label> '.'</td>';
    }
                return response()->json(@$html);
    }

    public function CitizenFeeStore(Request $request){
        $date = date('Y-m',strtotime($request->date)); // Recuperamos la fecha en el campo
        //Buscamos el registro en la tabla, si se encuentra se eliminara para automaticamente volverse a insertar
        AccountCitizenFee::where('year_id',$request->year_id)->where('class_id',$request->class_id)->where('fee_category_id',$request->fee_category_id)->where('date',$request->date)->delete();

        // Comprobamos si la checkbox de la vista fue seleccionada o no, es decir, si el tramite fue pagado o no.
        $checkData = $request->checkmanage;

        if($checkData != null){  // Cuando la checbox sea diferente a nulo, es decir, fue marcada como pagada, entonces se introduciran esos datos como "PAGADOS"
            for ($i=0; $i < count($checkData) ;$i++){ //Empieza ciclo for para insertar cada uno de los datos
                $data = new AccountCitizenFee(); // Crearmos un nuevo objeto del modelo para insertar datos
                $data->year_id = $request->year_id;
                $data->class_id = $request->class_id;
                $data->date = $date;
                $data->fee_category_id = $request->fee_category_id;
                $data->citizen_id = $request->citizen_id[$checkData[$i]];
                $data->amount = $request->amount[$checkData[$i]];
                $data->save();
            }
        }

        if(!empty(@$data) || empty($checkData)){ // Si se registran los datos correctamente
            $notification = array(
                'message' => 'Pago de tarifa registrado correctamente',
                'alert-type' => 'success'
            );
            // Desplegamos la notificación de exito en la view
            return redirect()->route('citizen.fee.view')->with($notification);
        }else{
            $notification = array(
                'message' => 'Ocurrio un error al registrar el pago, verifique los datos',
                'alert-type' => 'error'
            );
            // Desplegamos la notificación de exito en la view
            return redirect()->back()->with($notification);
        }
    }
}
