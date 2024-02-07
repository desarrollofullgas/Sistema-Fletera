<?php

namespace App\Providers;

use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
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
        // Configuración para fechas en español
        // Carbon::setUTF8(true);
        // Carbon::setLocale(config('app.locale'));
        // setlocale(LC_ALL, 'es_MX', 'es', 'ES', 'es_MX.utf8');
        Carbon::setLocale(config('app.locale'));
        setlocale(LC_TIME, config('app.locale'));
    }
}
