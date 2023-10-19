<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeLeave extends Model
{
    public function user(){ // Creamos la función para asociar el id del empleado con el id del empleado dentro de la tabla de de asuencia de empleado
        return $this->belongsTo(User::class,'employee_id','id');
    }

    public function purpose(){ // Creamos la función para asociar el id de la razon de ausencia en la tabla de ausencia de empleado con el id de la tabla de razones
        return $this->belongsTo(LeavePurpose::class,'leave_purpose_id','id');
    }
}
