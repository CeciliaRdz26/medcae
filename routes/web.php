<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\ProductoController;

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
})->name('welcome');

Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/productos', [ProductoController::class, 'index'])->name('producto.index');
    Route::get('/productos/create', [ProductoController::class, 'create'])->name('producto.create');
    Route::post('/productos', [ProductoController::class, 'store'])->name('producto.store');
    Route::get('/productos/{producto}', [ProductoController::class, 'show'])->name('producto.show');
    Route::get('/productos/{producto}/edit', [ProductoController::class, 'edit'])->name('producto.edit');
    Route::put('/productos/{producto}', [ProductoController::class, 'update'])->name('producto.update');
    Route::delete('/productos/{producto}', [ProductoController::class, 'destroy'])->name('producto.destroy');

    Route::get('/medicos', [MedicoController::class, 'index'])->name('medico.index');
    Route::get('/medicos/create', [MedicoController::class, 'create'])->name('medico.create');
    Route::post('/medicos', [MedicoController::class, 'store'])->name('medico.store');
    Route::get('/medicos/{medico}', [MedicoController::class, 'show'])->name('medico.show');
    Route::get('/medicos/{medico}/edit', [MedicoController::class, 'edit'])->name('medico.edit');
    Route::put('/medicos/{medico}', [MedicoController::class, 'update'])->name('medico.update');
    Route::delete('/medicos/{medico}', [MedicoController::class, 'destroy'])->name('medico.destroy');

    Route::get('/pacientes', [PacienteController::class, 'index'])->name('paciente.index');

    Route::get('/citas/{medico}', [CitaController::class, 'index'])->name('citamedica.index');
    Route::get('/citas/create', [CitaController::class, 'create'])->name('citamedica.create');
    


});
