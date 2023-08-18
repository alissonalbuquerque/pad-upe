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
use App\Models\Tabelas\Traits\ExpandModel;
use App\Models\Util\Status;

class Avaliacao extends Model
{
    use HasFactory;
    use ExpandModel;
    
    const STATUS_REPROVADO = 6;
    const STATUS_APROVADO = 7;
    const STATUS_PENDENTE = 3;
    const STATUS_EM_REVISAO = 8;

    const TYPE_ENSINO_AULA = 1;
    const TYPE_ENSINO_COORDENACAO_REGENCIA = 2;
    const TYPE_ENSINO_ORIENTACAO = 3;
    const TYPE_ENSINO_SUPERVISAO = 4;
    const TYPE_ENSINO_ATENDIMENTO_DISCENTE = 5;
    const TYPE_ENSINO_PROJETO = 6;
    const TYPE_ENSINO_PARTICIPACAO = 7;
    const TYPE_ENSINO_MEMBRO_DOCENTE = 8;
    const TYPE_ENSINO_OUTROS = 9;

    const TYPE_PESQUISA_COORDENACAO = 10;
    const TYPE_PESQUISA_ORIENTACAO = 11;
    const TYPE_PESQUISA_LIDERANCA = 12;
    const TYPE_PESQUISA_OUTROS = 13;

    const TYPE_EXTENSAO_COORDENACAO = 14;
    const TYPE_EXTENSAO_ORIENTACAO = 15;
    const TYPE_EXTENSAO_OUTROS = 16;

    CONST TYPE_GESTAO_COORDENACAO_LABORATORIOS_DIDATICOS = 17;
    CONST TYPE_GESTAO_MEMBRO_CONSELHO = 18;
    CONST TYPE_GESTAO_COORDENACAO_PROGRAMA_INSTITUCIONAL = 19;
    CONST TYPE_GESTAO_MEMBRO_TITULAR_CONSELHO = 20;
    CONST TYPE_GESTAO_MEMBRO_CAMARAS = 21;
    CONST TYPE_GESTAO_REPRESENTANTE_UNIDADE_EDUCACAO = 22;
    CONST TYPE_GESTAO_MEMBRO_COMISSAO = 23;
    CONST TYPE_GESTAO_OUTROS = 24;

    public static function listStatus($value = null)
    {
        $values = [
            self::STATUS_APROVADO => 'Aprovado',
            self::STATUS_PENDENTE => 'Pendente',
            self::STATUS_REPROVADO => 'Reprovado',
            self::STATUS_EM_REVISAO => 'Em Revisão'
        ];

        return $value !== null ? $values[$value] : $values;
    }

    protected $table = 'avaliacao';

    protected $fillable = ['tarefa_id', 'avaliador_id', 'type', 'status', 'descricao', 'ch_semanal', 'hora_reajuste'];

    public function tarefa()
    {   
        // Return Ensino Models
        // - - - - - - - - - - 
        if($this->type === self::TYPE_ENSINO_ATENDIMENTO_DISCENTE) {
            return $this->hasOne(EnsinoAtendimentoDiscente::class, 'id', 'tarefa_id');
        }

        if($this->type === self::TYPE_ENSINO_AULA) {
            return $this->hasOne(EnsinoAula::class, 'id', 'tarefa_id');
        }

        if($this->type === self::TYPE_ENSINO_COORDENACAO_REGENCIA) {
            return $this->hasOne(EnsinoCoordenacaoRegencia::class, 'id', 'tarefa_id');
        }

        if($this->type === self::TYPE_ENSINO_MEMBRO_DOCENTE) {
            return $this->hasOne(EnsinoMembroDocente::class, 'id', 'tarefa_id');
        }

        if($this->type === self::TYPE_ENSINO_ORIENTACAO) {
            return $this->hasOne(EnsinoOrientacao::class, 'id', 'tarefa_id');
        }

        if($this->type === self::TYPE_ENSINO_OUTROS) {
            return $this->hasOne(EnsinoOutros::class, 'id', 'tarefa_id');
        }

        if($this->type === self::TYPE_ENSINO_PARTICIPACAO) {
            return $this->hasOne(EnsinoParticipacao::class, 'id', 'tarefa_id');
        }

        if($this->type === self::TYPE_ENSINO_PROJETO) {
            return $this->hasOne(EnsinoProjeto::class, 'id', 'tarefa_id');
        }

        if($this->type === self::TYPE_ENSINO_SUPERVISAO) {
            return $this->hasOne(EnsinoSupervisao::class, 'id', 'tarefa_id');
        }
        // - - - - - - - - - - 

        // Return Pesquisa Models
        // - - - - - - - - - - 
        if($this->type === self::TYPE_PESQUISA_COORDENACAO) {
            return $this->hasOne(PesquisaCoordenacao::class, 'id', 'tarefa_id');
        }

        if($this->type === self::TYPE_PESQUISA_LIDERANCA) {
            return $this->hasOne(PesquisaLideranca::class, 'id', 'tarefa_id');
        }

        if($this->type === self::TYPE_PESQUISA_ORIENTACAO) {
            return $this->hasOne(PesquisaOrientacao::class, 'id', 'tarefa_id');
        }

        if($this->type === self::TYPE_PESQUISA_OUTROS) {
            return $this->hasOne(PesquisaOutros::class, 'id', 'tarefa_id');
        }
        // - - - - - - - - - - 

        // Return Extensao Models
        // - - - - - - - - - - 
        if($this->type === self::TYPE_EXTENSAO_COORDENACAO) {
            return $this->hasOne(ExtensaoCoordenacao::class, 'id', 'tarefa_id');
        }

        if($this->type === self::TYPE_EXTENSAO_ORIENTACAO) {
            return $this->hasOne(ExtensaoOrientacao::class, 'id', 'tarefa_id');
        }

        if($this->type === self::TYPE_EXTENSAO_OUTROS) {
            return $this->hasOne(ExtensaoOutros::class, 'id', 'tarefa_id');
        }
        // - - - - - - - - - - 

        // Return Gestao Models
        // - - - - - - - - - - 
        if($this->type === self::TYPE_GESTAO_COORDENACAO_LABORATORIOS_DIDATICOS) {
            return $this->hasOne(GestaoCoordenacaoLaboratoriosDidaticos::class, 'id', 'tarefa_id');
        }

        if($this->type === self::TYPE_GESTAO_COORDENACAO_PROGRAMA_INSTITUCIONAL) {
            return $this->hasOne(GestaoCoordenacaoProgramaInstitucional::class, 'id', 'tarefa_id');
        }

        if($this->type === self::TYPE_GESTAO_MEMBRO_CAMARAS) {
            return $this->hasOne(GestaoMembroCamaras::class, 'id', 'tarefa_id');
        }

        if($this->type === self::TYPE_GESTAO_MEMBRO_COMISSAO) {
            return $this->hasOne(GestaoMembroComissao::class, 'id', 'tarefa_id');
        }

        if($this->type === self::TYPE_GESTAO_MEMBRO_CONSELHO) {
            return $this->hasOne(GestaoMembroConselho::class, 'id', 'tarefa_id');
        }

        if($this->type === self::TYPE_GESTAO_MEMBRO_TITULAR_CONSELHO) {
            return $this->hasOne(GestaoMembroTitularConselho::class, 'id', 'tarefa_id');
        }

        if($this->type === self::TYPE_GESTAO_OUTROS) {
            return $this->hasOne(GestaoOutros::class, 'id', 'tarefa_id');
        }

        if($this->type === self::TYPE_GESTAO_REPRESENTANTE_UNIDADE_EDUCACAO) {
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

    public static function getTypeByClassPath($classPath) {

        $typeByClassPath = [
            EnsinoAtendimentoDiscente::class => self::TYPE_ENSINO_ATENDIMENTO_DISCENTE,
            EnsinoAula::class => self::TYPE_ENSINO_AULA,
            EnsinoCoordenacaoRegencia::class => self::TYPE_ENSINO_COORDENACAO_REGENCIA,
            EnsinoMembroDocente::class => self::TYPE_ENSINO_MEMBRO_DOCENTE,
            EnsinoOrientacao::class => self::TYPE_ENSINO_ORIENTACAO,
            EnsinoOutros::class => self::TYPE_ENSINO_OUTROS,
            EnsinoParticipacao::class => self::TYPE_ENSINO_PARTICIPACAO,
            EnsinoProjeto::class => self::TYPE_ENSINO_PROJETO,
            EnsinoSupervisao::class => self::TYPE_ENSINO_SUPERVISAO,

            PesquisaCoordenacao::class => self::TYPE_PESQUISA_COORDENACAO,
            PesquisaLideranca::class => self::TYPE_PESQUISA_LIDERANCA,
            PesquisaOrientacao::class => self::TYPE_PESQUISA_ORIENTACAO,
            PesquisaOutros::class => self::TYPE_PESQUISA_OUTROS,

            ExtensaoCoordenacao::class => self::TYPE_EXTENSAO_COORDENACAO,
            ExtensaoOrientacao::class => self::TYPE_EXTENSAO_ORIENTACAO,
            ExtensaoOutros::class => self::TYPE_EXTENSAO_OUTROS,

            GestaoCoordenacaoLaboratoriosDidaticos::class => self::TYPE_GESTAO_COORDENACAO_LABORATORIOS_DIDATICOS,
            GestaoCoordenacaoProgramaInstitucional::class => self::TYPE_GESTAO_COORDENACAO_PROGRAMA_INSTITUCIONAL,
            GestaoMembroCamaras::class => self::TYPE_GESTAO_MEMBRO_CAMARAS,
            GestaoMembroComissao::class => self::TYPE_GESTAO_MEMBRO_COMISSAO,
            GestaoMembroConselho::class => self::TYPE_GESTAO_MEMBRO_CONSELHO,
            GestaoMembroTitularConselho::class => self::TYPE_GESTAO_MEMBRO_TITULAR_CONSELHO,
            GestaoOutros::class => self::TYPE_GESTAO_OUTROS,
            GestaoRepresentanteUnidadeEducacao::class => self::TYPE_GESTAO_REPRESENTANTE_UNIDADE_EDUCACAO
        ];

        return $typeByClassPath[$classPath];
    }
}
