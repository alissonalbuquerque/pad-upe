<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserPadController;

Route::prefix('/user-pad')->group(function() {
    Route::get('/create/{pad_id?}', [UserPadController::class, 'actionCreate'])->name('user-pad_create');
    Route::post('/store', [UserPadController::class, 'actionStore'])->name('user-pad_store');
    Route::get('/edit/{id?}', [UserPadController::class, 'actionEdit'])->name('user-pad_edit');
    Route::post('/update/{id}', [UserPadController::class, 'actionUpdate'])->name('user-pad_update');
    Route::delete('/delete/{id}', [UserPadController::class, 'actionDelete'])->name('user-pad_delete');
    Route::post('/validate', [UserPadController::class, 'ajaxValidation'])->name('user-pad_ajax_validation');
    Route::post('/send-confirmation-email', [UserPadController::class, 'enviaEmailConfirmacao'])->name('send-confirmation-email');
    Route::get('/save/{user_pad_id}', [UserPadController::class, 'savePAD'])->name('user-pad_save');
    Route::get('/pdf/{user_pad_id}', [UserPadController::class, 'generatePDF'])->name('user-pad_pdf');
});
