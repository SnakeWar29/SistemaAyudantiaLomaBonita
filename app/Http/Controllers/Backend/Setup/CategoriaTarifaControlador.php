<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FeeCategory;

class CategoriaTarifaControlador extends Controller
{
    // Este controlador se encargara de administrar  los tramites

    // Controlador para el la categoria de tarifa
    public function ViewFeeCat(){
        $data['allData'] = FeeCategory::all();
        // Retormanos la vista junto con todos los datos
        return view('backend.setup.fee_category.view_fee_cat',$data);

    }

    public function FeeCatAdd(){
        return view('backend.setup.fee_category.add_fee_cat');
    }

    public function FeeCatStore(Request $request){
        $validatedData = $request->validate([
            // Valida si el name esta rellenado
            'name' => 'required|unique:fee_categories,name',
        ]);

        // Insertamos los datos a la tabla de la BD
        $data = new FeeCategory();
        $data -> name = $request->name;
        $data -> save();

         // Inicia procedimiento para notificación dentro del sistema
         $notification = array(
            'message' => 'Categoria de tarifa añadida de forma correcta',
            'alert-type' => 'success'
        );

        // Desplegamos la notificación de exito
        return redirect()->route('fee.category.view')->with($notification);
    }

    // Funcion para redirigir a la view de edicion la tarifa
    public function FeeCatEdit($id){
        // Extraer los datos correspondientes relacionados con la ID
        $editData = FeeCategory::find($id);
        // Retornamos la view con los datos encontrados
        return view('backend.setup.fee_category.edit_fee_cat', compact('editData'));
    }

    // Funcion para editar una tarifa, esta se activara al pulsar el botón
    public function FeeCatUpdate(Request $request,$id ){
        $data = FeeCategory::find($id);  // Se encuentra por el ID, es un objeto ya creado
        $validatedData = $request->validate([
            // Valida si el name con ese id especifico esta rellenado
            'name' => 'required|unique:fee_categories,name,'.$data->id,
        ]);

        $data -> name = $request->name;
        $data -> save();

         // Inicia procedimiento para notificación dentro del sistema
         $notification = array(
            'message' => 'Categoría de la tarifa editada de forma correcta',
            'alert-type' => 'success'
        );

        // Desplegamos la notificación de exito
        return redirect()->route('fee.category.view')->with($notification);
    }

    // Funcion para eliminar una clase junto con el id del cidudadano
    public function FeeCatDelete ($id){
        $user = FeeCategory::find($id);
        $user->delete();
        $notification = array(
            'message' => 'Categoria de tarifa eliminado de forma correcta',
            'alert-type' => 'info'
        );
        // Desplegamos la notificación de exito
        return redirect()->route('fee.category.view')->with($notification);
    }
}
