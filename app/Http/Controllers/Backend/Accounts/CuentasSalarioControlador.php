<?php

namespace App\Http\Controllers\Backend\Accounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CitizenYear;
use App\Models\Designation;
use App\Models\CitizenClass;
use App\Models\CitizenGroup;
use App\Models\CitizenShift;
use App\Models\AssignCitizen;
use App\Models\DiscountCitizen;
use App\Models\EmployeeAttendance;
use App\Models\EmployeeSallaryLog;
use App\Models\AccountEmployeeSalary;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class CuentasSalarioControlador extends Controller
{
    // ======================================= INICIA SALARIO DE EMPLEADOS ========================== //
    public function AccountSalaryView(){
        $data['allData'] = AccountEmployeeSalary::all(); // Recuperamos los datos de los salarios pagados
        return view('backend.account.employee_salary.employee_salary_view',$data);
    }

    public function AccountSalaryAdd(){
        return view('backend.account.employee_salary.employee_salary_add');
    }

    public function AccountSalaryGet(Request $request){
        $date = date('Y-m',strtotime($request->date));
        if ($date !='') {
            $where[] = ['date','like',$date.'%'];  // Verificamos si los campos no estan vacios, es decir, la selección por defecto
        }
        $data = EmployeeAttendance::select('employee_id')->groupBy('employee_id')->with(['user'])->where($where)->get();
        // Usamos el modelo de la tabla de asistencias, para seleccionarlos y agruparlos por id, con el metodo user del modelo
        $html['thsource']  = '<th> # </th>';   // Usamos la variable thsource creada anteriormente en la vista para los encabezados
        $html['thsource'] .= '<th>ID Identificativo</th>';
        $html['thsource'] .= '<th>Empleado</th>';
        $html['thsource'] .= '<th>Salario base</th>';
        $html['thsource'] .= '<th>Salario mensual</th>';
        $html['thsource'] .= '<th>¿Pago entregado?</th>';

        foreach ($data as $key => $attend) { // Por cada registro encontrado anteriormente

            $account_salary = AccountEmployeeSalary::where('employee_id',$attend->employee_id)->where('date',$date)->first();

            if($account_salary !=null) { // Si se recuperaron registros con exito..... (no es nulo)
                $checked = 'checked'; // Se marca como revisado
            }else{ // Si no se encontraron registros ...
                $checked = ''; // No se marca como revisado
            }

            $totalattend = EmployeeAttendance::with(['user'])->where($where)->where('employee_id',$attend->employee_id)->get(); // Recuperamos los empleados
            $absentcount = count($totalattend->where('attend_status','Ausente')); // Recuperamos los registros con ausencia

            $color = 'success';
            $html[$key]['tdsource']  = '<td>'.($key+1).'</td>'; // Imprimimos todo el el tdsource, las filas de la tabla
            $html[$key]['tdsource'] .= '<td>'.$attend['user']['id_no'].'<input type="hidden" name="date" value="'.$date.'">'.'</td>'; // Recuperamos el nombre con el modelo
            $html[$key]['tdsource'] .= '<td>'.$attend['user']['name'].'</td>';
            $html[$key]['tdsource'] .= '<td>'.$attend['user']['salary'].' MXN$'.'</td>'; // Apuntamos al nombre del ciudadano

            // Empieza el calculo para el salario mensual dependiendo de las faltas
            $salary = (float)$attend['user']['salary']; // recuperamos el salario
            $salaryperday = (float)$salary/30; // Declaramos el salario por dia, dividiendo entre 30 (mes)
            $totalsalaryminus = (float)$absentcount*(float)$salaryperday; // recuperamos el cuento de los justificados y se multiplica por el salario por dia
            $totalsalary = (float)$salary-(float)$totalsalaryminus; // Restamos la cantidad al salario base

            $html[$key]['tdsource'] .='<td>'.number_format($totalsalary,2,'.').'<input type="hidden" name="amount[]" value="'.$totalsalary.'">'.' MXN$'.'</td>';
            $html[$key]['tdsource'] .='<td>'.'<input type="hidden" name="employee_id[]" value="'.$attend->employee_id.'">'.'<input type="checkbox" name="checkmanage[]" id="'.$key.'" value="'.$key.'" '.$checked.' style="transform: scale(1.5);margin-left: 10px;"> <label for="'.$key.'"> </label> '.'</td>';

        }
       return response()->json(@$html);
    }

    public function AccountSalaryStore(Request $request){
        $date = date('Y-m',strtotime($request->date)); // Recuperamos la fecha en el campo
        //Buscamos el registro en la tabla, si se encuentra se eliminara para automaticamente volverse a insertar
        AccountEmployeeSalary::where('date',$date)->delete();

        // Comprobamos si la checkbox de la vista fue seleccionada o no, es decir, si el tramite fue pagado o no.
        $checkData = $request->checkmanage;

        if($checkData != null){  // Cuando la checbox sea diferente a nulo, es decir, fue marcada como pagada, entonces se introduciran esos datos como "PAGADOS"
            for ($i=0; $i < count($checkData) ;$i++){ //Empieza ciclo for para insertar cada uno de los datos
                $data = new AccountEmployeeSalary(); // Crearmos un nuevo objeto del modelo para insertar datos
                $data->date = $date;
                $data->employee_id = $request->employee_id[$checkData[$i]];
                $data->amount = $request->amount[$checkData[$i]];
                $data->save();
            }
        }

        if(!empty(@$data) || empty($checkData)){ // Si se registran los datos correctamente
            $notification = array(
                'message' => 'Pago de tarifa registrado correctamente',
                'alert-type' => 'success'
            );
            // Desplegamos la notificación de exito en la view
            return redirect()->route('account.salary.view')->with($notification);
        }else{
            $notification = array(
                'message' => 'Ocurrio un error al registrar el pago, verifique los datos',
                'alert-type' => 'error'
            );
            // Desplegamos la notificación de error en la view
            return redirect()->back()->with($notification);
        }
    }


}
