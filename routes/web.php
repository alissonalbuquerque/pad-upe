<?php

use App\Http\Controllers\CampusController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Dimensao\EnsinoController;
use App\Http\Controllers\Dimensao\PesquisaController;
use App\Http\Controllers\Dimensao\ExtensaoController;
use App\Http\Controllers\Dimensao\GestaoController;
use App\Http\Controllers\DisciplinaController;
use App\Http\Controllers\UnidadeController;
use App\Http\Controllers\PADController;
use App\Http\Controllers\Dimensao\Tabelas\Ensino\EnsinoAulaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CoordenadorController;
use App\Http\Controllers\DiretorController;
use App\Models\Disciplina;
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

require __DIR__ . '/auth.php';

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::prefix('/campus')->group(function () {
    Route::get('/index', [CampusController::class, 'index'])->name('campus_index');
    Route::get('/create', [CampusController::class, 'create'])->name('campus_create');
    Route::post('/store', [CampusController::class, 'store'])->name('campus_store');
    Route::get('/edit/{id}', [CampusController::class, 'edit'])->name('campus_edit');
    Route::post('/update/{id}', [CampusController::class, 'update'])->name('campus_update');
    Route::delete('/delete/{id}', [CampusController::class, 'destroy'])->name('campus_delete');
});

Route::prefix('/curso')->group(function () {
    Route::get('/index', [CursoController::class, 'index'])->name('curso_index');
    Route::get('/create', [CursoController::class, 'create'])->name('curso_create');
    Route::post('/store', [CursoController::class, 'store'])->name('curso_store');
    Route::get('/edit/{id}', [CursoController::class, 'edit'])->name('curso_edit');
    Route::post('/update/{id}', [CursoController::class, 'update'])->name('curso_update');
    Route::delete('/delete/{id}', [CursoController::class, 'destroy'])->name('curso_delete');
});

Route::prefix('/unidade')->group(function () {
    Route::get('/index', [UnidadeController::class, 'index'])->name('unidade_index');
    Route::get('/create', [UnidadeController::class, 'create'])->name('unidade_create');
    Route::post('/store', [UnidadeController::class, 'store'])->name('unidade_store');
    Route::get('/edit/{id}', [UnidadeController::class, 'edit'])->name('unidade_edit');
    Route::post('/update/{id}', [UnidadeController::class, 'update'])->name('unidade_update');
    Route::delete('/delete/{id}', [UnidadeController::class, 'destroy'])->name('unidade_delete');
});

Route::prefix('/ensino')->group(function () {
    Route::get('/index', [EnsinoController::class, 'index'])->name('ensino_index');
    Route::get('/create', [EnsinoController::class, 'create'])->name('ensino_create');
    Route::post('/store', [EnsinoController::class, 'store'])->name('ensino_store');
    Route::get('/edit/{id}', [EnsinoController::class, 'edit'])->name('ensino_edit');
    Route::post('/update/{id}', [EnsinoController::class, 'update'])->name('ensino_update');
    Route::delete('/delete/{id}', [EnsinoController::class, 'destroy'])->name('ensino_delete');
});

Route::prefix('/pad')->group(function () {
    Route::get('/index', [PADController::class, 'index'])->name('pad_index');
    Route::get('/create', [PADController::class, 'create'])->name('pad_create');
    Route::post('/store', [PADController::class, 'store'])->name('pad_store');
    Route::get('/edit/{id}', [PADController::class, 'edit'])->name('pad_edit');
    Route::post('/update/{id}', [PADController::class, 'update'])->name('pad_update');
    Route::delete('/delete/{id}', [PADController::class, 'destroy'])->name('pad_delete');
    Route::get('/anexo', [PADController::class, 'anexo'])->name('pad_anexo');
});

Route::prefix('/coordenador')->group(function () {
    Route::get('/index', [CoordenadorController::class, 'index'])->name('coordenador_index');
    Route::get('/create', [CoordenadorController::class, 'create'])->name('coordenador_create');
    Route::post('/store', [CoordenadorController::class, 'store'])->name('coordenador_store');
    Route::get('/edit/{id}', [CoordenadorController::class, 'edit'])->name('coordenador_edit');
    Route::post('/update/{id}', [CoordenadorController::class, 'update'])->name('coordenador_update');
    Route::delete('/delete/{id}', [CoordenadorController::class, 'destroy'])->name('coordenador_delete');
});

Route::prefix('/diretor')->group(function () {
    Route::get('/index', [DiretorController::class, 'index'])->name('diretor_index');
    Route::get('/create', [DiretorController::class, 'create'])->name('diretor_create');
    Route::post('/store', [DiretorController::class, 'store'])->name('diretor_store');
    Route::get('/edit/{id}', [DiretorController::class, 'edit'])->name('diretor_edit');
    Route::post('/update/{id}', [DiretorController::class, 'update'])->name('diretor_update');
    Route::delete('/delete/{id}', [DiretorController::class, 'destroy'])->name('diretor_delete');
});

// return json
Route::get('/listar/unidade', [UnidadeController::class, 'getAll'])->name('listar_unidades');
Route::get('/list/campus/{unidade_id}', [CampusController::class, 'findByUnidade'])->name('list_campus_by_unidade');

Route::prefix('/pad/dimensao/')->group(function () {
    Route::get('/gestao', [GestaoController::class, 'index'])->name('dimensao_gestao');
    Route::get('/ensino', [EnsinoController::class, 'index'])->name('dimensao_ensino');
    Route::get('/pesquisa', [PesquisaController::class, 'index'])->name('dimensao_pesquisa');
    Route::get('/extensao', [ExtensaoController::class, 'index'])->name('dimensao_extensao');
});

Route::prefix('/pad/dimensao/ensino')->group(function () {
    Route::post('/aulas/create', [EnsinoAulaController::class, 'create'])->name('ensino_aula_create');
    // Route::get('/ensino/aulas/update', [EnsinoAulaController::class, 'update'])->name('ensino_aula_update');
    // Route::get('/ensino/aulas/delete', [EnsinoAulaController::class, 'update'])->name('ensino_aula_delete');
    Route::get('/aulas/{pad_id}', [EnsinoAulaController::class, 'getAll'])->name('ensino_aula_all');
});

Route::prefix('/user')->group(function () {
    Route::get('/edit/perfil', [UserController::class, 'editPerfil'])->name('edit_perfil');
    Route::post('/update/perfil', [UserController::class, 'updatePerfil'])->name('update_perfil');
    Route::post('/update/password', [UserController::class, 'updatePassword'])->name('update_password');
});

/** json */
Route::get('/disciplina/{curso_id}', [DisciplinaController::class, 'getDisciplinaByCurso'])->name('get_disciplina_by_curso');
