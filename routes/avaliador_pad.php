<?php

use App\Http\Controllers\AvaliadorPadController;
use Illuminate\Support\Facades\Route;
/** UserPad */
Route::prefix('/avaliator-pad')->group(function() {
    Route::get('/create/{pad_id?}', [AvaliadorPadController::class, 'actionCreate'])->name('avaliator-pad_create');
    Route::post('/store', [AvaliadorPadController::class, 'actionStore'])->name('avaliator-pad_store');
    // Route::get('/edit/{id?}', [UserPadController::class, 'actionEdit'])->name('user-pad_edit');
    // Route::post('/update/{id}', [UserPadController::class, 'actionUpdate'])->name('user-pad_update');
    // Route::delete('/delete/{id}', [UserPadController::class, 'actionDelete'])->name('user-pad_delete');
    Route::post('/validate', [AvaliadorPadController::class, 'ajaxValidation'])->name('avaliador-pad_ajax_validation');
});

