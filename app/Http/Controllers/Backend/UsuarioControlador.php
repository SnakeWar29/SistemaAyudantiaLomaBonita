<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


class UsuarioControlador extends Controller
{
    // Este controlador se encargara de administrar todos los usuarios

    // Función para mandar las variables que contiene todos los datos de la tabla de users
    public function UserView(){
        // Con $allData traemos todos los datos de los usuarios de la base de datos
        // Con $data mandamos los datos obtenidos
        $data['allData'] = User::all();
        return view('Backend.usuario.view_user',$data);
    }

    // Función para redireccionar a la vista para poder administrar un usuario
    public function UserAdd(){
        return view('backend.usuario.add_user');
    }

    // Función para poder añadir un usuario desde el panel asignado
    // Entrada: Datos del formulario en la vista
    // Salida: Guardar datos en la base de datos con $data
    public function UserStore(Request $request){
        $validatedData = $request->validate([
            // Valida si el email esta rellenado y es unico dentro de la BD
            'email' => 'required|unique:users',
            // Valida si el nombre esta rellenado
            'name' =>'required',
        ]);

        $data = new User();
        // Se introducen los datos asignados en el formulario a los comapos de la base de datos
        $data->usertype = $request->usertype;
        $data->name = $request->name;
        $data->email = $request->email;
        // Bcrypt es para poder encriptar la contraseña una vez introducida
        $data->password = bcrypt($request->password);
        $data->save();


        // Inicia procedimiento para notificación dentro del sistema
        $notification = array(
            'message' => 'Usuario agregado de forma correcta',
            'alert-type' => 'success'
        );

        // Desplegamos la notificación de exito
        return redirect()->route('user.view')->with($notification);
    }


    // Función que permitira recuperar los datos de un usuario registrado anteriormente
    //  Entrada: Datos del usuario registrado y logueado
    // Salida : Vista con la misma información de entrada
    public function UserEdit($id){
        $editData = User::find($id);
        return view('backend.usuario.edit_user',compact('editData'));
    }

    // Función que editara un usuario
    public function UserUpdate(Request $request, $id){
        // Se encuentra el usuario especifico
        $data = User::find($id);
        $data->usertype = $request->usertype;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->save();


        // Inicia procedimiento para notificación dentro del sistema
        $notification = array(
            'message' => 'Usuario actualizado de forma correcta',
            'alert-type' => 'info'
        );

        // Desplegamos la notificación de exito
        return redirect()->route('user.view')->with($notification);
    }

    // Función para eliminar un usuario 
    // Entrada:  Datos del usuario logueado
    // Salida: Eliminación del usuario con coincidencias en la base de datos, al igual que la vista con notificación
    public function UserDelete($id){
        $user = User::find($id);
        $user->delete();

                // Inicia procedimiento para notificación dentro del sistema
                $notification = array(
                    'message' => 'Usuario eliminado exitosamente',
                    'alert-type' => 'info'
                );
        
                // Desplegamos la notificación de exito
                return redirect()->route('user.view')->with($notification);
    }

}
