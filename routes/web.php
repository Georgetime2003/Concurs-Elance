<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

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
    return view('index');
})->name('index');

Route::post('login', [App\Http\Controllers\AuthController::class, 'login'])->name('login');

Route::post('participacions', [App\Http\Controllers\Participacions::class, 'import'])->name('participacions');
//Carpeta images
Route::get('/images/{filename}', function ($filename)
{
    $path = storage_path('app/public/images/' . $filename);

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});

Route::get('inici', function() {
    return view('dashboard');
})->name('inici');

Route::get('importacio', function() {
    return view('importacio');
})->name('importacio');

Route::post('importacio', [App\Http\Controllers\Participacions::class, 'import'])->name('importacio');

Route::get('participants', [App\Http\Controllers\Participacions::class, 'indexparticipants'])->name('afegirParticipants');
Route::post('participants', [App\Http\Controllers\Participacions::class, 'store'])->name('afegirParticipants');

Route::get('veureparticipants/', [App\Http\Controllers\Participacions::class, 'view'])->name('veureParticipants');
/* Route::get('veureparticipants/{ordre}/{tipus}', [App\Http\Controllers\Participacions::class, 'view'])->name('veureParticipants'); */

Route::get('crearJutges', [App\Http\Controllers\Jutges::class, 'index'])->name('crearJutges');
Route::post('crearJutges', [App\Http\Controllers\Jutges::class, 'crearJutges'])->name('crearJutges');

Route::get('blocs', function() {
    return view('Blocs');
})->name('blocs');

Route::post('obtenirBlocs', [App\Http\Controllers\Blocs::class, 'index'])->name('obtenirBlocs');
Route::post('crearBloc', [App\Http\Controllers\Blocs::class, 'crearBloc'])->name('crearBloc');
Route::post('mostrarBloc', [App\Http\Controllers\Blocs::class, 'mostrarBloc'])->name('mostrarBloc');