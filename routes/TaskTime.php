<?php

use App\Http\Controllers\TaskTimeController;
use Illuminate\Support\Facades\Route;

Route::prefix('/tarefa/horario')->group(function () {
    Route::get('/index/{user_pad_id}', [TaskTimeController::class, 'index'])->name('TaskTimeIndex');
    Route::get('/create/{user_pad_id}', [TaskTimeController::class, 'create'])->name('TaskTimeCreate');
    Route::post('/save', [TaskTimeController::class, 'save'])->name('TaskTimeSave');
    Route::get('/edit/{id?}', [TaskTimeController::class, 'edit'])->name('TaskTimeEdit');
    Route::post('/update/{id}', [TaskTimeController::class, 'update'])->name('TaskTimeUpdate');
    Route::delete('/delete/{id}', [TaskTimeController::class, 'delete'])->name('TaskTimeDelete');
    Route::get('/search-task', [TaskTimeController::class, 'searchTask'])->name('TaskTimeSearchTask');
    Route::post('/validation', [TaskTimeController::class, 'ajaxValidation'])->name('TaskTimeValidation');
});
