<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountEmployeeSalary extends Model
{
    // Función para relacionar la variable data pasada a la view para ver los empleados y extraer los datos de la tabla usuarios
   public function employee(){
    return $this->belongsTo(User::class,'employee_id','id');
   }
}
