<?php

namespace App\Http\Controllers\Backend\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\AccountCitizenFee;
use App\Models\AccountOtherCost;
use App\Models\AccountEmployeeSalary;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class GananciasControlador extends Controller
{
    public function MonthlyProfitView(){
        return view('backend.report.profit.profit_view');
    }

    public function MonthlyProfitGet(Request $request){
        $start_date = date('Y-m',strtotime($request->start_date));
        $end_date = date('Y-m',strtotime($request->end_date)); // Recuperamos los rangos de fecha definidos en la vista
        $sdate = date('Y-m-d',strtotime($request->start_date)); // Se crean variables similares pero con el formato Y-M-D para coincidir con las tablas de otros costos
        $edate = date('Y-m-d',strtotime($request->end_date));

        // Recuperamos los datos de la cuenta de tarifa de ciduadanos donde el campo de su fecha, coincida entre la fecha inicial y final, se suma todas las cantidades
        $citizen_fee = AccountCitizenFee::whereBetween('date',[$start_date,$end_date])->sum('amount');
        // Recuperamos los datos de los costos adicionales donde el campo de su fecha, coincida entre la fecha inicial y final, se suma todas las cantidades
        $other_cost = AccountOtherCost::whereBetween('date',[$sdate,$edate])->sum('amount');
        // Recuperamos los datos del salario de los empleados donde el campo de su fecha, coincida entre la fecha inicial y final, se suma todas las cantidades
        $emp_salary = AccountEmployeeSalary::whereBetween('date',[$start_date,$end_date])->sum('amount');

        // Se define una variable con el total de gastos usando las variables anteriores
        $total_cost = $other_cost+$emp_salary;
        // Se define una variable con las ganancias totales, estas siendo las tarifas pagadas de ciudadanos menos los costos anteriores
        $profit = $citizen_fee-$total_cost;

        $html['thsource']  = '<th>Tarifa de los ciudadanos</th>';
        $html['thsource'] .= '<th>Costos adicionales</th>';
        $html['thsource'] .= '<th>Salario de empleados pagados</th>';
        $html['thsource'] .= '<th>Total de gastos</th>';
        $html['thsource'] .= '<th>Ganancias</th>';
        $html['thsource'] .= '<th>Acción</th>';

        $color = 'success';

        $html['tdsource']  = '<td>'.number_format($citizen_fee,2,'.').' MXN$'.'</td>';
        $html['tdsource']  .= '<td>'.number_format($other_cost,2,'.').' MXN$'.'</td>';
        $html['tdsource']  .= '<td>'.number_format($emp_salary,2,'.').' MXN$'.'</td>';
        $html['tdsource']  .= '<td>'.number_format($total_cost,2,'.').' MXN$'.'</td>';
        $html['tdsource']  .= '<td>'.number_format($profit,2,'.').' MXN$'.'</td>';
        $html['tdsource'] .='<td>';
            $html['tdsource'] .='<a class="btn btn-sm btn-'.$color.'" title="PDF" target="_blanks" href="'.route("report.profit.pdf").'?start_date='.$sdate.'&end_date='.$edate.'"> Consultar </a>';
            $html['tdsource'] .= '</td>';

            return response()->json(@$html);
    }

    public function MonthlyProfitReport(Request $request){
        $data['start_date'] = date('Y-m',strtotime($request->start_date));
        $data['end_date'] = date('Y-m',strtotime($request->end_date));
        $data['sdate'] = date('Y-m-d',strtotime($request->start_date));
        $data['edate'] = date('Y-m-d',strtotime($request->end_date));

        $firtsdate = date('Y-m-d',strtotime($request->start_date)); // Se crean variables similares pero con el formato Y-M-D para coincidir con las tablas de otros costos
        $enddate = date('Y-m-d',strtotime($request->end_date));

        $pdf = PDF::loadView('backend.report.profit.report_pdf',$data);
        return $pdf->download('Reporte_Ganancia_Rango_'.$firtsdate.'_'.$enddate.'.pdf');
    }
}
