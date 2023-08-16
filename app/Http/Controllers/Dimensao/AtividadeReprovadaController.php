<?php

namespace App\Http\Controllers\Dimensao;

use App\Http\Controllers\Controller;
use App\Models\Avaliacao;
use App\Models\Tabelas\Ensino\EnsinoAtendimentoDiscente;
use App\Models\Tabelas\Ensino\EnsinoAula;
use App\Models\Tabelas\Ensino\EnsinoCoordenacaoRegencia;
use App\Models\Tabelas\Ensino\EnsinoMembroDocente;
use App\Models\Tabelas\Ensino\EnsinoOrientacao;
use App\Models\Tabelas\Ensino\EnsinoOutros;
use App\Models\Tabelas\Ensino\EnsinoParticipacao;
use App\Models\Tabelas\Ensino\EnsinoProjeto;
use App\Models\Tabelas\Ensino\EnsinoSupervisao;
use App\Models\Tabelas\Extensao\ExtensaoCoordenacao;
use App\Models\Tabelas\Extensao\ExtensaoOrientacao;
use App\Models\Tabelas\Extensao\ExtensaoOutros;
use App\Models\Tabelas\Gestao\GestaoCoordenacaoLaboratoriosDidaticos;
use App\Models\Tabelas\Gestao\GestaoCoordenacaoProgramaInstitucional;
use App\Models\Tabelas\Gestao\GestaoMembroCamaras;
use App\Models\Tabelas\Gestao\GestaoMembroComissao;
use App\Models\Tabelas\Gestao\GestaoMembroConselho;
use App\Models\Tabelas\Gestao\GestaoMembroTitularConselho;
use App\Models\Tabelas\Gestao\GestaoOutros;
use App\Models\Tabelas\Gestao\GestaoRepresentanteUnidadeEducacao;
use App\Models\Tabelas\Pesquisa\PesquisaCoordenacao;
use App\Models\Tabelas\Pesquisa\PesquisaLideranca;
use App\Models\Tabelas\Pesquisa\PesquisaOrientacao;
use App\Models\Tabelas\Pesquisa\PesquisaOutros;
use App\Models\Util\MenuItemsTeacher;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;

class AtividadeReprovadaController extends Controller
{
    public function index($user_pad_id) {

        //Ensino Collections

        $ensinoAtendimentoDiscentes = EnsinoAtendimentoDiscente::whereUserPadId($user_pad_id)->join(Avaliacao::getTableName(), function (JoinClause $join) {
            $join->on(EnsinoAtendimentoDiscente::getColumnName('id'), '=', Avaliacao::getColumnName('tarefa_id'))
                ->where(Avaliacao::getColumnName('type'), '=', Avaliacao::TYPE_ENSINO_ATENDIMENTO_DISCENTE)
                ->where(Avaliacao::getColumnName('status'), '=', Avaliacao::STATUS_REPROVADO);
        })->get();

        $ensinoCoordenacaoRegencias = EnsinoCoordenacaoRegencia::whereUserPadId($user_pad_id)->join(Avaliacao::getTableName(), function (JoinClause $join) {
            $join->on(EnsinoCoordenacaoRegencia::getColumnName('id'), '=', Avaliacao::getColumnName('tarefa_id'))
                ->where(Avaliacao::getColumnName('type'), '=', Avaliacao::TYPE_ENSINO_COORDENACAO_REGENCIA)
                ->where(Avaliacao::getColumnName('status'), '=', Avaliacao::STATUS_REPROVADO);
        })->get();

        $ensinoOrientacoes = EnsinoOrientacao::whereUserPadId($user_pad_id)->join(Avaliacao::getTableName(), function (JoinClause $join) {
            $join->on(EnsinoOrientacao::getColumnName('id'), '=', Avaliacao::getColumnName('tarefa_id'))
                ->where(Avaliacao::getColumnName('type'), '=', Avaliacao::TYPE_ENSINO_ORIENTACAO)
                ->where(Avaliacao::getColumnName('status'), '=', Avaliacao::STATUS_REPROVADO);
        })->get();

        $ensinoParticipacoes = EnsinoParticipacao::whereUserPadId($user_pad_id)->join(Avaliacao::getTableName(), function (JoinClause $join) {
            $join->on(EnsinoParticipacao::getColumnName('id'), '=', Avaliacao::getColumnName('tarefa_id'))
                ->where(Avaliacao::getColumnName('type'), '=', Avaliacao::TYPE_ENSINO_PARTICIPACAO)
                ->where(Avaliacao::getColumnName('status'), '=', Avaliacao::STATUS_REPROVADO);
        })->get();

        $ensinoSupervisoes = EnsinoSupervisao::whereUserPadId($user_pad_id)->join(Avaliacao::getTableName(), function (JoinClause $join) {
            $join->on(EnsinoSupervisao::getColumnName('id'), '=', Avaliacao::getColumnName('tarefa_id'))
                ->where(Avaliacao::getColumnName('type'), '=', Avaliacao::TYPE_ENSINO_SUPERVISAO)
                ->where(Avaliacao::getColumnName('status'), '=', Avaliacao::STATUS_REPROVADO);
        })->get();

        $ensinoAulas = EnsinoAula::whereUserPadId($user_pad_id)->join(Avaliacao::getTableName(), function (JoinClause $join) {
            $join->on(EnsinoAula::getColumnName('id'), '=', Avaliacao::getColumnName('tarefa_id'))
                ->where(Avaliacao::getColumnName('type'), '=', Avaliacao::TYPE_ENSINO_AULA)
                ->where(Avaliacao::getColumnName('status'), '=', Avaliacao::STATUS_REPROVADO);
        })->get();

        $ensinoMembroDocentes = EnsinoMembroDocente::whereUserPadId($user_pad_id)->join(Avaliacao::getTableName(), function (JoinClause $join) {
            $join->on(EnsinoMembroDocente::getColumnName('id'), '=', Avaliacao::getColumnName('tarefa_id'))
                ->where(Avaliacao::getColumnName('type'), '=', Avaliacao::TYPE_ENSINO_MEMBRO_DOCENTE)
                ->where(Avaliacao::getColumnName('status'), '=', Avaliacao::STATUS_REPROVADO);
        })->get();

        $ensinoOutros = EnsinoOutros::whereUserPadId($user_pad_id)->join(Avaliacao::getTableName(), function (JoinClause $join) {
            $join->on(EnsinoOutros::getColumnName('id'), '=', Avaliacao::getColumnName('tarefa_id'))
                ->where(Avaliacao::getColumnName('type'), '=', Avaliacao::TYPE_ENSINO_OUTROS)
                ->where(Avaliacao::getColumnName('status'), '=', Avaliacao::STATUS_REPROVADO);
        })->get();

        $ensinoProjetos = EnsinoProjeto::whereUserPadId($user_pad_id)->join(Avaliacao::getTableName(), function (JoinClause $join) {
            $join->on(EnsinoProjeto::getColumnName('id'), '=', Avaliacao::getColumnName('tarefa_id'))
                ->where(Avaliacao::getColumnName('type'), '=', Avaliacao::TYPE_ENSINO_PROJETO)
                ->where(Avaliacao::getColumnName('status'), '=', Avaliacao::STATUS_REPROVADO);
        })->get();

        //Pesquisa Collections

        $pesquisaCoordenacoes = PesquisaCoordenacao::whereUserPadId($user_pad_id)->join(Avaliacao::getTableName(), function (JoinClause $join) {
            $join->on(PesquisaCoordenacao::getColumnName('id'), '=', Avaliacao::getColumnName('tarefa_id'))
                ->where(Avaliacao::getColumnName('type'), '=', Avaliacao::TYPE_PESQUISA_COORDENACAO)
                ->where(Avaliacao::getColumnName('status'), '=', Avaliacao::STATUS_REPROVADO);
        })->get();

        $pesquisaLiderancas = PesquisaLideranca::whereUserPadId($user_pad_id)->join(Avaliacao::getTableName(), function (JoinClause $join) {
            $join->on(PesquisaLideranca::getColumnName('id'), '=', Avaliacao::getColumnName('tarefa_id'))
                ->where(Avaliacao::getColumnName('type'), '=', Avaliacao::TYPE_PESQUISA_LIDERANCA)
                ->where(Avaliacao::getColumnName('status'), '=', Avaliacao::STATUS_REPROVADO);
        })->get();

        $pesquisaOrientacoes = PesquisaOrientacao::whereUserPadId($user_pad_id)->join(Avaliacao::getTableName(), function (JoinClause $join) {
            $join->on(PesquisaOrientacao::getColumnName('id'), '=', Avaliacao::getColumnName('tarefa_id'))
                ->where(Avaliacao::getColumnName('type'), '=', Avaliacao::TYPE_PESQUISA_ORIENTACAO)
                ->where(Avaliacao::getColumnName('status'), '=', Avaliacao::STATUS_REPROVADO);
        })->get();

        $pesquisaOutros = PesquisaOutros::whereUserPadId($user_pad_id)->join(Avaliacao::getTableName(), function (JoinClause $join) {
            $join->on(PesquisaOutros::getColumnName('id'), '=', Avaliacao::getColumnName('tarefa_id'))
                ->where(Avaliacao::getColumnName('type'), '=', Avaliacao::TYPE_PESQUISA_OUTROS)
                ->where(Avaliacao::getColumnName('status'), '=', Avaliacao::STATUS_REPROVADO);
        })->get();

        //Extensão Collections

        $extensaoCoordenacoes = ExtensaoCoordenacao::whereUserPadId($user_pad_id)->join(Avaliacao::getTableName(), function (JoinClause $join) {
            $join->on(ExtensaoCoordenacao::getColumnName('id'), '=', Avaliacao::getColumnName('tarefa_id'))
                ->where(Avaliacao::getColumnName('type'), '=', Avaliacao::TYPE_EXTENSAO_COORDENACAO)
                ->where(Avaliacao::getColumnName('status'), '=', Avaliacao::STATUS_REPROVADO);
        })->get();

        $extensaoOrientacoes = ExtensaoOrientacao::whereUserPadId($user_pad_id)->join(Avaliacao::getTableName(), function (JoinClause $join) {
            $join->on(ExtensaoOrientacao::getColumnName('id'), '=', Avaliacao::getColumnName('tarefa_id'))
                ->where(Avaliacao::getColumnName('type'), '=', Avaliacao::TYPE_EXTENSAO_ORIENTACAO)
                ->where(Avaliacao::getColumnName('status'), '=', Avaliacao::STATUS_REPROVADO);
        })->get();

        $extensaoOutros = ExtensaoOutros::whereUserPadId($user_pad_id)->join(Avaliacao::getTableName(), function (JoinClause $join) {
            $join->on(ExtensaoOutros::getColumnName('id'), '=', Avaliacao::getColumnName('tarefa_id'))
                ->where(Avaliacao::getColumnName('type'), '=', Avaliacao::TYPE_EXTENSAO_OUTROS)
                ->where(Avaliacao::getColumnName('status'), '=', Avaliacao::STATUS_REPROVADO);
        })->get();

        //Gestão Collections

        $gestaoCoordenacaoLaboratoriosDidaticos = GestaoCoordenacaoLaboratoriosDidaticos::whereUserPadId($user_pad_id)->join(Avaliacao::getTableName(), function (JoinClause $join) {
            $join->on(GestaoCoordenacaoLaboratoriosDidaticos::getColumnName('id'), '=', Avaliacao::getColumnName('tarefa_id'))
                ->where(Avaliacao::getColumnName('type'), '=', Avaliacao::TYPE_GESTAO_COORDENACAO_LABORATORIOS_DIDATICOS)
                ->where(Avaliacao::getColumnName('status'), '=', Avaliacao::STATUS_REPROVADO);
        })->get();

        $gestaoMembroComissoes = GestaoMembroComissao::whereUserPadId($user_pad_id)->join(Avaliacao::getTableName(), function (JoinClause $join) {
            $join->on(GestaoMembroComissao::getColumnName('id'), '=', Avaliacao::getColumnName('tarefa_id'))
                ->where(Avaliacao::getColumnName('type'), '=', Avaliacao::TYPE_GESTAO_MEMBRO_COMISSAO)
                ->where(Avaliacao::getColumnName('status'), '=', Avaliacao::STATUS_REPROVADO);
        })->get();

        $gestaoOutros = GestaoOutros::whereUserPadId($user_pad_id)->join(Avaliacao::getTableName(), function (JoinClause $join) {
            $join->on(GestaoOutros::getColumnName('id'), '=', Avaliacao::getColumnName('tarefa_id'))
                ->where(Avaliacao::getColumnName('type'), '=', Avaliacao::TYPE_GESTAO_OUTROS)
                ->where(Avaliacao::getColumnName('status'), '=', Avaliacao::STATUS_REPROVADO);
        })->get();

        $gestaoCoordenacaoProgramaInstitucionais = GestaoCoordenacaoProgramaInstitucional::whereUserPadId($user_pad_id)->join(Avaliacao::getTableName(), function (JoinClause $join) {
            $join->on(GestaoCoordenacaoProgramaInstitucional::getColumnName('id'), '=', Avaliacao::getColumnName('tarefa_id'))
                ->where(Avaliacao::getColumnName('type'), '=', Avaliacao::TYPE_GESTAO_COORDENACAO_PROGRAMA_INSTITUCIONAL)
                ->where(Avaliacao::getColumnName('status'), '=', Avaliacao::STATUS_REPROVADO);
        })->get();

        $gestaoMembroConselhos = GestaoMembroConselho::whereUserPadId($user_pad_id)->join(Avaliacao::getTableName(), function (JoinClause $join) {
            $join->on(GestaoMembroConselho::getColumnName('id'), '=', Avaliacao::getColumnName('tarefa_id'))
                ->where(Avaliacao::getColumnName('type'), '=', Avaliacao::TYPE_GESTAO_MEMBRO_CONSELHO)
                ->where(Avaliacao::getColumnName('status'), '=', Avaliacao::STATUS_REPROVADO);
        })->get();

        $gestaoRepresentanteUnidadeEducacoes = GestaoRepresentanteUnidadeEducacao::whereUserPadId($user_pad_id)->join(Avaliacao::getTableName(), function (JoinClause $join) {
            $join->on(GestaoRepresentanteUnidadeEducacao::getColumnName('id'), '=', Avaliacao::getColumnName('tarefa_id'))
                ->where(Avaliacao::getColumnName('type'), '=', Avaliacao::TYPE_GESTAO_REPRESENTANTE_UNIDADE_EDUCACAO)
                ->where(Avaliacao::getColumnName('status'), '=', Avaliacao::STATUS_REPROVADO);
        })->get();

        $gestaoMembroCamaras = GestaoMembroCamaras::whereUserPadId($user_pad_id)->join(Avaliacao::getTableName(), function (JoinClause $join) {
            $join->on(GestaoMembroCamaras::getColumnName('id'), '=', Avaliacao::getColumnName('tarefa_id'))
                ->where(Avaliacao::getColumnName('type'), '=', Avaliacao::TYPE_GESTAO_MEMBRO_CAMARAS)
                ->where(Avaliacao::getColumnName('status'), '=', Avaliacao::STATUS_REPROVADO);
        })->get();

        $gestaoMembroTitularConselhos = GestaoMembroTitularConselho::whereUserPadId($user_pad_id)->join(Avaliacao::getTableName(), function (JoinClause $join) {
            $join->on(GestaoMembroTitularConselho::getColumnName('id'), '=', Avaliacao::getColumnName('tarefa_id'))
                ->where(Avaliacao::getColumnName('type'), '=', Avaliacao::TYPE_GESTAO_MEMBRO_TITULAR_CONSELHO)
                ->where(Avaliacao::getColumnName('status'), '=', Avaliacao::STATUS_REPROVADO);
        })->get();

        return view('pad/dimensao/atividades/reprovadas/index', [

            'menu' => MenuItemsTeacher::PAD,

            'ensinoAtendimentoDiscentes' => $ensinoAtendimentoDiscentes,
            'ensinoCoordenacaoRegencias' => $ensinoCoordenacaoRegencias,
            'ensinoOrientacoes' => $ensinoOrientacoes,
            'ensinoParticipacoes' => $ensinoParticipacoes,
            'ensinoSupervisoes' => $ensinoSupervisoes,
            'ensinoAulas' => $ensinoAulas,
            'ensinoMembroDocentes' => $ensinoMembroDocentes,
            'ensinoOutros' => $ensinoOutros,
            'ensinoProjetos' => $ensinoProjetos,

            'pesquisaCoordenacoes' => $pesquisaCoordenacoes,
            'pesquisaLiderancas' => $pesquisaLiderancas,
            'pesquisaOrientacoes' => $pesquisaOrientacoes,
            'pesquisaOutros' => $pesquisaOutros,

            'extensaoCoordenacoes' => $extensaoCoordenacoes,
            'extensaoOrientacoes' => $extensaoOrientacoes,
            'extensaoOutros' => $extensaoOutros,

            'gestaoCoordenacaoLaboratoriosDidaticos' => $gestaoCoordenacaoLaboratoriosDidaticos,
            'gestaoMembroComissoes' => $gestaoMembroComissoes,
            'gestaoOutros' => $gestaoOutros,
            'gestaoCoordenacaoProgramaInstitucionais' => $gestaoCoordenacaoProgramaInstitucionais,
            'gestaoMembroConselhos' => $gestaoMembroConselhos,
            'gestaoRepresentanteUnidadeEducacoes' => $gestaoRepresentanteUnidadeEducacoes,
            'gestaoMembroCamaras' => $gestaoMembroCamaras,
            'gestaoMembroTitularConselhos' => $gestaoMembroTitularConselhos,
        ]);
    }
}
