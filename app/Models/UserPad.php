<?php

namespace App\Models;

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
use App\Queries\UserPadQuery;
use App\Models\Pad;
use App\Models\Util\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTime;

//remover tabela de user_pad

class UserPad extends Model
{
    const STATUS_DEFAULT = 0;
    const STATUS_ATIVO   = 1;
    const STATUS_INATIVO = 2;

    /** @var string */
    protected $table = 'user_pad';

    /** @var array */
    protected $fillable = ['id', 'user_id', 'pad_id', 'status'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function pad() {
        return $this->belongsTo(Pad::class);
    }

    public function statusAsText() {
        return Status::listStatus($this->status);
    }

    public static function initQuery() {
        return new UserPadQuery(get_called_class());
    }

    /**
     * @return string
     * */
    public function status_as_text() {
        return self::list_status($this->status);
    }

    /**
     * @return string|array
     */
    public static function list_status($value = null)
    {
        $values = [
            self::STATUS_DEFAULT        => 'ATIVO (EM LOTE)',
            self::STATUS_ATIVO          => 'ATIVO',
            self::STATUS_INATIVO        => 'INATIVO',
        ];

        return $value !== null ? $values[$value] : $values;
    }

    public static function rules() {
        return [

        ];
    }

    public static function messages() {
        return [

        ];
    }

    public function totalHoras()
    {
        $ensinoTotalHoras =
            EnsinoAtendimentoDiscente::whereUserPadId($this->id)->sum('ch_semanal')
            + EnsinoAula::whereUserPadId($this->id)->sum('ch_semanal')
            + EnsinoCoordenacaoRegencia::whereUserPadId($this->id)->sum('ch_semanal')
            + EnsinoMembroDocente::whereUserPadId($this->id)->sum('ch_semanal')
            + EnsinoOrientacao::whereUserPadId($this->id)->sum('ch_semanal')
            + EnsinoOutros::whereUserPadId($this->id)->sum('ch_semanal')
            + EnsinoParticipacao::whereUserPadId($this->id)->sum('ch_semanal')
            + EnsinoProjeto::whereUserPadId($this->id)->sum('ch_semanal')
            + EnsinoSupervisao::whereUserPadId($this->id)->sum('ch_semanal');

        $gestaoTotalHoras =
            GestaoCoordenacaoLaboratoriosDidaticos::whereUserPadId($this->id)->sum('ch_semanal')
            + GestaoCoordenacaoProgramaInstitucional::whereUserPadId($this->id)->sum('ch_semanal')
            + GestaoMembroCamaras::whereUserPadId($this->id)->sum('ch_semanal')
            + GestaoMembroComissao::whereUserPadId($this->id)->sum('ch_semanal')
            + GestaoMembroConselho::whereUserPadId($this->id)->sum('ch_semanal')
            + GestaoMembroTitularConselho::whereUserPadId($this->id)->sum('ch_semanal')
            + GestaoOutros::whereUserPadId($this->id)->sum('ch_semanal')
            + GestaoRepresentanteUnidadeEducacao::whereUserPadId($this->id)->sum('ch_semanal');

        $pesquisaTotalHoras =
            PesquisaCoordenacao::whereUserPadId($this->id)->sum('ch_semanal')
            + PesquisaLideranca::whereUserPadId($this->id)->sum('ch_semanal')
            + PesquisaOrientacao::whereUserPadId($this->id)->sum('ch_semanal')
            + PesquisaOutros::whereUserPadId($this->id)->sum('ch_semanal');

        $extensaoTotalHoras =
            ExtensaoCoordenacao::whereUserPadId($this->id)->sum('ch_semanal')
            + ExtensaoOrientacao::whereUserPadId($this->id)->sum('ch_semanal')
            + ExtensaoOutros::whereUserPadId($this->id)->sum('ch_semanal');

        $totalHoras = $ensinoTotalHoras + $gestaoTotalHoras + $pesquisaTotalHoras + $extensaoTotalHoras;

        return $totalHoras;
    }

    public function total_horas()
    {
        $date_interval = TaskTime::float_to_date_interval($this->totalHoras());

        [$hours, $minutes] = [$date_interval->format('%h'), $date_interval->format('%i')];

        $hours   = strlen($hours) < 2 ? str_pad($hours, 2, '0', STR_PAD_LEFT) : $hours;
        $minutes = strlen($minutes) < 2 ? str_pad($minutes, 2, '0', STR_PAD_LEFT) : $minutes;

        $date_format = "{$hours}:{$minutes}";

        return $date_format;
    }

    public function status_avaliacao_as_text() {
        
        return Avaliacao::avaliacao_by_user_pad();
        
    }

    /*
    * @RELATIONS (relações entre tarefas)
    */
    public function ensinoAtendimentoDiscentes() {
        return $this->hasMany(ensinoAtendimentoDiscente::class, 'user_pad_id', 'id');
    }

    public function ensinoAulas() {
        return $this->hasMany(EnsinoAula::class, 'user_pad_id', 'id');
    }

    public function ensinoCoordenacaoRegencias() {
        return $this->hasMany(EnsinoCoordenacaoRegencia::class, 'user_pad_id', 'id');
    }

    public function ensinoMembroDocentes() {
        return $this->hasMany(EnsinoMembroDocente::class, 'user_pad_id', 'id');
    }

    public function ensinoOrientacoes() {
        return $this->hasMany(EnsinoOrientacao::class, 'user_pad_id', 'id');
    }

    public function ensinoOutros() {
        return $this->hasMany(EnsinoOutros::class, 'user_pad_id', 'id');
    }

    public function ensinoParticipacoes() {
        return $this->hasMany(EnsinoParticipacao::class, 'user_pad_id', 'id');
    }

    public function ensinoProjetos() {
        return $this->hasMany(EnsinoProjeto::class, 'user_pad_id', 'id');
    }

    public function ensinoSupervisoes() {
        return $this->hasMany(EnsinoSupervisao::class, 'user_pad_id', 'id');
    }


    public function extensaoCoordenacoes() {
        return $this->hasMany(ExtensaoCoordenacao::class, 'user_pad_id', 'id');
    }

    public function extensaoOrientacoes() {
        return $this->hasMany(ExtensaoOrientacao::class, 'user_pad_id', 'id');
    }

    public function extensaoOutros() {
        return $this->hasMany(ExtensaoOutros::class, 'user_pad_id', 'id');
    }


    public function gestaoCoordenacaoLaboratoriosDidaticos() {
        return $this->hasMany(GestaoCoordenacaoLaboratoriosDidaticos::class, 'user_pad_id', 'id');
    }

    public function gestaoCoordenacaoProgramasInstitucionais() {
        return $this->hasMany(GestaoCoordenacaoProgramaInstitucional::class, 'user_pad_id', 'id');
    }

    public function gestaoMembroCamaras() {
        return $this->hasMany(GestaoMembroCamaras::class, 'user_pad_id', 'id');
    }

    public function gestaoMembroComissoes() {
        return $this->hasMany(GestaoMembroComissao::class, 'user_pad_id', 'id');
    }

    public function gestaoMembroConselhos() {
        return $this->hasMany(GestaoMembroConselho::class, 'user_pad_id', 'id');
    }

    public function gestaoMembroTitularConselhos() {
        return $this->hasMany(GestaoMembroTitularConselho::class, 'user_pad_id', 'id');
    }

    public function gestaoOutros() {
        return $this->hasMany(GestaoOutros::class, 'user_pad_id', 'id');
    }

    public function gestaoRepresentanteUnidadeEducacoes() {
        return $this->hasMany(GestaoRepresentanteUnidadeEducacao::class, 'user_pad_id', 'id');
    }


    public function pesquisaCoordenacoes() {
        return $this->hasMany(PesquisaCoordenacao::class, 'user_pad_id', 'id');
    }

    public function pesquisaLiderancas() {
        return $this->hasMany(PesquisaLideranca::class, 'user_pad_id', 'id');
    }

    public function pesquisaOrientacoes() {
        return $this->hasMany(PesquisaOrientacao::class, 'user_pad_id', 'id');
    }

    public function pesquisaOutros() {
        return $this->hasMany(PesquisaOutros::class, 'user_pad_id', 'id');
    }
}
