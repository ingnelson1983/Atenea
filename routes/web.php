<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductoController;
use App\Http\Controllers\Almacen\Salidas\SalidaController;
use App\Http\Controllers\General\ProyectoController;
use App\Http\Controllers\General\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
/*
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');


    Route::get('/events', function () {
        return view('events');
    });
//CRUD de productos de Manera Manual
/*
//Ruta mostrar todos los productos
Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
//Ruta para mostrar el formulario que va a capturar los datos para posteriormente crear el insert
Route::get('/productos/create', [ProductoController::class, 'create'])->name('productos.create');
//Ruta para realizar el insert en la base de datos, con el metodo post
Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store');
//Ruta para listar solo un producto. el valor que está entre las llaves son los parametros (IdProducto) que se le envian al metodo
//Si son mas de dos parametros, se separan con /. por ejemplo {producto}/{otro}
Route::get('/productos/{producto}', [ProductoController::class, 'show'])->name('productos.show');
//El edit lo que hace es mostarme otro formulario, pero ya con los datos del producto que quiero editar
Route::get('/productos/{producto}/edit', [ProductoController::class, 'edit'])->name('productos.edit');
//con el metodo PUT enviamos a la base de datos, el comando para actualizar el registro
Route::put('/productos/{producto}', [ProductoController::class, 'update'])->name('productos.update');
//con el metodo DELETE enviamos a la base de datos, el comando para Eliminar el registro
Route::detele('/productos/{producto}', [ProductoController::class, 'destroy'])->name('productos.destroy');
*/


    Route::resource('/almacen/salidas/salida', SalidaController::class)->names('salida');
    Route::apiResource("v1/salidas", App\Http\Controllers\Api\V1\SalidaController::class);
    Route::put('/almacen/salidas/aprobalamacen/{salida}', [SalidaController::class, 'aprobalmacen'])->name('salidas.aprobar.almacenista');

    //Ruta para  que llama al controlador, proyectocontroller y al metodo listar usuario proyecto y asociar usuario a proyectos
    Route::get('/usuario/proyectos/{usuario?}', [ProyectoController::class, 'listarUsuarioProyecto'])->name('listarusuariosproyectos');
    //Route::get('/General/proyectos2/{usuario}', [ProyectoController::class, 'listarUsuarioProyecto'])->name('usuarioProyectos2');

    Route::post('/usuario/proyectos/{usuario}', [ProyectoController::class, 'asignarProyectosUsuario'])->name('asignarProyectosUsuario')->middleware('auth');
    //Route::post('/General/{usuario}/proyectos3', [ProyectoController::class, 'asignarProyectosUsuario'])->name('asignarProyectosUsuario2')->middleware('auth');
    

        //Rutas para un CRUD de usuarios sin DELETE
      //  Route::resource('usuarios', UserController::class)->except(['destroy'])->middleware('auth');

        //Rutas de login y logout
        //En esta primer ruta solo se redirige a la vista
        //Route::view('/login', 'General.usuarios.login')->name('login');
        //aca necesitamos otra ruta con el metodo post para cuando se vayan a enviar las credenciales del usuario
       // Route::post('/login', [UserController::class, 'login'])->name('login');
        //Route::post('/logout', [UserController::class, 'logout'])->name('logout');
});

