<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('/users')->group(function() {
    Route::get('/index', [UserController::class, 'actionIndex'])->name('user_index');
    Route::get('/create', [UserController::class, 'actionCreate'])->name('user_create');
    Route::post('/store', [UserController::class, 'actionStore'])->name('user_store');
    Route::get('/edit/{id}', [UserController::class, 'actionEdit'])->name('user_edit');
    Route::post('/update/{id}', [UserController::class, 'actionUpdate'])->name('user_update');
    Route::delete('/delete/{id}', [UserController::class, 'actionDelete'])->name('user_delete');

    Route::post('/import', [UserController::class, 'actionImport'])->name('user_import');
    Route::get('/importView', [UserController::class, 'actionImportView'])->name('user_import_view');
});