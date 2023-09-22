<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Designation;

class DesignacionControlador extends Controller
{
    public function ViewDesignation(){
        $data['allData'] = Designation::all();
        // Retormanos la vista junto con todos los datos
        return view('backend.setup.designation.view_designation',$data);
    }

    public function AddDesignation(){
        return view('backend.setup.designation.add_designation');
    }

    public function DesignationStore(Request $request){
        $validatedData = $request->validate([
            // Valida si el name esta rellenado
            'name' => 'required|unique:designations,name',
        ]);

        // Insertamos los datos a la tabla de la BD
        $data = new Designation();
        $data -> name = $request->name;
        $data -> save();

         // Inicia procedimiento para notificación dentro del sistema
         $notification = array(
            'message' => 'Designación añadida de forma exitosa',
            'alert-type' => 'success'
        );

        // Desplegamos la notificación de exito
        return redirect()->route('designation.view')->with($notification);
    }

           // Funcion para redirigir a la view de edicion
    public function DesignationEdit($id){
            // Extraer los datos correspondientes relacionados con la ID
            $editData = Designation::find($id);
            // Retornamos la view con los datos encontrados
            return view('backend.setup.designation.edit_designation', compact('editData'));
    }


        // Funcion para editar
        public function DesignationSupport(Request $request,$id ){
            $data = Designation::find($id);  // Se encuentra por el ID, es un objeto ya creado
            $validatedData = $request->validate([
                // Valida si el name con ese id especifico esta rellenado
                'name' => 'required|unique:designations,name,'.$data->id,
            ]);

            $data -> name = $request->name;
            $data -> save();

             // Inicia procedimiento para notificación dentro del sistema
             $notification = array(
                'message' => 'Designación eidtada de forma correcta',
                'alert-type' => 'success'
            );

            // Desplegamos la notificación de exito
            return redirect()->route('designation.view')->with($notification);
        }

          // Funcion para eliminar
          public function DesignationDelete ($id){
            $user = Designation::find($id);
            $user->delete();
            $notification = array(
                'message' => 'Designación eliminada de forma correcta',
                'alert-type' => 'info'
            );
            // Desplegamos la notificación de exito
            return redirect()->route('designation.view')->with($notification);
        }

}
