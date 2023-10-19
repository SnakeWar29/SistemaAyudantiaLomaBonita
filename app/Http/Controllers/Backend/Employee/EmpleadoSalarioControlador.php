<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use App\Models\CitizenYear;
use App\Models\Designation;
use App\Models\CitizenClass;
use App\Models\CitizenGroup;
use App\Models\CitizenShift;
//use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\AssignCitizen;
use App\Models\DiscountCitizen;
//use DB;
use App\Models\EmployeeSallaryLog;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class EmpleadoSalarioControlador extends Controller
{
    public function EmployeeSalaryView(){
        $data['allData'] = User::where('usertype','Empleado')->get(); // Recuperamos todos los usuarios que sean Empleados
        return view('backend.employee.employee_salary.employee_salary_view',$data);
    }

    public function EmployeeSalaryIncrement($id){
        $data['editData'] = User::find($id);
        return view('backend.employee.employee_salary.employee_salary_increment',$data);
    }

    public function EmployeeSalaryStore(Request $request, $id){
        $user = User::find($id); // Recuperamos el ID del empleado afectado
        $previous_salary = $user->salary; // Declaramos su salario actual como el previo
        $present_salary = (float)$previous_salary + (float)$request->increment_salary; // El salario actual sera el salario previo (base) + el incremento
        $user->salary =  $present_salary; // Se actualiza el salario de la tabla donde esta el empleado por el salario presente
        $user->save();

        $salaryData = new EmployeeSallaryLog();
        $salaryData->employee_id = $id;  // Relacionamos el id del empleado de la tabla de registro de salario con el ID del empleado
        $salaryData->previous_salary =  $previous_salary; // Guardamos el salario previo con la variable anterior
        $salaryData->increment_salary =  $request->increment_salary; // Asignamos el incremento con el dato que se relleno en la vista
        $salaryData->present_salary =  $present_salary; // Guardamos el salario actual con la variable anterior
        $salaryData->effected_salary =  date('Y-m-d', strtotime($request->effected_salary)); // Guardamos la fecha de efecto del salario usando el campo de la vista
        $salaryData->save();

        $notification = array(
            'message' => 'Salario incrementado de forma correcta',
            'alert-type' => 'success'
        );
        // Desplegamos la notificación de exito en la view
        return redirect()->route('employee.salary.view')->with($notification);
    }

    public function EmployeeSalaryDetails($id){
        $data['details'] = User::find($id);
        $data['salary_log'] = EmployeeSallaryLog::where('employee_id',  $data['details']->id)->get(); // Vinculamos el id del empleado con su id dentro de la tabla de historial de salario
        // dd($data['salary_log']->toArray());
        return view('backend.employee.employee_salary.employee_salary_details',$data);
    }

}
