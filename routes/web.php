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
use App\Http\Controllers\Dimensao\Tabelas\Ensino\EnsinoCoordenacaoRegenciaController;
use App\Http\Controllers\Dimensao\Tabelas\Ensino\EnsinoOrientacaoController;
use App\Http\Controllers\Dimensao\Tabelas\Ensino\EnsinoParticipacaoController;
use App\Http\Controllers\Dimensao\Tabelas\Ensino\EnsinoProjetoController;
use App\Http\Controllers\Dimensao\Tabelas\Ensino\EnsinoSupervisaoController;
use App\Http\Controllers\Dimensao\Tabelas\Ensino\EnsinoMembroDocenteController;
use App\Http\Controllers\Dimensao\Tabelas\Extensao\ExtensaoCoordenacaoController;
use App\Http\Controllers\Dimensao\Tabelas\Extensao\ExtensaoOrientacaoController;
use App\Http\Controllers\Dimensao\Tabelas\Gestao\GestaoCoordenacaoLaboratoriosDidaticosController;
use App\Http\Controllers\Dimensao\Tabelas\Gestao\GestaoCoordenacaoProgramaInstitucionalController;
use App\Http\Controllers\Dimensao\Tabelas\Gestao\GestaoMembroCamarasController;
use App\Http\Controllers\Dimensao\Tabelas\Gestao\GestaoMembroComissaoController;
use App\Http\Controllers\Dimensao\Tabelas\Gestao\GestaoMembroConselhoController;
use App\Http\Controllers\Dimensao\Tabelas\Gestao\GestaoMembroTitularConselhoController;
use App\Http\Controllers\Dimensao\Tabelas\Gestao\GestaoRepresentanteUnidadeEducacaoController;
use App\Http\Controllers\Dimensao\Tabelas\Pesquisa\PesquisaCoordenacaoController;
use App\Http\Controllers\Dimensao\Tabelas\Pesquisa\PesquisaLiderancaController;
use App\Http\Controllers\Dimensao\Tabelas\Pesquisa\PesquisaOrientacaoController;
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
    Route::get('/resolucao', [EnsinoAulaController::class, 'viewResolucao'])->name('view_ensino_aula_resolucao');
});

/* EnsinoCoordenacaoRegenciaController */
Route::prefix('/pad/dimensao/ensino/coordenacao/regencia')->group(function () {
    Route::post('/create', [EnsinoCoordenacaoRegenciaController::class, 'create'])->name('ensino_coordenacao_regencia_create');
    Route::post('/update/{id}', [EnsinoCoordenacaoRegenciaController::class, 'update'])->name('ensino_coordenacao_regencia_update');
    Route::post('/validate', [EnsinoCoordenacaoRegenciaController::class, 'ajaxValidation'])->name('ensino_coordenacao_regencia_validate');
    Route::delete('/delete/{id}', [EnsinoCoordenacaoRegenciaController::class, 'delete'])->name('ensino_coordenacao_regencia_delete');

    Route::get('/index/{user_pad_id}', [EnsinoCoordenacaoRegenciaController::class, 'index'])->name('ensino_coordenacao_regencia_index');
    Route::get('/edit/{id?}', [EnsinoCoordenacaoRegenciaController::class, 'edit'])->name('view_ensino_coordenacao_regencia_update');
    Route::get('/search/{user_pad_id?}', [EnsinoCoordenacaoRegenciaController::class, 'search'])->name('ensino_coordenacao_regencia_search');
    Route::get('/resolucao', [EnsinoCoordenacaoRegenciaController::class, 'viewResolucao'])->name('view_ensino_coordenacao_regencia_resolucao');
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
    Route::get('/resolucao', [EnsinoOrientacaoController::class, 'viewResolucao'])->name('view_ensino_orientacao_resolucao');
});


/* EnsinoSupervisaoController */
Route::prefix('/pad/dimensao/ensino/supervisao')->group(function () {
    Route::post('/create', [EnsinoSupervisaoController::class, 'create'])->name('ensino_supervisao_create');
    Route::post('/update/{id}', [EnsinoSupervisaoController::class, 'update'])->name('ensino_supervisao_update');
    Route::post('/validate', [EnsinoSupervisaoController::class, 'ajaxValidation'])->name('ensino_supervisao_validate');
    Route::delete('/delete/{id}', [EnsinoSupervisaoController::class, 'delete'])->name('ensino_supervisao_delete');

    Route::get('/index/{user_pad_id}', [EnsinoSupervisaoController::class, 'index'])->name('ensino_supervisao_index');
    Route::get('/edit/{id?}', [EnsinoSupervisaoController::class, 'edit'])->name('view_ensino_supervisao_update');
    Route::get('/search/{user_pad_id?}', [EnsinoSupervisaoController::class, 'search'])->name('ensino_supervisao_search');
    Route::get('/resolucao', [EnsinoSupervisaoController::class, 'viewResolucao'])->name('view_ensino_supervisao_resolucao');
});


/* EnsinoAtendimentoDiscenteController */
Route::prefix('/pad/dimensao/ensino/atendimento/discente')->group(function () {
    Route::post('/create', [EnsinoAtendimentoDiscenteController::class, 'create'])->name('ensino_atendimento_discente_create');
    Route::post('/update/{id}', [EnsinoAtendimentoDiscenteController::class, 'update'])->name('ensino_atendimento_discente_update');
    Route::post('/validate', [EnsinoAtendimentoDiscenteController::class, 'ajaxValidation'])->name('ensino_atendimento_discente_validate');
    Route::delete('/delete/{id}', [EnsinoAtendimentoDiscenteController::class, 'delete'])->name('ensino_atendimento_discente_delete');

    Route::get('/index/{user_pad_id}', [EnsinoAtendimentoDiscenteController::class, 'index'])->name('ensino_atendimento_discente_index');
    Route::get('/edit/{id?}', [EnsinoAtendimentoDiscenteController::class, 'edit'])->name('view_ensino_atendimento_discente_update');
    Route::get('/search/{user_pad_id?}', [EnsinoAtendimentoDiscenteController::class, 'search'])->name('ensino_atendimento_discente_search');
});


/* EnsinoProjetoController */
Route::prefix('/pad/dimensao/ensino/projeto')->group(function () {
    Route::post('/create', [EnsinoProjetoController::class, 'create'])->name('ensino_projeto_create');
    Route::post('/update/{id}', [EnsinoProjetoController::class, 'update'])->name('ensino_projeto_update');
    Route::post('/validate', [EnsinoProjetoController::class, 'ajaxValidation'])->name('ensino_projeto_validate');
    Route::delete('/delete/{id}', [EnsinoProjetoController::class, 'delete'])->name('ensino_projeto_delete');

    Route::get('/index/{user_pad_id}', [EnsinoProjetoController::class, 'index'])->name('ensino_projeto_index');
    Route::get('/edit/{id?}', [EnsinoProjetoController::class, 'edit'])->name('view_ensino_projeto_update');
    Route::get('/search/{user_pad_id?}', [EnsinoProjetoController::class, 'search'])->name('ensino_projeto_search');
});


/* EnsinoParticipacaoController */
Route::prefix('/pad/dimensao/ensino/participacao')->group(function () {
    Route::post('/create', [EnsinoParticipacaoController::class, 'create'])->name('ensino_participacao_create');
    Route::post('/update/{id}', [EnsinoParticipacaoController::class, 'update'])->name('ensino_participacao_update');
    Route::post('/validate', [EnsinoParticipacaoController::class, 'ajaxValidation'])->name('ensino_participacao_validate');
    Route::delete('/delete/{id}', [EnsinoParticipacaoController::class, 'delete'])->name('ensino_participacao_delete');

    Route::get('/index/{user_pad_id}', [EnsinoParticipacaoController::class, 'index'])->name('ensino_participacao_index');
    Route::get('/edit/{id?}', [EnsinoParticipacaoController::class, 'edit'])->name('view_ensino_participacao_update');
    Route::get('/search/{user_pad_id?}', [EnsinoParticipacaoController::class, 'search'])->name('ensino_participacao_search');
});


/* EnsinoMembroDocenteController */
Route::prefix('/pad/dimensao/ensino/membro/docente')->group(function () {
    Route::post('/create', [EnsinoMembroDocenteController::class, 'create'])->name('ensino_membro_docente_create');
    Route::post('/update/{id}', [EnsinoMembroDocenteController::class, 'update'])->name('ensino_membro_docente_update');
    Route::post('/validate', [EnsinoMembroDocenteController::class, 'ajaxValidation'])->name('ensino_membro_docente_validate');
    Route::delete('/delete/{id}', [EnsinoMembroDocenteController::class, 'delete'])->name('ensino_membro_docente_delete');

    Route::get('/index/{user_pad_id}', [EnsinoMembroDocenteController::class, 'index'])->name('ensino_membro_docente_index');
    Route::get('/edit/{id?}', [EnsinoMembroDocenteController::class, 'edit'])->name('view_ensino_membro_docente_update');
    Route::get('/search/{user_pad_id?}', [EnsinoMembroDocenteController::class, 'search'])->name('ensino_membro_docente_search');
});


/** PesquisaCoordenacaoController */
Route::prefix('/pad/dimensao/pesquisa/coordenacao')->group(function () {
    Route::post('/create', [PesquisaCoordenacaoController::class, 'create'])->name('pesquisa_coordenacao_create');
    Route::post('/update/{id}', [PesquisaCoordenacaoController::class, 'update'])->name('pesquisa_coordenacao_update');
    Route::post('/validate', [PesquisaCoordenacaoController::class, 'ajaxValidation'])->name('pesquisa_coordenacao_validate');
    Route::delete('/delete/{id}', [PesquisaCoordenacaoController::class, 'delete'])->name('pesquisa_coordenacao_delete');

    Route::get('/index/{user_pad_id}', [PesquisaCoordenacaoController::class, 'index'])->name('pesquisa_coordenacao_index');
    Route::get('/edit/{id?}', [PesquisaCoordenacaoController::class, 'edit'])->name('view_pesquisa_coordenacao_update');
    Route::get('/search/{user_pad_id?}', [PesquisaCoordenacaoController::class, 'search'])->name('pesquisa_coordenacao_search');
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
});


/** ExtensaoCoordenacaoController */
Route::prefix('/pad/dimensao/extensao/coordenacao')->group(function () {
    Route::post('/create', [ExtensaoCoordenacaoController::class, 'create'])->name('extensao_coordenacao_create');
    Route::post('/update/{id}', [ExtensaoCoordenacaoController::class, 'update'])->name('extensao_coordenacao_update');
    Route::post('/validate', [ExtensaoCoordenacaoController::class, 'ajaxValidation'])->name('extensao_coordenacao_validate');
    Route::delete('/delete/{id}', [ExtensaoCoordenacaoController::class, 'delete'])->name('extensao_coordenacao_delete');

    Route::get('/index/{user_pad_id}', [ExtensaoCoordenacaoController::class, 'index'])->name('extensao_coordenacao_index');
    Route::get('/edit/{id?}', [ExtensaoCoordenacaoController::class, 'edit'])->name('view_extensao_coordenacao_update');
    Route::get('/search/{user_pad_id?}', [ExtensaoCoordenacaoController::class, 'search'])->name('extensao_coordenacao_search');
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
});


/** GestaoMembroComissaoController */
Route::prefix('/pad/dimensao/gestao/membro/comissao')->group(function () {
    Route::post('/create', [GestaoMembroComissaoController::class, 'create'])->name('gestao_membro_comissao_create');
    Route::post('/update/{id}', [GestaoMembroComissaoController::class, 'update'])->name('gestao_membro_comissao_update');
    Route::post('/validate', [GestaoMembroComissaoController::class, 'ajaxValidation'])->name('gestao_membro_comissao_validate');
    Route::delete('/delete/{id}', [GestaoMembroComissaoController::class, 'delete'])->name('gestao_membro_comissao_delete');

    Route::get('/index/{user_pad_id}', [GestaoMembroComissaoController::class, 'index'])->name('gestao_membro_comissao_index');
    Route::get('/edit/{id?}', [GestaoMembroComissaoController::class, 'edit'])->name('view_gestao_membro_comissao_update');
    Route::get('/search/{user_pad_id?}', [GestaoMembroComissaoController::class, 'search'])->name('gestao_membro_comissao_search');
    Route::get('/resolucao', [GestaoMembroComissaoController::class, 'viewResolucao'])->name('view_gestao_membro_comissao_resolucao');
});


/** GestaoMembroConselhoController */
Route::prefix('/pad/dimensao/gestao/membro/conselho')->group(function () {
    Route::post('/create', [GestaoMembroConselhoController::class, 'create'])->name('gestao_membro_conselho_create');
    Route::post('/update/{id}', [GestaoMembroConselhoController::class, 'update'])->name('gestao_membro_conselho_update');
    Route::post('/validate', [GestaoMembroConselhoController::class, 'ajaxValidation'])->name('gestao_membro_conselho_validate');
    Route::delete('/delete/{id}', [GestaoMembroConselhoController::class, 'delete'])->name('gestao_membro_conselho_delete');

    Route::get('/index/{user_pad_id}', [GestaoMembroConselhoController::class, 'index'])->name('gestao_membro_conselho_index');
    Route::get('/edit/{id?}', [GestaoMembroConselhoController::class, 'edit'])->name('view_gestao_membro_conselho_update');
    Route::get('/search/{user_pad_id?}', [GestaoMembroConselhoController::class, 'search'])->name('gestao_membro_conselho_search');
});


/** GestaoMembroTitularConselhoController */
Route::prefix('/pad/dimensao/gestao/membro/titular/conselho')->group(function () {
    Route::post('/create', [GestaoMembroTitularConselhoController::class, 'create'])->name('gestao_membro_titular_conselho_create');
    Route::post('/update/{id}', [GestaoMembroTitularConselhoController::class, 'update'])->name('gestao_membro_titular_conselho_update');
    Route::post('/validate', [GestaoMembroTitularConselhoController::class, 'ajaxValidation'])->name('gestao_membro_titular_conselho_validate');
    Route::delete('/delete/{id}', [GestaoMembroTitularConselhoController::class, 'delete'])->name('gestao_membro_titular_conselho_delete');

    Route::get('/index/{user_pad_id}', [GestaoMembroTitularConselhoController::class, 'index'])->name('gestao_membro_titular_conselho_index');
    Route::get('/edit/{id?}', [GestaoMembroTitularConselhoController::class, 'edit'])->name('view_gestao_membro_titular_conselho_update');
    Route::get('/search/{user_pad_id?}', [GestaoMembroTitularConselhoController::class, 'search'])->name('gestao_membro_titular_conselho_search');
});


/** GestaoRepresentanteUnidadeEducacaoController */
Route::prefix('/pad/dimensao/gestao/representante/unidade/educacao')->group(function () {
    Route::post('/create', [GestaoRepresentanteUnidadeEducacaoController::class, 'create'])->name('gestao_representante_unidade_educacao_create');
    Route::post('/update/{id}', [GestaoRepresentanteUnidadeEducacaoController::class, 'update'])->name('gestao_representante_unidade_educacao_update');
    Route::post('/validate', [GestaoRepresentanteUnidadeEducacaoController::class, 'ajaxValidation'])->name('gestao_representante_unidade_educacao_validate');
    Route::delete('/delete/{id}', [GestaoRepresentanteUnidadeEducacaoController::class, 'delete'])->name('gestao_representante_unidade_educacao_delete');

    Route::get('/index/{user_pad_id}', [GestaoRepresentanteUnidadeEducacaoController::class, 'index'])->name('gestao_representante_unidade_educacao_index');
    Route::get('/edit/{id?}', [GestaoRepresentanteUnidadeEducacaoController::class, 'edit'])->name('view_gestao_representante_unidade_educacao_update');
    Route::get('/search/{user_pad_id?}', [GestaoRepresentanteUnidadeEducacaoController::class, 'search'])->name('gestao_representante_unidade_educacao_search');
});


/** GestaoMembroCamarasController */
Route::prefix('/pad/dimensao/gestao/membro/camaras')->group(function () {
    Route::post('/create', [GestaoMembroCamarasController::class, 'create'])->name('gestao_membro_camaras_create');
    Route::post('/update/{id}', [GestaoMembroCamarasController::class, 'update'])->name('gestao_membro_camaras_update');
    Route::post('/validate', [GestaoMembroCamarasController::class, 'ajaxValidation'])->name('gestao_membro_camaras_validate');
    Route::delete('/delete/{id}', [GestaoMembroCamarasController::class, 'delete'])->name('gestao_membro_camaras_delete');

    Route::get('/index/{user_pad_id}', [GestaoMembroCamarasController::class, 'index'])->name('gestao_membro_camaras_index');
    Route::get('/edit/{id?}', [GestaoMembroCamarasController::class, 'edit'])->name('view_gestao_membro_camaras_update');
    Route::get('/search/{user_pad_id?}', [GestaoMembroCamarasController::class, 'search'])->name('gestao_membro_camaras_search');
});


/** GestaoCoordenacaoLaboratoriosDidaticosController */
Route::prefix('/pad/dimensao/gestao/laboratorios/didaticos')->group(function () {
    Route::post('/create', [GestaoCoordenacaoLaboratoriosDidaticosController::class, 'create'])->name('gestao_coordenacao_laboratorios_didaticos_create');
    Route::post('/update/{id}', [GestaoCoordenacaoLaboratoriosDidaticosController::class, 'update'])->name('gestao_coordenacao_laboratorios_didaticos_update');
    Route::post('/validate', [GestaoCoordenacaoLaboratoriosDidaticosController::class, 'ajaxValidation'])->name('gestao_coordenacao_laboratorios_didaticos_validate');
    Route::delete('/delete/{id}', [GestaoCoordenacaoLaboratoriosDidaticosController::class, 'delete'])->name('gestao_coordenacao_laboratorios_didaticos_delete');

    Route::get('/index/{user_pad_id}', [GestaoCoordenacaoLaboratoriosDidaticosController::class, 'index'])->name('gestao_coordenacao_laboratorios_didaticos_index');
    Route::get('/edit/{id?}', [GestaoCoordenacaoLaboratoriosDidaticosController::class, 'edit'])->name('gestao_coordenacao_laboratorios_didaticos_update');
    Route::get('/search/{user_pad_id?}', [GestaoCoordenacaoLaboratoriosDidaticosController::class, 'search'])->name('gestao_coordenacao_laboratorios_didaticos_search');
});

/** GestaoCoordenacaoProgramaInstitucionalController */
Route::prefix('/pad/dimensao/gestao/coordenacao/programa/institucional')->group(function () {
    Route::post('/create', [GestaoCoordenacaoProgramaInstitucionalController::class, 'create'])->name('gestao_coordenacao_programa_institucional_create');
    Route::post('/update/{id}', [GestaoCoordenacaoProgramaInstitucionalController::class, 'update'])->name('gestao_coordenacao_programa_institucional_update');
    Route::post('/validate', [GestaoCoordenacaoProgramaInstitucionalController::class, 'ajaxValidation'])->name('gestao_coordenacao_programa_institucional_validate');
    Route::delete('/delete/{id}', [GestaoCoordenacaoProgramaInstitucionalController::class, 'delete'])->name('gestao_coordenacao_programa_institucional_delete');

    Route::get('/index/{user_pad_id}', [GestaoCoordenacaoProgramaInstitucionalController::class, 'index'])->name('gestao_coordenacao_programa_institucional_index');
    Route::get('/edit/{id?}', [GestaoCoordenacaoProgramaInstitucionalController::class, 'edit'])->name('view_gestao_coordenacao_programa_institucional_update');
    Route::get('/search/{user_pad_id?}', [GestaoCoordenacaoProgramaInstitucionalController::class, 'search'])->name('gestao_coordenacao_programa_institucional_search');
});

// return json
Route::get('/listar/unidade', [UnidadeController::class, 'getAll'])->name('listar_unidades');
Route::get('/list/campus/{unidade_id}', [CampusController::class, 'findByUnidade'])->name('list_campus_by_unidade');