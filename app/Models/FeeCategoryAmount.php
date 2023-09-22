<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class FeeCategoryAmount extends Model
{
    // Esta funcion relaciona el capo de fee_category_id de la tabla monto al ID principal de la tabla fee_category, para relacionarlas
    public function fee_category(){
        return $this->belongsTo(FeeCategory::class,'fee_category_id','id');
    }

    public function citizen_class(){
        return $this->belongsTo(CitizenClass::class,'class_id','id');
    }
}
