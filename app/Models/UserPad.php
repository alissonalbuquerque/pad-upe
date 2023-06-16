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

//remover tabela de user_pad

class UserPad extends Model
{
    use HasFactory;

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

    /*  
    * @RELATIONS (relações entre tarefas)
    */
    public function ensinoAulas() {
        return $this->hasMany(EnsinoAula::class, 'user_pad_id', 'id');
    }
}
