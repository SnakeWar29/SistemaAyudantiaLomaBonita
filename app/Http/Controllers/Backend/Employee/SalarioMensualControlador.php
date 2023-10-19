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
use App\Models\EmployeeAttendance;
//use DB;
use App\Models\EmployeeSallaryLog;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Barryvdh\DomPDF\Facade\Pdf as PDF;


class SalarioMensualControlador extends Controller
{
    public function EmployeeMonthlySalaryView(){
        return view('backend.employee.monthly_salary.monthly_salary_view');
    }

    public function EmployeeMonthlySalaryGet(Request $request){
        $date = date('Y-m',strtotime($request->date));
        if ($date !='') {
            $where[] = ['date','like',$date.'%'];  // Verificamos si los campos no estan vacios, es decir, la selección por defecto
        }
        $data = EmployeeAttendance::select('employee_id')->groupBy('employee_id')->with(['user'])->where($where)->get();
        // Usamos el modelo de la tabla de asistencias, para seleccionarlos y agruparlos por id, con el metodo user del modelo
        $html['thsource']  = '<th> # </th>';   // Usamos la variable thsource creada anteriormente en la vista para los encabezados
        $html['thsource'] .= '<th>Empleado</th>';
        $html['thsource'] .= '<th>Salario base</th>';
        $html['thsource'] .= '<th>Salario mensual</th>';
        $html['thsource'] .= '<th>Acción</th>';

        foreach ($data as $key => $attend) { // Por cada registro encontrado anteriormente
            $totalattend = EmployeeAttendance::with(['user'])->where($where)->where('employee_id',$attend->employee_id)->get(); // Recuperamos los empleados
            $absentcount = count($totalattend->where('attend_status','Ausente')); // Recuperamos los registros con justificación

            $color = 'success';
            $html[$key]['tdsource']  = '<td>'.($key+1).'</td>'; // Imprimimos todo el el tdsource, las filas de la tabla
            $html[$key]['tdsource'] .= '<td>'.$attend['user']['name'].'</td>'; // Recuperamos el nombre con el modelo
            $html[$key]['tdsource'] .= '<td>'.$attend['user']['salary'].' MXN$'.'</td>'; // Apuntamos al nombre del ciudadano

            // Empieza el calculo para el salario mensual dependiendo de las faltas
            $salary = (float)$attend['user']['salary']; // recuperamos el salario
            $salaryperday = (float)$salary/30; // Declaramos el salario por dia, dividiendo entre 30 (mes)
            $totalsalaryminus = (float)$absentcount*(float)$salaryperday; // recuperamos el cuento de los justificados y se multiplica por el salario por dia
            $totalsalary = (float)$salary-(float)$totalsalaryminus; // Restamos la cantidad al salario base

            $html[$key]['tdsource'] .='<td>'.number_format($totalsalary,3,'.').' MXN$'.'</td>';
            $html[$key]['tdsource'] .='<td>';
            $html[$key]['tdsource'] .='<a class="btn btn-sm btn-'.$color.'" title="PaySlip" target="_blanks" href="'.route("employee.monthly.salary.payslip",$attend->employee_id).'"> Consultar </a>';
            $html[$key]['tdsource'] .= '</td>';

        }
       return response()->json(@$html);
    }

    public function EmployeeMonthlySalaryPaySlip(Request $request,$employee_id){
        $id= EmployeeAttendance::where('employee_id',$employee_id)->first();
        $date = date('Y-m',strtotime($id->date));
        if ($date !='') {
            $where[] = ['date','like',$date.'%'];  // Verificamos si los campos no estan vacios, es decir, la selección por defecto
        }

        $data['details'] = EmployeeAttendance::with(['user'])->where($where)->where('employee_id',$id->employee_id)->get();
        $pdf = PDF::loadView('backend.employee.monthly_salary.monthly_salary_pdf',$data);
        return $pdf->download('Reporte_Tarifa_Ciudadano.pdf');
    }
}
