<?php

use App\Http\Controllers\AvaliadorController;
use App\Http\Controllers\AvaliadorTaskTimeController;
use App\Http\Controllers\PadController;
use Illuminate\Support\Facades\Route;

Route::prefix('/avaliador')->group(function () {
    Route::get('/index', [AvaliadorController::class, 'index'])->name('avaliador_index');
    Route::put('/avaliar', [AvaliadorController::class, 'avaliar'])->name('avaliador_avaliar');
    Route::get('/create', [AvaliadorController::class, 'create'])->name('avaliador_create');
    Route::post('/store', [AvaliadorController::class, 'store'])->name('avaliador_store');
    Route::get('/edit/{id}', [AvaliadorController::class, 'edit'])->name('avaliador_edit');
    Route::post('/update/{id}', [AvaliadorController::class, 'update'])->name('avaliador_update');
    Route::delete('/delete/{id}', [AvaliadorController::class, 'destroy'])->name('avaliador_delete');
    Route::get('/relatorio', [AvaliadorController::class, 'relatorio'])->name('avaliador_relatorio');
    Route::get('/relatorio/{id}', [PadController::class, 'relatorio'])->name('pad_relatório');
    Route::get('/relatorio/{id}/pdf', [PadController::class, 'generatePDF'])->name('pad_relatório_pdf');

    Route::get('/horario/index', [AvaliadorTaskTimeController::class, 'index'])->name('avaliador_task_time_index');
});
