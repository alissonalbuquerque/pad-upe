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
use App\Http\Controllers\PadController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CoordenadorController;
use App\Http\Controllers\DiretorController;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\AvaliadorController;
use App\Http\Controllers\Dimensao\Tabelas\Ensino\EnsinoAulaController;
use App\Http\Controllers\Dimensao\Tabelas\Ensino\EnsinoAtendimentoDiscenteController;
use App\Http\Controllers\Dimensao\Tabelas\Ensino\EnsinoCoordenacaoDisciplinaController;
use App\Http\Controllers\Dimensao\Tabelas\Ensino\EnsinoOrientacaoController;
use App\Http\Controllers\Dimensao\Tabelas\Ensino\EnsinoParticipacaoController;
use App\Http\Controllers\Dimensao\Tabelas\Ensino\EnsinoProjetoController;
use App\Http\Controllers\Dimensao\Tabelas\Ensino\EnsinoSupervisaoController;
use App\Http\Controllers\Dimensao\Tabelas\Ensino\EnsinoCoordenacaoDocenteController;
use App\Http\Controllers\Dimensao\Tabelas\Pesquisa\PesquisaCoordenacaoController;
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
    Route::get('/create', [AvaliadorController::class, 'create'])->name('avaliador_create');
    Route::post('/store', [AvaliadorController::class, 'store'])->name('avaliador_store');
    Route::get('/edit/{id}', [AvaliadorController::class, 'edit'])->name('avaliador_edit');
    Route::post('/update/{id}', [AvaliadorController::class, 'update'])->name('avaliador_update');
    Route::delete('/delete/{id}', [AvaliadorController::class, 'destroy'])->name('avaliador_delete');
});

Route::prefix('/user')->group(function () {
    Route::get('/edit/perfil', [UserController::class, 'editPerfil'])->name('edit_perfil');
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

/** Dimensoes|Eixos */
Route::prefix('/pad/dimensao/')->group(function () {
    Route::get('/gestao/{user_pad_id}', [GestaoController::class, 'index'])->name('dimensao_gestao');
    Route::get('/ensino/{user_pad_id}', [EnsinoController::class, 'index'])->name('dimensao_ensino');
    Route::get('/pesquisa/{user_pad_id}/{form_selected?}', [PesquisaController::class, 'index'])->name('dimensao_pesquisa');
    Route::get('/extensao/{user_pad_id}/{form_selected?}', [ExtensaoController::class, 'index'])->name('dimensao_extensao');
});

/* EnsinoAulaController */
Route::prefix('/pad/dimensao/ensino/aulas')->group(function () {
    Route::post('/create', [EnsinoAulaController::class, 'create'])->name('ensino_aula_create');
    Route::post('/update/{id}', [EnsinoAulaController::class, 'update'])->name('ensino_aula_update');
    Route::post('/validate', [EnsinoAulaController::class, 'ajaxValidation'])->name('ensino_aula_validate');
    Route::delete('/delete/{id}', [EnsinoAulaController::class, 'delete'])->name('ensino_aula_delete');

    Route::get('/index/{user_pad_id}', [EnsinoAulaController::class, 'index'])->name('ensino_aula_index');
    Route::get('/edit/{id?}', [EnsinoAulaController::class, 'edit'])->name('view_ensino_aula_update');
    Route::get('/search/{user_pad_id?}', [EnsinoAulaController::class, 'search'])->name('ensino_aula_search');
});

/* EnsinoCoordenacaoDisciplinaController */
Route::prefix('/pad/dimensao/ensino/coordenacao/disciplina')->group(function () {
    Route::post('/create', [EnsinoCoordenacaoDisciplinaController::class, 'create'])->name('ensino_coordenacao_disciplina_create');
    Route::post('/update/{id}', [EnsinoCoordenacaoDisciplinaController::class, 'update'])->name('ensino_coordenacao_disciplina_update');
    Route::post('/validate', [EnsinoCoordenacaoDisciplinaController::class, 'ajaxValidation'])->name('ensino_coordenacao_disciplina_validate');
    Route::delete('/delete/{id}', [EnsinoCoordenacaoDisciplinaController::class, 'delete'])->name('ensino_coordenacao_disciplina_delete');

    Route::get('/index/{user_pad_id}', [EnsinoCoordenacaoDisciplinaController::class, 'index'])->name('ensino_coordenacao_disciplina_index');
    Route::get('/edit/{id?}', [EnsinoCoordenacaoDisciplinaController::class, 'edit'])->name('ensino_coordenacao_disciplina_update');
    Route::get('/search/{user_pad_id?}', [EnsinoCoordenacaoDisciplinaController::class, 'search'])->name('ensino_coordenacao_disciplina_search');
});


/* EnsinoOrientacaoController */
Route::prefix('/pad/dimensao/ensino/orientacao')->group(function () {
    Route::post('/create', [EnsinoOrientacaoController::class, 'create'])->name('ensino_orientacao_create');
    Route::post('/update/{id}', [EnsinoOrientacaoController::class, 'update'])->name('ensino_orientacao_update');
    Route::post('/validate', [EnsinoOrientacaoController::class, 'ajaxValidation'])->name('ensino_orientacao_validate');
    Route::delete('/delete/{id}', [EnsinoOrientacaoController::class, 'delete'])->name('ensino_orientacao_delete');

    Route::get('/index/{user_pad_id}', [EnsinoOrientacaoController::class, 'index'])->name('ensino_orientacao_index');
    Route::get('/edit/{id?}', [EnsinoOrientacaoController::class, 'edit'])->name('view_ensino_orientacao_update');
    Route::get('/search/{user_pad_id?}', [EnsinoOrientacaoController::class, 'search'])->name('ensino_orientacao_search');
});

/* EnsinoSupervisaoController */
Route::prefix('/pad/dimensao/ensino/supervisao')->group(function () {
    Route::post('/create', [EnsinoSupervisaoController::class, 'create'])->name('ensino_supervisao_create');
    Route::post('/update/{id}', [EnsinoSupervisaoController::class, 'update'])->name('ensino_supervisao_update');
    Route::post('/validate', [EnsinoSupervisaoController::class, 'ajaxValidation'])->name('ensino_supervisao_validate');
    Route::delete('/delete/{id}', [EnsinoSupervisaoController::class, 'delete'])->name('ensino_supervisao_delete');

    Route::get('/index/{user_pad_id}', [EnsinoSupervisaoController::class, 'index'])->name('ensino_supervisao_index');
    Route::get('/edit/{id?}', [EnsinoSupervisaoController::class, 'edit'])->name('ensino_supervisao_update');
    Route::get('/search/{user_pad_id?}', [EnsinoSupervisaoController::class, 'search'])->name('ensino_supervisao_search');
});

/* EnsinoAtendimentoDiscenteController */
Route::prefix('/pad/dimensao/ensino/atendimento/discente')->group(function () {
    Route::post('/create', [EnsinoAtendimentoDiscenteController::class, 'create'])->name('ensino_atendimento_discente_create');
    Route::post('/update/{id}', [EnsinoAtendimentoDiscenteController::class, 'update'])->name('ensino_atendimento_discente_update');
    Route::post('/validate', [EnsinoAtendimentoDiscenteController::class, 'ajaxValidation'])->name('ensino_atendimento_discente_validate');
    Route::delete('/delete/{id}', [EnsinoAtendimentoDiscenteController::class, 'delete'])->name('ensino_atendimento_discente_delete');

    Route::get('/index/{user_pad_id}', [EnsinoAtendimentoDiscenteController::class, 'index'])->name('ensino_atendimento_discente_index');
    Route::get('/edit/{id?}', [EnsinoAtendimentoDiscenteController::class, 'edit'])->name('ensino_atendimento_discente_update');
    Route::get('/search/{user_pad_id?}', [EnsinoAtendimentoDiscenteController::class, 'search'])->name('ensino_atendimento_discente_search');
});

/* EnsinoProjetoController */
Route::prefix('/pad/dimensao/ensino/projeto')->group(function () {
    Route::post('/create', [EnsinoProjetoController::class, 'create'])->name('ensino_projeto_create');
    Route::post('/update/{id}', [EnsinoProjetoController::class, 'update'])->name('ensino_projeto_update');
    Route::post('/validate', [EnsinoProjetoController::class, 'ajaxValidation'])->name('ensino_projeto_validate');
    Route::delete('/delete/{id}', [EnsinoProjetoController::class, 'delete'])->name('ensino_projeto_delete');

    Route::get('/index/{user_pad_id}', [EnsinoProjetoController::class, 'index'])->name('ensino_projeto_index');
    Route::get('/edit/{id?}', [EnsinoProjetoController::class, 'edit'])->name('ensino_projeto_update');
    Route::get('/search/{user_pad_id?}', [EnsinoProjetoController::class, 'search'])->name('ensino_projeto_search');
});

/* EnsinoParticipacaoController */
Route::prefix('/pad/dimensao/ensino/participacao')->group(function () {
    Route::post('/create', [EnsinoParticipacaoController::class, 'create'])->name('ensino_participacao_create');
    Route::post('/update/{id}', [EnsinoParticipacaoController::class, 'update'])->name('ensino_participacao_update');
    Route::post('/validate', [EnsinoParticipacaoController::class, 'ajaxValidation'])->name('ensino_participacao_validate');
    Route::delete('/delete/{id}', [EnsinoParticipacaoController::class, 'delete'])->name('ensino_participacao_delete');

    Route::get('/index/{user_pad_id}', [EnsinoParticipacaoController::class, 'index'])->name('ensino_participacao_index');
    Route::get('/edit/{id?}', [EnsinoParticipacaoController::class, 'edit'])->name('ensino_participacao_update');
    Route::get('/search/{user_pad_id?}', [EnsinoParticipacaoController::class, 'search'])->name('ensino_participacao_search');
});

/* EnsinoCoordenacaoDocenteController */
Route::prefix('/pad/dimensao/ensino/coordenacao/docente')->group(function () {
    Route::post('/create', [EnsinoCoordenacaoDocenteController::class, 'create'])->name('ensino_coordenacao_docente_create');
    Route::post('/update/{id}', [EnsinoCoordenacaoDocenteController::class, 'update'])->name('ensino_coordenacao_docente_update');
    Route::post('/validate', [EnsinoCoordenacaoDocenteController::class, 'ajaxValidation'])->name('ensino_coordenacao_docente_validate');
    Route::delete('/delete/{id}', [EnsinoCoordenacaoDocenteController::class, 'delete'])->name('ensino_coordenacao_docente_delete');

    Route::get('/index/{user_pad_id}', [EnsinoCoordenacaoDocenteController::class, 'index'])->name('ensino_coordenacao_docente_index');
    Route::get('/edit/{id?}', [EnsinoCoordenacaoDocenteController::class, 'edit'])->name('ensino_coordenacao_docente_update');
    Route::get('/search/{user_pad_id?}', [EnsinoCoordenacaoDocenteController::class, 'search'])->name('ensino_coordenacao_docente_search');
});


/** PesquisaCoordenacaoController */
Route::prefix('pad/dimensao/pesquisa/coordenacao')->group(function() {
    Route::post('/create', [PesquisaCoordenacaoController::class, 'create'])->name('pesquisa_coordenacao_create');
    Route::post('/update/{id}', [PesquisaCoordenacaoController::class, 'update'])->name('pesquisa_coordenacao_update');
    Route::delete('/delete/{id}', [PesquisaCoordenacaoController::class, 'delete'])->name('pesquisa_coordenacao_delete');

    Route::get('/edit/{id?}', [PesquisaCoordenacaoController::class, 'edit'])->name('pesquisa_coordenacao_edit');
    Route::get('/search/{user_pad_id?}', [PesquisaCoordenacaoController::class, 'search'])->name('pesquisa_coordenacao_search');
});

// return json
Route::get('/listar/unidade', [UnidadeController::class, 'getAll'])->name('listar_unidades');
Route::get('/list/campus/{unidade_id}', [CampusController::class, 'findByUnidade'])->name('list_campus_by_unidade');