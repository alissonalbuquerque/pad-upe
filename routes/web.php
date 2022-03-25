<?php

use App\Http\Controllers\CampusController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Dimensao\EnsinoController;
use App\Http\Controllers\Dimensao\PesquisaController;
use App\Http\Controllers\Dimensao\ExtensaoController;
use App\Http\Controllers\Dimensao\GestaoController;
use App\Http\Controllers\UnidadeController;
use App\Http\Controllers\PADController;
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

Route::get('/pad/index', [PADController::class, 'index'])->name('pad_index');
Route::get('/pad/create', [PADController::class, 'create'])->name('pad_create');
Route::post('/pad/store', [PADController::class, 'store'])->name('pad_store');
Route::get('/pad/edit/{id}', [PADController::class, 'edit'])->name('pad_edit');
Route::post('/pad/update/{id}', [PADController::class, 'update'])->name('pad_update');
Route::delete('/pad/delete/{id}', [PADController::class, 'destroy'])->name('pad_delete');


Route::get('/curso/index', [CursoController::class, 'index'])->name('curso_index');
Route::get('/curso/create', [CursoController::class, 'create'])->name('curso_create');
Route::post('/curso/store', [CursoController::class, 'store'])->name('curso_store');

// return json
Route::get('/listar/unidade', [UnidadeController::class, 'getAll'])->name('listar_unidades');
Route::get('/list/campus/{unidade_id}', [CampusController::class, 'findByUnidade'])->name('list_campus_by_unidade');

Route::get('/dimensao/gestao', [GestaoController::class, 'index'])->name('dimensao_gestao');
Route::get('/dimensao/ensino', [EnsinoController::class, 'index'])->name('dimensao_ensino');
Route::get('/dimensao/pesquisa', [PesquisaController::class, 'index'])->name('dimensao_pesquisa');
Route::get('/dimensao/extensao', [ExtensaoController::class, 'index'])->name('dimensao_extensao');
