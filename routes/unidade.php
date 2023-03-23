<?php

use App\Http\Controllers\UnidadeController;
use Illuminate\Support\Facades\Route;

Route::prefix('/unidade')->group(function () {
    Route::get('/index', [UnidadeController::class, 'index'])->name('unidade_index');
    Route::get('/create', [UnidadeController::class, 'create'])->name('unidade_create');
    Route::post('/store', [UnidadeController::class, 'store'])->name('unidade_store');
    Route::get('/edit/{id}', [UnidadeController::class, 'edit'])->name('unidade_edit');
    Route::get('/search', [UnidadeController::class, 'search'])->name('unidade_search');
    Route::post('/update/{id}', [UnidadeController::class, 'update'])->name('unidade_update');
    Route::delete('/delete/{id}', [UnidadeController::class, 'delete'])->name('unidade_delete');
});
