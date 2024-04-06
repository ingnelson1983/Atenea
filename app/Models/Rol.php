<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;

            //Se crea la relacion de 1 a muchos, con la tabla de usuarios. Significa que 1 rol tiene muchos usuarios
            public function users()
       {
                //hasMany = uno a muchos
                return $this->hasMany(User::class);
        }
}

