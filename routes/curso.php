<?php

use App\Http\Controllers\CursoController;
use Illuminate\Support\Facades\Route;

Route::prefix('/curso')->group(function () {
    Route::get('/index', [CursoController::class, 'index'])->name('curso_index');
    Route::get('/create', [CursoController::class, 'create'])->name('curso_create');
    Route::post('/store', [CursoController::class, 'store'])->name('curso_store');
    Route::get('/edit/{id}', [CursoController::class, 'edit'])->name('curso_edit');
    Route::post('/update/{id}', [CursoController::class, 'update'])->name('curso_update');
    Route::delete('/delete/{id}', [CursoController::class, 'delete'])->name('curso_delete');
    Route::get('/search', [CursoController::class, 'actionSearch'])->name('curso_search');
    Route::get('/viewPDF', [CursoController::class, 'pdfVisualizer'])->name('view_pdf');
    Route::get('/pdf', [CursoController::class, 'createPDF'])->name('cursos_print');
});
