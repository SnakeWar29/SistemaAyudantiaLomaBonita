<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CitizenShift;

class CiudadanoTurnoControlador extends Controller
{
    // Este controlador manejara la administración de los turnos de los ciudadanos
    public function ViewShift(){
        $data['allData'] = CitizenShift::all();
        // Retormanos la vista junto con todos los datos
        return view('backend.setup.shift.view_shift',$data);

    }

     // Ruta para añadir un nuevo grupo, entrar a la interfaz
     public function CitizenShiftAdd(){
        return view('backend.setup.shift.add_shift');
    }

    // Ruta para añadir un nuevo grupo, al presionar el boton
    public function CitizenShiftStore(Request $request){
        $validatedData = $request->validate([
            // Valida si el name esta rellenado
            'name' => 'required|unique:citizen_shifts,name',
        ]);

        // Insertamos los datos a la tabla de la BD
        $data = new CitizenShift();
        $data -> name = $request->name;
        $data -> save();

         // Inicia procedimiento para notificación dentro del sistema
         $notification = array(
            'message' => 'Turno de ciudadanos añadido correctamente',
            'alert-type' => 'success'
        );

        // Desplegamos la notificación de exito
        return redirect()->route('citizen.shift.view')->with($notification);
    }

    public function CitizenShiftEdit($id){
        $editData = CitizenShift::find($id);
        // Retornamos la view con los datos encontrados
        return view('backend.setup.shift.edit_shift', compact('editData'));
    }

     // Funcion para editar un turno, esta se activara al pulsar e l botón
     public function CitizenShiftUpdate(Request $request,$id ){
        $data = CitizenShift::find($id);  // Se encuentra al turno por el ID, es un objeto ya creado
        $validatedData = $request->validate([
            // Valida si el name con ese id especifico esta rellenado
            'name' => 'required|unique:citizen_shifts,name,'.$data->id,
        ]);

        $data -> name = $request->name;
        $data -> save();

         // Inicia procedimiento para notificación dentro del sistema
         $notification = array(
            'message' => 'Turno modificado de forma correcta',
            'alert-type' => 'success'
        );

        // Desplegamos la notificación de exito
        return redirect()->route('citizen.shift.view')->with($notification);
    }

    // Funcion para eliminar una grupo junto con el id del cidudadano
    public function CitizenShiftDelete($id){
        $user = CitizenShift::find($id);
        $user->delete();
        $notification = array(
            'message' => 'Turno eliminado de forma correcta',
            'alert-type' => 'info'
        );
        // Desplegamos la notificación de exito
        return redirect()->route('citizen.shift.view')->with($notification);
    }
}
