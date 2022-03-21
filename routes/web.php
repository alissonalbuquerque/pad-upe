<?php

use App\Http\Controllers\CampusController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UnidadeController;
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

require __DIR__.'/auth.php';

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::get('/campus/index', [CampusController::class, 'index'])->name('campus_index');
Route::get('/campus/create', [CampusController::class, 'create'])->name('campus_create');
Route::post('/campus/store', [CampusController::class, 'store'])->name('campus_store');

Route::get('/unidade/index', [UnidadeController::class, 'index'])->name('unidade_index');
Route::get('/unidade/create', [UnidadeController::class, 'create'])->name('unidade_create');
Route::post('/unidade/store', [UnidadeController::class, 'store'])->name('unidade_store');
Route::get('/unidade/edit/{id}', [UnidadeController::class, 'edit'])->name('unidade_edit');
Route::post('/unidade/update/{id}', [UnidadeController::class, 'update'])->name('unidade_update');
Route::delete('/unidade/delete/{id}', [UnidadeController::class, 'destroy'])->name('unidade_delete');

Route::get('/ensino/index', [EnsinoController::class, 'index'])->name('ensino_index');
Route::get('/ensino/create', [EnsinoController::class, 'create'])->name('ensino_create');
Route::post('/ensino/store', [EnsinoController::class, 'store'])->name('ensino_store');
Route::get('/ensino/edit/{id}', [EnsinoController::class, 'edit'])->name('ensino_edit');
Route::post('/ensino/update/{id}', [EnsinoController::class, 'update'])->name('ensino_update');
Route::delete('/ensino/delete/{id}', [EnsinoController::class, 'destroy'])->name('ensino_delete');

Route::get('/extensao/index', [ExtensaoController::class, 'index'])->name('extensao_index');
Route::get('/extensao/create', [ExtensaoController::class, 'create'])->name('extensao_create');
Route::post('/extensao/store', [ExtensaoController::class, 'store'])->name('extensao_store');
Route::get('/extensao/edit/{id}', [ExtensaoController::class, 'edit'])->name('extensao_edit');
Route::post('/extensao/update/{id}', [ExtensaoController::class, 'update'])->name('extensao_update');
Route::delete('/extensao/delete/{id}', [ExtensaoController::class, 'destroy'])->name('extensao_delete');

Route::get('/gestao/index', [GestaoController::class, 'index'])->name('gestao_index');
Route::get('/gestao/create', [GestaoController::class, 'create'])->name('gestao_create');
Route::post('/gestao/store', [GestaoController::class, 'store'])->name('gestao_store');
Route::get('/gestao/edit/{id}', [GestaoController::class, 'edit'])->name('gestao_edit');
Route::post('/gestao/update/{id}', [GestaoController::class, 'update'])->name('gestao_update');
Route::delete('/gestao/delete/{id}', [GestaoController::class, 'destroy'])->name('gestao_delete');

Route::get('/pesquisa/index', [PesquisaController::class, 'index'])->name('pesquisa_index');
Route::get('/pesquisa/create', [PesquisaController::class, 'create'])->name('pesquisa_create');
Route::post('/pesquisa/store', [PesquisaController::class, 'store'])->name('pesquisa_store');
Route::get('/pesquisa/edit/{id}', [PesquisaController::class, 'edit'])->name('pesquisa_edit');
Route::post('/pesquisa/update/{id}', [PesquisaController::class, 'update'])->name('pesquisa_update');
Route::delete('/pesquisa/delete/{id}', [PesquisaController::class, 'destroy'])->name('pesquisa_delete');

Route::get('/curso/index', [CursoController::class, 'index'])->name('curso_index');
Route::get('/curso/create', [CursoController::class, 'create'])->name('curso_create');
Route::post('/curso/store', [CursoController::class, 'store'])->name('curso_store');

// return json
Route::get('/listar/unidade', [UnidadeController::class, 'getAll'])->name('listar_unidades');
Route::get('/list/campus/{unidade_id}', [CampusController::class, 'findByUnidade'])->name('list_campus_by_unidade');