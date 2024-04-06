<?php

namespace App\Http\Controllers\General;
use App\Http\Controllers\Controller;
//use App\Http\Controllers\Controller;
use App\Models\Proyecto;
use App\Models\User;

use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Proyecto $proyecto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proyecto $proyecto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Proyecto $proyecto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proyecto $proyecto)
    {
        //
    }

    //se crea el método listarUsuarioProyecto y dentro del metodo enviamos la variable usuario, que es una instancia de User
    //al poner el nombre del modelo User antes de la variable $usuario, trae toda la informacion del usuario y el $ usuario es el 
    //ID que queremos consultar
    public function listarUsuarioProyecto($usuario=null)
    {   
        //Aca se consulta a través de Eloquent todos los usuarios que hay en el modelo User,y lo almacenamos en la variable Usuarios
        $usuarios=User::all();
        if ($usuario <> null)
            {
                //Aca se consulta a través de Eloquent todos los proyectos que hay en el modelo Proyecto,y lo almacenamos en la variable Usuarios
                $proyectos=Proyecto::all();
                //$usuario->proyectos acá lo que estamos haciendo es acceder a la relación  que hay con proyectos, en el modelo user.
                 $usuario=User::findorFail($usuario);

                //De  esta manera vamos a traer todos los proyectos que tiene activos determinado usuario
                $proyectosUsuario=$usuario->proyectos;
            }
            else
            {
                $proyectos=[];
                $proyectosUsuario=[];

            }
            //dd($proyectos, $proyectosUsuario);
            //Le mandamos esta información a la vista proyectos = informacion de todos los proyectos, proyectosusuario= que proyectos
            //tiene activos determinado usuario, usuarios= informacion de tods los usuarios, usuario= id del usuario escogido
            return view('sistema.General.proyectos_usuarios',compact('proyectos', 'proyectosUsuario', 'usuarios','usuario'));
                
        }

       // Guardar los proyectos de un usuario. En la variable request estamos mandando la cantidad de checks marcados, y el
       //al que se lo estamos marcando
       public function asignarProyectosUsuario(Request $request, User $usuario)
       {
           //Siny lo que hace es actualizar los que estan marcados en el momento y los demas los va a desmarcar o marcar segun sea el caso
           // $usuario->proyectos() se lee como si el usuario tuviera muchos proyectos
           $usuario->proyectos()->sync($request->proyectos);
           return to_route('listarusuariosproyectos', $usuario);
       }
}
