<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CitizenYear;
use App\Models\Designation;
use App\Models\CitizenClass;
use App\Models\CitizenGroup;
use App\Models\CitizenShift;
use App\Models\CitizenSupports;
use App\Models\AssignSupport;
use App\Models\SupportType;
//use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\AssignCitizen;
use App\Models\DiscountCitizen;
use App\Models\EmployeeAttendance;
//use DB;
use App\Models\EmployeeSallaryLog;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class ControladorPredeterminado extends Controller
{
    public function getSupport(Request $request){
        $class_id = $request->class_id; // Recuperamos la clase seleccionada en el campo
        $allData = AssignSupport::with(['Assign_support'])->where('class_id',$class_id)->get();
        // Usando la función de Asignar Apoyo, relacionamos la ID de la tabla asignar apoyo con el campo seleccionado
        return response()->json($allData);
    }

    public function getCitizens(Request $request){
        $year_id = $request->year_id; // Recuperamos el año seleccionado en el campo
        $class_id = $request->class_id; // Recuperamos la seleccionada en el campo
        // Recuperamos los ciudadanos que coincidan con el año y clase
        $allData = AssignCitizen::with(['citizen'])->where('year_id',$year_id)->where('class_id',$class_id)->get();
        return response()->json($allData);
    }
}
