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
//use DB;
use App\Models\EmployeeSallaryLog;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class EmpleadoAusenciaControlador extends Controller
{
    public function EmployeeLeaveView(){
        $data['allData'] = EmployeeLeave::orderBy('id','desc')->get(); // Recuperamos la información de la tabla
        return view('backend.employee.employee_leave.employee_leave_view',$data);
    }

    public function EmployeeLeaveAdd(){
        $data['employees'] = User::where('usertype','Empleado')->get(); // Recuperamos los usuarios que coincidan con el tipo Empleado
        $data['leave_purpose'] = LeavePurpose::all(); // Recuperamos todos los motivos de ausencia pre-cargados
        return view('backend.employee.employee_leave.employee_leave_add',$data);
    }

    // ENTRADA - Opción seleccionada en las razones de ausencia
    // SALIDA
    // Caso 1 - Insercción de nueva razón de ausencia si el campo seleccionado es 0, es decir, otro
    // Insercción de datos de ausencia a BD / Notificación de éxito
    // Caso 2 - Insercción de una razón de ausencia previamente registrada
    // Insercción de datos de ausencia a BD / Notificación de éxito
    // Función para añadir la ausencia de un empleado
    public function EmployeeLeaveStore(Request $request){
        if($request->leave_purpose_id == "0"){ // Si el campo Otro esta seleccionado, se insertaran los datos de una nueva razón
            $leavepurpose = new LeavePurpose();
            $leavepurpose->name = $request->name;
            $leavepurpose->save();
            $leave_purpose_id = $leavepurpose->id; // Una vez que se guardo, se despliega
        }else{
            $leave_purpose_id = $request->leave_purpose_id;
        }

        // Empieza la insercción de datos
        $data = new EmployeeLeave();
        $data->employee_id = $request->employee_id;
        $data->leave_purpose_id = $leave_purpose_id;
        $data->start_date = date('Y-m-d',strtotime($request->start_date));
        $data->end_date = date('Y-m-d',strtotime($request->end_date));
        $data->save();

        // Retornamos vista con notificación
        $notification = array(
            'message' => 'Ausencia del empleado registrada éxitosamente',
            'alert-type' => 'success'
        );
        // Desplegamos la notificación de exito en la view
        return redirect()->route('employee.leave.view')->with($notification);
    }

    public function EmployeeLeaveEdit($id){
        $data['editData'] = EmployeeLeave::find($id); // Encontramos los datos de ausencia asociados con el id
        $data['employees'] = User::where('usertype','Empleado')->get(); // Obtenemos los usuarios que coincidan con empleado
        $data['leave_purpose'] = LeavePurpose::all(); // Obtenemos todas las razones de ausencia
        return view('backend.employee.employee_leave.employee_leave_edit',$data);
    }

    public function EmployeeLeaveUpdate(Request $request,$id){
        if($request->leave_purpose_id == "0"){ // Si el campo Otro esta seleccionado, se insertaran los datos de una nueva razón
            $leavepurpose = new LeavePurpose();
            $leavepurpose->name = $request->name;
            $leavepurpose->save();
            $leave_purpose_id = $leavepurpose->id; // Una vez que se guardo, se despliega
        }else{
            $leave_purpose_id = $request->leave_purpose_id;
        }

        // Empieza la insercción de datos
        $data = EmployeeLeave::find($id);
        $data->employee_id = $request->employee_id;
        $data->leave_purpose_id = $leave_purpose_id;
        $data->start_date = date('Y-m-d',strtotime($request->start_date));
        $data->end_date = date('Y-m-d',strtotime($request->end_date));
        $data->save();

        // Retornamos vista con notificación
        $notification = array(
            'message' => 'Ausencia del empleado actualizada exitosamente',
            'alert-type' => 'success'
        );
        // Desplegamos la notificación de exito en la view
        return redirect()->route('employee.leave.view')->with($notification);
    }

    public function EmployeeLeaveDelete($id){
        $leave = EmployeeLeave::find($id);
        $leave->delete();
        $notification = array(
            'message' => 'Ausencia del empleado eliminada exitosamente',
            'alert-type' => 'success'
        );
        // Desplegamos la notificación de exito en la view
        return redirect()->route('employee.leave.view')->with($notification);
    }


}
