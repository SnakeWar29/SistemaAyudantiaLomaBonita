<?php

namespace App\Http\Controllers\Backend\Supports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CitizenYear;
use App\Models\Designation;
use App\Models\CitizenClass;
use App\Models\CitizenGroup;
use App\Models\CitizenShift;
use App\Models\CitizenSupports;
//use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\AssignCitizen;
use App\Models\DiscountCitizen;
use App\Models\EmployeeAttendance;
//use DB;
use App\Models\EmployeeSallaryLog;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class EntregaApoyoControlador extends Controller
{
    public function SupportsAdd(){
        $data['years'] = CitizenYear::all(); // Recuperamos todos los años
        $data['classes'] = CitizenClass::all(); // Recuperamos todos las clases
        return view('backend.supports.supports_add',$data);
    }

    public function SupportsStore(Request $request){
        $citizencount = $request->citizen_id; // Se toma cuantos ciudadanos hay
        if($citizencount){
            for($i=0 ; $i< count($request->citizen_id) ; $i++){
                $data = New CitizenSupports(); // Creamos nuevo modelo para introducir datos en los apoyos de ciudadanos
                $data->year_id = $request->year_id; // Introducimos el año del campo
                $data->class_id = $request->class_id; // Introducimos la clase del campo
                $data->assign_support_id = $request->assign_support_id; // Introducimos el ID del apoyo
                $data->citizen_id = $request->citizen_id[$i]; // Introducimos el ID del ciudadano en forma de arreglo, porque seran varios registros de golpe
                $data->id_no = $request->id_no[$i]; // Introducimos el ID del ciudadano en forma de arreglo, porque seran varios registros de golpe
                $data->marks = $request->marks[$i]; // Introducimos la cantidad de apoyo dada en forma de arreglo, ya que seran varios registros
                $data->save(); // Guardamos los datos
            }

        }

        $notification = array(
            'message' => 'Apoyo completo o parcial entregado correctamente',
            'alert-type' => 'success'
        );
        // Desplegamos la notificación de exito en la view
        return redirect()->back()->with($notification);
    }

    public function SupportsEdit(){
        $data['years'] = CitizenYear::all(); // Recuperamos todos los años
        $data['classes'] = CitizenClass::all(); // Recuperamos todos las clases
        return view('backend.supports.supports_edit',$data);
    }

    public function getCitizensEdit(Request $request){
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $assign_support_id = $request->assign_support_id;
        // Recuperamos los registros que coincidan con el año, clase y el soporte asignado usando la función en el modelo
        $getStudent = CitizenSupports::with(['citizen'])->where('year_id',$year_id)->where('class_id',$class_id)->where('assign_support_id',$assign_support_id)->get();
        return response()->json($getStudent);
    }

    public function SupportsEditStore(Request $request){
        CitizenSupports::WHERE('year_id',$request->year_id)->where('class_id',$request->class_id)->where('assign_support_id',$request->assign_support_id)->delete();
        $citizencount = $request->citizen_id; // Se toma cuantos ciudadanos hay
        if($citizencount){
            for($i=0 ; $i< count($request->citizen_id) ; $i++){
                $data = New CitizenSupports(); // Creamos nuevo modelo para introducir datos en los apoyos de ciudadanos
                $data->year_id = $request->year_id; // Introducimos el año del campo
                $data->class_id = $request->class_id; // Introducimos la clase del campo
                $data->assign_support_id = $request->assign_support_id; // Introducimos el ID del apoyo
                $data->citizen_id = $request->citizen_id[$i]; // Introducimos el ID del ciudadano en forma de arreglo, porque seran varios registros de golpe
                $data->id_no = $request->id_no[$i]; // Introducimos el ID del ciudadano en forma de arreglo, porque seran varios registros de golpe
                $data->marks = $request->marks[$i]; // Introducimos la cantidad de apoyo dada en forma de arreglo, ya que seran varios registros
                $data->save(); // Guardamos los datos
            }

        }

        $notification = array(
            'message' => 'Apoyo completo o parcial entregado actualizado correctamente',
            'alert-type' => 'success'
        );
        // Desplegamos la notificación de exito en la view
        return redirect()->back()->with($notification);
    }
}
