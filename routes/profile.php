<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('/profile')->group(function() {
    Route::get('/change/{user_id}/{user_type_id}', [UserController::class, 'actionChangeProfile'])->name('change_profile');
});