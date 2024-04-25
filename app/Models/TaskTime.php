<?php

namespace App\Models;

use Illuminate\Validation\Rule;

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
use App\Rules\ValidationGreaterThanTime;
use App\Rules\ValidationLimitTime;
use App\Rules\ValidationRangeTime;
use Carbon\Carbon;
use DateInterval;
use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

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

    CONST WEEK_HOUR = 0;
    CONST WEEK_DAY_SUNDAY       = 1; // Não Utilizado
    CONST WEEK_DAY_MONDAY       = 2;
    CONST WEEK_DAY_TUESDAY      = 3;
    CONST WEEK_DAY_WEDNESDAY    = 4;
    CONST WEEK_DAY_THURSDAY     = 5;
    CONST WEEK_DAY_FRIDAY       = 6;
    CONST WEEK_DAY_SATURDAY     = 7;

    protected $table = 'task_time';

    protected $fillable = ['user_pad_id', 'tarefa_id', 'type', 'weekday', 'start_time', 'end_time'];

    public static function rules($attributes)
    {
        return [
            'cod_atividade'     => ['required'],
            'slct_tarefa_id'    => ['required'],
            'tarefa_id'         => ['required', 'integer'],
            'type'              => ['required', 'integer', Rule::in(array_keys(self::listTaskTypes()))],
            'weekday'           => ['required', 'integer', Rule::in(array_keys(self::listWeekDays()))],
            'start_time'        => ['required', 'date_format:H:i', 'before:end_time'],
            'end_time'          => ['required', 'date_format:H:i', 'after:start_time', new ValidationLimitTime($attributes), new ValidationRangeTime($attributes)],
        ];
    }


    public static function messages()
    {
        return [
            //cod_atividade
            'cod_atividade.required' => '',

            //tarefa_id
            'slct_tarefa_id.required' => 'O campo "Atividade" é obrigatório!',

            // //type
            // 'type.required' => 'O campo "Atividade" é obrigatório!',

            //weekday
            'weekday.required' => 'O campo "Dia da Semana" é obrigatório!',
            'weekday.in' => 'Selecione uma opção da lista de "Dia da Semana"!',
            'weekday.integer' => 'O campo "Dia da Semana" deve cónter um inteiro!',

            //start_time
            'start_time.required' => 'O campo "Horário Inicial" é obrigatório!',
            'start_time.before' => 'O campo "Horário Inicial" deve ser menor do que "Horário Final"!',

            //end_time
            'end_time.required' => 'O campo "Horário Final" é obrigatório!',
            'end_time.after' => 'O campo "Horário Final" deve ser maior do que "Horário Inicial"!',
        ];
    }

    public function tarefa()
    {
        // Return Ensino Models
        // - - - - - - - - - - 
        if($this->type == self::TYPE_ENSINO_ATENDIMENTO_DISCENTE) {
            return $this->hasOne(EnsinoAtendimentoDiscente::class, 'id', 'tarefa_id');
        }

        if($this->type == self::TYPE_ENSINO_AULA) {
            return $this->hasOne(EnsinoAula::class, 'id', 'tarefa_id');
        }

        if($this->type == self::TYPE_ENSINO_COORDENACAO_REGENCIA) {
            return $this->hasOne(EnsinoCoordenacaoRegencia::class, 'id', 'tarefa_id');
        }

        if($this->type == self::TYPE_ENSINO_MEMBRO_DOCENTE) {
            return $this->hasOne(EnsinoMembroDocente::class, 'id', 'tarefa_id');
        }

        if($this->type == self::TYPE_ENSINO_ORIENTACAO) {
            return $this->hasOne(EnsinoOrientacao::class, 'id', 'tarefa_id');
        }

        if($this->type == self::TYPE_ENSINO_OUTROS) {
            return $this->hasOne(EnsinoOutros::class, 'id', 'tarefa_id');
        }

        if($this->type == self::TYPE_ENSINO_PARTICIPACAO) {
            return $this->hasOne(EnsinoParticipacao::class, 'id', 'tarefa_id');
        }

        if($this->type == self::TYPE_ENSINO_PROJETO) {
            return $this->hasOne(EnsinoProjeto::class, 'id', 'tarefa_id');
        }

        if($this->type == self::TYPE_ENSINO_SUPERVISAO) {
            return $this->hasOne(EnsinoSupervisao::class, 'id', 'tarefa_id');
        }
        // - - - - - - - - - - 

        // Return Pesquisa Models
        // - - - - - - - - - - 
        if($this->type == self::TYPE_PESQUISA_COORDENACAO) {
            return $this->hasOne(PesquisaCoordenacao::class, 'id', 'tarefa_id');
        }

        if($this->type == self::TYPE_PESQUISA_LIDERANCA) {
            return $this->hasOne(PesquisaLideranca::class, 'id', 'tarefa_id');
        }

        if($this->type == self::TYPE_PESQUISA_ORIENTACAO) {
            return $this->hasOne(PesquisaOrientacao::class, 'id', 'tarefa_id');
        }

        if($this->type == self::TYPE_PESQUISA_OUTROS) {
            return $this->hasOne(PesquisaOutros::class, 'id', 'tarefa_id');
        }
        // - - - - - - - - - - 

        // Return Extensao Models
        // - - - - - - - - - - 
        if($this->type == self::TYPE_EXTENSAO_COORDENACAO) {
            return $this->hasOne(ExtensaoCoordenacao::class, 'id', 'tarefa_id');
        }

        if($this->type == self::TYPE_EXTENSAO_ORIENTACAO) {
            return $this->hasOne(ExtensaoOrientacao::class, 'id', 'tarefa_id');
        }

        if($this->type == self::TYPE_EXTENSAO_OUTROS) {
            return $this->hasOne(ExtensaoOutros::class, 'id', 'tarefa_id');
        }
        // - - - - - - - - - - 

        // Return Gestao Models
        // - - - - - - - - - - 
        if($this->type == self::TYPE_GESTAO_COORDENACAO_LABORATORIOS_DIDATICOS) {
            return $this->hasOne(GestaoCoordenacaoLaboratoriosDidaticos::class, 'id', 'tarefa_id');
        }

        if($this->type == self::TYPE_GESTAO_COORDENACAO_PROGRAMA_INSTITUCIONAL) {
            return $this->hasOne(GestaoCoordenacaoProgramaInstitucional::class, 'id', 'tarefa_id');
        }

        if($this->type == self::TYPE_GESTAO_MEMBRO_CAMARAS) {
            return $this->hasOne(GestaoMembroCamaras::class, 'id', 'tarefa_id');
        }

        if($this->type == self::TYPE_GESTAO_MEMBRO_COMISSAO) {
            return $this->hasOne(GestaoMembroComissao::class, 'id', 'tarefa_id');
        }

        if($this->type == self::TYPE_GESTAO_MEMBRO_CONSELHO) {
            return $this->hasOne(GestaoMembroConselho::class, 'id', 'tarefa_id');
        }

        if($this->type == self::TYPE_GESTAO_MEMBRO_TITULAR_CONSELHO) {
            return $this->hasOne(GestaoMembroTitularConselho::class, 'id', 'tarefa_id');
        }

        if($this->type == self::TYPE_GESTAO_OUTROS) {
            return $this->hasOne(GestaoOutros::class, 'id', 'tarefa_id');
        }

        if($this->type == self::TYPE_GESTAO_REPRESENTANTE_UNIDADE_EDUCACAO) {
            return $this->hasOne(GestaoRepresentanteUnidadeEducacao::class, 'id', 'tarefa_id');
        }
        // - - - - - - - - - - 
    }

    public function userPad() {
        return $this->hasOne(UserPad::class, 'id', 'user_pad_id');
    }

    /**
     * @return string
     */
    public function getCode() {
        return $this->tarefa->cod_atividade;
    }

    /**
     * @return string
     */
    public function getName() {
        // Return Ensino Models
        // - - - - - - - - - - 
        if($this->type == self::TYPE_ENSINO_ATENDIMENTO_DISCENTE) {
            return $this->tarefa->componente_curricular;
        }

        if($this->type == self::TYPE_ENSINO_AULA) {
            return $this->tarefa->componente_curricular;
        }

        if($this->type == self::TYPE_ENSINO_COORDENACAO_REGENCIA) {
            return $this->tarefa->componente_curricular;
        }

        if($this->type == self::TYPE_ENSINO_MEMBRO_DOCENTE) {
            return $this->tarefa->nucleo;
        }

        if($this->type == self::TYPE_ENSINO_ORIENTACAO) {
            return $this->tarefa->atividade;
        }

        if($this->type == self::TYPE_ENSINO_OUTROS) {
            return $this->tarefa->atividade;
        }

        if($this->type == self::TYPE_ENSINO_PARTICIPACAO) {
            return $this->tarefa->curso;
        }

        if($this->type == self::TYPE_ENSINO_PROJETO) {
            return $this->tarefa->componente_curricular;
        }

        if($this->type == self::TYPE_ENSINO_SUPERVISAO) {
            return $this->tarefa->atividade;
        }
        // - - - - - - - - - - 

        // Return Pesquisa Models
        // - - - - - - - - - - 
        if($this->type == self::TYPE_PESQUISA_COORDENACAO) {
            return $this->tarefa->titulo_projeto;
        }

        if($this->type == self::TYPE_PESQUISA_LIDERANCA) {
            return $this->tarefa->grupo_pesquisa;
        }

        if($this->type == self::TYPE_PESQUISA_ORIENTACAO) {
            return $this->tarefa->titulo_projeto;
        }

        if($this->type == self::TYPE_PESQUISA_OUTROS) {
            return $this->tarefa->atividade;
        }
        // - - - - - - - - - - 

        // Return Extensao Models
        // - - - - - - - - - - 
        if($this->type == self::TYPE_EXTENSAO_COORDENACAO) {
            return $this->tarefa->titulo_projeto;
        }

        if($this->type == self::TYPE_EXTENSAO_ORIENTACAO) {
            return $this->tarefa->titulo_projeto;
        }

        if($this->type == self::TYPE_EXTENSAO_OUTROS) {
            return $this->tarefa->atividade;
        }
        // - - - - - - - - - - 

        // Return Gestao Models
        // - - - - - - - - - - 
        if($this->type == self::TYPE_GESTAO_COORDENACAO_LABORATORIOS_DIDATICOS) {
            return $this->tarefa->nome;
        }

        if($this->type == self::TYPE_GESTAO_COORDENACAO_PROGRAMA_INSTITUCIONAL) {
            return $this->tarefa->nome;
        }

        if($this->type == self::TYPE_GESTAO_MEMBRO_CAMARAS) {
            return $this->tarefa->nome;
        }

        if($this->type == self::TYPE_GESTAO_MEMBRO_COMISSAO) {
            return $this->tarefa->nome;
        }

        if($this->type == self::TYPE_GESTAO_MEMBRO_CONSELHO) {
            return $this->tarefa->nome;
        }

        if($this->type == self::TYPE_GESTAO_MEMBRO_TITULAR_CONSELHO) {
            return $this->tarefa->nome;
        }

        if($this->type == self::TYPE_GESTAO_OUTROS) {
            return $this->tarefa->atividade;
        }

        if($this->type == self::TYPE_GESTAO_REPRESENTANTE_UNIDADE_EDUCACAO) {
            return $this->tarefa->nome;
        }
        // - - - - - - - - - - 
    }

    /**
     * @return string
     */
    public function getWeekdayAsText() {
        return $this->listWeekDays($this->weekday);
    }

    /**
     * @return string
     */
    public function intervalTime($format = 'H:i:s') {

        $startTime = DateTime::createFromFormat('H:i:s', $this->start_time);
        
        $endTime = DateTime::createFromFormat('H:i:s', $this->end_time);

        $interval = $startTime->diff($endTime);

        $dateTime = new DateTime('00:00');
        $dateTime->add($interval); // Popular com Interval

        return $dateTime->format($format);
    }

    public function formatStartTime() {
        return Carbon::createFromFormat('H:i:s', $this->start_time)->format('H:i');
    }

    public function formatEndTime() {
        return Carbon::createFromFormat('H:i:s', $this->end_time)->format('H:i');
    }

    /**
     * STATIC METHODS
     */

    public static function listWeekDaysTable($value = null) {
        $values = [
            self::WEEK_HOUR             => "HORÁRIO",
            self::WEEK_DAY_MONDAY       => "SEGUNDA-FEIRA",
            self::WEEK_DAY_TUESDAY      => "TERÇA-FEIRA",
            self::WEEK_DAY_WEDNESDAY    => "QUARTA-FEIRA",
            self::WEEK_DAY_THURSDAY     => "QUINTA-FEIRA",
            self::WEEK_DAY_FRIDAY       => "SEXTA-FEIRA",
            self::WEEK_DAY_SATURDAY     => "SÁBADO",
        ];

        return $value != null ? $values[$value] : $values;
    }

    public static function listWeekDays($value = null) {
        $values = [
            // self::WEEK_DAY_SUNDAY       => "DOMINGO",
            self::WEEK_DAY_MONDAY       => "SEGUNDA-FEIRA",
            self::WEEK_DAY_TUESDAY      => "TERÇA-FEIRA",
            self::WEEK_DAY_WEDNESDAY    => "QUARTA-FEIRA",
            self::WEEK_DAY_THURSDAY     => "QUINTA-FEIRA",
            self::WEEK_DAY_FRIDAY       => "SEXTA-FEIRA",
            self::WEEK_DAY_SATURDAY     => "SÁBADO",
        ];

        return $value != null ? $values[$value] : $values;
    }

    public static function listTaskTypes($value = null) {
        $values = [
            
            self::TYPE_ENSINO_AULA => '',
            self::TYPE_ENSINO_COORDENACAO_REGENCIA => '',
            self::TYPE_ENSINO_ORIENTACAO => '',
            self::TYPE_ENSINO_SUPERVISAO => '',
            self::TYPE_ENSINO_ATENDIMENTO_DISCENTE => '',
            self::TYPE_ENSINO_PROJETO => '',
            self::TYPE_ENSINO_PARTICIPACAO => '',
            self::TYPE_ENSINO_MEMBRO_DOCENTE => '',
            self::TYPE_ENSINO_OUTROS => '',

            self::TYPE_PESQUISA_COORDENACAO => '',
            self::TYPE_PESQUISA_ORIENTACAO => '',
            self::TYPE_PESQUISA_LIDERANCA => '',
            self::TYPE_PESQUISA_OUTROS => '',

            self::TYPE_EXTENSAO_COORDENACAO => '',
            self::TYPE_EXTENSAO_ORIENTACAO => '',
            self::TYPE_EXTENSAO_OUTROS => '',

            self::TYPE_GESTAO_COORDENACAO_LABORATORIOS_DIDATICOS => '',
            self::TYPE_GESTAO_MEMBRO_CONSELHO => '',
            self::TYPE_GESTAO_COORDENACAO_PROGRAMA_INSTITUCIONAL => '',
            self::TYPE_GESTAO_MEMBRO_TITULAR_CONSELHO => '',
            self::TYPE_GESTAO_MEMBRO_CAMARAS => '',
            self::TYPE_GESTAO_REPRESENTANTE_UNIDADE_EDUCACAO => '',
            self::TYPE_GESTAO_MEMBRO_COMISSAO => '',
            self::TYPE_GESTAO_OUTROS => '',
        ];

        return $value != null ? $values[$value] : $values;
    }

    /** 
     * @param $floatValue 
     * @return string|time
    */
    public static function float_to_date_interval($float_value)
    {
        // Calcula as horas
        $horas = floor($float_value);

        // Calcula os minutos
        $minutos_decimal = ($float_value - $horas) * 60;
        $minutos = floor($minutos_decimal);

        // Calcula os segundos
        $segundos = round(($minutos_decimal - $minutos) * 60);
        
        /** @var DateInterval */
        $date_interval = new DateInterval("PT{$horas}H{$minutos}M{$segundos}S");

        return $date_interval;
    }

    /** 
     * @param $floatValue 
     * @return string|time
    */
    public static function convertFloatToHour($float_value)
    {
        // Calcula as horas
        $horas = floor($float_value);

        // Calcula os minutos
        $minutos_decimal = ($float_value - $horas) * 60;
        $minutos = floor($minutos_decimal);

        // Calcula os segundos
        $segundos = round(($minutos_decimal - $minutos) * 60);
        
        /** @var DateInterval */
        $date_interval = new DateInterval("PT{$horas}H{$minutos}M{$segundos}S");

        return $date_interval;

        // /** @var DateTime */
        // $date_time = new DateTime('00:00');
        // $date_time->add($date_interval);

        // dd(
        //     $date_time->format('H:i:s')
        // );

        // return $date_time->format('H:i:s');
    }

    /**
     * Recebe e formata uma string para formato H:i
     * Pode ser recebido uma hora completa H:i:s ou uma hora padrão H:i
     * @return string|date
     */
    public static function traitHour(string|null $hour = "")
    {
        if(!empty($hour)) {
            $hour_splited = explode(':', $hour );

            $hour_h_i = "{$hour_splited[0]}:$hour_splited[1]";

            return $hour_h_i;
        }

        return $hour;
    }

    /** 
     * @param $taskTimes
     * @return DateTime
     */
    public static function sumIntervalTimes(Collection $taskTimes) {

        $sumDateTime = new DateTime("00:00:00");

        foreach($taskTimes as $taskTime) {

            $split_time = explode(":", $taskTime->intervalTime());
            
            $hours = $split_time[0];
            $minutes = $split_time[1];
            $seconds = $split_time[2];

            $sumDateTime->modify("+{$hours} hours +{$minutes} minutes +{$seconds} seconds");
        }

        return $sumDateTime;
    }

    /** 
     * @param $taskTimes
     * @return DateTime
     */
    public static function sum_interval_times(Collection $task_times)
    {
        [$total_hours, $total_minutes] = [0, 0];
        foreach($task_times as $task_time) {

            $date_time_start = new DateTime($task_time->start_time);
            $date_time_end   = new DateTime($task_time->end_time);

            /** @return DateInternal|null */
            $diff = $date_time_end->diff($date_time_start);

            $total_hours   = $total_hours + $diff->h;
            $total_minutes = $total_minutes + $diff->m;
        }

        $date_interval = new DateInterval("PT{$total_hours}H{$total_minutes}M");

        return $date_interval;
    }

    /** 
     * @param DateTime $dateTimeX
     * @param DateTime $dateTimeY
     * @return DateTime
     */
    public static function sumDateTimes(DateTime $dateTimeX, DateTime $dateTimeY)
    {
        $time_x = $dateTimeX->format("H:i:s");
        $time_y = $dateTimeY->format("H:i:s");

        $newDateTime = new DateTime($time_x);

        $split_time = explode(":", $time_y);
        
        $hours = $split_time[0];
        $minutes = $split_time[1];
        $seconds = $split_time[2];

        $newDateTime->modify("+{$hours} hours +{$minutes} minutes +{$seconds} seconds");
        
        return $newDateTime;
    }

    /** @return mixed */
    public static function tarefaByStatic($type, $tarefa_id)
    {
        // Return Ensino Models
        // - - - - - - - - - - 
        if($type == self::TYPE_ENSINO_ATENDIMENTO_DISCENTE) {
            return EnsinoAtendimentoDiscente::find($tarefa_id);
        }

        if($type == self::TYPE_ENSINO_AULA) {
            return EnsinoAula::find($tarefa_id);
        }

        if($type == self::TYPE_ENSINO_COORDENACAO_REGENCIA) {
            return EnsinoCoordenacaoRegencia::find($tarefa_id);
        }

        if($type == self::TYPE_ENSINO_MEMBRO_DOCENTE) {
            return EnsinoMembroDocente::find($tarefa_id);
        }

        if($type == self::TYPE_ENSINO_ORIENTACAO) {
            return EnsinoOrientacao::find($tarefa_id);
        }

        if($type == self::TYPE_ENSINO_OUTROS) {
            return EnsinoOutros::find($tarefa_id);
        }

        if($type == self::TYPE_ENSINO_PARTICIPACAO) {
            return EnsinoParticipacao::find($tarefa_id);
        }

        if($type == self::TYPE_ENSINO_PROJETO) {
            return EnsinoProjeto::find($tarefa_id);
        }

        if($type == self::TYPE_ENSINO_SUPERVISAO) {
            return EnsinoSupervisao::find($tarefa_id);
        }
        // - - - - - - - - - - 

        // Return Pesquisa Models
        // - - - - - - - - - - 
        if($type == self::TYPE_PESQUISA_COORDENACAO) {
            return PesquisaCoordenacao::find($tarefa_id);
        }

        if($type == self::TYPE_PESQUISA_LIDERANCA) {
            return PesquisaLideranca::find($tarefa_id);
        }

        if($type == self::TYPE_PESQUISA_ORIENTACAO) {
            return PesquisaOrientacao::find($tarefa_id);
        }

        if($type == self::TYPE_PESQUISA_OUTROS) {
            return PesquisaOutros::find($tarefa_id);
        }
        // - - - - - - - - - - 

        // Return Extensao Models
        // - - - - - - - - - - 
        if($type == self::TYPE_EXTENSAO_COORDENACAO) {
            return ExtensaoCoordenacao::find($tarefa_id);
        }

        if($type == self::TYPE_EXTENSAO_ORIENTACAO) {
            return ExtensaoOrientacao::find($tarefa_id);
        }

        if($type == self::TYPE_EXTENSAO_OUTROS) {
            return ExtensaoOutros::find($tarefa_id);
        }
        // - - - - - - - - - - 

        // Return Gestao Models
        // - - - - - - - - - - 
        if($type == self::TYPE_GESTAO_COORDENACAO_LABORATORIOS_DIDATICOS) {
            return GestaoCoordenacaoLaboratoriosDidaticos::find($tarefa_id);
        }

        if($type == self::TYPE_GESTAO_COORDENACAO_PROGRAMA_INSTITUCIONAL) {
            return GestaoCoordenacaoProgramaInstitucional::find($tarefa_id);
        }

        if($type == self::TYPE_GESTAO_MEMBRO_CAMARAS) {
            return GestaoMembroCamaras::find($tarefa_id);
        }

        if($type == self::TYPE_GESTAO_MEMBRO_COMISSAO) {
            return GestaoMembroComissao::find($tarefa_id);
        }

        if($type == self::TYPE_GESTAO_MEMBRO_CONSELHO) {
            return GestaoMembroConselho::find($tarefa_id);
        }

        if($type == self::TYPE_GESTAO_MEMBRO_TITULAR_CONSELHO) {
            return GestaoMembroTitularConselho::find($tarefa_id);
        }

        if($type == self::TYPE_GESTAO_OUTROS) {
            return GestaoOutros::find($tarefa_id);
        }

        if($type == self::TYPE_GESTAO_REPRESENTANTE_UNIDADE_EDUCACAO) {
            return GestaoRepresentanteUnidadeEducacao::find($tarefa_id);
        }
        // - - - - - - - - - - 
    }
}
