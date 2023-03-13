<?php

use App\Http\Controllers\CampusController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Dimensao\EnsinoController;
use App\Http\Controllers\DisciplinaController;
use App\Http\Controllers\UnidadeController;
use App\Http\Controllers\PadController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CoordenadorController;
use App\Http\Controllers\DiretorController;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\AvaliadorController;
use App\Http\Controllers\UserPadController;
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

require __DIR__ . '/profile.php';

require __DIR__ . '/anexo.php';

require __DIR__ . '/users.php';

require __DIR__ . '/user_type.php';

require __DIR__ . '/dimensao/dimensao.php';

require __DIR__ . '/dimensao/ensino.php';
require __DIR__ . '/dimensao/gestao.php';
require __DIR__ . '/dimensao/pesquisa.php';
require __DIR__ . '/dimensao/extensao.php';

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
    Route::get('/search', [CampusController::class, 'actionSearch'])->name('campus_search');
});

Route::prefix('/curso')->group(function () {
    Route::get('/index', [CursoController::class, 'index'])->name('curso_index');
    Route::get('/create', [CursoController::class, 'create'])->name('curso_create');
    Route::post('/store', [CursoController::class, 'store'])->name('curso_store');
    Route::get('/edit/{id}', [CursoController::class, 'edit'])->name('curso_edit');
    Route::post('/update/{id}', [CursoController::class, 'update'])->name('curso_update');
    Route::delete('/delete/{id}', [CursoController::class, 'destroy'])->name('curso_delete');
    Route::get('/search', [CursoController::class, 'actionSearch'])->name('curso_search');
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
    Route::get('/index', [PadController::class, 'index'])->name('pad_index');
    Route::get('/create', [PadController::class, 'create'])->name('pad_create');
    Route::post('/store', [PadController::class, 'store'])->name('pad_store');
    Route::get('/edit/{id}', [PadController::class, 'edit'])->name('pad_edit');
    Route::put('/update/{id}', [PadController::class, 'update'])->name('pad_update');
    Route::delete('/delete/{id}', [PadController::class, 'delete'])->name('pad_delete');
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

Route::prefix('/professor')->group(function () {
    Route::get('/index', [ProfessorController::class, 'index'])->name('professor_index');
    Route::get('/create', [ProfessorController::class, 'create'])->name('professor_create');
    Route::post('/store', [ProfessorController::class, 'store'])->name('professor_store');
    Route::get('/edit/{id}', [ProfessorController::class, 'edit'])->name('professor_edit');
    Route::post('/update/{id}', [ProfessorController::class, 'update'])->name('professor_update');
    Route::delete('/delete/{id}', [ProfessorController::class, 'destroy'])->name('professor_delete');
});

Route::prefix('/avaliador')->group(function () {
    Route::get('/index', [AvaliadorController::class, 'index'])->name('avaliador_index');
    Route::get('/avaliar', [AvaliadorController::class, 'avaliar'])->name('avaliador_avaliar');
    Route::get('/create', [AvaliadorController::class, 'create'])->name('avaliador_create');
    Route::post('/store', [AvaliadorController::class, 'store'])->name('avaliador_store');
    Route::get('/edit/{id}', [AvaliadorController::class, 'edit'])->name('avaliador_edit');
    Route::post('/update/{id}', [AvaliadorController::class, 'update'])->name('avaliador_update');
    Route::delete('/delete/{id}', [AvaliadorController::class, 'destroy'])->name('avaliador_delete');
});

Route::prefix('/user')->group(function () {
    Route::get('/edit/perfil/{tab?}', [UserController::class, 'editPerfil'])->name('edit_perfil');
    Route::post('/update/perfil', [UserController::class, 'updatePerfil'])->name('update_perfil');
    Route::post('/update/password', [UserController::class, 'updatePassword'])->name('update_password');
});

/** json */
Route::get('/disciplina/{curso_id}', [DisciplinaController::class, 'getDisciplinaByCurso'])->name('get_disciplina_by_curso');

/** PadProfessor */
Route::prefix('/pad/professor')->group(function () {
    Route::get('/index', [PadController::class, 'index'])->name('pad_index');
    Route::get('/view/{id}', [PadController::class, 'view'])->name('pad_view');
    Route::get('/anexo/{id}', [PadController::class, 'anexo'])->name('pad_anexo');
});

/** UserPad */
Route::prefix('/user-pad')->group(function() {
    Route::get('/create/{pad_id?}', [UserPadController::class, 'actionCreate'])->name('user-pad_create');
    Route::post('/store', [UserPadController::class, 'actionStore'])->name('user-pad_store');
    Route::get('/edit/{id?}', [UserPadController::class, 'actionEdit'])->name('user-pad_edit');
    Route::post('/update/{id}', [UserPadController::class, 'actionUpdate'])->name('user-pad_update');
    Route::delete('/delete/{id}', [UserPadController::class, 'actionDelete'])->name('user-pad_delete');
    Route::post('/validate', [UserPadController::class, 'ajaxValidation'])->name('user-pad_ajax_validation');
});


// return json
Route::get('/listar/unidade', [UnidadeController::class, 'getAll'])->name('listar_unidades');
Route::get('/list/campus/{unidade_id}', [CampusController::class, 'findByUnidade'])->name('list_campus_by_unidade');