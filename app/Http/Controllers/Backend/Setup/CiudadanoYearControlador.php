<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CitizenYear;

class CiudadanoYearControlador extends Controller
{
    // Controlador para el año del ciudadano
    public function ViewYear(){
        $data['allData'] = CitizenYear::all();
        // Retormanos la vista junto con todos los datos
        return view('backend.setup.year.view_year',$data);

    }

    public function CitizenYearAdd(){
        return view('backend.setup.year.add_year');
    }

    // Funcion para añadir nuevos años de ciudadanos desde el forms
    public function CitizenYearStore(Request $request){
        $validatedData = $request->validate([
            // Valida si el name esta rellenado
            'name' => 'required|unique:citizen_years,name',
        ]);

        // Insertamos los datos a la tabla de la BD
        $data = new CitizenYear();
        $data -> name = $request->name;
        $data -> save();

         // Inicia procedimiento para notificación dentro del sistema
         $notification = array(
            'message' => 'Año añadido de forma correcta',
            'alert-type' => 'success'
        );

        // Desplegamos la notificación de exito
        return redirect()->route('citizen.year.view')->with($notification);
    }

    // Funcion para redirigir a la view de edicion de un año del ciudadano
    public function CitizenYearEdit($id){
        // Extraer los datos correspondientes relacionados con la ID
        $editData = CitizenYear::find($id);
        // Retornamos la view con los datos encontrados
        return view('backend.setup.year.edit_year', compact('editData'));
    }

    // Funcion para editar una clase, esta se activara al pulsar e l botón
    public function CitizenYearUpdate(Request $request,$id ){
        $data = CitizenYear::find($id);  // Se encuentra al ciudadano por el ID, es un objeto ya creado
        $validatedData = $request->validate([
            // Valida si el name con ese id especifico esta rellenado
            'name' => 'required|unique:citizen_years,name,'.$data->id,
        ]);

        $data -> name = $request->name;
        $data -> save();

         // Inicia procedimiento para notificación dentro del sistema
         $notification = array(
            'message' => 'Año modificado de forma correcta',
            'alert-type' => 'success'
        );

        // Desplegamos la notificación de exito
        return redirect()->route('citizen.year.view')->with($notification);
    }

    // Funcion para eliminar una clase junto con el id del cidudadano
    public function CitizenYearDelete($id){
        $user = CitizenYear::find($id);
        $user->delete();
        $notification = array(
            'message' => 'Año eliminado de forma correcta',
            'alert-type' => 'info'
        );
        // Desplegamos la notificación de exito
        return redirect()->route('citizen.year.view')->with($notification);
    }

}
