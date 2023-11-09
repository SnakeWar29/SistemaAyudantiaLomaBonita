<?php

namespace App\Http\Controllers\Backend\Citizen;

use App\Models\User;
use App\Models\CitizenYear;
use App\Models\CitizenClass;
use App\Models\CitizenGroup;
use App\Models\CitizenShift;
use Illuminate\Http\Request;
use App\Models\AssignCitizen;
use App\Models\DiscountCitizen;
//use Barryvdh\DomPDF\Facade\Pdf;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\DB;
//use DB;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Carbon\Carbon;



class CiudadanoRegistroControlador extends Controller
{
    // Este controlador manejara el registro de un ciudadano dentro del sistema
    public function CitizenRegView(){
        $data['years'] = CitizenYear::all(); // Recuperamos todos los años registrados
        $data['classes'] = CitizenClass::all();  // Recuperamos todas las clases registradas

        $data['year_id'] = CitizenYear::orderBy('id','desc')->first()->id;
        $data['class_id'] = CitizenClass::orderBy('id','desc')->first()->id;

        $data['allData'] = AssignCitizen::where('year_id',$data['year_id'])->where('class_id',$data['class_id'])->get(); // Recuperamos los datos donde el id de la clase y año coincidan con los de la busqueda
        return view ('backend.citizen.citizen_reg.citizen_view',$data);
    }

    public function CitizenClassYearWise(Request $request){
        $data['years'] = CitizenYear::all(); // Recuperamos todos los años registrados
        $data['classes'] = CitizenClass::all();  // Recuperamos todas las clases registradas

        $data['year_id'] = $request->year_id;
        $data['class_id'] = $request->class_id;

        $data['allData'] = AssignCitizen::where('year_id',$request->year_id)->where('class_id',$request->class_id)->get(); // Recuperamos los datos donde el id de la clase y año coincidan con los de la busqueda
        return view ('backend.citizen.citizen_reg.citizen_view',$data);
    }

    public function CitizenRegAdd(){
        $data['years'] = CitizenYear::all(); // Recuperamos todos los años registrados
        $data['classes'] = CitizenClass::all(); // Recuperamos todos las clases registrados
        $data['groups'] = CitizenGroup::all(); // Recuperamos todos los grupos registrados
        $data['shifts'] = CitizenShift::all(); // Recuperamos todos los turnos registrados
        return view ('backend.citizen.citizen_reg.citizen_add',$data);
    }

    // ENTRADA - Datos del ciudadano obtenidos en la vista add
    // SALIDA - Registro de datos del ciudadano en la BD / Notificación de éxito
    // Función para añadir un nuevo ciudadano a la base de datos
    public function CitizenRegStore(Request $request){
        // El ID del ciudadano se generara por el Año, XXXX y el numero en orden
        // Ejem. 20220001, 20220002, 20220003
        DB::transaction(function () use($request) {
            $checkYear = CitizenYear::find($request->year_id)->name;
            $citizen = User::where('usertype','Ciudadano')->orderBy('id','DESC')->first();
            if($citizen == null){
                $firstReg = 0;
                $citizenId =  $firstReg+1;
                if($citizenId < 10){
                    $id_no = '000'.$citizenId;
                }elseif($citizenId < 100){
                    $id_no = '00'.$citizenId;
                }elseif($citizenId < 1000){
                    $id_no = '0'.$citizenId;
                }
            }else{
                $citizen = User::where('usertype','Ciudadano')->orderBy('id','DESC')->first()->id;
                $citizenId = $citizen+1;
                if($citizenId < 10){
                    $id_no = '000'.$citizenId;
                }elseif($citizenId < 100){
                    $id_no = '00'.$citizenId;
                }elseif($citizenId < 1000){
                    $id_no = '0'.$citizenId;
                }
            }

            // Comienza proceso para insertar datos
            $final_id_no = $checkYear.$id_no;
            // Datos del ciudadano
            $user = new User();
            $code = rand(0000,9999);
            $user->id_no = $final_id_no;
            $user->password = bcrypt($code);
            $user->usertype = 'Ciudadano';
            $user->code = $code;
            $user->name = $request->name;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->Disabilities = $request->Disabilities;
            $user->dob = date('Y-m-d',strtotime($request->dob));
            if($request->file('image')){
                $file = $request->file('image');
                $filename = date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('upload/citizen_images'),$filename);
                $user['image'] = $filename;
            }
            $user->save();

            // Datos la asignación del ciudadano
            $assign_citizen = new AssignCitizen();
            $assign_citizen->citizen_id = $user->id;
            $assign_citizen->year_id = $request->year_id;
            $assign_citizen->class_id = $request->class_id;
            $assign_citizen->group_id = $request->group_id;
            $assign_citizen->shift_id = $request->shift_id;
            $assign_citizen->save();

            // Datos de los descuentos de los ciudadanos
            $discount_citizen = new DiscountCitizen();
            $discount_citizen->assign_citizens_id = $assign_citizen->id;
            $discount_citizen->fee_category_id = 1;
            $discount_citizen->discount = $request->discount;
            $discount_citizen->save();
        });

        $notification = array(
            'message' => 'Ciudadano registrado de forma exitosa',
            'alert-type' => 'success'
        );
        // Desplegamos la notificación de exito en la view
        return redirect()->route('citizen.registration.view')->with($notification);
    }

    public function CitizenRegEdit($citizen_id){
        $data['years'] = CitizenYear::all(); // Recuperamos todos los años registrados
        $data['classes'] = CitizenClass::all(); // Recuperamos todos las clases registrados
        $data['groups'] = CitizenGroup::all(); // Recuperamos todos los grupos registrados
        $data['shifts'] = CitizenShift::all(); // Recuperamos todos los turnos registrados
        $data['editData']= AssignCitizen::with(['citizen','discount'])->where('citizen_id',$citizen_id)->first();
        //dd($data['editData']->toArray());
        return view ('backend.citizen.citizen_reg.citizen_edit',$data);
    }

    public function CitizenRegUpdate(Request $request,$citizen_id){
        // El ID del ciudadano se generara por el Año, XXXX y el numero en orden
        // Ejem. 20220001, 20220002, 20220003
        DB::transaction(function () use($request,$citizen_id) {
            // Datos del ciudadano
            $user = User::where('id',$citizen_id)->first();
            $user->name = $request->name;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->Disabilities = $request->Disabilities;
            $user->dob = date('Y-m-d',strtotime($request->dob));
            if($request->file('image')){
                $file = $request->file('image');
                @unlink(public_path('upload/citizen_images/'.$user->image));
                $filename = date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('upload/citizen_images'),$filename);
                $user['image'] = $filename;
            }
            $user->save();

            // Datos la asignación del ciudadano
            $assign_citizen = AssignCitizen::where('id',$request->id)->where('citizen_id',$citizen_id)->first();
            $assign_citizen->year_id = $request->year_id;
            $assign_citizen->class_id = $request->class_id;
            $assign_citizen->group_id = $request->group_id;
            $assign_citizen->shift_id = $request->shift_id;
            $assign_citizen->save();

            // Datos de los descuentos de los ciudadanos
            $discount_citizen = DiscountCitizen::where('assign_citizens_id',$request->id)->first();
            $discount_citizen->discount = $request->discount;
            $discount_citizen->save();
        });

        $notification = array(
            'message' => 'Ciudadano editado de forma exitosa',
            'alert-type' => 'success'
        );
        // Desplegamos la notificación de exito en la view
        return redirect()->route('citizen.registration.view')->with($notification);
    }

    public function CitizenRegPromotion($citizen_id){
        $data['years'] = CitizenYear::all(); // Recuperamos todos los años registrados
        $data['classes'] = CitizenClass::all(); // Recuperamos todos las clases registrados
        $data['groups'] = CitizenGroup::all(); // Recuperamos todos los grupos registrados
        $data['shifts'] = CitizenShift::all(); // Recuperamos todos los turnos registrados
        $data['editData']= AssignCitizen::with(['citizen','discount'])->where('citizen_id',$citizen_id)->first();
        //dd($data['editData']->toArray());
    }

    public function CitizenUpdatePromotion(Request $request,$citizen_id){
        // El ID del ciudadano se generara por el Año, XXXX y el numero en orden
        // Ejem. 20220001, 20220002, 20220003
        DB::transaction(function () use($request,$citizen_id) {
            // Datos del ciudadano
            $user = User::where('id',$citizen_id)->first();
            $user->name = $request->name;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->Disabilities = $request->Disabilities;
            $user->dob = date('Y-m-d',strtotime($request->dob));
            if($request->file('image')){
                $file = $request->file('image');
                @unlink(public_path('upload/citizen_images/'.$user->image));
                $filename = date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('upload/citizen_images'),$filename);
                $user['image'] = $filename;
            }
            $user->save();

            // Datos la asignación del ciudadano
            $assign_citizen = new AssignCitizen();
            $assign_citizen->citizen_id = $citizen_id;
            $assign_citizen->year_id = $request->year_id;
            $assign_citizen->class_id = $request->class_id;
            $assign_citizen->group_id = $request->group_id;
            $assign_citizen->shift_id = $request->shift_id;
            $assign_citizen->save();

            // Datos de los descuentos de los ciudadanos
            $discount_citizen = new DiscountCitizen();
            $discount_citizen->assign_citizens_id = $assign_citizen->id;
            $discount_citizen->fee_category_id = 1;
            $discount_citizen->discount = $request->discount;
            $discount_citizen->save();
        });

        $notification = array(
            'message' => 'Ciudadano promovido de forma exitosa',
            'alert-type' => 'success'
        );
        // Desplegamos la notificación de exito en la view
        return redirect()->route('citizen.registration.view')->with($notification);
    }

    public function CitizenRegDelete(Request $request,$citizen_id){
        $citizen = User::find($citizen_id);
        $assign_citizen = DB::delete(DB::raw("delete from assign_citizens where citizen_id='$citizen_id'"));
        $citizen->delete();
        // Inicia procedimiento para notificación dentro del sistema
        $notification = array(
            'message' => 'Ciudadano eliminado exitosamente',
            'alert-type' => 'info'
        );

        // Desplegamos la notificación de exito
        return redirect()->route('citizen.registration.view')->with($notification);
    }

    public function CitizenRegDetails($citizen_id){
        $data['details']= AssignCitizen::with(['citizen','discount'])->where('citizen_id',$citizen_id)->first();
        $pdf = PDF::loadView('backend.citizen.citizen_reg.citizen_details_pdf',$data);
        return $pdf->download('Reporte_Ciudadano.pdf');

    }
}
