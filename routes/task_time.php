<?php

use App\Http\Controllers\TaskTimeController;
use Illuminate\Support\Facades\Route;

Route::prefix('/tarefa/horario')->group(function () {
    Route::get('/index/{user_pad_id}', [TaskTimeController::class, 'index'])->name('task_time_index');
    Route::get('/create/{user_pad_id}', [TaskTimeController::class, 'create'])->name('task_time_create');
    Route::post('/save', [TaskTimeController::class, 'save'])->name('task_time_save');
    Route::get('/edit/{id?}', [TaskTimeController::class, 'edit'])->name('task_time_edit');
    Route::post('/update/{id}', [TaskTimeController::class, 'update'])->name('task_time_update');
    Route::delete('/delete/{id}', [TaskTimeController::class, 'delete'])->name('task_time_delete');
    Route::get('/search-task', [TaskTimeController::class, 'searchTask'])->name('task_time_search');
    Route::post('/validation', [TaskTimeController::class, 'ajaxValidation'])->name('task_time_validation');
});
