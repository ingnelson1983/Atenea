<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    use HasFactory;
    // Con esta funcion se protegen los campos.
    protected $fillable = ['Cod_Proyecto_Sinco', 'Nombre_Proyecto'];

    //Se crea la relacion de muchos a muchos, con la tabla de usuarios. Significa que 1 Proyecto tiene muchos usuarios
    public function users()
    {
                    //belongsToMany = Muchos a muchos
        return $this->belongsToMany(User::class);
    }

    public function salidas()
    {
                    //hasMany = Un proyecto tiene muchas salidas
        return $this->hasMany(Salida::class);
    }

}
