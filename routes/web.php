<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EstacionController;
use App\Http\Controllers\OperadorController;
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VersionController;
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

     //Permisos
     Route::get('/roles', [PermisoController::class, 'show'])->name('roles');
     Route::put('/roles/{id}', [PermisoController::class, 'asignar'])->name('asignacionpermiso.asignar');
 
     //Sistema
     Route::get('/versiones', [VersionController::class, 'show'])->name('versiones');

});
