<?php

use App\Http\Controllers\PadController;
use Illuminate\Support\Facades\Route;

Route::prefix('/pad')->group(function () {
    Route::get('/index', [PadController::class, 'index'])->name('pad_index');
    Route::get('/create', [PadController::class, 'create'])->name('pad_create');
    Route::post('/store', [PadController::class, 'store'])->name('pad_store');
    Route::get('/edit/{id}', [PadController::class, 'edit'])->name('pad_edit');
    Route::put('/update/{id}', [PadController::class, 'update'])->name('pad_update');
    Route::delete('/delete/{id}', [PadController::class, 'delete'])->name('pad_delete');
});