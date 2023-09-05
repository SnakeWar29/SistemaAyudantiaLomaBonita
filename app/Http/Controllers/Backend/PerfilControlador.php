<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PerfilControlador extends Controller
{
    //Función para mostrar la información del perfil actual
    public function ProfileView(){
        // Con esto encontramos el ID del usuario autentificado actualmente
        $id = Auth::id();
        $user = User::find($id);

        return view('backend.usuario.view_profile',compact('user'));
    }

    // Función para editar la información desde Mi Perfil
    public function ProfileEdit(){
        $id = Auth::id();
        $editData = User::find($id); 
        return view('backend.usuario.edit_profile',compact('editData'));
    }

    // Función para editar la informacion ddesde Mi Perfil
    public function ProfileStore(Request $request){
        $data = User::find(Auth::user()->id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->mobile = $request->mobile;
        $data->address = $request->address;
        $data->gender = $request->gender;

        // Subir imagen de perfil

        if($request->file('image')){
            $file = $request->file('image');
            @unlink(public_path('upload/user_images/'.$data->image));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/user_images'),$filename);
            $data['image'] = $filename;
        }
        $data->save();

        // Se desplega la notificación 
        $notification = array(
            'message' => 'Imagen de perfil subida de forma correcta',
            'alert-type' => 'success'
        );
        // Desplegamos la notificación de exito en la view
        return redirect()->route('profile.view')->with($notification);
    } 

    // Función para retornar la vista para cambiar la contraseña
    public function PasswordView(){
        return view('backend.usuario.edit_password');
    }

    // Función que cambiara la contraseña desde la vista de Mi Perfil
    public function PasswordUpdate(Request $request){
        $validatedData = $request->validate([
            // Valida si la contraseña vieja esta dentro de la BD
            'oldpassword' => 'required',
            // Valida si el campo contraseña esta rellenado
            'password' =>'required|confirmed',
        ]);

        // Recuperamos contraseña actual
        $hashedPassword = Auth::user()->password;
        // Si la contraseña recuperada coincide con ña contraseña vieja
        if(Hash::check($request->oldpassword, $hashedPassword)){
            $user = User::find(Auth::id());
            // Recupera el contenido que hay dentor del coampo contraseña
            $user->password = Hash::make($request->password);
            // Se guarda la nueva contraseña
            $user->save();
            // Se cierra sesión de forma inmediata despues de cambiar de contraseña
            Auth::logout();
            return redirect()->route('login');
        }else{
            // Si no se cumple el if, se regresa 
            return redirect()->back();
        }


    }
}
