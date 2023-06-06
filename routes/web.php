<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\Servico1Controller;
use App\Http\Controllers\ReuniaoController;
use App\Http\Controllers\VagaController;
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

Route::get('/dashboard', function () {
    return view('base.dashboard');
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('usuario', UsuarioController::class);
    Route::resource('servico1', Servico1Controller::class);
    Route::resource('reuniao', ReuniaoController::class);
    Route::resource('vaga', VagaController::class);

    Route::post('usuario/search', [UsuarioController::class, 'search'])->name(
        'usuario.search'
    );
    Route::post('servico1/search', [Servico1Controller::class, 'search'])->name(
        'servico1.search'
    );
    Route::post('reuniao/search', [ReuniaoController::class, 'search'])->name(
        'reuniao.search'
    );
    Route::post('vaga/search', [VagaController::class, 'search'])->name(
        'vaga.search'
    );

    Route::get('/profile', [ProfileController::class, 'edit'])->name(
        'profile.edit'
    );
    Route::patch('/profile', [ProfileController::class, 'update'])->name(
        'profile.update'
    );
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name(
        'profile.destroy'
    );
});

require __DIR__ . '/auth.php';
