<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskTime extends Model
{
    const STATUS_REPROVADO  = 6;
    const STATUS_APROVADO   = 7;
    const STATUS_PENDENTE   = 3;
    const STATUS_EM_REVISAO = 8;

    const TYPE_ENSINO_AULA                  = 1;
    const TYPE_ENSINO_COORDENACAO_REGENCIA  = 2;
    const TYPE_ENSINO_ORIENTACAO            = 3;
    const TYPE_ENSINO_SUPERVISAO            = 4;
    const TYPE_ENSINO_ATENDIMENTO_DISCENTE  = 5;
    const TYPE_ENSINO_PROJETO               = 6;
    const TYPE_ENSINO_PARTICIPACAO          = 7;
    const TYPE_ENSINO_MEMBRO_DOCENTE        = 8;
    const TYPE_ENSINO_OUTROS                = 9;

    const TYPE_PESQUISA_COORDENACAO         = 10;
    const TYPE_PESQUISA_ORIENTACAO          = 11;
    const TYPE_PESQUISA_LIDERANCA           = 12;
    const TYPE_PESQUISA_OUTROS              = 13;

    const TYPE_EXTENSAO_COORDENACAO         = 14;
    const TYPE_EXTENSAO_ORIENTACAO          = 15;
    const TYPE_EXTENSAO_OUTROS              = 16;

    CONST TYPE_GESTAO_COORDENACAO_LABORATORIOS_DIDATICOS    = 17;
    CONST TYPE_GESTAO_MEMBRO_CONSELHO                       = 18;
    CONST TYPE_GESTAO_COORDENACAO_PROGRAMA_INSTITUCIONAL    = 19;
    CONST TYPE_GESTAO_MEMBRO_TITULAR_CONSELHO               = 20;
    CONST TYPE_GESTAO_MEMBRO_CAMARAS                        = 21;
    CONST TYPE_GESTAO_REPRESENTANTE_UNIDADE_EDUCACAO        = 22;
    CONST TYPE_GESTAO_MEMBRO_COMISSAO                       = 23;
    CONST TYPE_GESTAO_OUTROS                                = 24;

    CONST WEEK_DAY_SUNDAY       = 1;
    CONST WEEK_DAY_MONDAY       = 2;
    CONST WEEK_DAY_TUESDAY      = 3;
    CONST WEEK_DAY_WEDNESDAY    = 4;
    CONST WEEK_DAY_THURSDAY     = 5;
    CONST WEEK_DAY_FRIDAY       = 6;
    CONST WEEK_DAY_SATURDAY     = 7;

    protected $table = 'task_time';

    protected $fillable = ['user_pad_upe', 'tarefa_id', 'type', 'weekday', 'start_time', 'end_time'];

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

    public function userPad() {
        return $this->hasOne(UserPad::class, 'id', 'user_pad_id');
    }

    public static function listWeekDays($value) {
        $values = [
            self::WEEK_DAY_SUNDAY       => "DOMINGO",
            self::WEEK_DAY_MONDAY       => "SEGUNDA-FEIRA",
            self::WEEK_DAY_TUESDAY      => "TERÇA-FEIRA",
            self::WEEK_DAY_WEDNESDAY    => "QUARTA-FEIRA",
            self::WEEK_DAY_THURSDAY     => "QUINTA-FEIRA",
            self::WEEK_DAY_FRIDAY       => "SEXTA-FEIRA",
            self::WEEK_DAY_SATURDAY     => "SÁBADO",
        ];

        return $value != null ? $values[$value] : $values;
    }

}
