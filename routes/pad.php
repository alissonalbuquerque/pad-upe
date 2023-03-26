<?php

use App\Http\Controllers\PadAvaliadorController;
use App\Http\Controllers\PadController;
use Illuminate\Support\Facades\Route;

/** PadAdmin */
Route::prefix('/pad')->group(function () {
    Route::get('/index', [PadController::class, 'index'])->name('pad_index');
    Route::get('/create', [PadController::class, 'create'])->name('pad_create');
    Route::post('/store', [PadController::class, 'store'])->name('pad_store');
    Route::get('/edit/{id}', [PadController::class, 'edit'])->name('pad_edit');
    Route::put('/update/{id}', [PadController::class, 'update'])->name('pad_update');
    Route::delete('/delete/{id}', [PadController::class, 'delete'])->name('pad_delete');
});

/** PadProfessor */
Route::prefix('/pad/professor')->group(function () {
    Route::get('/index', [PadController::class, 'index'])->name('pad_index');
    Route::get('/view/{id}', [PadController::class, 'view'])->name('pad_view');
    Route::get('/anexo/{id}', [PadController::class, 'anexo'])->name('pad_anexo');
});

/** PadAvaliador */
Route::prefix('/pad/avaliador')->group(function () {
    Route::get('/index', [PadAvaliadorController::class, 'index'])->name('pad_index');
    // Route::get('/view/{id}', [PadAvaliadorController::class, 'view'])->name('pad_view');
    // Route::get('/anexo/{id}', [PadAvaliadorController::class, 'anexo'])->name('pad_anexo');
});