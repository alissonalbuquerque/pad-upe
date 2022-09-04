<?php

use App\Http\Controllers\Dimensao\Tabelas\Ensino\EnsinoAulaController;
use App\Http\Controllers\Dimensao\Tabelas\Ensino\EnsinoAtendimentoDiscenteController;
use App\Http\Controllers\Dimensao\Tabelas\Ensino\EnsinoCoordenacaoRegenciaController;
use App\Http\Controllers\Dimensao\Tabelas\Ensino\EnsinoOrientacaoController;
use App\Http\Controllers\Dimensao\Tabelas\Ensino\EnsinoParticipacaoController;
use App\Http\Controllers\Dimensao\Tabelas\Ensino\EnsinoProjetoController;
use App\Http\Controllers\Dimensao\Tabelas\Ensino\EnsinoSupervisaoController;
use App\Http\Controllers\Dimensao\Tabelas\Ensino\EnsinoMembroDocenteController;
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
    Route::get('/resolucao', [EnsinoAtendimentoDiscenteController::class, 'viewResolucao'])->name('view_ensino_atendimento_discente_resolucao');
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
    Route::get('/resolucao', [EnsinoProjetoController::class, 'viewResolucao'])->name('view_ensino_projeto_resolucao');
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
    Route::get('/resolucao', [EnsinoParticipacaoController::class, 'viewResolucao'])->name('view_ensino_participacao_resolucao');
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
    Route::get('/resolucao', [EnsinoMembroDocenteController::class, 'viewResolucao'])->name('view_ensino_membro_docente_resolucao');
});
