<?php

use Illuminate\Support\Facades\Route;
//agregamos los siguientes controladores
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TypeEventController;
use App\Http\Controllers\TicComponentController;
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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Agrega la ruta aquí
Route::get('/events/confirmados', [EventController::class, 'confirmados'])->name('events.confirmados');
Auth::routes();


//y creamos un grupo de rutas protegidas para los controladores
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RolController::class);
    Route::resource('usuarios', UsuarioController::class);
    Route::resource('places', PlaceController::class);
    Route::resource('events', EventController::class);
    Route::resource('typeEvents', TypeEventController::class);
    Route::resource('ticComponents', TicComponentController::class);
    Route::get('/places/{place}/calendar', [App\Http\Controllers\PlaceController::class, 'calendar'])->name('places.calendar');
    Route::get('/places/{place}/events', [App\Http\Controllers\PlaceController::class, 'events'])->name('places.events');
    Route::put('/events/{event}/updatestate', [App\Http\Controllers\EventController::class, 'updatestate'])->name('events.updatestate');
    //Agregalo aca, si lo agrego afuera de esto funciona, pero si lo quiero agregar adentro de este Route:group no funciona porque?


});
