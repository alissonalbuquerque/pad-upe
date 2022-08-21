<?php

use App\Http\Controllers\Dimensao\EnsinoController;
use App\Http\Controllers\Dimensao\PesquisaController;
use App\Http\Controllers\Dimensao\ExtensaoController;
use App\Http\Controllers\Dimensao\GestaoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/** Dimensoes|Eixos */
Route::prefix('/pad/dimensao/')->group(function () {
    Route::get('/gestao/{user_pad_id}', [GestaoController::class, 'index'])->name('dimensao_gestao');
    Route::get('/ensino/{user_pad_id}', [EnsinoController::class, 'index'])->name('dimensao_ensino');
    Route::get('/pesquisa/{user_pad_id}/{form_selected?}', [PesquisaController::class, 'index'])->name('dimensao_pesquisa');
    Route::get('/extensao/{user_pad_id}/{form_selected?}', [ExtensaoController::class, 'index'])->name('dimensao_extensao');
});