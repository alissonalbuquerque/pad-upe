<?php

use App\Http\Controllers\UnidadeController;
use App\Http\Controllers\UserPadController;
use Illuminate\Support\Facades\Route;

Route::prefix('/user-pad')->group(function() {
    Route::get('/change-status/{id}', [UserPadController::class, 'action_change_status'])->name('user_pad_alter_status');
});
