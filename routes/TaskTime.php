<?php

use App\Http\Controllers\TaskTimeController;
use Illuminate\Support\Facades\Route;

Route::prefix('/tarefa/horario')->group(function () {
    Route::get('/index/{user_pad_id}', [TaskTimeController::class, 'index'])->name('TaskTimeIndex');
    Route::get('/create/{user_pad_id}', [TaskTimeController::class, 'create'])->name('TaskTimeCreate');
    Route::post('/save', [TaskTimeController::class, 'save'])->name('TaskTimeSave');
    //edit
    //update
    //delete
    //move

});