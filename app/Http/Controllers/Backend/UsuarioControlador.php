<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\ExitEmailNotification;
use App\Notifications\WelcomeEmailNotification;

class UsuarioControlador extends Controller
{
    // Este controlador se encargara de administrar todos los usuarios

    // Función para mandar las variables que contiene todos los datos de la tabla de users
    public function UserView(){
        // Con $allData traemos todos los datos de los usuarios de la base de datos
        // Con $data mandamos los datos obtenidos
        $data['allData'] = User::where('usertype','Admin')->get();
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
        // Asignamos que se genere de forma aletoria un codigo de 4 numeros entre 0 y 9
        $code = rand(0000,9999);
        // Se introducen los datos asignados en el formulario a los comapos de la base de datos
        $data->usertype = 'Admin';
        $data->role = $request->role;
        $data->name = $request->name;
        $data->email = $request->email;
        // Bcrypt es para poder encriptar la contraseña una vez introducida
        $data->password = bcrypt($code);
        $data->code = $code;
        $data->notify(new WelcomeEmailNotification);
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
        $data->name = $request->name;
        $data->email = $request->email;
        $data->role = $request->role;
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
        $user->notify(new ExitEmailNotification);
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
