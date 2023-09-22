<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CitizenGroup;

class CiudadanoGrupoControlador extends Controller
{
    // Controlador para los distintos grupos de ciudadanos

    public function ViewGroup(){
        $data['allData'] = CitizenGroup::all();
        // Retormanos la vista junto con todos los datos
        return view('backend.setup.group.view_group',$data);
    }

    // Ruta para añadir un nuevo grupo, entrar a la interfaz
    public function CitizenGroupAdd(){
        return view('backend.setup.group.add_group');
    }

    // Ruta para añadir un nuevo grupo, al presionar el boton
    public function CitizenGroupStore(Request $request){
        $validatedData = $request->validate([
            // Valida si el name esta rellenado
            'name' => 'required|unique:citizen_groups,name',
        ]);

        // Insertamos los datos a la tabla de la BD
        $data = new CitizenGroup();
        $data -> name = $request->name;
        $data -> save();

         // Inicia procedimiento para notificación dentro del sistema
         $notification = array(
            'message' => 'Grupo de ciudadanos añadido correctamente',
            'alert-type' => 'success'
        );

        // Desplegamos la notificación de exito
        return redirect()->route('citizen.group.view')->with($notification);
    }

    public function CitizenGroupEdit($id){
        $editData = CitizenGroup::find($id);
        // Retornamos la view con los datos encontrados
        return view('backend.setup.group.edit_group', compact('editData'));
    }

    // Funcion para editar un grupo, esta se activara al pulsar e l botón
    public function CitizenGroupUpdate(Request $request,$id ){
        $data = CitizenGroup::find($id);  // Se encuentra al cgrupo por el ID, es un objeto ya creado
        $validatedData = $request->validate([
            // Valida si el name con ese id especifico esta rellenado
            'name' => 'required|unique:citizen_groups,name,'.$data->id,
        ]);

        $data -> name = $request->name;
        $data -> save();

         // Inicia procedimiento para notificación dentro del sistema
         $notification = array(
            'message' => 'Grupo modificado de forma correcta',
            'alert-type' => 'success'
        );

        // Desplegamos la notificación de exito
        return redirect()->route('citizen.group.view')->with($notification);
    }

    // Funcion para eliminar una grupo junto con el id del cidudadano
    public function CitizenGroupDelete($id){
        $user = CitizenGroup::find($id);
        $user->delete();
        $notification = array(
            'message' => 'Grupo eliminado de forma correcta',
            'alert-type' => 'info'
        );
        // Desplegamos la notificación de exito
        return redirect()->route('citizen.group.view')->with($notification);
    }
}
