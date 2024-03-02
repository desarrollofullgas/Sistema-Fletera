<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EstacionController;
use App\Http\Controllers\OperadorController;
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\UnidadController;
use App\Http\Controllers\UnidadesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VersionController;
use App\Http\Controllers\ViajesController;
use App\Http\Controllers\ZonaController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    //Dashboard
    Route::get('/dashboard', [DashboardController::class, 'data'])->name('dashboard');
    Route::get('/notificaciones', [DashboardController::class, 'notifs'])->name('notificaciones');

    //Usuarios
    Route::get('/usuarios', [UserController::class, 'index'])->name('users');
    Route::delete('/users{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get("/trashed", [UserController::class, "trashed_users"])->name('users.trashed');
    Route::get("/visitas", [UserController::class, "visita_users"])->name('users.visita');
    Route::post("/restoreuser", [UserController::class, "do_restore"])->name('user_restore');
    Route::post("/deleteuser-permanently", [UserController::class, "delete_permanently"])->name('deleteuser_permanently');

    //Zonas
    Route::get('/zonas', [ZonaController::class, 'index'])->name('zonas');
    Route::delete('/zonas{zona}', [ZonaController::class, 'destroy'])->name('zonas.destroy');
    Route::get("/trashedzonas", [ZonaController::class, "trashed_zonas"])->name('zonas.trashedzonas');
    Route::post("/restorezona", [ZonaController::class, "do_restore"])->name('zona_restore');
    Route::post("/deletezona-permanently", [ZonaController::class, "delete_permanently"])->name('deletezona_permanently');

    //Estaciones
    Route::get('/estaciones', [EstacionController::class, 'index'])->name('estaciones');
    Route::delete('/estaciones{estacion}', [EstacionController::class, 'destroy'])->name('estaciones.destroy');
    Route::get("/trashedestaciones", [EstacionController::class, "trashed_estaciones"])->name('estaciones.trashed');
    Route::post("/restoreestacion", [EstacionController::class, "do_restore"])->name('estacion_restore');
    Route::post("/deleteestacion-permanently", [EstacionController::class, "delete_permanently"])->name('deleteestacion_permanently');
    Route::get('/estacion/editar/{id}', [EstacionController::class, "editEstacion"])->name('estacion.edit');

    //unidades
    Route::controller(UnidadesController::class)->group(function (){
        Route::get('/unidades','home')->name('unidades');
        Route::get('/lineas-transporte','lineasHome')->name('lineas.transporte');
        Route::get('/unidades/editar/{id}','editUnidad')->name('unidad.edit');
    });

    //Operadores
    Route::get('/operadores', [OperadorController::class, 'index'])->name('operadores');
    Route::delete('/operadores{operador}', [OperadorController::class, 'destroy'])->name('operadores.destroy');
    Route::get("/trashedoperadores", [OperadorController::class, "trashed_operadores"])->name('operadores.trashed');
    Route::post("/restoreoperador", [OperadorController::class, "do_restore"])->name('operador_restore');
    Route::post("/deleteoperador-permanently", [OperadorController::class, "delete_permanently"])->name('deleteoperador_permanently');

    //Proveedores
    Route::get('/proveedores', [ProveedorController::class, 'index'])->name('proveedores');
    Route::delete('/proveedores{operador}', [ProveedorController::class, 'destroy'])->name('proveedores.destroy');
    Route::get("/trashedproveedores", [ProveedorController::class, "trashed_proveedores"])->name('proveedores.trashed');
    Route::post("/restoreproveedor", [ProveedorController::class, "do_restore"])->name('proveedor_restore');
    Route::post("/deleteproveedor-permanently", [ProveedorController::class, "delete_permanently"])->name('deleteproveedor_permanently');

    //Unidades
    Route::controller(UnidadController::class)->group(function () {
        Route::get('/unidades', 'index')->name('unidades');
        Route::delete('/unidades{unidad}' . 'destroy')->name('unidades.destroy');
        Route::get("/trashedunidades", 'trashed_unidades')->name('unidades.trashed');
        Route::post("/restoreunidad", 'do_restore')->name('unidad_restore');
        Route::post("/deleteunidad-permanently", 'delete_permanently')->name('unidad_permanently');
        Route::get('/unidades/editar/{id}','editUnidad')->name('unidad.edit');
        //Lineas
        Route::get('/lineas-transporte', 'lineasIndex')->name('lineas.transporte');
        Route::delete('/lineas-transporte{lineas}' . 'destroyL')->name('lineas.destroy');
        Route::get("/trashedlineas-transporte", 'trashed_lineas')->name('lineas.trashed');
        Route::post("/restorelinea", 'do_restoreL')->name('linea_restore');
        Route::post("/deletelinea-permanently", 'delete_permanentlyL')->name('linea_permanently');
    });
    //viajes
    Route::controller(ViajesController::class)->group(function(){
        Route::get('/viajes','home')->name('viajes');
        Route::get('/viajes/recepcion-pipas/{ctID}','recepcion')->name('recepcion');
        Route::get('/viajes/cataporte/{id}','pdf')->name('ct.archivo');
        Route::get('/viajes/recepcion-pipas/editar/{rep}','editRecepcion')->name('recepcion.edit');
    });

    //Permisos
    Route::get('/roles', [PermisoController::class, 'show'])->name('roles');
    Route::put('/roles/{id}', [PermisoController::class, 'asignar'])->name('asignacionpermiso.asignar');

    //Sistema
    Route::get('/versiones', [VersionController::class, 'show'])->name('versiones');
});
