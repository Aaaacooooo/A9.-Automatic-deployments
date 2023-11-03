<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes(['verify' => 'true']);

Route::get('/home', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');

Route::get('community/{channel:slug}', [App\Http\Controllers\CommunityLinkController::class, 'index']);

Route::post('/votes/{link}', 'App\Http\Controllers\CommunityLinkUserController@store');


Route::post('/community?popular', 'App\Http\Controllers\CommunityLinkUserController@index');


//Una para mostrar todos los enlaces que llamará al método index del controlador mediante GET 
Route::get('community', [App\Http\Controllers\CommunityLinkController::class, 'index']);
//Otra para crear un link que llamará al método store del controlador mediante POST:
Route::post('community', [App\Http\Controllers\CommunityLinkController::class, 'store'])->middleware('auth');


//Parámetro obligatorio.
Route::get('/user/{id}', function (string $id) {
    return 'User ' . $id;
});

// Para que no sea obligatorio tan solo tenemos que colocar un ? al lado del parametro
//Esta NO tiene valor por defecto
Route::get('/user/{name?}', function (?string $name = null) {
    if (empty($name)) {
        return "Not name";
    } else {
        return $name;
    }
});



// Ruta protegida para editar el perfil del usuario
Route::get('/profile/edit', [App\Http\Controllers\ProfileController::class, 'edit'])->middleware('auth')->name('profile.edit');




//              ------ PRUEBAS --------

//Esta SI tiene valor por defecto
Route::get('/user/{name?}', function (?string $name = 'John') {
    return $name;
});

Route::post('/gdpr', function () {
    return "ruta post";
});

Route::get('/respuesta/200', function () {
    return response('Respuesta', 200);
});

Route::get('/error/404', function () {
    return response('Error', 404);
});
