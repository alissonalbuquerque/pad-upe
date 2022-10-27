<?php

use App\Http\Controllers\Dimensao\Tabelas\Pesquisa\PesquisaCoordenacaoController;
use App\Http\Controllers\Dimensao\Tabelas\Pesquisa\PesquisaLiderancaController;
use App\Http\Controllers\Dimensao\Tabelas\Pesquisa\PesquisaOrientacaoController;
use App\Http\Controllers\Dimensao\Tabelas\Pesquisa\PesquisaOutrosController;
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

/** PesquisaCoordenacaoController */
Route::prefix('/pad/dimensao/pesquisa/coordenacao')->group(function () {
    Route::post('/create', [PesquisaCoordenacaoController::class, 'create'])->name('pesquisa_coordenacao_create');
    Route::post('/update/{id}', [PesquisaCoordenacaoController::class, 'update'])->name('pesquisa_coordenacao_update');
    Route::post('/validate', [PesquisaCoordenacaoController::class, 'ajaxValidation'])->name('pesquisa_coordenacao_validate');
    Route::delete('/delete/{id}', [PesquisaCoordenacaoController::class, 'delete'])->name('pesquisa_coordenacao_delete');

    Route::get('/index/{user_pad_id}', [PesquisaCoordenacaoController::class, 'index'])->name('pesquisa_coordenacao_index');
    Route::get('/edit/{id?}', [PesquisaCoordenacaoController::class, 'edit'])->name('view_pesquisa_coordenacao_update');
    Route::get('/search/{user_pad_id?}', [PesquisaCoordenacaoController::class, 'search'])->name('pesquisa_coordenacao_search');
    Route::get('/resolucao', [PesquisaCoordenacaoController::class, 'viewResolucao'])->name('view_pesquisa_coordenacao_resolucao');
});

/** PesquisaLiderancaController */
Route::prefix('/pad/dimensao/pesquisa/lideranca')->group(function () {
    Route::post('/create', [PesquisaLiderancaController::class, 'create'])->name('pesquisa_lideranca_create');
    Route::post('/update/{id}', [PesquisaLiderancaController::class, 'update'])->name('pesquisa_lideranca_update');
    Route::post('/validate', [PesquisaLiderancaController::class, 'ajaxValidation'])->name('pesquisa_lideranca_validate');
    Route::delete('/delete/{id}', [PesquisaLiderancaController::class, 'delete'])->name('pesquisa_lideranca_delete');

    Route::get('/index/{user_pad_id}', [PesquisaLiderancaController::class, 'index'])->name('pesquisa_lideranca_index');
    Route::get('/edit/{id?}', [PesquisaLiderancaController::class, 'edit'])->name('view_pesquisa_lideranca_update');
    Route::get('/search/{user_pad_id?}', [PesquisaLiderancaController::class, 'search'])->name('pesquisa_lideranca_search');
    Route::get('/resolucao', [PesquisaLiderancaController::class, 'viewResolucao'])->name('view_pesquisa_lideranca_resolucao');
});


/** PesquisaOrientacaoController */
Route::prefix('/pad/dimensao/pesquisa/orientacao')->group(function () {
    Route::post('/create', [PesquisaOrientacaoController::class, 'create'])->name('pesquisa_orientacao_create');
    Route::post('/update/{id}', [PesquisaOrientacaoController::class, 'update'])->name('pesquisa_orientacao_update');
    Route::post('/validate', [PesquisaOrientacaoController::class, 'ajaxValidation'])->name('pesquisa_orientacao_validate');
    Route::delete('/delete/{id}', [PesquisaOrientacaoController::class, 'delete'])->name('pesquisa_orientacao_delete');

    Route::get('/index/{user_pad_id}', [PesquisaOrientacaoController::class, 'index'])->name('pesquisa_orientacao_index');
    Route::get('/edit/{id?}', [PesquisaOrientacaoController::class, 'edit'])->name('view_pesquisa_orientacao_update');
    Route::get('/search/{user_pad_id?}', [PesquisaOrientacaoController::class, 'search'])->name('pesquisa_orientacao_search');
    Route::get('/resolucao', [PesquisaOrientacaoController::class, 'viewResolucao'])->name('view_pesquisa_orientacao_resolucao');
});

/** PesquisaOutrosController */
Route::prefix('/pad/dimensao/pesquisa/outros')->group(function () {
    Route::post('/create', [PesquisaOutrosController::class, 'create'])->name('pesquisa_outros_create');
    Route::post('/update/{id}', [PesquisaOutrosController::class, 'update'])->name('pesquisa_outros_update');
    Route::post('/validate', [PesquisaOutrosController::class, 'ajaxValidation'])->name('pesquisa_outros_validate');
    Route::delete('/delete/{id}', [PesquisaOutrosController::class, 'delete'])->name('pesquisa_outros_delete');

    Route::get('/index/{user_pad_id}', [PesquisaOutrosController::class, 'index'])->name('pesquisa_outros_index');
    Route::get('/edit/{id?}', [PesquisaOutrosController::class, 'edit'])->name('view_pesquisa_outros_update');
    Route::get('/search/{user_pad_id?}', [PesquisaOutrosController::class, 'search'])->name('pesquisa_outros_search');
    Route::get('/resolucao', [PesquisaOutrosController::class, 'viewResolucao'])->name('view_pesquisa_outros_resolucao');
});