<?php

use App\Http\Controllers\Dimensao\Tabelas\Gestao\GestaoCoordenacaoLaboratoriosDidaticosController;
use App\Http\Controllers\Dimensao\Tabelas\Gestao\GestaoCoordenacaoProgramaInstitucionalController;
use App\Http\Controllers\Dimensao\Tabelas\Gestao\GestaoMembroCamarasController;
use App\Http\Controllers\Dimensao\Tabelas\Gestao\GestaoMembroComissaoController;
use App\Http\Controllers\Dimensao\Tabelas\Gestao\GestaoMembroConselhoController;
use App\Http\Controllers\Dimensao\Tabelas\Gestao\GestaoMembroTitularConselhoController;
use App\Http\Controllers\Dimensao\Tabelas\Gestao\GestaoOutrosController;
use App\Http\Controllers\Dimensao\Tabelas\Gestao\GestaoRepresentanteUnidadeEducacaoController;
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
    Route::get('/resolucao', [GestaoMembroConselhoController::class, 'viewResolucao'])->name('view_gestao_membro_conselho_resolucao');
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
    Route::get('/resolucao', [GestaoMembroTitularConselhoController::class, 'viewResolucao'])->name('view_gestao_membro_titular_conselho_resolucao');
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
    Route::get('/resolucao', [GestaoRepresentanteUnidadeEducacaoController::class, 'viewResolucao'])->name('view_gestao_representante_unidade_educacao_resolucao');
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
    Route::get('/resolucao', [GestaoMembroCamarasController::class, 'viewResolucao'])->name('view_gestao_membro_camaras_resolucao');
});


/** GestaoCoordenacaoLaboratoriosDidaticosController */
Route::prefix('/pad/dimensao/gestao/laboratorios/didaticos')->group(function () {
    Route::post('/create', [GestaoCoordenacaoLaboratoriosDidaticosController::class, 'create'])->name('gestao_coordenacao_laboratorios_didaticos_create');
    Route::post('/update/{id}', [GestaoCoordenacaoLaboratoriosDidaticosController::class, 'update'])->name('gestao_coordenacao_laboratorios_didaticos_update');
    Route::post('/validate', [GestaoCoordenacaoLaboratoriosDidaticosController::class, 'ajaxValidation'])->name('gestao_coordenacao_laboratorios_didaticos_validate');
    Route::delete('/delete/{id}', [GestaoCoordenacaoLaboratoriosDidaticosController::class, 'delete'])->name('gestao_coordenacao_laboratorios_didaticos_delete');

    Route::get('/index/{user_pad_id}', [GestaoCoordenacaoLaboratoriosDidaticosController::class, 'index'])->name('gestao_coordenacao_laboratorios_didaticos_index');
    Route::get('/edit/{id?}', [GestaoCoordenacaoLaboratoriosDidaticosController::class, 'edit'])->name('view_gestao_coordenacao_laboratorios_didaticos_update');
    Route::get('/search/{user_pad_id?}', [GestaoCoordenacaoLaboratoriosDidaticosController::class, 'search'])->name('gestao_coordenacao_laboratorios_didaticos_search');
    Route::get('/resolucao', [GestaoCoordenacaoLaboratoriosDidaticosController::class, 'viewResolucao'])->name('view_gestao_coordenacao_laboratorios_didaticos_resolucao');
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
    Route::get('/resolucao', [GestaoCoordenacaoProgramaInstitucionalController::class, 'viewResolucao'])->name('view_gestao_coordenacao_programa_institucional_resolucao');
});

/** GestaoOutrosController */
Route::prefix('/pad/dimensao/gestao/outros')->group(function () {
    Route::post('/create', [GestaoOutrosController::class, 'create'])->name('gestao_outros_create');
    Route::post('/update/{id}', [GestaoOutrosController::class, 'update'])->name('gestao_outros_update');
    Route::post('/validate', [GestaoOutrosController::class, 'ajaxValidation'])->name('gestao_outros_validate');
    Route::delete('/delete/{id}', [GestaoOutrosController::class, 'delete'])->name('gestao_outros_delete');

    Route::get('/index/{user_pad_id}', [GestaoOutrosController::class, 'index'])->name('gestao_outros_index');
    Route::get('/edit/{id?}', [GestaoOutrosController::class, 'edit'])->name('view_gestao_outros_update');
    Route::get('/search/{user_pad_id?}', [GestaoOutrosController::class, 'search'])->name('gestao_outros_search');
    Route::get('/resolucao', [GestaoOutrosController::class, 'viewResolucao'])->name('view_gestao_outros_resolucao');
});
