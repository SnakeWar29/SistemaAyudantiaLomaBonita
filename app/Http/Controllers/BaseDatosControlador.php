<?php

namespace App\Http\Controllers;

use App\Imports\UsersImport;
use App\Imports\AssignCitizneImport;

use App\Exports\UsersExport;
use App\Exports\CitizenClassExport;
use App\Exports\CitizenGroupExport;
use App\Exports\CitizenShiftExport;
use App\Exports\CitizenYearExport;
use App\Exports\AssignCitizenExport;


use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;
use PhpParser\Node\Stmt\Return_;

class BaseDatosControlador extends Controller
{
    public function Import(){
        return view('imports_exports.import_view');
    }

    public function ImportExecute(){
        try {
            Excel::Import(new UsersImport, request()->file('file')); // Recuperamos el archivo
            $notification = array(
                'message' => 'Importacion realizada con exito',
                'alert-type' => 'success'
            );
            // Desplegamos la notificación de exito en la view
            return redirect()->route('database.import.view')->with($notification);
        } catch (\Exception $e) {
            dd($e->getMessage());
            return back()->with('error', __('Invalid File Structure!'));
        }
    }

    public function ExportExecute(){
        return Excel::download(new UsersExport , 'usuarios_ciudadanos_empleados.xlsx');
        $notification = array(
            'message' => 'Exportación de usuarios realizada con exito',
            'alert-type' => 'success'
        );
        // Desplegamos la notificación de exito en la view
        return redirect()->route('database.import.view')->with($notification);
    }

    public function ExportCitizensClassData(){
        return Excel::download(new CitizenClassExport , 'clases_ciudadanos.xlsx');
        $notification = array(
            'message' => 'Importacion de información general de ciudadanos éxitosa',
            'alert-type' => 'success'
        );
        // Desplegamos la notificación de exito en la view
        return redirect()->route('database.import.view')->with($notification);
    }

    public function ExportCitizensGroupData(){
        return Excel::download(new CitizenGroupExport , 'grupos_ciudadanos.xlsx');
        $notification = array(
            'message' => 'Importacion de información general de ciudadanos éxitosa',
            'alert-type' => 'success'
        );
        // Desplegamos la notificación de exito en la view
        return redirect()->route('database.import.view')->with($notification);
    }

    public function ExportCitizensShiftData(){
        return Excel::download(new CitizenShiftExport , 'turnos_ciudadanos.xlsx');
        $notification = array(
            'message' => 'Importacion de información general de ciudadanos éxitosa',
            'alert-type' => 'success'
        );
        // Desplegamos la notificación de exito en la view
        return redirect()->route('database.import.view')->with($notification);
    }

    public function ExportCitizensYearData(){
        return Excel::download(new CitizenYearExport , 'años_ciudadanos.xlsx');
        $notification = array(
            'message' => 'Importacion de información general de ciudadanos éxitosa',
            'alert-type' => 'success'
        );
        // Desplegamos la notificación de exito en la view
        return redirect()->route('database.import.view')->with($notification);
    }

    public function ExportCitizensAssignData(){
        return Excel::download(new AssignCitizenExport , 'asignacion_ciudadanos.xlsx');
        $notification = array(
            'message' => 'Importacion de asignación de ciudadanos éxitosa',
            'alert-type' => 'success'
        );
        // Desplegamos la notificación de exito en la view
        return redirect()->route('database.import.view')->with($notification);
    }

    public function ImportAssignCitizensExecute(){
        try {
            Excel::Import(new AssignCitizneImport, request()->file('file')); // Recuperamos el archivo
            $notification = array(
                'message' => 'Importacion realizada con exito',
                'alert-type' => 'success'
            );
            // Desplegamos la notificación de exito en la view
            return redirect()->route('database.import.view')->with($notification);
        } catch (\Exception $e) {
            dd($e->getMessage());
            return back()->with('error', __('Invalid File Structure!'));
        }
    }

}
