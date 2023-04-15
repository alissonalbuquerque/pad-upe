<?php

use App\Http\Controllers\AvaliadorPadController;
use Illuminate\Support\Facades\Route;
/** UserPad */
Route::prefix('/avaliator-pad')->group(function() {
    Route::get('/create/{pad_id?}', [AvaliadorPadController::class, 'actionCreate'])->name('avaliator-pad_create');
    Route::post('/store', [AvaliadorPadController::class, 'actionStore'])->name('avaliator-pad_store');
    Route::get('/edit/{id?}', [AvaliadorPadController::class, 'actionEdit'])->name('avaliador-pad_edit');
    Route::post('/update/{id}', [AvaliadorPadController::class, 'actionUpdate'])->name('avaliator-pad_update');
    Route::delete('/delete/{id}', [AvaliadorPadController::class, 'actionDelete'])->name('avaliador-pad_delete');
    Route::post('/validate', [AvaliadorPadController::class, 'ajaxValidation'])->name('avaliador-pad_ajax_validation');
});

