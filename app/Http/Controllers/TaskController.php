<?php

namespace App\Http\Controllers;

use App\Models\Tabelas\Ensino\EnsinoAtendimentoDiscente;
use App\Models\Tabelas\Ensino\EnsinoCoordenacaoRegencia;
use App\Models\Tabelas\Ensino\EnsinoOrientacao;
use App\Models\Tabelas\Ensino\EnsinoParticipacao;
use App\Models\Tabelas\Ensino\EnsinoSupervisao;
use App\Models\Tabelas\Ensino\EnsinoAula;
use App\Models\Tabelas\Ensino\EnsinoMembroDocente;
use App\Models\Tabelas\Ensino\EnsinoOutros;
use App\Models\Tabelas\Ensino\EnsinoProjeto;

use App\Models\Tabelas\Pesquisa\PesquisaCoordenacao;
use App\Models\Tabelas\Pesquisa\PesquisaLideranca;
use App\Models\Tabelas\Pesquisa\PesquisaOrientacao;
use App\Models\Tabelas\Pesquisa\PesquisaOutros;

use App\Models\Tabelas\Extensao\ExtensaoCoordenacao;
use App\Models\Tabelas\Extensao\ExtensaoOrientacao;
use App\Models\Tabelas\Extensao\ExtensaoOutros;

use App\Models\Tabelas\Gestao\GestaoCoordenacaoLaboratoriosDidaticos;
use App\Models\Tabelas\Gestao\GestaoMembroCamaras;
use App\Models\Tabelas\Gestao\GestaoMembroConselho;
use App\Models\Tabelas\Gestao\GestaoOutros;
use App\Models\Tabelas\Gestao\GestaoCoordenacaoProgramaInstitucional;
use App\Models\Tabelas\Gestao\GestaoMembroComissao;
use App\Models\Tabelas\Gestao\GestaoMembroTitularConselho;
use App\Models\Tabelas\Gestao\GestaoRepresentanteUnidadeEducacao;
use App\Models\TaskTime;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Response;

class TaskController extends Controller
{
    public function search(Request $request) {

        $q = $request->query('q'); 
        $user_pad_id = $request->query('user_pad_id');

        //ENSINO
        //---------------------------------------------
        $type_ensino_aula = TaskTime::TYPE_ENSINO_AULA;
        $list_ensino_aula = 
            EnsinoAula::whereUserPadId($user_pad_id)->get()->map(function(EnsinoAula $model) use ($type_ensino_aula) {
                return [
                    'id' => "id_{$model->id}|type_{$type_ensino_aula}",
                    'text' => $model->componente_curricular
                ];
            });
        
        $type_ensino_coordenacao_regencia = TaskTime::TYPE_ENSINO_COORDENACAO_REGENCIA;
        $list_ensino_coordenacao_regencia = 
            EnsinoCoordenacaoRegencia::whereUserPadId($user_pad_id)->get()->map(function(EnsinoCoordenacaoRegencia $model) use ($type_ensino_coordenacao_regencia) {
                return [
                    'id' => "id_{$model->id}|type_{$type_ensino_coordenacao_regencia}",
                    'text' => $model->componente_curricular
                ];
            });

        $type_ensino_orientacao = TaskTime::TYPE_ENSINO_ORIENTACAO;
        $list_ensino_orientacao = 
            EnsinoOrientacao::whereUserPadId($user_pad_id)->get()->map(function(EnsinoOrientacao $model) use ($type_ensino_orientacao) {
                return [
                    'id' => "id_{$model->id}|type_{$type_ensino_orientacao}",
                    'text' => $model->atividade
                ];
            });

        $type_ensino_supervisao = TaskTime::TYPE_ENSINO_SUPERVISAO;
        $list_ensino_supervisao = 
            EnsinoSupervisao::whereUserPadId($user_pad_id)->get()->map(function(EnsinoSupervisao $model) use ($type_ensino_supervisao) {
                return [
                    'id' => "id_{$model->id}|type_{$type_ensino_supervisao}",
                    'text' => $model->atividade
                ];
            });


        $type_ensino_atendimento_discente = TaskTime::TYPE_ENSINO_ATENDIMENTO_DISCENTE;
        $list_ensino_atendimento_discente = 
            EnsinoAtendimentoDiscente::whereUserPadId($user_pad_id)->get()->map(function(EnsinoAtendimentoDiscente $model) use ($type_ensino_atendimento_discente) {
                return [
                    'id' => "id_{$model->id}|type_{$type_ensino_atendimento_discente}",
                    'text' => $model->componente_curricular
                ];
            });

        $type_ensino_projeto = TaskTime::TYPE_ENSINO_PROJETO;
        $list_ensino_projeto = 
            EnsinoProjeto::whereUserPadId($user_pad_id)->get()->map(function(EnsinoProjeto $model) use ($type_ensino_projeto) {
                return [
                    'id' => "id_{$model->id}|type_{$type_ensino_projeto}",
                    'text' => $model->componente_curricular
                ];
            });

        $type_ensino_participacao = TaskTime::TYPE_ENSINO_PARTICIPACAO;
        $list_ensino_participacao = 
            EnsinoParticipacao::whereUserPadId($user_pad_id)->get()->map(function(EnsinoParticipacao $model) use ($type_ensino_participacao) {
                return [
                    'id' => "id_{$model->id}|type_{$type_ensino_participacao}",
                    'text' => $model->curso
                ];
            });

        $type_ensino_membro_docente = TaskTime::TYPE_ENSINO_MEMBRO_DOCENTE;
        $list_ensino_membro_docente = 
            EnsinoMembroDocente::whereUserPadId($user_pad_id)->get()->map(function(EnsinoMembroDocente $model) use ($type_ensino_membro_docente) {
                return [
                    'id' => "id_{$model->id}|type_{$type_ensino_membro_docente}",
                    'text' => $model->nucleo
                ];
            });

        $type_ensino_outros = TaskTime::TYPE_ENSINO_OUTROS;
        $list_ensino_outros = 
            EnsinoOutros::whereUserPadId($user_pad_id)->get()->map(function(EnsinoOutros $model) use ($type_ensino_outros) {
                return [
                    'id' => "id_{$model->id}|type_{$type_ensino_outros}",
                    'text' => $model->atividade
                ];
            });
        //---------------------------------------------

        //PESQUISA
        //---------------------------------------------
        $type_pesquisa_coordenacao = TaskTime::TYPE_PESQUISA_COORDENACAO;
        $list_pesquisa_coordenacao = 
            PesquisaCoordenacao::whereUserPadId($user_pad_id)->get()->map(function(PesquisaCoordenacao $model) use ($type_pesquisa_coordenacao) {
                return [
                    'id' => "id_{$model->id}|type_{$type_pesquisa_coordenacao}",
                    'text' => $model->titulo_projeto
                ];
            });

        $type_pesquisa_orientacao = TaskTime::TYPE_PESQUISA_ORIENTACAO;
        $list_pesquisa_orientacao = 
            PesquisaOrientacao::whereUserPadId($user_pad_id)->get()->map(function(PesquisaOrientacao $model) use ($type_pesquisa_orientacao) {
                return [
                    'id' => "id_{$model->id}|type_{$type_pesquisa_orientacao}",
                    'text' => $model->titulo_projeto
                ];
            });

        $type_pesquisa_lideranca = TaskTime::TYPE_PESQUISA_LIDERANCA;
        $list_pesquisa_lideranca = 
            PesquisaLideranca::whereUserPadId($user_pad_id)->get()->map(function(PesquisaLideranca $model) use ($type_pesquisa_lideranca) {
                return [
                    'id' => "id_{$model->id}|type_{$type_pesquisa_lideranca}",
                    'text' => $model->grupo_pesquisa
                ];
            });

        $type_pesquisa_outros = TaskTime::TYPE_PESQUISA_OUTROS;
        $list_pesquisa_outros = 
            PesquisaOutros::whereUserPadId($user_pad_id)->get()->map(function(PesquisaOutros $model) use ($type_pesquisa_outros) {
                return [
                    'id' => "id_{$model->id}|type_{$type_pesquisa_outros}",
                    'text' => $model->atividade
                ];
            });
        //---------------------------------------------

        //EXTENSÃO
        //---------------------------------------------
        $type_extensao_coordenacao = TaskTime::TYPE_EXTENSAO_COORDENACAO;
        $list_extensao_coordenacao = 
            ExtensaoCoordenacao::whereUserPadId($user_pad_id)->get()->map(function(ExtensaoCoordenacao $model) use ($type_extensao_coordenacao) {
                return [
                    'id' => "id_{$model->id}|type_{$type_extensao_coordenacao}",
                    'text' => $model->titulo_projeto
                ];
            });

        $type_extensao_orientacao = TaskTime::TYPE_EXTENSAO_ORIENTACAO;
        $list_extensao_orientacao = 
            ExtensaoOrientacao::whereUserPadId($user_pad_id)->get()->map(function(ExtensaoOrientacao $model) use ($type_extensao_orientacao) {
                return [
                    'id' => "id_{$model->id}|type_{$type_extensao_orientacao}",
                    'text' => $model->titulo_projeto
                ];
            });

        $type_extensao_outros = TaskTime::TYPE_EXTENSAO_OUTROS;
        $list_extensao_outros = 
            ExtensaoOutros::whereUserPadId($user_pad_id)->get()->map(function(ExtensaoOutros $model) use ($type_extensao_outros) {
                return [
                    'id' => "id_{$model->id}|type_{$type_extensao_outros}",
                    'text' => $model->atividade
                ];
            });
        //---------------------------------------------

        //GESTÃO
        //---------------------------------------------

        $type_gestao_coordenacao_laboratorios_didaticos = TaskTime::TYPE_GESTAO_COORDENACAO_LABORATORIOS_DIDATICOS;
        $list_gestao_coordenacao_laboratorios_didaticos = 
            GestaoCoordenacaoLaboratoriosDidaticos::whereUserPadId($user_pad_id)->get()->map(function(GestaoCoordenacaoLaboratoriosDidaticos $model) use ($type_gestao_coordenacao_laboratorios_didaticos) {
                return [
                    'id' => "id_{$model->id}|type_{$type_gestao_coordenacao_laboratorios_didaticos}",
                    'text' => $model->nome
                ];
            });

        $type_gestao_membro_conselho = TaskTime::TYPE_GESTAO_MEMBRO_CONSELHO;
        $list_gestao_membro_conselho = 
            GestaoMembroConselho::whereUserPadId($user_pad_id)->get()->map(function(GestaoMembroConselho $model) use ($type_gestao_membro_conselho) {
                return [
                    'id' => "id_{$model->id}|type_{$type_gestao_membro_conselho}",
                    'text' => $model->nome
                ];
            });

        $type_gestao_coordenacao_programa_institucional = TaskTime::TYPE_GESTAO_COORDENACAO_PROGRAMA_INSTITUCIONAL;
        $list_gestao_coordenacao_programa_institucional = 
            GestaoCoordenacaoProgramaInstitucional::whereUserPadId($user_pad_id)->get()->map(function(GestaoCoordenacaoProgramaInstitucional $model) use ($type_gestao_coordenacao_programa_institucional) {
                return [
                    'id' => "id_{$model->id}|type_{$type_gestao_coordenacao_programa_institucional}",
                    'text' => $model->nome
                ];
            });

        $type_gestao_membro_titular_conselho = TaskTime::TYPE_GESTAO_MEMBRO_TITULAR_CONSELHO;
        $list_gestao_membro_titular_conselho = 
            GestaoMembroTitularConselho::whereUserPadId($user_pad_id)->get()->map(function(GestaoMembroTitularConselho $model) use ($type_gestao_membro_titular_conselho) {
                return [
                    'id' => "id_{$model->id}|type_{$type_gestao_membro_titular_conselho}",
                    'text' => $model->nome
                ];
            });

        $type_gestao_membro_camaras = TaskTime::TYPE_GESTAO_MEMBRO_CAMARAS;
        $list_gestao_membro_camaras = 
            GestaoMembroCamaras::whereUserPadId($user_pad_id)->get()->map(function(GestaoMembroCamaras $model) use ($type_gestao_membro_camaras) {
                return [
                    'id' => "id_{$model->id}|type_{$type_gestao_membro_camaras}",
                    'text' => $model->nome
                ];
            });

        $type_gestao_representante_unidade_educacao = TaskTime::TYPE_GESTAO_REPRESENTANTE_UNIDADE_EDUCACAO;
        $list_gestao_representante_unidade_educacao = 
            GestaoRepresentanteUnidadeEducacao::whereUserPadId($user_pad_id)->get()->map(function(GestaoRepresentanteUnidadeEducacao $model) use ($type_gestao_representante_unidade_educacao) {
                return [
                    'id' => "id_{$model->id}|type_{$type_gestao_representante_unidade_educacao}",
                    'text' => $model->nome
                ];
            });

        $type_gestao_membro_comissao = TaskTime::TYPE_GESTAO_MEMBRO_COMISSAO;
        $list_gestao_membro_comissao = 
            GestaoMembroComissao::whereUserPadId($user_pad_id)->get()->map(function(GestaoMembroComissao $model) use ($type_gestao_membro_comissao) {
                return [
                    'id' => "id_{$model->id}|type_{$type_gestao_membro_comissao}",
                    'text' => $model->nome
                ];
            });

        $type_gestao_outros = TaskTime::TYPE_GESTAO_OUTROS;
        $list_gestao_outros = 
            GestaoOutros::whereUserPadId($user_pad_id)->get()->map(function(GestaoOutros $model) use ($type_gestao_outros) {
                return [
                    'id' => "id_{$model->id}|type_{$type_gestao_outros}",
                    'text' => $model->atividade
                ];
            });
        //---------------------------------------------

        $dimension_collections = [
            $list_ensino_aula,
            $list_ensino_coordenacao_regencia,
            $list_ensino_orientacao,
            $list_ensino_supervisao,
            $list_ensino_atendimento_discente,
            $list_ensino_projeto,
            $list_ensino_participacao,
            $list_ensino_membro_docente,
            $list_ensino_outros,

            $list_pesquisa_coordenacao,
            $list_pesquisa_orientacao, 
            $list_pesquisa_lideranca, 
            $list_pesquisa_outros,

            $list_extensao_coordenacao,
            $list_extensao_orientacao,
            $list_extensao_outros,

            $list_gestao_coordenacao_laboratorios_didaticos,
            $list_gestao_membro_conselho,
            $list_gestao_coordenacao_programa_institucional,
            $list_gestao_membro_titular_conselho, 
            $list_gestao_membro_camaras,
            $list_gestao_representante_unidade_educacao,
            $list_gestao_membro_comissao,
            $list_gestao_outros,
        ];

        $combined_collections = collect([]);

        $list_tasks =
            collect($dimension_collections)
                ->reduce(
                    function ($carry, $collection) {
                        return $carry->concat($collection);
                    },
                    $combined_collections
                );

        $results = ['results' => $list_tasks];

        return Response::json($results);
    }

    public function searchById(Request $request) {
        
        dd($request->all());
    }
}
