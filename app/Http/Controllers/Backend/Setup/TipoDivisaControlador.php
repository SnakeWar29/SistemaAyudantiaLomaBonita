<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BadgeType;

class TipoDivisaControlador extends Controller
{
    // Este controlador se encargara de administrar los tipos de Divisa
    public function ViewBadgeType(){
        $data['allData'] = BadgeType::all();
        // Retormanos la vista junto con todos los datos
        return view('backend.setup.badge_type.view_badge_type',$data);
    }


    public function BagdeTypeAdd(){
        return view('backend.setup.badge_type.add_badge_type');
    }

    public function BadgeTypeStore(Request $request){
        $validatedData = $request->validate([
            // Valida si el name esta rellenado
            'name' => 'required|unique:badge_types,name',
        ]);

        // Insertamos los datos a la tabla de la BD
        $data = new BadgeType();
        $data -> name = $request->name;
        $data -> save();

         // Inicia procedimiento para notificación dentro del sistema
         $notification = array(
            'message' => 'Divisa añadida de forma correcta',
            'alert-type' => 'success'
        );

        // Desplegamos la notificación de exito
        return redirect()->route('badge.type.view')->with($notification);
    }

    // Funcion para redirigir a la view de edicion
    public function BadgeTypeEdit($id){
        // Extraer los datos correspondientes relacionados con la ID
        $editData = BadgeType::find($id);
        // Retornamos la view con los datos encontrados
        return view('backend.setup.badge_type.edit_badge_type', compact('editData'));
    }

    // Funcion para editar
    public function BadgeTypeUpdate(Request $request,$id ){
        $data = BadgeType::find($id);  // Se encuentra por el ID, es un objeto ya creado
        $validatedData = $request->validate([
            // Valida si el name con ese id especifico esta rellenado
            'name' => 'required|unique:badge_types,name,'.$data->id,
        ]);

        $data -> name = $request->name;
        $data -> save();

         // Inicia procedimiento para notificación dentro del sistema
         $notification = array(
            'message' => 'Divisa editada de forma correcta',
            'alert-type' => 'success'
        );

        // Desplegamos la notificación de exito
        return redirect()->route('badge.type.view')->with($notification);
    }

     // Funcion para eliminar
     public function BadgeTypeDelete ($id){
        $user = BadgeType::find($id);
        $user->delete();
        $notification = array(
            'message' => 'Divisa eliminada de forma correcta',
            'alert-type' => 'info'
        );
        // Desplegamos la notificación de exito
        return redirect()->route('badge.type.view')->with($notification);
    }

}
