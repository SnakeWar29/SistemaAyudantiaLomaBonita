<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CitizenClass;

// Controlador para configurar la clase de los ciudadanos

class CiudadanoClaseControlador extends Controller
{
    // Funcion para mostrar todos los datos de clases de ciudadanos
    public function ViewCitizen(){
        // Recuperamos todos los datos de la tabla de clase de ciudadanos
        $data['allData'] = CitizenClass::all();
        // Retormanos la vista junto con todos los datos
        return view('backend.setup.ciudadano_clase.view_class',$data);

    }

    // Funcion para añadir nuevas clases de ciudadanos
    public function CitizenClassAdd(){
        return view('backend.setup.ciudadano_clase.add_class');
    }

    // Funcion para añadir nuevas clases de ciudadanos desde el forms
    public function CitizenClassStore(Request $request){
        $validatedData = $request->validate([
            // Valida si el name esta rellenado
            'name' => 'required|unique:citizen_classes,name',
        ]);

        // Insertamos los datos a la tabla de la BD
        $data = new CitizenClass();
        $data -> name = $request->name;
        $data -> save();

         // Inicia procedimiento para notificación dentro del sistema
         $notification = array(
            'message' => 'Clase añadida de forma correcta',
            'alert-type' => 'success'
        );

        // Desplegamos la notificación de exito
        return redirect()->route('citizen.class.view')->with($notification);
    }

    // Funcion para redirigir a la view de edicion de una clase de ciudadano
    public function CitizenClassEdit($id){
        // Extraer los datos correspondientes relacionados con la ID
        $editData = CitizenClass::find($id);
        // Retornamos la view con los datos encontrados
        return view('backend.setup.ciudadano_clase.edit_class', compact('editData'));
    }

    // Funcion para editar una clase, esta se activara al pulsar e l botón
    public function CitizenClassUpdate(Request $request,$id ){
        $data = CitizenClass::find($id);  // Se encuentra al ciudadano por el ID, es un objeto ya creado
        $validatedData = $request->validate([
            // Valida si el name con ese id especifico esta rellenado
            'name' => 'required|unique:citizen_classes,name,'.$data->id,
        ]);

        $data -> name = $request->name;
        $data -> save();

         // Inicia procedimiento para notificación dentro del sistema
         $notification = array(
            'message' => 'Clase modificada de forma correcta',
            'alert-type' => 'success'
        );

        // Desplegamos la notificación de exito
        return redirect()->route('citizen.class.view')->with($notification);
    }

    // Funcion para eliminar una clase junto con el id del cidudadano
    public function CitizenClassDelete($id){
        $user = CitizenClass::find($id);
        $user->delete();
        $notification = array(
            'message' => 'Clase eliminada de forma correcta',
            'alert-type' => 'info'
        );
        // Desplegamos la notificación de exito
        return redirect()->route('citizen.class.view')->with($notification);
    }
}
