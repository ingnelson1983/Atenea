<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Notifications;

class Salida extends Model
{
    use HasFactory;
    protected $fillable=['id_usu', 'proyecto_id', 'fecha_Salida', 'cod_material_sinco', 'nom_material', 'unidad_medida', 'cantidad', 'destino', 'descripcion', 'estado'];

       public function proyecto()
    {
        //belongsTo = Una salida tiene relacioado un proyecto
        return $this->belongsTo(Proyecto::class);
    }


}
