<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\ReservaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

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
    return view('welcome');
});

Auth::routes(["reset"=>false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function(){
    
    Route::get('reservas/grilla', [ReservaController::class, 'indexGrilla'])->name('indexGrilla');
    Route::resource('reservas', ReservaController::class);
    
});

Route::group(['middleware' => ['admin']], function () {
    Route::get('admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');
    Route::get('admin/reservas', [App\Http\Controllers\AdminController::class, 'reservas'])->name('admin.reservas');
    Route::get('admin/reservas/log', [App\Http\Controllers\AdminController::class, 'log'])->name('admin.reservas.log');
    Route::post('admin/reservas/view', [App\Http\Controllers\AdminController::class, 'verReserva'])->name('admin.reservas.view');
    Route::resource('admin/users', UserController::class);
    // Route::resource('admin/asiento', AsientoController::class);
});