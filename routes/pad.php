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
    Route::get('/{id}/avaliar/professores', [PadController::class, 'professores'])->name('pad_professores');
    Route::get('/{id}/professor/{professor_id}/atividades/{aba?}', [PadController::class, 'professor_atividades'])->name('pad_professor_atividades');
    Route::get('/{id}/professor/{professor_id}/atividades/ensino', [PadController::class, 'professor_atividades'])->name('pad_professor_atividades_ensino');
    Route::get('/{id}/professor/{professor_id}/atividades/pesquisa', [PadController::class, 'professor_atividades'])->name('pad_professor_atividades_pesquisa');
    Route::get('/{id}/professor/{professor_id}/atividades/gestao', [PadController::class, 'professor_atividades'])->name('pad_professor_atividades_gestao');
    Route::get('/{id}/professor/{professor_id}/atividades/extensao', [PadController::class, 'professor_atividades'])->name('pad_professor_atividades_extensao');
});

/** PadProfessor */
Route::prefix('/pad/professor')->group(function () {
    Route::get('/index', [PadController::class, 'index'])->name('pad_index');
    Route::get('/view/{id}', [PadController::class, 'view'])->name('pad_view');
    Route::get('/anexo/{id}', [PadController::class, 'anexo'])->name('pad_anexo');
});

/** PadAvaliador */
// Route::prefix('/pad/avaliador')->group(function () {
//     Route::get('/index', [PadAvaliadorController::class, 'index'])->name('pad_index');
//     // Route::get('/view/{id}', [PadAvaliadorController::class, 'view'])->name('pad_view');
//     // Route::get('/anexo/{id}', [PadAvaliadorController::class, 'anexo'])->name('pad_anexo');
// });
