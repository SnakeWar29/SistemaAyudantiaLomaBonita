<?php

namespace App\Http\Controllers\Backend\Citizen;

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
//use Barryvdh\DomPDF\Facade\Pdf;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\DB;
//use DB;
use Illuminate\Support\Facades\App;
use Carbon\Carbon;


class TarifaMensualControlador extends Controller
{
    //Controlador de la tarifa mensual

    public function MonthlyFeeView(){
        $data['years'] = CitizenYear::all();
        $data['classes'] = CitizenClass::all();

        return view('backend.citizen.monthly_fee.fee_monthly_view',$data);
    }

     // Función para recuperar y mostrar los datos de los ciudadanos de esa tarifa
     // ENTRADA - ID del año del ciudadano y de la clase del ciudadano
     // SALIDA - Datos de ciudadanos en formato JavaScript coincidentes con los datos de entrada
     public function MonthlyFeeClassData(Request $request){
        $year_id = $request->year_id; // Recuperamos el año seleccionado en el form de la vista
        $class_id = $request->class_id; // Recuperamos la clase seleccionada en el form de la vista
        if ($year_id !='') {
            $where[] = ['year_id','like',$year_id.'%'];  // Verificamos si los campos no estan vacios, es decir, la selección por defecto
        }
        if ($class_id !='') {
            $where[] = ['class_id','like',$class_id.'%'];
        }
        $allCitizen = AssignCitizen::with(['discount'])->where($where)->get();

        $html['thsource']  = '<th> # </th>';   // Usamos la variable thsource creada anteriormente en la vista para los encabezados
        $html['thsource'] .= '<th>ID No</th>';
        $html['thsource'] .= '<th>Nombre del ciudadano</th>';
        $html['thsource'] .= '<th>Rol</th>';
        $html['thsource'] .= '<th>Tarifa mensual</th>';
        $html['thsource'] .= '<th>Descuento </th>';
        $html['thsource'] .= '<th>Tarifa final</th>';
        $html['thsource'] .= '<th>Acción</th>';


        foreach ($allCitizen as $key => $v) { // Por cada registro encontrado anteriormente
            $registrationfee = FeeCategoryAmount::where('fee_category_id','2')->where('class_id',$v->class_id)->first();
            $color = 'success';
            $html[$key]['tdsource']  = '<td>'.($key+1).'</td>'; // Imprimimos todo el el tdsource, las filas de la tabla
            $html[$key]['tdsource'] .= '<td>'.$v['citizen']['id_no'].'</td>'; // Apuntamos al id
            $html[$key]['tdsource'] .= '<td>'.$v['citizen']['name'].'</td>'; // Apuntamos al nombre del ciudadano
            $html[$key]['tdsource'] .= '<td>'.$v->roll.'</td>'; // Apuntamos al rol
            $html[$key]['tdsource'] .= '<td>'.$registrationfee->amount.' MXN$'.'</td>'; // Apuntamos al total de la tarifa
            $html[$key]['tdsource'] .= '<td>'.$v['discount']['discount'].'%'.'</td>'; // Apuntamos al descuento

            $originalfee = $registrationfee->amount; // Declaramos la tarifa original, sin descuento
            $discount = $v['discount']['discount']; // Declaramos el descuento
            $discounttablefee = $discount/100*$originalfee; // Extraemos la cantidad del descuento de la tarifa
            $finalfee = (float)$originalfee-(float)$discounttablefee; // Declaramos la tarifa final, restando el descuento a la tarifa original

            $html[$key]['tdsource'] .='<td>'.$finalfee.' MXN$'.'</td>';
            $html[$key]['tdsource'] .='<td>';
            $html[$key]['tdsource'] .='<a class="btn btn-sm btn-'.$color.'" title="PaySlip" target="_blanks" href="'.route("citizen.monthly.fee.payslip").'?class_id='.$v->class_id.'&citizen_id='.$v->citizen_id.'&month='.$request->month.'"> Consultar </a>';
            $html[$key]['tdsource'] .= '</td>';

        }
       return response()->json(@$html);
    }


     // Funcion para el reporte pdf
     public function MonthlyFeePayslip(Request $request){
        $citizen_id = $request->citizen_id; // Recuperamos los campos anteriormente definidos
        $class_id = $request->class_id;
        $data['month'] = $request->month; // En este caso, recuperamos el campo del mes definido en la vista

        $data['details'] = AssignCitizen::with(['citizen','discount'])->where('citizen_id',$citizen_id)->where('class_id',$class_id)->first();
        $pdf = PDF::loadView('backend.citizen.monthly_fee.fee_monthly_pdf',$data);
        return $pdf->download('Reporte_TarifaMensual_Ciudadano.pdf');

    }

}
