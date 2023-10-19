<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeAttendance extends Model
{
    public function user(){
        return $this->belongsTo(User::class,'employee_id','id'); // Creamos la relacion entre el id de la tabla de asistencias y la de empleados
        
    }
}
