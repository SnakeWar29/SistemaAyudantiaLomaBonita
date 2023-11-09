<?php

namespace App\Http\Controllers;

use ZipArchive;
use App\Exports\UsersExport;

use App\Imports\UsersImport;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;
use App\Exports\CitizenYearExport;
use App\Exports\CitizenClassExport;
use App\Exports\CitizenGroupExport;


use App\Exports\CitizenShiftExport;

use App\Exports\AssignCitizenExport;
use App\Imports\AssignCitizneImport;
use Maatwebsite\Excel\Facades\Excel;

class   BaseDatosControlador extends Controller
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


    public function respaldo(){
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        ini_set('max_execution_time', 300);
        error_reporting(E_ALL);

        $database = 'ayudantia';
        $user = 'root';
        $pass = '';
        $host = 'localhost';

        $fecha = date("Ymd-His");

        $dumpFile = tempnam(sys_get_temp_dir(), 'dump_') . '.sql';

        echo "<h3>Backing up database to `<code>{$dumpFile}</code>`</h3>";

        system("mysqldump  --user={$user} --password={$pass} --host={$host} {$database} --result-file={$dumpFile} 2>&1", $output);

        $zip = new ZipArchive();
        $zipFileName = $database . '_' . $fecha . '.zip';
        if ($zip->open($zipFileName, ZipArchive::CREATE) === true) {
            $zip->addFile($dumpFile, 'dump.sql');
            $zip->close();
            unlink($dumpFile);

            header('Content-Type: application/zip');
            header("Content-Disposition: attachment; filename=$zipFileName");
            readfile($zipFileName);

            // Asegúrate de que no haya nada más para imprimir después de descargar el archivo
            exit;
        } else {
            echo 'Error';
        }

        var_dump($output);
        $notification = array(
            'message' => 'Exportación de la base de datos completa exitosa',
            'alert-type' => 'success'
        );
        // Desplegamos la notificación de exito en la view
        return redirect()->route('database.import.view')->with($notification);
    }

    public function restauracion(Request $request){
        if ($request->hasFile('archivo_zip')) {
            $archivoZip = $request->file('archivo_zip');
            // Verificar si el archivo es un archivo ZIP
            if ($archivoZip->getClientOriginalExtension() == 'zip') {
                // Extraer el archivo ZIP
                $extractPath = storage_path('app\temp_restore'); // Directorio temporal
                $archivoZip->move($extractPath, $archivoZip->getClientOriginalName());
                // Descomprimir el archivo ZIP
                $zip = new ZipArchive();
                if ($zip->open($extractPath . '/' . $archivoZip->getClientOriginalName())) {
                    $zip->extractTo($extractPath);
                    $zip->close();

                    // Restaurar la base de datos desde el archivo SQL
                    $database = 'ayudantia';
                    $user = 'root';
                    $pass = '';
                    $host = 'localhost';
                    $sqlFile = $extractPath . '/dump.sql';

                    // Ejecutar el comando para restaurar la base de datos
                    $command = "mysql --user={$user} --password={$pass} --host={$host} {$database} < {$sqlFile}";
                    exec($command, $output, $result);

                    if ($result === 0) {
                        // Restauración exitosa
                        session()->flash('code', 2);
                        $notification = array(
                            'message' => 'Importación de la base de datos completa exitosa',
                            'alert-type' => 'success'
                        );
                        // Desplegamos la notificación de exito en la view
                        return redirect()->route('database.import.view')->with($notification);
                    } else {
                        // Restauración fallida
                        session()->flash('code', 1);
                        $notification = array(
                            'message' => 'Exportación de la base de datos completa fallida',
                            'alert-type' => 'error'
                        );
                        // Desplegamos la notificación de exito en la view
                        return redirect()->route('database.import.view')->with($notification);
                    }

                } else {
                    // No se proporcionó ningún archivo
                    session()->flash('code', 3);
                    $notification = array(
                        'message' => 'No se adjuntó ningún archivo',
                        'alert-type' => 'info'
                    );
                    // Desplegamos la notificación de exito en la view
                    return redirect()->route('database.import.view')->with($notification);
                }
            }
        }
    }

}
