<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FeeCategoryAmount;
use App\Models\CitizenClass;
use App\Models\FeeCategory;
use App\Models\AssignSupport;
use App\Models\SupportType;

class AsignarApoyoControlador extends Controller
{
    //
    public function ViewAssignSupport(){
        //$data['allData'] = AssignSupport::all();  // Aqui traemos todos los datos de la tabla
        $data['allData']= AssignSupport::select('class_id')->groupBy('class_id')->get();
        // Retormanos la vista junto con todos los datos
        return view('backend.setup.assign_support.view_assign_support',$data);
    }

    // Funcion para añadir un monto de tarifa
    public function AddAssignSupport(){
        $data['supports'] = SupportType::all(); // Extraemos todos los datos de la categoria de la tarifa
        $data['classes'] = CitizenClass::all(); // Extraemos todos los datos de la clase del ciudadano
        return view('backend.setup.assign_support.add_assign_support',$data); // Retornamos la vista con todos los datos que extraimos anteriormente
    }

    // Funcion para añadir
    public function AssignSupportStore(Request $request){
        $supportCount = count($request->support_id);
        if($supportCount !=NULL){ // Si los campos no son nulas
            for($i=0; $i < $supportCount; $i++){   // Se añade todo lo que el usuario haya decidido incluir en una consulta
                $assign_support = new AssignSupport();
                $assign_support->class_id = $request->class_id;
                $assign_support->support_id = $request->support_id[$i];
                $assign_support->full_support = $request->full_support[$i];
                $assign_support->monthly_support = $request->monthly_support[$i];
                $assign_support->total_payments = $request->total_payments[$i];
                $assign_support->save();
            } // Termina for

        } // Termina if

    // Inicia procedimiento para notificación dentro del sistema
    $notification = array(
        'message' => 'Asignación de apoyo agregado correctamente',
        'alert-type' => 'success'
    );

    // Desplegamos la notificación de exito
    return redirect()->route('assign.support.view')->with($notification);
    }


     // Funcion para redirigir a la view de edicion
     public function AssignSupportEdit($class_id){
        $data['editData'] = AssignSupport::where('class_id',$class_id)->orderBy('support_id','asc')->get();
        //dd($data['editData']->toArray());
        $data['supports'] = SupportType::all(); // Extraemos todos los datos del tipo de apoyo
        $data['classes'] = CitizenClass::all(); // Extraemos todos los datos de la clase del ciudadano
        return view('backend.setup.assign_support.edit_assign_support',$data); // Retornamos la vista con todos los datos que extraimos anteriormente
    }

     // Funcion para editar al enviar el form
     public function UpdateAssignSupport(Request $request, $class_id){
        if($request->support_id == NULL){
            $notification = array(
                'message' => 'Los apoyos para una clase no pueden estar vacios',
                'alert-type' => 'error'
            );

            // Desplegamos la notificación de exito
            return redirect()->route('assign.support.edit',$class_id)->with($notification);
        }else{
            $countClass = count($request->support_id);
            AssignSupport::where('class_id',$class_id)->delete();
                for($i=0; $i < $countClass; $i++){   // Se añade cada clase que el usuario haya decidido incluir en una consulta
                    $assign_support = new AssignSupport();
                    $assign_support->class_id = $request->class_id;
                    $assign_support->support_id = $request->support_id[$i];
                    $assign_support->full_support = $request->full_support[$i];
                    $assign_support->monthly_support = $request->monthly_support[$i];
                    $assign_support->total_payments = $request->total_payments[$i];
                    $assign_support->save();
                } // Termina for
        }

        $notification = array(
            'message' => 'Asignación de apoyo modificada de forma exitosa',
            'alert-type' => 'success'
        );

        // Desplegamos la notificación de exito
        return redirect()->route('assign.support.view')->with($notification);

    }

    public function AssignSupportDetails($class_id){
        $data['detailsData'] = AssignSupport::where('class_id',$class_id)->orderBy('support_id','asc')->get();
        return view ('backend.setup.assign_support.details_assign_support',$data);
    }

}
