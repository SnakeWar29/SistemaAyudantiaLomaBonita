<?php

namespace App\Http\Controllers\Backend\Citizen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CitizenYear;
use App\Models\CitizenClass;
use App\Models\CitizenGroup;
use App\Models\CitizenShift;
use App\Models\AssignCitizen;
use App\Models\DiscountCitizen;
//use Barryvdh\DomPDF\Facade\Pdf;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\DB;
//use DB;
use Illuminate\Support\Facades\App;
use Carbon\Carbon;

class CiudadanoRolControlador extends Controller
{
    public function CitizenRolView(){
        $data['years'] = CitizenYear::all();
        $data['classes'] = CitizenClass::all();

        return view('backend.citizen.rol_generate.rol_generate_view',$data);

    }

    public function GetCitizens(Request $request){
       $allData = AssignCitizen::with(['citizen'])->where('year_id',$request->year_id)->where('class_id',$request->class_id)->get();  // Recuperamos la info que coincida con el año y la clase seleciconada
       //dd($allData->toArray());
       return response()->json($allData); // Retornamos la funcion json con los datos encontrados
    }

    public function CitizenRollStore(Request $request){
        $year_id = $request->year_id;
        $class_id = $request->class_id;

        if($request->citizen_id !=null){  // Comprobamos si existe el ciudadano
            for ($i=0; $i < count($request->citizen_id); $i++){
                // Donde el año coincida con el campo, la clase coincida con el campo y donde el id coincida con el id en la BD, se va a actualizar el rol
                AssignCitizen::where('year_id',$year_id)->where('class_id',$class_id)->where('citizen_id',$request->citizen_id[$i])
                ->update(['roll' => $request->roll[$i]]);
            }
        }else{ // Si no se encuentra, retorna la vista anterior con el mensaje de rror
            $notification = array(
                'message' => 'ERROR - No hay ciudadanos registrados',
                'alert-type' => 'error'
            );
            // Desplegamos la notificación de exito en la view
            return redirect()->back()->with($notification);
        }

        // Si sale del ciclo if, es decir, si se encontro los datos y se actualizo el rol, redirige a la vista con notificación de exito

        $notification = array(
            'message' => 'Rol asignado de forma exitosa',
            'alert-type' => 'success'
        );
        // Desplegamos la notificación de exito en la view
        return redirect()->route('rol.generate.view')->with($notification);
    }
}
