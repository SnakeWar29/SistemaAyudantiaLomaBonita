<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeLeave extends Model
{
    // Función para asociar el id del empleado con el id del empleado dentro de la tabla de de asuencia de empleado
    // ENTRADA - ID del empleado
    // SALIDA - Datos relacionados al ID
    public function user(){
        return $this->belongsTo(User::class,'employee_id','id');
    }

    // Función para asociar el id de la razon de ausencia en la tabla de ausencia de empleado con el id de la tabla de razones de ausencia
    // ENTRADA - ID del empleado
    // SALIDA - Datos relacionados al ID
    public function purpose(){
        return $this->belongsTo(LeavePurpose::class,'leave_purpose_id','id');
    }
}
