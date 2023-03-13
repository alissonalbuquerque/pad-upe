<?php

use App\Http\Controllers\UserTypeController;
use Illuminate\Support\Facades\Route;

/** UserType */
Route::prefix('/user-type')->group(function() {
    Route::get('/create/{user_id?}', [UserTypeController::class, 'actionCreate'])->name('user-type_create');
    Route::post('/store', [UserTypeController::class, 'actionStore'])->name('user-type_store');
    Route::get('/edit/{id?}', [UserTypeController::class, 'actionEdit'])->name('user-type_edit');
    Route::post('/update/{id}', [UserTypeController::class, 'actionUpdate'])->name('user-type_update');
    Route::delete('/delete/{id}', [UserTypeController::class, 'actionDelete'])->name('user-type_delete');
    Route::post('/validate', [UserTypeController::class, 'ajaxValidation'])->name('user-type_ajax_validation');
});