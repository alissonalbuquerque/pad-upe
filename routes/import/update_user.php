<?php

use App\Http\Controllers\ImportUserController;
use Illuminate\Support\Facades\Route;

Route::prefix('/import')->group(function()
{
    Route::get('/index', [ImportUserController::class, 'actionIndex'])->name('import_index');
    Route::post('/store', [ImportUserController::class, 'actionStore'])->name('import_store');
});
