<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CitizenSupports extends Model
{
    // Función para relacionar el id del ciudadano en la tabla de otorgación de apoyo con el de user
    public function citizen(){
        return $this->belongsTo(User::class,'citizen_id','id');
    }
}
