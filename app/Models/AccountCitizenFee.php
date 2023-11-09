<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountCitizenFee extends Model
{
    // Función para relacionar la variable data pasada a la view para ver los ciudadanos y extraer los datos de la tabla usuarios
    // ENTRADA - ID del ciudadano
    // SALIDA - Datos relacionados al ID de entrada
    public function citizen(){
        return $this->belongsTo(User::class,'citizen_id','id');
    }

    // Función para relacionar la tabla de tarifas con la tabla de descuentos
    // ENTRADA - ID del descuento
    // SALIDA - Datos relacionados al ID de entrada
    public function discount(){
        return $this->belongsTo(DiscountCitizen::class,'id','assign_citizens_id');
    }

    // Función para relacionar el ID del ciudadano con la tabla de clases, esto para extraer los datos de la tabla clases del ciudadano
    // ENTRADA - ID de la clase
    // SALIDA - Datos relacionados al ID de entrada
    public function citizen_class(){
        return $this->belongsTo(CitizenClass::class,'class_id','id');
    }

    // Función para relacionar la variable data pasada a la view para ver los ciudadanos y extraer los datos de la tabla año del ciudadano
    public function citizen_year(){
        return $this->belongsTo(CitizenYear::class,'year_id','id');
    }
    
    // Función para enlazar con la tabla de grupos
    public function group(){
        return $this->belongsTo(CitizenGroup::class,'group_id','id');
    }
   // Función para enlazar con la tabla de turnos
    public function shift(){
        return $this->belongsTo(CitizenShift::class,'shift_id','id');
    }

      // Función para enlazar con la tabla de categorias de tarifa
    public function fee_category(){
        return $this->belongsTo(FeeCategory::class,'fee_category_id','id');
    }
}
