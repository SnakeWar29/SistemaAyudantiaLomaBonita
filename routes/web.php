<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminControlador;
use App\Http\Controllers\Backend\UsuarioControlador;
use App\Http\Controllers\Backend\PerfilControlador;
use App\Http\Controllers\Backend\Setup\CiudadanoClaseControlador;
use App\Http\Controllers\Backend\Setup\CiudadanoYearControlador;
use App\Http\Controllers\Backend\Setup\CiudadanoGrupoControlador;
use App\Http\Controllers\Backend\Setup\CiudadanoTurnoControlador;
use App\Http\Controllers\Backend\Setup\CategoriaTarifaControlador;
use App\Http\Controllers\Backend\Setup\MontoTarifaControlador;
use App\Http\Controllers\Backend\Setup\TipoDivisaControlador;
use App\Http\Controllers\Backend\Setup\CiudadanoApoyoControlador;
use App\Http\Controllers\Backend\Setup\AsignarApoyoControlador;
use App\Http\Controllers\Backend\Setup\DesignacionControlador;

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

// -----------  Rutas para la Gestion general  ------------
Route::prefix('setups')->group(function(){
    // Rutas para la clase para el ciudadano

    // Ruta para mostrar la información de clases de ciudadanos actuales
    Route::get('citizen/class/view',[CiudadanoClaseControlador::class,'ViewCitizen'])->name('citizen.class.view');
    // Ruta para del form para añadir una nueva clase de ciudadano
    Route::get('citizen/class/add',[CiudadanoClaseControlador::class,'CitizenClassAdd'])->name('citizen.class.add');
    // Ruta para añadir una nueva clase desde el form
    Route::post('citizen/class/store',[CiudadanoClaseControlador::class,'CitizenClassStore'])->name('store.citizen.class');
    // Ruta para editar una clase de ciudadano , redirige a la vista de edicion
    Route::get('citizen/class/edit/{id}',[CiudadanoClaseControlador::class,'CitizenClassEdit'])->name('citizen.class.edit');
    // Ruta para editar una clase, es cuando se pulsa el bton de editar
    Route::post('citizen/class/update/{id}',[CiudadanoClaseControlador::class,'CitizenClassUpdate'])->name('update.citizen.class');
    // Ruta para eliminar una clase, se activa al pulsar el boton
    Route::get('citizen/class/delete/{id}',[CiudadanoClaseControlador::class,'CitizenClassDelete'])->name('citizen.class.delete');

    // Rutas para el año del ciudadano
    Route::get('citizen/year/view',[CiudadanoYearControlador::class,'ViewYear'])->name('citizen.year.view');
     // Ruta para del form para añadir un nuevo año de ciudadano
    Route::get('citizen/year/add',[CiudadanoYearControlador::class,'CitizenYearAdd'])->name('citizen.year.add');
    // Ruta para añadir un nuevo año desde el form
    Route::post('citizen/year/store',[CiudadanoYearControlador::class,'CitizenYearStore'])->name('store.citizen.year');
    // Ruta para editar un año del ciudadano , redirige a la vista de edicion
    Route::get('citizen/year/edit/{id}',[CiudadanoYearControlador::class,'CitizenYearEdit'])->name('citizen.year.edit');
    // Ruta para editar un año de ciudadano, es cuando se pulsa el bton de editar
    Route::post('citizen/year/update/{id}',[CiudadanoYearControlador::class,'CitizenYearUpdate'])->name('update.citizen.year');
    // Ruta para eliminar un año, se activa al pulsar el boton
    Route::get('citizen/year/delete/{id}',[CiudadanoYearControlador::class,'CitizenYearDelete'])->name('citizen.year.delete');

    // Ruta para el grupo del ciudadano
    Route::get('citizen/group/view',[CiudadanoGrupoControlador::class,'ViewGroup'])->name('citizen.group.view');
     // Ruta para del form para añadir un nuevo grupo de ciudadano
    Route::get('citizen/group/add',[CiudadanoGrupoControlador::class,'CitizenGroupAdd'])->name('citizen.group.add');
     // Ruta para añadir un nuevo grupo desde el form
    Route::post('citizen/group/store',[CiudadanoGrupoControlador::class,'CitizenGroupStore'])->name('store.citizen.group');
    // Ruta para editar un grupo de ciudadanos , redirige a la vista de edicion
    Route::get('citizen/group/edit/{id}',[CiudadanoGrupoControlador::class,'CitizenGroupEdit'])->name('citizen.group.edit');
    // Ruta para editar un grupo de ciudadano, es cuando se pulsa el bton de editar
    Route::post('citizen/group/update/{id}',[CiudadanoGrupoControlador::class,'CitizenGroupUpdate'])->name('update.citizen.group');
    // Ruta para eliminar un grupo, se activa al pulsar el boton
    Route::get('citizen/group/delete/{id}',[CiudadanoGrupoControlador::class,'CitizenGroupDelete'])->name('citizen.group.delete');

    // Ruta para el turno del ciudadano
    Route::get('citizen/shift/view',[CiudadanoTurnoControlador::class,'ViewShift'])->name('citizen.shift.view');
     // Ruta para del form para añadir un nuevo turno del ciudadano
     Route::get('citizen/shift/add',[CiudadanoTurnoControlador::class,'CitizenShiftAdd'])->name('citizen.shift.add');
      // Ruta para añadir un nuevo grupo desde el form
    Route::post('citizen/shift/store',[CiudadanoTurnoControlador::class,'CitizenShiftStore'])->name('store.citizen.shift');
    // Ruta para editar un turno de ciudadanos , redirige a la vista de edicion
    Route::get('citizen/shift/edit/{id}',[CiudadanoTurnoControlador::class,'CitizenShiftEdit'])->name('citizen.shift.edit');
    // Ruta para editar un turno de ciudadano, es cuando se pulsa el bton de editar
    Route::post('citizen/shift/update/{id}',[CiudadanoTurnoControlador::class,'CitizenShiftUpdate'])->name('update.citizen.shift');
     // Ruta para eliminar un turno, se activa al pulsar el boton
     Route::get('citizen/shift/delete/{id}',[CiudadanoTurnoControlador::class,'CitizenShiftDelete'])->name('citizen.shift.delete');


     // Ruta para las categorias de las tarifas (tramites)
     // Ruta para la vista de la tarifa
    Route::get('fee/category/view',[CategoriaTarifaControlador::class,'ViewFeeCat'])->name('fee.category.view');
    // Ruta para del form para añadir una nueva categoria del ciudadano
    Route::get('fee/category/add',[CategoriaTarifaControlador::class,'FeeCatAdd'])->name('fee.category.add');
    // Ruta para añadir un nuevo grupo desde el form
    Route::post('fee/category/store',[CategoriaTarifaControlador::class,'FeeCatStore'])->name('store.fee.category');
     // Ruta para editar una categoria de tarifa , redirige a la vista de edicion
     Route::get('fee/category/edit/{id}',[CategoriaTarifaControlador::class,'FeeCatEdit'])->name('fee.category.edit');
    // Ruta para editar una categoria de tarifa, es cuando se pulsa el bton de editar
    Route::post('fee/category/update/{id}',[CategoriaTarifaControlador::class,'FeeCatUpdate'])->name('update.fee.category');
    // Ruta para eliminar una categoria de tarifa, se activa al pulsar el boton
    Route::get('fee/category/delete/{id}',[CategoriaTarifaControlador::class,'FeeCatDelete'])->name('fee.category.delete');


     // Rutas para el monto de las tarifas
      // Ruta para la vista del monto de la tarifa
    Route::get('fee/amount/view',[MontoTarifaControlador::class,'ViewFeeAmount'])->name('fee.amount.view');
    // Ruta para del form para añadir una nueva categoria del ciudadano
    Route::get('fee/amount/add',[MontoTarifaControlador::class,'AddFeeAmount'])->name('fee.amount.add');
    // Ruta para añadir un nuevo monyo desde el form
    Route::post('fee/amount/store',[MontoTarifaControlador::class,'FeeAmountStore'])->name('store.fee.amount');
    // Ruta para editar un monto, redirige a la vista de edicion
    Route::get('fee/amount/edit/{fee_category_id}',[MontoTarifaControlador::class,'FeeAmountEdit'])->name('fee.amount.edit');
    // Ruta para editar un monto, al pulsar el boton y entregar el form
    Route::post('fee/amount/update/{fee_category_id}',[MontoTarifaControlador::class,'UpdateAmountEdit'])->name('update.fee.amount');
     // Ruta para ver los detalles de un monto
     Route::get('fee/amount/details/{fee_category_id}',[MontoTarifaControlador::class,'FeeAmountDetails'])->name('fee.amount.details');

     // Rutas prueba
    Route::get('badge/type/view',[TipoDivisaControlador::class,'ViewBadgeType'])->name('badge.type.view');
      // Ruta para del form para añadir una nueva categoria del ciudadano
    Route::get('badge/type/add',[TipoDivisaControlador::class,'BagdeTypeAdd'])->name('badge.type.add');
      // Ruta para añadir un nuevo grupo desde el form
    Route::post('badge/type/store',[TipoDivisaControlador::class,'BadgeTypeStore'])->name('store.badge.type');
       // Ruta para editar una categoria de tarifa , redirige a la vista de edicion
    Route::get('badge/type/edit/{id}',[TipoDivisaControlador::class,'BadgeTypeEdit'])->name('store.badge.edit');
      // Ruta para editar una categoria de tarifa, es cuando se pulsa el bton de editar
    Route::post('badge/type/update/{id}',[TipoDivisaControlador::class,'BadgeTypeUpdate'])->name('update.badge.type');
      // Ruta para eliminar una categoria de tarifa, se activa al pulsar el boton
    Route::get('badge/type/delete/{id}',[TipoDivisaControlador::class,'BadgeTypeDelete'])->name('badge.type.delete');


    // Rutas para el apoyo
     // Rutas prueba
     Route::get('support/type/view',[CiudadanoApoyoControlador::class,'ViewSupportType'])->name('support.type.view');
     // Ruta para del form para añadir
   Route::get('support/type/add',[CiudadanoApoyoControlador::class,'SupportTypeAdd'])->name('support.type.add');
     // Ruta para añadir desde el form
   Route::post('support/type/store',[CiudadanoApoyoControlador::class,'SupportTypeStore'])->name('store.support.type');
      // Ruta para editar, redirige a la vista de edicion
   Route::get('support/type/edit/{id}',[CiudadanoApoyoControlador::class,'SupportTypeEdit'])->name('store.support.edit');
     // Ruta para editar, es cuando se pulsa el bton de editar
   Route::post('support/type/update/{id}',[CiudadanoApoyoControlador::class,'SupportTypeUpdate'])->name('update.support.type');
     // Ruta para eliminar, se activa al pulsar el boton
   Route::get('support/type/delete/{id}',[CiudadanoApoyoControlador::class,'SupportTypeDelete'])->name('support.type.delete');

    // Ruta para la vista de la asignación
    Route::get('assign/support/view',[AsignarApoyoControlador::class,'ViewAssignSupport'])->name('assign.support.view');
    // Ruta para del form para añadir
    Route::get('assign/support/add',[AsignarApoyoControlador::class,'AddAssignSupport'])->name('assign.support.add');
    // Ruta para añadir desde el form
    Route::post('assign/support/store',[AsignarApoyoControlador::class,'AssignSupportStore'])->name('store.assign.support');
    // Ruta para editar un monto, de ediciredirige a la vista on
    Route::get('assign/support/edit/{class_id}',[AsignarApoyoControlador::class,'AssignSupportEdit'])->name('assign.support.edit');
    // Ruta para editar un monto, al pulsar el boton y entregar el form
    Route::post('assign/support/update/{class_id}',[AsignarApoyoControlador::class,'UpdateAssignSupport'])->name('update.assign.support');
     // Ruta para ver los detalles de un monto
     Route::get('assign/support/details/{class_id}',[AsignarApoyoControlador::class,'AssignSupportDetails'])->name('assign.support.details');


     // Designacion
    Route::get('designation/view',[DesignacionControlador::class,'ViewDesignation'])->name('designation.view');
    // Ruta para del form para añadir
    Route::get('designation/add',[DesignacionControlador::class,'AddDesignation'])->name('designation.add');
    // Ruta para añadir desde el form
    Route::post('assign/support/store',[DesignacionControlador::class,'DesignationStore'])->name('store.designation');
    // Ruta para editar un monto, redirige a la vista de edicion
    Route::get('assign/support/edit/{class_id}',[DesignacionControlador::class,'DesignationEdit'])->name('assign.support.edit');
    // Ruta para editar un monto, al pulsar el boton y entregar el form
    Route::post('assign/support/update/{class_id}',[DesignacionControlador::class,'DesignationSupport'])->name('update.designation');
     // Ruta para ver los detalles de un monto
     Route::get('assign/support/details/{class_id}',[DesignacionControlador::class,'DesignationDelete'])->name('designation.delete');



});



