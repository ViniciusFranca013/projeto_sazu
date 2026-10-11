<?php

use App\Http\Controllers\CidadaoController;
use App\Http\Controllers\OcorrenciaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return view('auth/login');
});

Route::get('/dashboard', [CidadaoController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
    
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('posts', PostController::class); // add this resource route
Route::resource('cidadaos', CidadaoController::class); // add this resource route
Route::resource('ocorrencias', OcorrenciaController::class);
require __DIR__.'/auth.php';


