<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignSupport extends Model
{
    // Funcion para relacionar el nombre del ID de la tabla de asignación, con el id de la tabla de  clase, para recuperar su nombre
    public function citizen_class(){
        return $this->belongsTo(CitizenClass::class,'class_id','id');
    }

    public function Assign_support(){
        return $this->belongsTo(SupportType::class,'support_id','id');
    }

}
