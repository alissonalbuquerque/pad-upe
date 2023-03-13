<?php

use App\Http\Controllers\AnexoController;
use Illuminate\Support\Facades\Route;

Route::prefix('/pad/anexo')->group(function() {
    Route::get('/edit/{user_pad_id}', [AnexoController::class, 'edit'])->name('edit_anexo');
    Route::post('/update/{user_pad_id}', [AnexoController::class, 'update'])->name('update_anexo');
});