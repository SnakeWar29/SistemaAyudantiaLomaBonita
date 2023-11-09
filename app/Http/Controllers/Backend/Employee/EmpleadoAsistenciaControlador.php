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
use App\Models\LeavePurpose;
use App\Models\EmployeeLeave;
use App\Models\EmployeeAttendance;
//use DB;
use App\Models\EmployeeSallaryLog;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class EmpleadoAsistenciaControlador extends Controller
{
    public function EmployeeAttendanceView(){
        $data['allData']= EmployeeAttendance::select('date')->groupBy('date')->orderBy('id','DESC')->get(); // Recuperamos los datos de la lista de asistencia ordenados por ID
        return view('backend.employee.employee_attendance.employee_attendance_view',$data);
    }

    public function EmployeeAttendanceAdd(){
        $data['employees'] = User::where('usertype','Empleado')->get();
        return view('backend.employee.employee_attendance.employee_attendance_add',$data);
    }

    // ENTRADA - Fecha de pase de lista seleccionada en la vista
    // SALIDA - Insercción masiva de la asistencia de los empleados vinculados a la fecha de entrada / Notificación de éxito
    // Función para añadir pase de lista para todos los empleados
    public function EmployeeAttendanceStore(Request $request){
        EmployeeAttendance::where('date',date('Y-m-d', strtotime($request->date)))->delete(); // Eliminamos todos los registros anteriores y los sobreescribimos
        $countemployee = count($request->employee_id); // Recuperamos los ID de los empleados
        for ($i=0; $i<$countemployee ; $i++){   // Inicia en bucle que se repetira hasta que pase por todos los empleados
            $attend_status = 'attend_status'.$i; // Usamos la variable para almacenar cada estado de cada empleado
            $attend = new EmployeeAttendance(); // Empezamos insercción de datos dentro de la tabla de asistencia de empleados
            $attend->date=date('Y-m-d',strtotime($request->date));
            $attend->employee_id = $request->employee_id[$i]; // Usando el arreglo, almacenamos cada informacion de cada empleado
            $attend->attend_status = $request-> $attend_status;
            $attend->save();
        }
         // Retornamos vista con notificación
         $notification = array(
            'message' => '¡Pase de lista completado! Si la fecha es repetida, se actualizará',
            'alert-type' => 'success'
        );
        // Desplegamos la notificación de exito en la view
        return redirect()->route('employee.attendance.view')->with($notification);
    }

    public function EmployeeAttendanceEdit($date){
        $data['editData'] = EmployeeAttendance::where('date',$date)->get(); //Recuperamos todas las fechas que coincidan con date
        $data['employees'] = User::where('usertype','Empleado')->get(); // Recuperamos los empleados
        return view('backend.employee.employee_attendance.employee_attendance_edit',$data);
    }

    public function EmployeeAttendanceDetails($date){
        $data['details'] = EmployeeAttendance::where('date',$date)->get(); //Recuperamos todas las fechas que coincidan con date
        return view('backend.employee.employee_attendance.employee_attendance_details',$data);
    }
}
