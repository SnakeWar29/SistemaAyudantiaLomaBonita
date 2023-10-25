<?php

namespace App\Http\Controllers\Backend\Accounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CitizenYear;
use App\Models\CitizenClass;
use App\Models\CitizenGroup;
use App\Models\CitizenShift;
use App\Models\AssignCitizen;
use App\Models\DiscountCitizen;
use App\Models\FeeCategoryAmount;
use App\Models\FeeCategory;
use App\Models\AccountCitizenFee;
use App\Models\AccountOtherCost;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;

class CostosAdicionalesControlador extends Controller
{
    public function OtherCostView(){
        $data['allData'] = AccountOtherCost::orderBy('id','desc')->get();
        return view('backend.account.other_cost.other_cost_view',$data);
    }

    public function OtherCostAdd(){
        return view('backend.account.other_cost.other_cost_add');
    }

    public function OtherCostStore(Request $request){
        $cost = new AccountOtherCost(); // Creamos un objeto usando el modelo para insertar datos
        $cost->date = date('Y-m-d',strtotime($request->date));
        $cost->amount = $request->amount;
        $cost->description = $request->description;
        // Valida si una imagen fue subida
        if($request->file('image')){
            $file = $request->file('image');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/cost_images'),$filename);
            $cost['image'] = $filename;
        }
        $cost->save(); // Guardamos los datos

        // Se desplega la notificación
        $notification = array(
            'message' => 'Costo adicional registrado correctamente',
            'alert-type' => 'success'
        );
        // Desplegamos la notificación de exito en la view
        return redirect()->route('other.cost.view')->with($notification);
    }

    public function OtherCostEdit($id){
        $data['editData'] = AccountOtherCost::find($id); // Encontramos el registro del costo adicional por el ID
        return view('backend.account.other_cost.other_cost_edit',$data);
    }

    public function OtherCostUpdate(Request $request, $id){
        $cost = AccountOtherCost::find($id); // Usando el modelo encontramos el registro por el id
        $cost->date = date('Y-m-d',strtotime($request->date));
        $cost->amount = $request->amount;
        $cost->description = $request->description;
        // Valida si una imagen fue subida
        if($request->file('image')){
            $file = $request->file('image');
            @unlink(public_path('upload/cost_images/'.$cost->image));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/cost_images'),$filename);
            $cost['image'] = $filename;
        }
        $cost->save(); // Guardamos los datos

        // Se desplega la notificación
        $notification = array(
            'message' => 'Costo adicional actualizado correctamente',
            'alert-type' => 'success'
        );
        // Desplegamos la notificación de exito en la view
        return redirect()->route('other.cost.view')->with($notification);
    }
}
