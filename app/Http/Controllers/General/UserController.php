<?php

namespace App\Http\Controllers\General;
use App\Http\Controllers\Controller;
use App\Models\General\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    //Cuando se envia algo por el formulario lo recibimos a traves de la variable request-. en este caso el email y el password
    public function login(Request $request)
    {
        //Validamos que el email y el password no esten vacios y que sea un correo electronico valido
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
     
        //Aca lo que hace el sistema es validar, si las credenciales que estoy enviando son correctas
        if (Auth::attempt($credentials)) {
            //Inmediatamente genera la sesion
            $request->session()->regenerate();
            //Debo crear una pagina de aterrizaje, para que lleve al usuario si está correctamente autenticado
            return redirect()->intended(route('salidas.index'));
        }
        // si hay un error genera este mensaje
        return back()->withErrors([
            'email' => 'Datos incorrectos',
        ]);

    }

    public function logout(Request $request)
    {
        //la clase auth, trae un metodo que se llama logout, para invalidar la sesion a través de estos tres metodos
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
 
        return redirect(route('login'));
    }
}
