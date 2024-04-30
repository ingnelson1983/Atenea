<?php

namespace App\Http\Controllers\Almacen\Salidas;


use App\Models\Salida;
use App\Models\User;
use App\Models\Proyecto;
use App\Models\Sync;
use App\Http\Controllers\Controller;
use App\Http\Requests\Almacen\Salidas\SalidaRequest;
use App\Mail\SalidaMaterial;
use App\Mail\SalidaMaterialEdicion;
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;  
//use App\Notifications\SalidaMaterial;


class SalidaController extends Controller
{


    public function _construct()
    {
        $this->middleware('can:AprobSalCoordAdmin')->only('aprobarsalidacoordadmin');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    { 

        $materiales = DB::connection('sqlsrv')->select('SELECT Productos.ProCod, Productos.ProDesc FROM Productos INNER JOIN ADPTiposProductos ON Productos.ProADPTipo = ADPTiposProductos.TipCod
        INNER JOIN ADPControl ON Productos.ProCod = ADPControl.ConInsumo /*  WHERE( ADPControl.ConClase = "P" ) */GROUP BY Productos.ProDesc, ADPTiposProductos.TipDesc,
        ADPTiposProductos.TipOrden, Productos.ProUnidadCont, Productos.ProCod, Productos.ProADPTipo ORDER BY Productos.ProDesc');

        $salidas = Salida::all();
        //para cada una de las salidas que se consulta en la bd, se agrega un campo nuevo llamado DescripionSinco
       /* foreach ($salidas as $salida) {
            $salida->descripcionSinco = collect($materiales)->where('ProCod', $salida->cod_material_sinco)->first()->ProDesc;
        }*/ 
       // dd($salidas)
        return view ('almacen.salidas.index', compact('salidas'));
    }


    public function indexsinsinco()
    { 

        $salidas = Salida::all();
        return view ('almacen.salidas.indexsinsinco', compact('salidas'));
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
         $proyectos_usuario = auth()->user()->proyectos;
        
        return view('almacen.salidas.create', compact('materiales', 'proyectos_usuario'));
    }


    public function createsinsinco()
    {
           $proyectos_usuario = auth()->user()->proyectos;
        
        return view('almacen.salidas.createsinsinco', compact('proyectos_usuario'));
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
        //      $usuario->notify(new SalidaMaterial($salida));
        $email_almacenista=$salida->Proyecto->Email_almacenista;
        $email_coord_administrativo=$salida->Proyecto->Email_coord_administrativo;
        Mail::to($email_almacenista)->send(new SalidaMaterial($salida));
        Mail::to($email_coord_administrativo)->send(new SalidaMaterial($salida));
            
        //Despues de realizar el insert, vamos al metodo index de aca del controlador, nuevamente
        return redirect()->route('salida.index');
    }


    public function storesinsinco(SalidaRequest $request)
    {


        Salida::create($request->all());
        $salida = Salida::latest()->first();
        $usuario=User::find($request->id_usu); 
        $email_almacenista=$salida->Proyecto->Email_almacenista;
        $email_coord_administrativo=$salida->Proyecto->Email_coord_administrativo;
        Mail::to($email_almacenista)->send(new SalidaMaterial($salida));
        Mail::to($email_coord_administrativo)->send(new SalidaMaterial($salida));
            
        //Despues de realizar el insert, vamos al metodo index de aca del controlador, nuevamente
        return redirect()->route('salida.indexsinsinco');
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
                $nombrematerial = collect($materiales)->where('ProCod', $salida->cod_material_sinco)->first()->ProDesc;
                
                $proyectos_usuario = auth()->user()->proyectos;
                //ahora se  le enviamos los datos a la vista que se llama edit
                return view('almacen.salidas.edit', compact('salida', 'materiales','nombrematerial', 'proyectos_usuario'));
        
    }

    public function editsinsinco(String $id)
    {
                $salida= Salida::find($id);
                $proyectos_usuario = auth()->user()->proyectos;
                //ahora se  le enviamos los datos a la vista que se llama edit
                return view('almacen.salidas.editsinsinco', compact('salida',  'proyectos_usuario'));
        
    }


    /**
     * Update the specified resource in storage.
     */
    //El request son los datos que se van a enviar y el ID es para que se encuentre el producto a actualizar
    public function update(SalidaRequest $request, String $id)
    {
      //  dd($request->all());
        //Salida es el modelo, le mandamos el id, para que busque  la salida a actualizar, y le mandamos al update, todos los datos
        Salida::find($id)->update($request->all());
       // $salida_act = Salida::find($id);
       $salida = Salida::find($id);
        $email_almacenista=$salida->Proyecto->Email_almacenista;
        $email_coord_administrativo=$salida->Proyecto->Email_coord_administrativo;
        Mail::to($email_almacenista)->send(new SalidaMaterialEdicion($salida));
        Mail::to($email_coord_administrativo)->send(new SalidaMaterialEdicion($salida));
        return to_route('salida.index');
    }

    public function updatesinsinco(SalidaRequest $request, String $id)
    {
      //  dd($request->all());
        //Salida es el modelo, le mandamos el id, para que busque  la salida a actualizar, y le mandamos al update, todos los datos
        Salida::find($id)->update($request->all());
        $salida = Salida::find($id);
       
        $email_almacenista=$salida->Proyecto->Email_almacenista;
        $email_coord_administrativo=$salida->Proyecto->Email_coord_administrativo;

        Mail::to($email_almacenista)->send(new SalidaMaterialEdicion($salida));
        Mail::to($email_coord_administrativo)->send(new SalidaMaterialEdicion($salida));
        return to_route('salida.indexsinsinco');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
      
        Salida::destroy($id);
        //Le pasamos a la vista index dos variables, para validar, si el registro  fue eliminado y mostrar el mensaje de eliminado correctamente
        return to_route('salida.index')->with('eliminar', 'ok');
    }

    public function indexaprobarsalidaalmacen()
    { 

        $materiales = DB::connection('sqlsrv')->select('SELECT Productos.ProCod, Productos.ProDesc FROM Productos INNER JOIN ADPTiposProductos ON Productos.ProADPTipo = ADPTiposProductos.TipCod
        INNER JOIN ADPControl ON Productos.ProCod = ADPControl.ConInsumo /*  WHERE( ADPControl.ConClase = "P" ) */GROUP BY Productos.ProDesc, ADPTiposProductos.TipDesc,
        ADPTiposProductos.TipOrden, Productos.ProUnidadCont, Productos.ProCod, Productos.ProADPTipo ORDER BY Productos.ProDesc');

        $salidas = Salida::all();
        //para cada una de las salidas que se consulta en la bd, se agrega un campo nuevo llamado DescripionSinco
        //foreach ($salidas as $salida) {
        //    $salida->descripcionSinco = collect($materiales)->where('ProCod', $salida->cod_material_sinco)->first()->ProDesc;
       // }
       // dd($salidas)
        return view ('almacen.salidas.AprobAlmacen', compact('salidas'));
    }

    public function aprobarsalidaalmacen(Request $request, Salida $salida)
    {
        //Salida es el modelo, le mandamos el id, para que busque  la salida a actualizar, y le mandamos al update, todos los datos
        //Salida::find($id)->update('estado'=>$id['aprobado']);

        //dd($id);
        /*
		DB::table('salidas')
        ->where("salidas.id", '=',  $id)
        ->update(['salidas.estado'=> 'aprobado']);
        */
        
        $salida->update($request->all());

        return to_route('Rindex.salida.aprob.almacenista');
    }

        
    public function indexaprobarsalidacooradmin()
    { 

        $materiales = DB::connection('sqlsrv')->select('SELECT Productos.ProCod, Productos.ProDesc FROM Productos INNER JOIN ADPTiposProductos ON Productos.ProADPTipo = ADPTiposProductos.TipCod
        INNER JOIN ADPControl ON Productos.ProCod = ADPControl.ConInsumo /*  WHERE( ADPControl.ConClase = "P" ) */GROUP BY Productos.ProDesc, ADPTiposProductos.TipDesc,
        ADPTiposProductos.TipOrden, Productos.ProUnidadCont, Productos.ProCod, Productos.ProADPTipo ORDER BY Productos.ProDesc');

        $salidas = Salida::all();
        //para cada una de las salidas que se consulta en la bd, se agrega un campo nuevo llamado DescripionSinco
       // foreach ($salidas as $salida) {
         //   $salida->descripcionSinco = collect($materiales)->where('ProCod', $salida->cod_material_sinco)->first()->ProDesc;
        //}
       // dd($salidas)
        return view ('almacen.salidas.AprobCoordAdmin', compact('salidas'));
    }

    public function aprobarsalidacoordadmin(Request $request, Salida $salida)
    {
        //Salida es el modelo, le mandamos el id, para que busque  la salida a actualizar, y le mandamos al update, todos los datos
        //Salida::find($id)->update('estado'=>$id['aprobado']);

        //dd($id);
        /*
		DB::table('salidas')
        ->where("salidas.id", '=',  $id)
        ->update(['salidas.estado'=> 'aprobado']);
        */
        
        $salida->update($request->all());

        return to_route('Rindex.salida.aprob.coordadmin');
    }


    public function ConsultarInsumos()
    {

        $empresas = Sync::select('Cod_Empresa','Nom_Empresa')->groupBy('Cod_Empresa')->get();

      return view('almacen.salidas.ConsultarInsumos', compact('empresas'));
    }
    
    public function cargarObras($empresaId)
    {
        $obras = Sync::select('Codigo_Obra', 'Nombre_Obra')->where('Cod_Empresa', $empresaId)->groupBy('Codigo_Obra')->get();
        //dd($obras->Nombre_Obra);
        return view('almacen.salidas.partials.obras', compact('obras'));
    }

    public function cargarInsumos($obraId)
    {
        //aca estaba el error decia Codigo_Obra
        $insumos = Sync::select('Cod_Insumo', 'Nombre_Insumo')->where('Codigo_Obra', $obraId)->groupBy('Cod_Insumo')->get();
        return view('almacen.salidas.partials.insumos', compact('insumos'));
    }

    public function cargarItems($insumoId)
    {
        $items = Sync::select('Cod_Item', 'Nombre_Item', 'Cod_Nom_Destino_Item')->where('Cod_Insumo', $insumoId)->get();
        return view('almacen.salidas.partials.items', compact('items'));
    }


}

