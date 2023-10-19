<?php

namespace App\Http\Controllers\Backend\Employee;

use Carbon\Carbon;
use App\Models\User;
use App\Models\CitizenYear;
use App\Models\Designation;
use App\Models\CitizenClass;
use App\Models\CitizenGroup;
use App\Models\CitizenShift;
use Illuminate\Http\Request;
//use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\AssignCitizen;
use App\Models\DiscountCitizen;
//use DB;
use App\Models\EmployeeSallaryLog;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf as PDF;


class EmpleadoRegistroControlador extends Controller
{
    public function EmployeeView(){
        $data['allData'] = User::where('usertype','Empleado')->get(); // Recuperara los datos donde el tipo de usuario sea Encargado
        return view ('backend.employee.employee_reg.employee_view',$data); // Retornamos la vista con los datos
    }

    public function EmployeeAdd(){
        $data['designation'] = Designation::all(); // Recuperamos todas las designaciones
        return view ('backend.employee.employee_reg.employee_add',$data); // Retornamos la vista con los datos
    }

    public function EmployeeStore(Request $request){
        DB::transaction(function () use($request) {
            $checkYear = date('Ym',strtotime($request->join_date)); // Recuperamos año y mes
            $employee = User::where('usertype','Empleado')->orderBy('id','DESC')->first();
            if($employee == null){
                $firstReg = 0;
                $employeeId =  $firstReg+1;
                if($employeeId < 10){
                    $id_no = '000'.$employeeId;
                }elseif($employeeId < 100){
                    $id_no = '00'.$employeeId;
                }elseif($employeeId < 1000){
                    $id_no = '0'.$employeeId;
                }
            }else{
                $employee = User::where('usertype','Empleado')->orderBy('id','DESC')->first()->id;
                $employeeId = $employee+1;
                if($employeeId < 10){
                    $id_no = '000'.$employeeId;
                }elseif($employeeId < 100){
                    $id_no = '00'.$employeeId;
                }elseif($employeeId < 1000){
                    $id_no = '0'.$employeeId;
                }
            }

            // Comienza proceso para insertar datos
            $final_id_no = $checkYear.$id_no;
            // Datos del ciudadano
            $user = new User();
            $code = rand(0000,9999);
            $user->id_no = $final_id_no;
            $user->password = bcrypt($code);
            $user->usertype = 'Empleado';
            $user->code = $code;
            $user->name = $request->name;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->salary = $request->salary;
            $user->designation_id = $request->designation_id;
            $user->Disabilities = $request->Disabilities;
            $user->dob = date('Y-m-d',strtotime($request->dob));
            $user->join_date = date('Y-m-d',strtotime($request->join_date));
            if($request->file('image')){
                $file = $request->file('image');
                $filename = date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('upload/employee_images'),$filename);
                $user['image'] = $filename;
            }
            $user->save();

            // Datos para la asignacion del salario log
            $employee_salary = new EmployeeSallaryLog();
            $employee_salary->employee_id = $user->id;
            $employee_salary->present_salary = $request->salary;
            $employee_salary->previous_salary = $request->salary; // Ambos salarios seran los mismo a la hora de registrarse, cambiara el salario presente dependiendo de otros factores
            $employee_salary->increment_salary = '0'; // Por defecto el incremento extra del salario sera 0
            $employee_salary->effected_salary = date('Y-m-d',strtotime($request->join_date));  // la fecha del efecto de su salario es la misma que la fecha de inicio
            $employee_salary->save();
        });

        $notification = array(
            'message' => 'Empleado registrado de forma exitosa',
            'alert-type' => 'success'
        );
        // Desplegamos la notificación de exito en la view
        return redirect()->route('employee.registration.view')->with($notification);
    }

    public function EmployeeEdit($id){
        $data['editData'] = User::find($id);
        $data['designation'] = Designation::all(); // Recuperamos todas las designaciones
        return view('backend.employee.employee_reg.employee_edit',$data);
    }

    public function EmployeeUpdate(Request $request, $id){
            // Datos del empleado
            $user = User::find($id); // Encontramos al empleado por ID
            $user->name = $request->name;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->designation_id = $request->designation_id;
            $user->Disabilities = $request->Disabilities;
            $user->dob = date('Y-m-d',strtotime($request->dob));
            if($request->file('image')){
                $file = $request->file('image');
                @unlink(public_path('upload/employee_images/'.$user->image));
                $filename = date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('upload/employee_images'),$filename);
                $user['image'] = $filename;
            }
            $user->save();

        $notification = array(
            'message' => 'Empleado actualizado de forma exitosa',
            'alert-type' => 'success'
        );
        // Desplegamos la notificación de exito en la view
        return redirect()->route('employee.registration.view')->with($notification);
    }

    public function EmployeeDetails($id){
        $data['details']= User::find($id);  // Extraemos los datos del empleado con el ID
        $pdf = PDF::loadView('backend.employee.employee_reg.employee_details_pdf',$data);
        return $pdf->download('Reporte_Empleado.pdf');

    }
}
