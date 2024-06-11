<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
#rutas usuarios
Route::get('usuarios', [App\Http\Controllers\Controller::class, 'vista_user'])->name('usuarios');
Route::get('usuarios/mostrar', [App\Http\Controllers\UserController::class, 'show']);
Route::post('usuarios/guardar', [App\Http\Controllers\UserController::class, 'create']);
Route::post('usuario/editar/{id}', [App\Http\Controllers\UserController::class, 'edit']);
Route::post('usuario/actualizar', [App\Http\Controllers\UserController::class, 'update']);
Route::post('usuario/eliminar/{id}', [App\Http\Controllers\UserController::class, 'destroy']);
