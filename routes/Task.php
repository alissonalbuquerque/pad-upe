<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::prefix('/tarefa/geral')->group(function () {
    Route::get('/search', [TaskController::class, 'search'])->name('TaskSearch');
});