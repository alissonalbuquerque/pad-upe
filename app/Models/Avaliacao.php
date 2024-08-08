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
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Avaliacao extends Model
{
    use HasFactory;
    use ExpandModel;
    
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

    const TYPE_GESTAO_COORDENACAO_LABORATORIOS_DIDATICOS = 17;
    const TYPE_GESTAO_MEMBRO_CONSELHO                    = 18;
    const TYPE_GESTAO_COORDENACAO_PROGRAMA_INSTITUCIONAL = 19;
    const TYPE_GESTAO_MEMBRO_TITULAR_CONSELHO            = 20;
    const TYPE_GESTAO_MEMBRO_CAMARAS                     = 21;
    const TYPE_GESTAO_REPRESENTANTE_UNIDADE_EDUCACAO     = 22;
    const TYPE_GESTAO_MEMBRO_COMISSAO                    = 23;
    const TYPE_GESTAO_OUTROS                             = 24;

    const TABLE_ENSINO_AULA                 = 'ensino_aulas';
    const TABLE_ENSINO_COORDENACAO_REGENCIA = 'ensino_coordenacao_regencia';
    const TABLE_ENSINO_ORIENTACAO           = 'ensino_orientacoes';
    const TABLE_ENSINO_SUPERVISAO           = 'ensino_supervisao';
    const TABLE_ENSINO_ATENDIMENTO_DISCENTE = 'ensino_atendimento_discente';
    const TABLE_ENSINO_PROJETO              = 'ensino_projeto';
    const TABLE_ENSINO_PARTICIPACAO         = 'ensino_participacao';
    const TABLE_ENSINO_MEMBRO_DOCENTE       = 'ensino_membro_docente';
    const TABLE_ENSINO_OUTROS               = 'ensino_outro';

    const TABLE_PESQUISA_COORDENACAO        = 'pesquisa_coordenacao';
    const TABLE_PESQUISA_ORIENTACAO         = 'pesquisa_orientacao';
    const TABLE_PESQUISA_LIDERANCA          = 'pesquisa_lideranca';
    const TABLE_PESQUISA_OUTROS             = 'pesquisa_outro';

    const TABLE_EXTENSAO_COORDENACAO        = 'extensao_coordenacao';
    const TABLE_EXTENSAO_ORIENTACAO         = 'extensao_orientacao';
    const TABLE_EXTENSAO_OUTROS             = 'extensao_outro';

    const TABLE_GESTAO_COORDENACAO_LABORATORIOS_DIDATICOS    = 'gestao_coordenacao_laboratorios_didaticos';
    const TABLE_GESTAO_MEMBRO_CONSELHO                       = 'gestao_membro_conselho';
    const TABLE_GESTAO_COORDENACAO_PROGRAMA_INSTITUCIONAL    = 'gestao_coordenacao_programa_institucional';
    const TABLE_GESTAO_MEMBRO_TITULAR_CONSELHO               = 'gestao_membro_titular_conselho';
    const TABLE_GESTAO_MEMBRO_CAMARAS                        = 'gestao_membro_camaras';
    const TABLE_GESTAO_REPRESENTANTE_UNIDADE_EDUCACAO        = 'gestao_representante_unidade_educacao';
    const TABLE_GESTAO_MEMBRO_COMISSAO                       = 'gestao_membro_comissao';
    const TABLE_GESTAO_OUTROS                                = 'gestao_outro';

    const CLASS_ENSINO_AULA                 = EnsinoAula::class;
    const CLASS_ENSINO_COORDENACAO_REGENCIA = EnsinoCoordenacaoRegencia::class;
    const CLASS_ENSINO_ORIENTACAO           = EnsinoOrientacao::class;
    const CLASS_ENSINO_SUPERVISAO           = EnsinoSupervisao::class;
    const CLASS_ENSINO_ATENDIMENTO_DISCENTE = EnsinoAtendimentoDiscente::class;
    const CLASS_ENSINO_PROJETO              = EnsinoProjeto::class;
    const CLASS_ENSINO_PARTICIPACAO         = EnsinoParticipacao::class;
    const CLASS_ENSINO_MEMBRO_DOCENTE       = EnsinoMembroDocente::class;
    const CLASS_ENSINO_OUTROS               = EnsinoOutros::class;

    const CLASS_PESQUISA_COORDENACAO        = PesquisaCoordenacao::class;
    const CLASS_PESQUISA_ORIENTACAO         = PesquisaOrientacao::class;
    const CLASS_PESQUISA_LIDERANCA          = PesquisaLideranca::class;
    const CLASS_PESQUISA_OUTROS             = PesquisaOutros::class;

    const CLASS_EXTENSAO_COORDENACAO        = ExtensaoCoordenacao::class;
    const CLASS_EXTENSAO_ORIENTACAO         = ExtensaoOrientacao::class;
    const CLASS_EXTENSAO_OUTROS             = ExtensaoOutros::class;

    const CLASS_GESTAO_COORDENACAO_LABORATORIOS_DIDATICOS = GestaoCoordenacaoLaboratoriosDidaticos::class;
    const CLASS_GESTAO_MEMBRO_CONSELHO                    = GestaoMembroConselho::class;
    const CLASS_GESTAO_COORDENACAO_PROGRAMA_INSTITUCIONAL = GestaoCoordenacaoProgramaInstitucional::class;
    const CLASS_GESTAO_MEMBRO_TITULAR_CONSELHO            = GestaoMembroTitularConselho::class;
    const CLASS_GESTAO_MEMBRO_CAMARAS                     = GestaoMembroCamaras::class;
    const CLASS_GESTAO_REPRESENTANTE_UNIDADE_EDUCACAO     = GestaoRepresentanteUnidadeEducacao::class;
    const CLASS_GESTAO_MEMBRO_COMISSAO                    = GestaoMembroComissao::class;
    const CLASS_GESTAO_OUTROS                             = GestaoOutros::class;

    protected $table = 'avaliacao';

    protected $fillable = ['id', 'tarefa_id', 'avaliador_id', 'type', 'status', 'descricao', 'ch_semanal', 'ch_total', 'created_at', 'updated_at', 'deleted_at', 'horas_reajuste'];

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

    public static function list_classe_name_tarefas_by_type()
    {
        return [
            self::TYPE_ENSINO_AULA                  => self::CLASS_ENSINO_AULA                ,
            self::TYPE_ENSINO_COORDENACAO_REGENCIA  => self::CLASS_ENSINO_COORDENACAO_REGENCIA,
            self::TYPE_ENSINO_ORIENTACAO            => self::CLASS_ENSINO_ORIENTACAO          ,
            self::TYPE_ENSINO_SUPERVISAO            => self::CLASS_ENSINO_SUPERVISAO          ,
            self::TYPE_ENSINO_ATENDIMENTO_DISCENTE  => self::CLASS_ENSINO_ATENDIMENTO_DISCENTE,
            self::TYPE_ENSINO_PROJETO               => self::CLASS_ENSINO_PROJETO             ,
            self::TYPE_ENSINO_PARTICIPACAO          => self::CLASS_ENSINO_PARTICIPACAO        ,
            self::TYPE_ENSINO_MEMBRO_DOCENTE        => self::CLASS_ENSINO_MEMBRO_DOCENTE      ,
            self::TYPE_ENSINO_OUTROS                => self::CLASS_ENSINO_OUTROS              ,

            self::TYPE_PESQUISA_COORDENACAO         => self::CLASS_PESQUISA_COORDENACAO,
            self::TYPE_PESQUISA_ORIENTACAO          => self::CLASS_PESQUISA_ORIENTACAO ,
            self::TYPE_PESQUISA_LIDERANCA           => self::CLASS_PESQUISA_LIDERANCA  ,
            self::TYPE_PESQUISA_OUTROS              => self::CLASS_PESQUISA_OUTROS     ,

            self::TYPE_EXTENSAO_COORDENACAO         => self::CLASS_EXTENSAO_COORDENACAO,
            self::TYPE_EXTENSAO_ORIENTACAO          => self::CLASS_EXTENSAO_ORIENTACAO ,
            self::TYPE_EXTENSAO_OUTROS              => self::CLASS_EXTENSAO_OUTROS     ,

            self::TYPE_GESTAO_COORDENACAO_LABORATORIOS_DIDATICOS => self::CLASS_GESTAO_COORDENACAO_LABORATORIOS_DIDATICOS,
            self::TYPE_GESTAO_MEMBRO_CONSELHO                    => self::CLASS_GESTAO_MEMBRO_CONSELHO                   ,
            self::TYPE_GESTAO_COORDENACAO_PROGRAMA_INSTITUCIONAL => self::CLASS_GESTAO_COORDENACAO_PROGRAMA_INSTITUCIONAL,
            self::TYPE_GESTAO_MEMBRO_TITULAR_CONSELHO            => self::CLASS_GESTAO_MEMBRO_TITULAR_CONSELHO           ,
            self::TYPE_GESTAO_MEMBRO_CAMARAS                     => self::CLASS_GESTAO_MEMBRO_CAMARAS                    ,
            self::TYPE_GESTAO_REPRESENTANTE_UNIDADE_EDUCACAO     => self::CLASS_GESTAO_REPRESENTANTE_UNIDADE_EDUCACAO    ,
            self::TYPE_GESTAO_MEMBRO_COMISSAO                    => self::CLASS_GESTAO_MEMBRO_COMISSAO                   ,
            self::TYPE_GESTAO_OUTROS                             => self::CLASS_GESTAO_OUTROS                            ,
        ];
    }

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

    /**
     * Retorna uma lista de avaliações com status reprovada
     *
     * @param "Ensino* Pesquisa* Extensao* Gestao*" $classPath
     * @return Collection<Avaliacao>
     */
    public static function getAvaliacoesDisapproved($classPath, $user_pad_id) {

        $class = $classPath;
        $avaliacaoType = self::getTypeByClassPath($classPath);

        $modelClassQuery = $class::whereUserPadId($user_pad_id)->join(Avaliacao::getTableName(), function (JoinClause $join) use ($class, $avaliacaoType) {
            $join->on($class::getColumnName('id'), '=', Avaliacao::getColumnName('tarefa_id'))
                ->where(Avaliacao::getColumnName('type'), '=', $avaliacaoType)
                ->where(Avaliacao::getColumnName('status'), '=', Avaliacao::STATUS_REPROVADO);
        })->select('avaliacao.tarefa_id');

        $avaliacaoIds = $modelClassQuery->get()->map(function($model) {
            return $model->tarefa_id;
        })->toArray();

        return Avaliacao::whereIn('tarefa_id', $avaliacaoIds)->whereType($avaliacaoType)->get();
    }

    /**
     * 
     */
    public static function avaliacao_by_user_pad($user_pad = null) {

        DB::statement("
            CREATE TEMPORARY TABLE php_tarefa_class (
                type TINYINT,
                class_name VARCHAR(255)
            );
        ");

            foreach(self::list_classe_name_tarefas_by_type() as $type => $class_name) {
                DB::statement("INSERT INTO php_tarefa_class(type, class_name) VALUES('{$type}', '{$class_name}')");
            }

        DB::statement("DROP TEMPORARY TABLE IF EXISTS php_tarefa_class");

        // DB::table('avaliacao')->select('avaliacao.*', 'tarefa.id', 'tarefa.user_pad_id', '')
        // ->when

        // avaliacao.type
        // avaliacao.tarefa_id
        // self::TYPE_ENSINO_AULA -> self::TABLE_ENSINO_AULA
    }
}
