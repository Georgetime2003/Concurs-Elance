<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;

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

Route::post('participacions', [App\Http\Controllers\Participacions::class, 'import'])->middleware('auth')->middleware('controlJutge')->name('participacions');
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
})->middleware('auth')->middleware('controlJutge')->name('inici');

Route::get('importacio', function() {
    return view('importacio');
})->middleware('auth')->middleware('controlJutge')->name('importacio');

Route::post('importacio', [App\Http\Controllers\Participacions::class, 'import'])->middleware('auth')->middleware('controlJutge')->name('importacio');

Route::get('participants', [App\Http\Controllers\Participacions::class, 'indexparticipants'])->middleware('auth')->middleware('controlJutge')->name('afegirParticipants');
Route::post('participants', [App\Http\Controllers\Participacions::class, 'store'])->middleware('auth')->middleware('controlJutge')->name('afegirParticipants');

Route::get('veureparticipants/', [App\Http\Controllers\Participacions::class, 'view'])->middleware('auth')->middleware('controlJutge')->name('veureParticipants');
/* Route::get('veureparticipants/{ordre}/{tipus}', [App\Http\Controllers\Participacions::class, 'view'])->name('veureParticipants'); */

Route::get('crearJutges', [App\Http\Controllers\Jutges::class, 'index'])->middleware('auth')->middleware('controlJutge')->name('crearJutges');
Route::post('crearJutges', [App\Http\Controllers\Jutges::class, 'crearJutges'])->middleware('auth')->middleware('controlJutge')->name('crearJutges');

Route::get('blocs', function() {
    return view('Blocs');
})->middleware('auth')->middleware('controlJutge')->name('blocs');

Route::post('obtenirBlocs', [App\Http\Controllers\Blocs::class, 'index'])->middleware('auth')->middleware('controlJutge')->name('obtenirBlocs');
Route::post('crearBloc', [App\Http\Controllers\Blocs::class, 'crearBloc'])->middleware('auth')->middleware('controlJutge')->name('crearBloc');
Route::post('mostrarBloc', [App\Http\Controllers\Blocs::class, 'mostrarBloc'])->middleware('auth')->middleware('controlJutge')->name('mostrarBloc');
Route::post('esborrarBloc', [App\Http\Controllers\Blocs::class, 'esborrarBloc'])->middleware('auth')->middleware('controlJutge')->name('esborrarBloc');

Route::get('votacions', [App\Http\Controllers\Jutges::class, 'votacionsIndex'])->middleware('auth')->name('votacions');
Route::post('obtenirBlocsActius', [App\Http\Controllers\Blocs::class, 'obtenirBlocsActius'])->name('obtenirBlocsActius');
Route::post('obtenirJutges', [App\Http\Controllers\Jutges::class, 'obtenirJutges'])->name('obtenirJutges');
Route::post('assignarJutge', [App\Http\Controllers\Blocs::class, 'assignarJutge'])->name('assignarJutge');
Route::post('activarBloc', [App\Http\Controllers\Blocs::class, 'activarBloc'])->name('activarBloc');
Route::post('desactivarBloc', [App\Http\Controllers\Blocs::class, 'desactivarBloc'])->name('desactivarBloc');
Route::post('actualitzarBlocCategoria', [App\Http\Controllers\Blocs::class, 'actualitzarBlocCategoria'])->name('actualitzarBlocCategoria');
Route::post('enviarVotacio', [App\Http\Controllers\Blocs::class, 'enviarVotacio'])->name('enviarVotacio');

Route::get('/logout', function() {
    Auth::logout();
    return redirect()->route('index');
})->name('logout');