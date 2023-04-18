<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Util\Avaliacao as UtilAvaliacao;
use App\Models\Tabelas\Ensino\EnsinoAtendimentoDiscente;
use App\Models\Tabelas\Ensino\EnsinoAula;
use App\Models\Tabelas\Ensino\EnsinoCoordenacaoRegencia;
use App\Models\Tabelas\Ensino\EnsinoMembroDocente;
use App\Models\Tabelas\Ensino\EnsinoOrientacao;
use App\Models\Tabelas\Ensino\EnsinoOutros;
use App\Models\Tabelas\Ensino\EnsinoParticipacao;
use App\Models\Tabelas\Ensino\EnsinoProjeto;
use App\Models\Tabelas\Ensino\EnsinoSupervisao;
use App\Models\Tabelas\Pesquisa\PesquisaCoordenacao;
use App\Models\Tabelas\Pesquisa\PesquisaLideranca;
use App\Models\Tabelas\Pesquisa\PesquisaOrientacao;
use App\Models\Tabelas\Pesquisa\PesquisaOutros;
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
use App\Models\Util\Status;

class Avaliacao extends Model
{
    use HasFactory;

    protected $table = 'avaliacao';

    protected $fillable = ['tarefa_id', 'avaliador_id', 'type', 'status', 'descricao', 'ch_semanal', 'hora_reajuste'];

    public function tarefa()
    {   
        // Return Ensino Models
        // - - - - - - - - - - 
        if($this->type === UtilAvaliacao::ENSINO_ATENDIMENTO_DISCENTE) {
            return $this->hasOne(EnsinoAtendimentoDiscente::class, 'id', 'tarefa_id');
        }

        if($this->type === UtilAvaliacao::ENSINO_AULA) {
            return $this->hasOne(EnsinoAula::class, 'id', 'tarefa_id');
        }

        if($this->type === UtilAvaliacao::ENSINO_COORDENACAO_REGENCIA) {
            return $this->hasOne(EnsinoCoordenacaoRegencia::class, 'id', 'tarefa_id');
        }

        if($this->type === UtilAvaliacao::ENSINO_MEMBRO_DOCENTE) {
            return $this->hasOne(EnsinoMembroDocente::class, 'id', 'tarefa_id');
        }

        if($this->type === UtilAvaliacao::ENSINO_ORIENTACAO) {
            return $this->hasOne(EnsinoOrientacao::class, 'id', 'tarefa_id');
        }

        if($this->type === UtilAvaliacao::ENSINO_OUTROS) {
            return $this->hasOne(EnsinoOutros::class, 'id', 'tarefa_id');
        }

        if($this->type === UtilAvaliacao::ENSINO_PARTICIPACAO) {
            return $this->hasOne(EnsinoParticipacao::class, 'id', 'tarefa_id');
        }

        if($this->type === UtilAvaliacao::ENSINO_PROJETO) {
            return $this->hasOne(EnsinoProjeto::class, 'id', 'tarefa_id');
        }

        if($this->type === UtilAvaliacao::ENSINO_SUPERVISAO) {
            return $this->hasOne(EnsinoSupervisao::class, 'id', 'tarefa_id');
        }
        // - - - - - - - - - - 

        // Return Pesquisa Models
        // - - - - - - - - - - 
        if($this->type === UtilAvaliacao::PESQUISA_COORDENACAO) {
            return $this->hasOne(PesquisaCoordenacao::class, 'id', 'tarefa_id');
        }

        if($this->type === UtilAvaliacao::PESQUISA_LIDERANCA) {
            return $this->hasOne(PesquisaLideranca::class, 'id', 'tarefa_id');
        }

        if($this->type === UtilAvaliacao::PESQUISA_ORIENTACAO) {
            return $this->hasOne(PesquisaOrientacao::class, 'id', 'tarefa_id');
        }

        if($this->type === UtilAvaliacao::PESQUISA_OUTROS) {
            return $this->hasOne(PesquisaOutros::class, 'id', 'tarefa_id');
        }
        // - - - - - - - - - - 

        // Return Extensao Models
        // - - - - - - - - - - 
        if($this->type === UtilAvaliacao::EXTENSAO_COORDENACAO) {
            return $this->hasOne(ExtensaoCoordenacao::class, 'id', 'tarefa_id');
        }

        if($this->type === UtilAvaliacao::EXTENSAO_ORIENTACAO) {
            return $this->hasOne(ExtensaoOrientacao::class, 'id', 'tarefa_id');
        }

        if($this->type === UtilAvaliacao::EXTENSAO_OUTROS) {
            return $this->hasOne(ExtensaoOutros::class, 'id', 'tarefa_id');
        }
        // - - - - - - - - - - 

        // Return Gestao Models
        // - - - - - - - - - - 
        if($this->type === UtilAvaliacao::GESTAO_COORDENACAO_LABORATORIOS_DIDATICOS) {
            return $this->hasOne(GestaoCoordenacaoLaboratoriosDidaticos::class, 'id', 'tarefa_id');
        }

        if($this->type === UtilAvaliacao::GESTAO_COORDENACAO_PROGRAMA_INSTITUCIONAL) {
            return $this->hasOne(GestaoCoordenacaoProgramaInstitucional::class, 'id', 'tarefa_id');
        }

        if($this->type === UtilAvaliacao::GESTAO_MEMBRO_CAMARAS) {
            return $this->hasOne(GestaoMembroCamaras::class, 'id', 'tarefa_id');
        }

        if($this->type === UtilAvaliacao::GESTAO_MEMBRO_COMISSAO) {
            return $this->hasOne(GestaoMembroComissao::class, 'id', 'tarefa_id');
        }

        if($this->type === UtilAvaliacao::GESTAO_MEMBRO_CONSELHO) {
            return $this->hasOne(GestaoMembroConselho::class, 'id', 'tarefa_id');
        }

        if($this->type === UtilAvaliacao::GESTAO_MEMBRO_TITULAR_CONSELHO) {
            return $this->hasOne(GestaoMembroTitularConselho::class, 'id', 'tarefa_id');
        }

        if($this->type === UtilAvaliacao::GESTAO_OUTROS) {
            return $this->hasOne(GestaoOutros::class, 'id', 'tarefa_id');
        }

        if($this->type === UtilAvaliacao::GESTAO_REPRESENTANTE_UNIDADE_EDUCACAO) {
            return $this->hasOne(GestaoRepresentanteUnidadeEducacao::class, 'id', 'tarefa_id');
        }
        // - - - - - - - - - - 
    }

    public function avaliadorPad() {
        return $this->belongsTo(AvaliadorPad::class);
    }

    public function getStatusAsText() {
        return Status::listStatus($this->status);
    }
}


/**
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 */