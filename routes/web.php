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


    Route::resource('/almacen/salidas/salida', SalidaController::class)->names('salida');
    Route::apiResource("v1/salidas", App\Http\Controllers\Api\V1\SalidaController::class);


        //Ruta para  que llama al controlador, proyectocontroller y al metodo listar usuario proyecto y asociar usuario a proyectos
        Route::get('/usuarios/{usuario}/proyectos', [ProyectoController::class, 'listarUsuarioProyecto'])->name('usuarioProyectos');
        Route::post('/usuarios/{usuario}/proyectos', [ProyectoController::class, 'asignarProyectosUsuario'])->name('asignarProyectosUsuario')->middleware('auth');


        //Rutas para un CRUD de usuarios sin DELETE
        Route::resource('usuarios', UserController::class)->except(['destroy'])->middleware('auth');

        //Rutas de login y logout
        //En esta primer ruta solo se redirige a la vista
        //Route::view('/login', 'General.usuarios.login')->name('login');
        //aca necesitamos otra ruta con el metodo post para cuando se vayan a enviar las credenciales del usuario
       // Route::post('/login', [UserController::class, 'login'])->name('login');
        //Route::post('/logout', [UserController::class, 'logout'])->name('logout');
});

