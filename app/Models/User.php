<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'rol_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    //Se crea la relacion de muchos a muchos, con la tabla de Proyectos. Significa que 1 Proyecto tiene muchos usuarios
    public function proyectos()
    {
        //belongsToMany = Muchos a muchos
        return $this->belongsToMany(Proyecto::class);
    }

    //Se crea la relacion de 1 a 1, con la tabla de roles. Significa que un usuario tiene un rol
    public function rol()
    {
         //belongsTo = uno a uno
         return $this->belongsTo(Rol::class);
    }
}
