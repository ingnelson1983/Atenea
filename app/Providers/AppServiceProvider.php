<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Gate::define('Salida_Almacen_Crud', function ($user) {
            if (auth()->user()->rol->nombre == 'Admin' or auth()->user()->rol->nombre == 'Inspector' or auth()->user()->rol->nombre == 'Coordinador_Administrativo') {
                return true;
            }
            return false;
        });
    
        \Gate::define('AprobSalCoordAdmin', function ($user) {
            if (auth()->user()->rol->nombre == 'Admin' or auth()->user()->rol->nombre == 'Coordinador_Administrativo') {
                return true;
            }
            return false;
        });

        \Gate::define('AprobSalAlmacen', function ($user) {
            if (auth()->user()->rol->nombre == 'Admin' or auth()->user()->rol->nombre == 'Almacenista') {
                return true;
            }
            return false;
        });

        \Gate::define('Usuario/Proyectos', function ($user) {
            if (auth()->user()->rol->nombre == 'Admin') {
                return true;
            }
            return false;
        });

    }
}
