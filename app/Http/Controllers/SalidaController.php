<?php

namespace App\Http\Controllers\Almacen\Salidas;


use App\Models\Salida;
use App\Models\User;
use App\Http\Controllers\Controller;
//use App\Http\Requests\Almacen\Salidas\SalidaRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//use App\Notifications\SalidaMaterial;


class SalidaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    { 

        $salidas = Salida::all();

       // dd($salidas)
        return view ('salida.index', compact('salidas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         //Consulta Materiales en el ERP. Aca le estamos diiendo que la conexion la haga desde sql server
        $materiales = DB::connection('sqlsrv')->select('SELECT Productos.ProCod, Productos.ProDesc FROM Productos INNER JOIN ADPTiposProductos ON Productos.ProADPTipo = ADPTiposProductos.TipCod
        INNER JOIN ADPControl ON Productos.ProCod = ADPControl.ConInsumo /*  WHERE( ADPControl.ConClase = "P" ) */GROUP BY Productos.ProDesc, ADPTiposProductos.TipDesc,
        ADPTiposProductos.TipOrden, Productos.ProUnidadCont, Productos.ProCod, Productos.ProADPTipo ORDER BY Productos.ProDesc');
        
        
        return view('almacen.salidas.create', compact('materiales'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SalidaRequest $request)
    {

       //dump and die
       //Comando para ver lo que el request tiene por dentro y que campos se le están mandado a la base de datos. Sirve como depuración de errores     
       // dd ($request->all());
        // $salida = new salida();
        //$salida-> proy_id_origen = $request->proy_id_origen;
        // $salida-> material = $request->material;
        // $salida-> proy_id_origen = $request->proy_id_origen;
        //$salida->save();
        //Esta es la manera corta de hacer el insert de todos los campos en la bd
        Salida::create($request->all());
        $salida = Salida::latest()->first();
        //Despues que se graba se envia la notificacion o el correo.
         // dd($salida);
         //auth()->user()->notify =  Si le fueramos a enviar el correo al usuario que esta autenticado
        //En este caso se lo vamos a enviar a un usuario que etsoy eligiendo
        $usuario=User::find($request->id_usu); 
        // si le fuera a enviar un correo a un usuario proveniente del formulario, lo que hago es 
        //$usuario=User::find($request->id_usu); 
        $usuario->notify(new SalidaMaterial($salida));
        
        //Despues de realizar el insert, vamos al metodo index de aca del controlador, nuevamente
        return redirect()->route('salidas.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(String $id)
    {
        //se llama el modelo Salida, y le enviamos el Id de la salida
        $salida= Salida::find($id);
        //ahora se  le enviamos los datos a la vista que se llama show
        return view('almacen.salidas.show', compact('salida'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {

               //Consulta Materiales en el ERP. Aca le estamos diiendo que la conexion la haga desde sql server
               $materiales = DB::connection('sqlsrv')->select('SELECT Productos.ProCod, Productos.ProDesc FROM Productos INNER JOIN ADPTiposProductos ON Productos.ProADPTipo = ADPTiposProductos.TipCod
               INNER JOIN ADPControl ON Productos.ProCod = ADPControl.ConInsumo /*  WHERE( ADPControl.ConClase = "P" ) */GROUP BY Productos.ProDesc, ADPTiposProductos.TipDesc,
               ADPTiposProductos.TipOrden, Productos.ProUnidadCont, Productos.ProCod, Productos.ProADPTipo ORDER BY Productos.ProDesc');
                //dd($materiales);
                //se llama el modelo Salida, y le enviamos el Id de la salida
                $salida= Salida::find($id);
                $nombrematerial = collect($materiales)->where('ProCod', $salida->material)->first()->ProDesc;
                //ahora se  le enviamos los datos a la vista que se llama edit
                return view('almacen.salidas.edit', compact('salida', 'materiales','nombrematerial'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    //El request son los datos que se van a enviar y el ID es para que se encuentre el producto a actualizar
    public function update(SalidaRequest $request, String $id)
    {
        //Salida es el modelo, le mandamos el id, para que busque  la salida a actualizar, y le mandamos al update, todos los datos
        Salida::find($id)->update($request->all());
        return to_route('salidas.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        Salida::destroy($id);
        return to_route('salidas.index');
    }
}
