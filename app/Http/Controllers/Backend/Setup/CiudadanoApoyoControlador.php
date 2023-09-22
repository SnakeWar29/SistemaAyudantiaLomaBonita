<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SupportType;

class CiudadanoApoyoControlador extends Controller
{
    // Este controlador administrara los apoyos que hay actualmente de los ciudadanos
        public function ViewSupportType(){
            $data['allData'] = SupportType::all();
            // Retormanos la vista junto con todos los datos
            return view('backend.setup.support_type.view_support_type',$data);
        }


        public function SupportTypeAdd(){
            return view('backend.setup.support_type.add_support_type');
        }

        public function SupportTypeStore(Request $request){
            $validatedData = $request->validate([
                // Valida si el name esta rellenado
                'name' => 'required|unique:support_types,name',
            ]);

            // Insertamos los datos a la tabla de la BD
            $data = new SupportType();
            $data -> name = $request->name;
            $data -> save();

             // Inicia procedimiento para notificación dentro del sistema
             $notification = array(
                'message' => 'Apoyo registrado de forma exitosa',
                'alert-type' => 'success'
            );

            // Desplegamos la notificación de exito
            return redirect()->route('support.type.view')->with($notification);
        }

        // Funcion para redirigir a la view de edicion
        public function SupportTypeEdit($id){
            // Extraer los datos correspondientes relacionados con la ID
            $editData = SupportType::find($id);
            // Retornamos la view con los datos encontrados
            return view('backend.setup.support_type.edit_support_type', compact('editData'));
        }

        // Funcion para editar
        public function SupportTypeUpdate(Request $request,$id ){
            $data = SupportType::find($id);  // Se encuentra por el ID, es un objeto ya creado
            $validatedData = $request->validate([
                // Valida si el name con ese id especifico esta rellenado
                'name' => 'required|unique:support_types,name,'.$data->id,
            ]);

            $data -> name = $request->name;
            $data -> save();

             // Inicia procedimiento para notificación dentro del sistema
             $notification = array(
                'message' => 'Apoyo editado de forma correcta',
                'alert-type' => 'success'
            );

            // Desplegamos la notificación de exito
            return redirect()->route('support.type.view')->with($notification);
        }

         // Funcion para eliminar
         public function SupportTypeDelete ($id){
            $user = SupportType::find($id);
            $user->delete();
            $notification = array(
                'message' => 'Apoyo eliminado de forma correcta',
                'alert-type' => 'info'
            );
            // Desplegamos la notificación de exito
            return redirect()->route('support.type.view')->with($notification);
        }

}
