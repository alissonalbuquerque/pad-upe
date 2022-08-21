<?php

use App\Http\Controllers\Dimensao\Tabelas\Extensao\ExtensaoCoordenacaoController;
use App\Http\Controllers\Dimensao\Tabelas\Extensao\ExtensaoOrientacaoController;
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

/** ExtensaoCoordenacaoController */
Route::prefix('/pad/dimensao/extensao/coordenacao')->group(function () {
    Route::post('/create', [ExtensaoCoordenacaoController::class, 'create'])->name('extensao_coordenacao_create');
    Route::post('/update/{id}', [ExtensaoCoordenacaoController::class, 'update'])->name('extensao_coordenacao_update');
    Route::post('/validate', [ExtensaoCoordenacaoController::class, 'ajaxValidation'])->name('extensao_coordenacao_validate');
    Route::delete('/delete/{id}', [ExtensaoCoordenacaoController::class, 'delete'])->name('extensao_coordenacao_delete');

    Route::get('/index/{user_pad_id}', [ExtensaoCoordenacaoController::class, 'index'])->name('extensao_coordenacao_index');
    Route::get('/edit/{id?}', [ExtensaoCoordenacaoController::class, 'edit'])->name('view_extensao_coordenacao_update');
    Route::get('/search/{user_pad_id?}', [ExtensaoCoordenacaoController::class, 'search'])->name('extensao_coordenacao_search');
    Route::get('/resolucao', [ExtensaoCoordenacaoController::class, 'viewResolucao'])->name('view_extensao_coordenacao_resolucao');
});


/** ExtensaoOrientacaoController */
Route::prefix('/pad/dimensao/extensao/orientacao')->group(function () {
    Route::post('/create', [ExtensaoOrientacaoController::class, 'create'])->name('extensao_orientacao_create');
    Route::post('/update/{id}', [ExtensaoOrientacaoController::class, 'update'])->name('extensao_orientacao_update');
    Route::post('/validate', [ExtensaoOrientacaoController::class, 'ajaxValidation'])->name('extensao_orientacao_validate');
    Route::delete('/delete/{id}', [ExtensaoOrientacaoController::class, 'delete'])->name('extensao_orientacao_delete');

    Route::get('/index/{user_pad_id}', [ExtensaoOrientacaoController::class, 'index'])->name('extensao_orientacao_index');
    Route::get('/edit/{id?}', [ExtensaoOrientacaoController::class, 'edit'])->name('view_extensao_orientacao_update');
    Route::get('/search/{user_pad_id?}', [ExtensaoOrientacaoController::class, 'search'])->name('extensao_orientacao_search');
    Route::get('/resolucao', [ExtensaoOrientacaoController::class, 'viewResolucao'])->name('view_extensao_orientacao_resolucao');
});
