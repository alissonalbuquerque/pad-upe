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
use App\Models\Util\Status;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pad extends Model
{
    use HasFactory;

    protected $table = 'pad';

    protected $fillable = ['id', 'nome', 'data_inicio', 'data_fim', 'status'];

    protected $dates = ['deleted_at'];

    public function statusAsString() {
        return Status::listStatus($this->status);
    }

    public function getDateInicio() {
        return Carbon::parse($this->data_inicio)->format('d/m/Y');
    }

    public function getDateFim() {
        return Carbon::parse($this->data_fim)->format('d/m/Y');
    }

    public function getTotalHoras()
    {
        $id = $this->id;
        
        return (

            EnsinoAtendimentoDiscente::whereUserPadId($id)->sum('ch_semanal')
            + EnsinoAula::whereUserPadId($id)->sum('ch_semanal')
            + EnsinoCoordenacaoRegencia::whereUserPadId($id)->sum('ch_semanal')
            + EnsinoMembroDocente::whereUserPadId($id)->sum('ch_semanal')
            + EnsinoOrientacao::whereUserPadId($id)->sum('ch_semanal')
            + EnsinoOutros::whereUserPadId($id)->sum('ch_semanal')
            + EnsinoParticipacao::whereUserPadId($id)->sum('ch_semanal')
            + EnsinoProjeto::whereUserPadId($id)->sum('ch_semanal')
            + EnsinoSupervisao::whereUserPadId($id)->sum('ch_semanal')
            
            + GestaoCoordenacaoLaboratoriosDidaticos::whereUserPadId($id)->sum('ch_semanal')
            + GestaoCoordenacaoProgramaInstitucional::whereUserPadId($id)->sum('ch_semanal')
            + GestaoMembroCamaras::whereUserPadId($id)->sum('ch_semanal')
            + GestaoMembroComissao::whereUserPadId($id)->sum('ch_semanal')
            + GestaoMembroConselho::whereUserPadId($id)->sum('ch_semanal')
            + GestaoMembroTitularConselho::whereUserPadId($id)->sum('ch_semanal')
            + GestaoOutros::whereUserPadId($id)->sum('ch_semanal')
            + GestaoRepresentanteUnidadeEducacao::whereUserPadId($id)->sum('ch_semanal')
            
            + PesquisaCoordenacao::whereUserPadId($id)->sum('ch_semanal')
            + PesquisaLideranca::whereUserPadId($id)->sum('ch_semanal')
            + PesquisaOrientacao::whereUserPadId($id)->sum('ch_semanal')
            + PesquisaOutros::whereUserPadId($id)->sum('ch_semanal')

            + ExtensaoCoordenacao::whereUserPadId($id)->sum('ch_semanal')
            + ExtensaoOrientacao::whereUserPadId($id)->sum('ch_semanal')
            + ExtensaoOutros::whereUserPadId($id)->sum('ch_semanal')
        );
    }
}

