<?php

namespace App\Http\Controllers\Backend\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\EmployeeAttendance;
use App\Models\EmployeeLeave;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class ReporteAsistenciasControlador extends Controller
{
    public function AttendanceReportView(){
        $data['employees'] = User::where('usertype','Empleado')->get(); // Recuperamos los registros que sean de empleados
        return view('backend.report.attend_report.attend_report_view',$data);
    }

    public function ReportAttendanceGet(Request $request){
        $employee_id = $request->employee_id; // Recuperamos el id del nombre del empleado
        if($employee_id != ''){ // Si es campo no esta vacio, recupera la informacion
            $where[] = ['employee_id',$employee_id];
        }
        $date = date('Y-m',strtotime($request->date));
        if($date != ''){ // Si el campo no esta vacio
            $where[] = ['date','like',$date.'%'];
        }

        $singleAttendance = EmployeeAttendance::with(['user'])->where($where)->get(); // Usando la funcion del modelo, recuperamos los registros que coincidan con nuestras condiciones where

        if($singleAttendance == true){  // Si se encuentran registros con nuestra variable anteriormente mencionada
            $data['allData'] = EmployeeAttendance::with(['user'])->where($where)->get(); // Usando la misma condición, declaramos una variable para la vista
           // dd($data['allData']->toArray());
           $data['absents'] = EmployeeAttendance::with(['user'])->where($where)->where('attend_status','Ausente')->get()->count(); // Recuperamos todos los registros que coincidan con el estado de Ausente y contramos cuantos hay, eso equivale al total de faltas
           $data['leaves'] = EmployeeAttendance::with(['user'])->where($where)->where('attend_status','Justificado')->get()->count();
           $data['assist'] = EmployeeAttendance::with(['user'])->where($where)->where('attend_status','Presente')->get()->count(); // Recuperamos todos los registros que coincidan con el estado de Justificado y contramos cuantos hay
           $data['month'] = date('m-Y', strtotime($request->date)); // Recuperamos la fecha del campo, tomando solo el mes y el año
           $date = date('m-Y', strtotime($request->date));
           $pdf = PDF::loadView('backend.report.attend_report.report_pdf',$data);
           return $pdf->download('Reporte_Asistencias_'.$date.'.pdf');
        }else{
            $notification = array(
                'message' => 'No hay registros que coincidan con los datos introducidos ',
                'alert-type' => 'error'
            );
            // Desplegamos la notificación de exito en la view
            return redirect()->route('attendance.report.view')->with($notification);
        }
    }

}
