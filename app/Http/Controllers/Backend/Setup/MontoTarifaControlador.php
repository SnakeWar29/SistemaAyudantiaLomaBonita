<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FeeCategoryAmount;
use App\Models\CitizenClass;
use App\Models\FeeCategory;

class MontoTarifaControlador extends Controller
{
    // Este controlador administrara el monto de la Tarifa

    public function ViewFeeAmount(){
        //$data['allData'] = FeeCategoryAmount::all();  // Aqui traemos todos los datos de la tabla
        $data['allData']= FeeCategoryAmount::select('fee_category_id')->groupBy('fee_category_id')->get();
        // Retormanos la vista junto con todos los datos
        return view('backend.setup.fee_amount.view_fee_amount',$data);
    }

    // Funcion para añadir un monto de tarifa
    public function AddFeeAmount(){
        $data['fee_categories'] = FeeCategory::all(); // Extraemos todos los datos de la categoria de la tarifa
        $data['classes'] = CitizenClass::all(); // Extraemos todos los datos de la clase del ciudadano
        return view('backend.setup.fee_amount.add_fee_amount',$data); // Retornamos la vista con todos los datos que extraimos anteriormente
    }

    // Funcion para añadir monto de categoria de ciudadanos desde el forms
    public function FeeAmountStore(Request $request){
        $countClass = count($request->class_id);
        if($countClass !=NULL){ // Si los campos de clases no son nulas
            for($i=0; $i < $countClass; $i++){   // Se añade cada clase que el usuario haya decidido incluir en una consulta
                $fee_amount = new FeeCategoryAmount();
                $fee_amount->fee_category_id = $request->fee_category_id;
                $fee_amount->class_id = $request->class_id[$i];
                $fee_amount->amount = $request->amount[$i];
                $fee_amount->save();
            } // Termina for

        } // Termina if

    // Inicia procedimiento para notificación dentro del sistema
    $notification = array(
        'message' => 'Monto de la categoría añadido de forma exitosa',
        'alert-type' => 'success'
    );

    // Desplegamos la notificación de exito
    return redirect()->route('fee.amount.view')->with($notification);
    }

    // Funcion para editar un monto, redirige a la vista
    public function FeeAmountEdit($fee_category_id){
        $data['editData'] = FeeCategoryAmount::where('fee_category_id',$fee_category_id)->orderBy('class_id','asc')->get();
        //dd($data['editData']->toArray());
        $data['fee_categories'] = FeeCategory::all(); // Extraemos todos los datos de la categoria de la tarifa
        $data['classes'] = CitizenClass::all(); // Extraemos todos los datos de la clase del ciudadano
        return view('backend.setup.fee_amount.edit_fee_amount',$data); // Retornamos la vista con todos los datos que extraimos anteriormente
    }

    // Funcion para editar un monto, actual al enviar el form
    public function UpdateAmountEdit(Request $request, $fee_category_id){
        if($request->class_id == NULL){
            $notification = array(
                'message' => 'El monto de la categoría no puede estar vacio',
                'alert-type' => 'error'
            );

            // Desplegamos la notificación de exito
            return redirect()->route('fee.amount.edit',$fee_category_id)->with($notification);
        }else{
            $countClass = count($request->class_id);
            FeeCategoryAmount::where('fee_category_id',$fee_category_id)->delete();
                for($i=0; $i < $countClass; $i++){   // Se añade cada clase que el usuario haya decidido incluir en una consulta
                    $fee_amount = new FeeCategoryAmount();
                    $fee_amount->fee_category_id = $request->fee_category_id;
                    $fee_amount->class_id = $request->class_id[$i];
                    $fee_amount->amount = $request->amount[$i];
                    $fee_amount->save();
                } // Termina for
        }

        $notification = array(
            'message' => 'Monto modificado de forma exitosa',
            'alert-type' => 'success'
        );

        // Desplegamos la notificación de exito
        return redirect()->route('fee.amount.view')->with($notification);

    }

    public function FeeAmountDetails($fee_category_id){
        $data['detailsData'] = FeeCategoryAmount::where('fee_category_id',$fee_category_id)->orderBy('class_id','asc')->get();
        return view ('backend.setup.fee_amount.details_fee_amount',$data);
    }
}
