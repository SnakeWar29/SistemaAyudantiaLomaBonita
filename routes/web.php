<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BaseDatosControlador;
use App\Http\Controllers\AdminControlador;
use App\Http\Controllers\Backend\UsuarioControlador;
use App\Http\Controllers\Backend\PerfilControlador;
use App\Http\Controllers\Backend\ControladorPredeterminado;

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

use App\Http\Controllers\Backend\Citizen\CiudadanoRegistroControlador;
use App\Http\Controllers\Backend\Citizen\CiudadanoRolControlador;
use App\Http\Controllers\Backend\Citizen\TarifaRegistroControlador;
use App\Http\Controllers\Backend\Citizen\TarifaMensualControlador;

use App\Http\Controllers\Backend\Employee\EmpleadoRegistroControlador;
use App\Http\Controllers\Backend\Employee\EmpleadoSalarioControlador;
use App\Http\Controllers\Backend\Employee\EmpleadoAusenciaControlador;
use App\Http\Controllers\Backend\Employee\EmpleadoAsistenciaControlador;
use App\Http\Controllers\Backend\Employee\SalarioMensualControlador;

use App\Http\Controllers\Backend\Supports\EntregaApoyoControlador;
use App\Http\Controllers\Backend\Supports\EstadoApoyoControlador;

use App\Http\Controllers\Backend\Accounts\CiudadanoTarifaControlador;
use App\Http\Controllers\Backend\Accounts\CuentasSalarioControlador;
use App\Http\Controllers\Backend\Accounts\CostosAdicionalesControlador;

use App\Http\Controllers\Backend\Report\GananciasControlador;
use App\Http\Controllers\Backend\Report\ReporteAsistenciasControlador;

use App\Http\Controllers\GraficasControlador;
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

Route::group(['middleware' => 'prevent-back-history'],function(){ // Middleware para prevenir el almacenamiento del cache en pestañas anteriores

// Ruta inicial, en esta ruta sera donde inicie le usuario cuando entre al sistema por primera vez
Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.index'); // Regresa la vista index del admin cuando se loguea con exito
    })->name('dashboard');
});

// Ruta para poder cerrar sesión, esta vinculada al boton Logout en el header, permitiendo cerrar sesión en todo momento
Route::get('/admin/logout',[AdminControlador::class,'Logout'])->name('admin.logout');

// -----------  Rutas para poder realizar la administración de los usuarios registrados en el sistema  ------------
// Este grupo se encargara de almacenar todos las rutas relacionadas con la administracion de los usuarios
Route::group([
    'prefix' => 'users',
    'middleware' => ['auth:sanctum',config('jetstream.auth_session'),'verified'],
], function(){
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
Route::group([
    'prefix' => 'profile',
    'middleware' => ['auth:sanctum',config('jetstream.auth_session'),'verified'],
], function(){
    // Ruta para mostrar la información del perfil actual
    Route::get('/view',[PerfilControlador::class,'ProfileView'])->name('profile.view');
    // Ruta para poder modificar el perfil del usuario desde Mi Perfil
    Route::get('/edit',[PerfilControlador::class,'ProfileEdit'])->name('profile.edit');
    // Ruta para editar el perfil desde Mi Perfil junto con la foto
    Route::post('/store',[PerfilControlador::class,'ProfileStore'])->name('profile.store');
    // Ruta para ver la vista de cambiar la contraseña desde Mi Perfil
    Route::get('/password/view',[PerfilControlador::class,'PasswordView'])->name('password.view');
    // Ruta para cambiar la contraseña desde mi perfil
    Route::post('/password/update',[PerfilControlador::class,'PasswordUpdate'])->name('password.update.login');

});

// -----------  Rutas para la Gestion general  ------------
Route::group([
    'prefix' => 'setups',
    'middleware' => ['auth:sanctum',config('jetstream.auth_session'),'verified'],
], function(){
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
    Route::post('designation/store',[DesignacionControlador::class,'DesignationStore'])->name('store.designation');
    // Ruta para editar un monto, redirige a la vista de edicion
    Route::get('designation/edit/{id}',[DesignacionControlador::class,'DesignationEdit'])->name('designation.edit');
    // Ruta para editar un monto, al pulsar el boton y entregar el form
    Route::post('designation/update/{id}',[DesignacionControlador::class,'DesignationSupport'])->name('update.designation');
     // Ruta para ver los detalles de un monto
     Route::get('designation/delete/{id}',[DesignacionControlador::class,'DesignationDelete'])->name('designation.delete');



});

// -----------  Rutas para  la administracion de ciudadano  ------------
// ENTRADA - Acciones del usuario
// SALIDA - Redireccionamiento a distintas vistas
Route::group([
    'prefix' => 'citizens',
    'middleware' => ['auth:sanctum',config('jetstream.auth_session'),'verified'],
], function(){
    Route::get('/reg/view',[CiudadanoRegistroControlador::class,'CitizenRegView'])->name('citizen.registration.view');
    // Ruta para redirigir a la vista de añadir ciudadano
    Route::get('/reg/add',[CiudadanoRegistroControlador::class,'CitizenRegAdd'])->name('citizen.registration.add');
    // Ruta para añadir al ciudadano al presionar el boton
    Route::post('/reg/store',[CiudadanoRegistroControlador::class,'CitizenRegStore'])->name('store.citizen.registration');
    // Ruta para redirigir a los resultados de la busqueda
    Route::get('/year/class/wise',[CiudadanoRegistroControlador::class,'CitizenClassYearWise'])->name('citizen.year.class.wise');
    // Ruta para redirigir a la vista de edicion del ciudadano
    Route::get('/reg/edit/{citizen_id}',[CiudadanoRegistroControlador::class,'CitizenRegEdit'])->name('citizen.registration.edit');
    // Ruta para editar al ciudadano al presionar el boton
    Route::post('/reg/update/{citizen_id}',[CiudadanoRegistroControlador::class,'CitizenRegUpdate'])->name('update.citizen.registration');
    // Ruta para promover al ciudadano
    Route::get('/reg/promotion/{citizen_id}',[CiudadanoRegistroControlador::class,'CitizenRegPromotion'])->name('citizen.registration.promotion');
    // Ruta para promocionar al ciudadano al presionar el boton
    Route::post('/reg/update/promotion/{citizen_id}',[CiudadanoRegistroControlador::class,'CitizenUpdatePromotion'])->name('promotion.citizen.registration');
    // Ruta para generar el pdf del ciudadano individual
    Route::get('/reg/details/{citizen_id}',[CiudadanoRegistroControlador::class,'CitizenRegDetails'])->name('citizen.registration.details');
    // Ruta para eliminar el ciudadano
    Route::get('/reg/delete/{citizen_id}',[CiudadanoRegistroControlador::class,'CitizenRegDelete'])->name('citizen.registration.delete');


    // Ruta para mostrar la vista de generación de rol
    Route::get('/rol/generate/view',[CiudadanoRolControlador::class,'CitizenRolView'])->name('rol.generate.view');
    // Ruta para recuperar los ciudadanos del form con JavaScript
    Route::get('/reg/getcitizens',[CiudadanoRolControlador::class,'GetCitizens'])->name('citizen.registration.getcitizens');
    // Ruta para asignar el rol en el form
    Route::post('/reg/roll/store',[CiudadanoRolControlador::class,'CitizenRollStore'])->name('roll.generate.store');


    // Rutas para mostrar la vista de la tarifa de registro
    Route::get('/reg/fee/view',[TarifaRegistroControlador::class,'RegFeeView'])->name('registration.fee.view');
    // Ruta para recuperar la tarifa de los ciudadanos
    Route::get('/reg/fee/classwisedata',[TarifaRegistroControlador::class,'RegFeeClassData'])->name('citizen.registration.fee.classwise.get');
    // ruta para el PDF de la tarifa de registro
    Route::get('/reg/fee/payslip',[TarifaRegistroControlador::class,'RegFeePayslip'])->name('citizen.registration.fee.payslip');


    // Rutas para mostrar la vita de la tarifa de registro
    Route::get('/monthly/fee/view',[TarifaMensualControlador::class,'MonthlyFeeView'])->name('monthly.fee.view');
    // Ruta para recuperar la tarifa de los ciudadanos
    Route::get('/monthly/fee/classwisedata',[TarifaMensualControlador::class,'MonthlyFeeClassData'])->name('citizen.monthly.fee.classwise.get');
    // ruta para el PDF de la tarifa de registro
    Route::get('/monthly/fee/payslip',[TarifaMensualControlador::class,'MonthlyFeePayslip'])->name('citizen.monthly.fee.payslip');


});

// -----------  Rutas para la administración de los empleados  ------------
Route::group([
    'prefix' => 'employees',
    'middleware' => ['auth:sanctum',config('jetstream.auth_session'),'verified'],
], function(){
    // Ruta para mostrar la vista de los empleados
    Route::get('reg/employee/view',[EmpleadoRegistroControlador::class,'EmployeeView'])->name('employee.registration.view');
    // Ruta para mostrar la vista para añadir empleados
    Route::get('reg/employee/add',[EmpleadoRegistroControlador::class,'EmployeeAdd'])->name('employee.registration.add');
    // Ruta para añadir el empleado, al pulsar el botón
    Route::post('reg/employee/store',[EmpleadoRegistroControlador::class,'EmployeeStore'])->name('store.employee.registration');
     // Ruta para mostrar la vista de edición
     Route::get('reg/employee/edit/{id}',[EmpleadoRegistroControlador::class,'EmployeeEdit'])->name('employee.registration.edit');
       // Ruta para editar el empleado, al pulsar el botón
    Route::post('reg/employee/update/{id}',[EmpleadoRegistroControlador::class,'EmployeeUpdate'])->name('update.employee.registration');
    // Ruta para mostrar el PDF de un empleado
    Route::get('reg/employee/details/{id}',[EmpleadoRegistroControlador::class,'EmployeeDetails'])->name('employee.registration.details');
    // Ruta para eliminar un empleado
    Route::get('reg/employee/delete/{id}',[EmpleadoRegistroControlador::class,'EmployeeDelete'])->name('employee.registration.delete');

    // Rutas para el salario del empleados
    // Ruta para mostrar la vista del salario de empleados
    Route::get('salary/employee/view',[EmpleadoSalarioControlador::class,'EmployeeSalaryView'])->name('employee.salary.view');
    // Ruta para mostrar la vista incremento de salario de los empleados
    Route::get('salary/employee/increment/{id}',[EmpleadoSalarioControlador::class,'EmployeeSalaryIncrement'])->name('employee.salary.increment');
    // Ruta para actualizar el campo de incremento y el efecto del salario
    Route::post('salary/employee/store/{id}',[EmpleadoSalarioControlador::class,'EmployeeSalaryStore'])->name('update.salary');
    // Ruta para mostrar la vista incremento de salario de los empleados
    Route::get('salary/employee/details/{id}',[EmpleadoSalarioControlador::class,'EmployeeSalaryDetails'])->name('employee.salary.details');

    // Rutas para los dias de ausencia de los empleados
    // Ruta para mostrar la vista de ausencia de los empleados
    Route::get('leave/employee/view',[EmpleadoAusenciaControlador::class,'EmployeeLeaveView'])->name('employee.leave.view');
    // Ruta para mostrar la vista para añadir una ausencia de los empleados
    Route::get('leave/employee/add',[EmpleadoAusenciaControlador::class,'EmployeeLeaveAdd'])->name('employee.leave.add');
    // Ruta para añadir la razón de ausencia de empleados, al presionar el boton
    Route::post('leave/employee/store',[EmpleadoAusenciaControlador::class,'EmployeeLeaveStore'])->name('store.employee.leave');
    // Ruta para mostrar la vista de edición
    Route::get('leave/employee/edit/{id}',[EmpleadoAusenciaControlador::class,'EmployeeLeaveEdit'])->name('employee.leave.edit');
    // Ruta para editar la razón de ausencia, al presionar el botón
    Route::post('leave/employee/update/{id}',[EmpleadoAusenciaControlador::class,'EmployeeLeaveUpdate'])->name('update.employee.leave');
    // Ruta para mostrar la vista de edición
    Route::get('leave/employee/delete/{id}',[EmpleadoAusenciaControlador::class,'EmployeeLeaveDelete'])->name('employee.leave.delete');

    // Rutas para la lista de asistencia de empleados
    // ENTRADA - Acciones del usuario
    // SALIDA - Redireccionamiento a distintas vistas
    // Ruta para mostrar la vista de la lista de asistencia
    Route::get('attendance/employee/view',[EmpleadoAsistenciaControlador::class,'EmployeeAttendanceView'])->name('employee.attendance.view');
    // Ruta para mostrar la vista para añadir asistencias
    Route::get('attendance/employee/add',[EmpleadoAsistenciaControlador::class,'EmployeeAttendanceAdd'])->name('employee.attendance.add');
    // Ruta para añadir la lista de asistencia al presionar el boton
    Route::post('attendance/employee/store',[EmpleadoAsistenciaControlador::class,'EmployeeAttendanceStore'])->name('employee.attendance.store');
    // Ruta para mostrar la vista para añadir asistencias
    Route::get('attendance/employee/edit/{date}',[EmpleadoAsistenciaControlador::class,'EmployeeAttendanceEdit'])->name('employee.attendance.edit');
    // Ruta para mostrar la vista para añadir asistencias
    Route::get('attendance/employee/details/{date}',[EmpleadoAsistenciaControlador::class,'EmployeeAttendanceDetails'])->name('employee.attendance.details');


     // Rutas para el salario mensual
    // Ruta para mostrar la vista del salario mensual
    Route::get('monthly/salary/view',[SalarioMensualControlador::class,'EmployeeMonthlySalaryView'])->name('employee.monthly.salary.view');
    // Ruta para mostrar los datos recuperados
    Route::get('monthly/salary/get',[SalarioMensualControlador::class,'EmployeeMonthlySalaryGet'])->name('employee.monthly.salary.get');
    // Ruta para el el reporte del salario mensual
    Route::get('monthly/salary/payslip/{employee_id}',[SalarioMensualControlador::class,'EmployeeMonthlySalaryPaySlip'])->name('employee.monthly.salary.payslip');
});

// -----------  Rutas para la administración de los apoyos  ------------
Route::group([
    'prefix' => 'supports',
    'middleware' => ['auth:sanctum',config('jetstream.auth_session'),'verified'],
], function(){
    // Ruta para mostrar
    Route::get('supports/entry/add',[EntregaApoyoControlador::class,'SupportsAdd'])->name('supports.entry.add');
    // Ruta para añadir el apoyo otorgado
    Route::post('supports/entry/store',[EntregaApoyoControlador::class,'SupportsStore'])->name('supports.entry.store');
    // Ruta para mostrar la edición del apoyo otorgado
    Route::get('supports/entry/edit',[EntregaApoyoControlador::class,'SupportsEdit'])->name('supports.entry.edit');
    // Ruta para recuperar los ciudadanos por año y clase en la edición
     Route::get('citizen/supports/edit/getcitizens',[EntregaApoyoControlador::class,'getCitizensEdit'])->name('citizen.edit.get');
     // Ruta para editar la asignación de apoyo
    Route::post('supports/entry/edit/store',[EntregaApoyoControlador::class,'SupportsEditStore'])->name('supports.entry.edit.store');
});

// Ruta para recuperar los apoyos por clase
    Route::get('supports/getsupports',[ControladorPredeterminado::class,'getSupport'])->name('marks.getsupports');
// Ruta para recuperar los ciudadanos por año y clase
    Route::get('citizen/supports/getcitizens',[ControladorPredeterminado::class,'getCitizens'])->name('citizen.support.getcitizens');


// -----------  Rutas para la tarifa de los ciudadanos  ------------
    Route::group([
        'prefix' => 'accounts',
        'middleware' => ['auth:sanctum',config('jetstream.auth_session'),'verified'],
    ], function(){
        // ==================== Tarifa ciudadanos ================
        // Ruta para mostrar la vista de la tarifa de ciudadanos
        Route::get('citizen/fee/view',[CiudadanoTarifaControlador::class,'CitizenFeeView'])->name('citizen.fee.view');
        // Ruta para mostrar la vista para añadir/editar una tarifa
        Route::get('citizen/fee/add',[CiudadanoTarifaControlador::class,'CitizenFeeAdd'])->name('citizen.fee.add');
        // Ruta para obtener los ciudadanos usando los filtros
        Route::get('citizen/fee/getcitizens',[CiudadanoTarifaControlador::class,'CitizenFeeGet'])->name('account.fee.getcitizens');
        // Ruta para añadir las tarifas de los ciudadano
        Route::post('citizen/fee/store',[CiudadanoTarifaControlador::class,'CitizenFeeStore'])->name('account.fee.store');

        // ==================== Salario empleados ================
        // Ruta para mostrar la vista del salario de los empleados
        Route::get('account/salary/view',[CuentasSalarioControlador::class,'AccountSalaryView'])->name('account.salary.view');
        // Ruta para mostrar la vista para añadir el salario de los empleados
        Route::get('account/salary/add',[CuentasSalarioControlador::class,'AccountSalaryAdd'])->name('account.salary.add');
        // Ruta para recuperar los empleados
        Route::get('account/salary/get',[CuentasSalarioControlador::class,'AccountSalaryGet'])->name('account.salary.getemployee');
        // Ruta para añadir el salario de los empleados
        Route::post('account/salary/store',[CuentasSalarioControlador::class,'AccountSalaryStore'])->name('account.salary.store');

        // ==================== Costos adicionales ================
        // Ruta para mostrar la vista de costos adicionales
        Route::get('other/cost/view',[CostosAdicionalesControlador::class,'OtherCostView'])->name('other.cost.view');
        // Ruta para mostrar la vista para añadir un costo adicional
        Route::get('other/cost/add',[CostosAdicionalesControlador::class,'OtherCostAdd'])->name('other.cost.add');
        // Ruta para añadir otros costos a la tabla de la BD
        Route::post('other/cost/store',[CostosAdicionalesControlador::class,'OtherCostStore'])->name('store.other.cost');
        // Ruta para editar un costo adicional
        Route::get('other/cost/edit/{id}',[CostosAdicionalesControlador::class,'OtherCostEdit'])->name('other.cost.edit');
        // Ruta para añadir otros costos a la tabla de la BD
        Route::post('other/cost/update/{id}',[CostosAdicionalesControlador::class,'OtherCostUpdate'])->name('update.other.cost');
    });

        // -----------  Rutas para los reportes generales  ------------
        Route::group([
            'prefix' => 'reports',
            'middleware' => ['auth:sanctum',config('jetstream.auth_session'),'verified'],
        ], function(){
            // REPORTES DE GANANCIAS
            // Ruta para mostrar la interfaz de la ganancia
            Route::get('/monthly/profit/view',[GananciasControlador::class,'MonthlyProfitView'])->name('monthly.profit.view');
            // Ruta para recuperar los datos con las fechas
            Route::get('/monthly/profit/get',[GananciasControlador::class,'MonthlyProfitGet'])->name('report.profit.get');
            // Ruta para la plantilla del PDF
            Route::get('/monthly/profit/pdf',[GananciasControlador::class,'MonthlyProfitReport'])->name('report.profit.pdf');

            // REPORTES DE ASISTENCIA
            // Ruta para mostrar la interfaz de la ganancia
            Route::get('/attendance/report/view',[ReporteAsistenciasControlador::class,'AttendanceReportView'])->name('attendance.report.view');
            // Ruta para recuperar los datos con las fechas
            Route::get('/attendance/report/get',[ReporteAsistenciasControlador::class,'ReportAttendanceGet'])->name('report.attendance.get');

            // Ruta para mostrar todos las graficas de datos de los ciudadanos
            Route::get('/citizens/graphs/view',[GraficasControlador::class,'CitizensGraphsView'])->name('citizen.graph.view');
             // Ruta para mostrar el PDF de clases de ciudadanos en graficas
             Route::get('/citizens/graphs/classes/pdf',[GraficasControlador::class,'CitizensGraphsClass'])->name('citizen.graph.class');
             // Ruta para mostrar el PDF de años del ciudadano
             Route::get('/citizens/graphs/year/pdf',[GraficasControlador::class,'CitizensGraphsYear'])->name('citizen.graph.year');
        });

        // -----------  Rutas para los graficos  ------------
        Route::group([
            'prefix' => 'graphs',
            'middleware' => ['auth:sanctum',config('jetstream.auth_session'),'verified'],
        ], function(){
            Route::get('/citizen/graph/view',[GraficasControlador::class,'piechart'])->name('pie.citizen.chart');
            Route::get('/citizen/graph/classes',[GraficasControlador::class,'CitizenGraphOne'])->name('classes.citizen.chart');
        });

        // -----------  Rutas para la exportacion o importacion  ------------
        // ENTRADA - Acciones del usuario
        // SALIDA - Redireccionamiento a distintas vistas
         Route::group([
            'prefix' => 'database',
            'middleware' => ['auth:sanctum',config('jetstream.auth_session'),'verified'],
         ], function(){
            // Ruta para mostrar la vita de la importacion de ciudadanos/empleados/usuarios
            Route::get('/database/import/view',[BaseDatosControlador::class,'Import'])->name('database.import.view');
            // Ruta para realizar la importacion
            Route::post('/database/import/execute',[BaseDatosControlador::class,'ImportExecute'])->name('database.import.execute');
            // Ruta para exportar ciudadanos/empleados/usuarios
            Route::get('/database/export/execute',[BaseDatosControlador::class,'ExportExecute'])->name('database.export.execute');
            // Ruta para exportar clase de los ciudadanos
            Route::get('/database/citizens/class',[BaseDatosControlador::class,'ExportCitizensClassData'])->name('database.citizens.class');
            // Ruta para exportar grupo de los ciudadanos
            Route::get('/database/citizens/group',[BaseDatosControlador::class,'ExportCitizensGroupData'])->name('database.citizens.group');
            // Ruta para exportar turno de los ciudadanos
            Route::get('/database/citizens/shift',[BaseDatosControlador::class,'ExportCitizensShiftData'])->name('database.citizens.shift');
            // Ruta para exportar año de los ciudadanos
            Route::get('/database/citizens/year',[BaseDatosControlador::class,'ExportCitizensYearData'])->name('database.citizens.year');
            // Ruta para exportar ña asignación de los ciudadanos
            Route::get('/database/citizens/assignation',[BaseDatosControlador::class,'ExportCitizensAssignData'])->name('database.citizens.assignation');
            // Ruta para realizar la importacion de la asignación de ciudadanos
            Route::post('/database/import/assign',[BaseDatosControlador::class,'ImportAssignCitizensExecute'])->name('database.import.assign.citizens');
            // Ruta para exportar la BD completa
            Route::get('/database/complete/export',[BaseDatosControlador::class,'respaldo'])->name('database.complete.export');
            // Ruta para importar la BD completa
            Route::post('/database/complete/import',[BaseDatosControlador::class,'restauracion'])->name('database.complete.import');

         });
});




