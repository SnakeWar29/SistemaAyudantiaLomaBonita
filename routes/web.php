<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminControlador;
use App\Http\Controllers\Backend\UsuarioControlador;
use App\Http\Controllers\Backend\PerfilControlador;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Ruta inicial, en esta ruta sera donde inicie le usuario cuando entre al sistema por primera vez
Route::get('/', function () {
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.index'); // Regresa la vista index del admin cuando se loguea con exito
    })->name('dashboard');
});

// Ruta para poder cerrar sesión, esta vinculada al boton Logout en el header, permitiendo cerrar sesión en todo momento
Route::get('/admin/logout',[AdminControlador::class,'Logout'])->name('admin.logout');

// -----------  Rutas para poder realizar la administración de los usuarios registrados en el sistema  ------------
// Este grupo se encargara de almacenar todos las rutas relacionadas con la administracion de los usuarios
Route::prefix('users')->group(function(){
    // Ver usuario
    Route::get('/view',[UsuarioControlador::class,'UserView'])->name('user.view');
    // Añadir usuario desde el registro
    Route::get('/add',[UsuarioControlador::class,'UserAdd'])->name('users.add');
    // Añadir usuario desde el panel de administrador asignado
    Route::post('/store',[UsuarioControlador::class,'UserStore'])->name('users.store');
    // Mostrar los datos actuales del usuario a editar
    Route::get('/edit/{id}',[UsuarioControlador::class,'UserEdit'])->name('users.edit');
    // Ruta que dirigira al la edición del usuario
    Route::post('/update/{id}',[UsuarioControlador::class,'UserUpdate'])->name('users.update');
    // Ruta que dirigira a la eliminación del usuario
    Route::get('/delete/{id}',[UsuarioControlador::class,'UserDelete'])->name('users.delete');

});
// -----------  Rutas para el perfil del usuario  ------------
Route::prefix('profile')->group(function(){
    // Ruta para mostrar la información del perfil actual
    Route::get('/view',[PerfilControlador::class,'ProfileView'])->name('profile.view');
    // Ruta para poder modificar el perfil del usuario desde Mi Perfil
    Route::get('/edit',[PerfilControlador::class,'ProfileEdit'])->name('profile.edit');
    // Ruta para editar el perfil desde Mi Perfil junto con la foto
    Route::post('/store',[PerfilControlador::class,'ProfileStore'])->name('profile.store');
    // Ruta para ver la vista de cambiar la contraseña desde Mi Perfil
    Route::get('/password/view',[PerfilControlador::class,'PasswordView'])->name('password.view');
    // Ruta para cambiar la contraseña desde mi perfil
    Route::post('/password/update',[PerfilControlador::class,'PasswordUpdate'])->name('password.update');

});
