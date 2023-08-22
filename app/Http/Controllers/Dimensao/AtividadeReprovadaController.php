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

        //Avaliacoes (Ensino) Collections

        $avaliacoesEnsinoAtendimentoDiscentes = Avaliacao::getAvaliacoesDisapproved(EnsinoAtendimentoDiscente::class, $user_pad_id);
        
        $avaliacoesEnsinoCoordenacaoRegencias = Avaliacao::getAvaliacoesDisapproved(EnsinoCoordenacaoRegencia::class, $user_pad_id);

        $avaliacoesEnsinoOrientacoes = Avaliacao::getAvaliacoesDisapproved(EnsinoOrientacao::class, $user_pad_id);

        $avaliacoesEnsinoParticipacoes = Avaliacao::getAvaliacoesDisapproved(EnsinoParticipacao::class, $user_pad_id);

        $avaliacoesEnsinoSupervisoes = Avaliacao::getAvaliacoesDisapproved(EnsinoSupervisao::class, $user_pad_id);
        
        $avaliacoesEnsinoAulas = Avaliacao::getAvaliacoesDisapproved(EnsinoAula::class, $user_pad_id);
        
        $avaliacoesEnsinoMembroDocentes = Avaliacao::getAvaliacoesDisapproved(EnsinoMembroDocente::class, $user_pad_id);

        $avaliacoesEnsinoOutros = Avaliacao::getAvaliacoesDisapproved(EnsinoOutros::class, $user_pad_id);

        $avaliacoesEnsinoProjetos = Avaliacao::getAvaliacoesDisapproved(EnsinoProjeto::class, $user_pad_id);

        //Avaliacoes (Pesquisa) Collections

        $avaliacoesPesquisaCoordenacoes = Avaliacao::getAvaliacoesDisapproved(PesquisaCoordenacao::class, $user_pad_id);
        $avaliacoesPesquisaLiderancas = Avaliacao::getAvaliacoesDisapproved(PesquisaLideranca::class, $user_pad_id);
        $avaliacoesPesquisaOrientacoes = Avaliacao::getAvaliacoesDisapproved(PesquisaOrientacao::class, $user_pad_id);
        $avaliacoesPesquisaOutros = Avaliacao::getAvaliacoesDisapproved(PesquisaOutros::class, $user_pad_id);

        //Avaliacoes (Extensão) Collections

        $avaliacoesExtensaoCoordenacoes = Avaliacao::getAvaliacoesDisapproved(ExtensaoCoordenacao::class, $user_pad_id);
        $avaliacoesExtensaoOrientacoes = Avaliacao::getAvaliacoesDisapproved(ExtensaoOrientacao::class, $user_pad_id);
        $avaliacoesExtensaoOutros = Avaliacao::getAvaliacoesDisapproved(ExtensaoOutros::class, $user_pad_id);

        //Avaliacoes (Gestão) Collections

        $avaliacoesGestaoCoordenacaoLaboratoriosDidaticos = Avaliacao::getAvaliacoesDisapproved(GestaoCoordenacaoLaboratoriosDidaticos::class, $user_pad_id);
        $avaliacoesGestaoMembroComissoes = Avaliacao::getAvaliacoesDisapproved(GestaoMembroComissao::class, $user_pad_id);
        $avaliacoesGestaoOutros = Avaliacao::getAvaliacoesDisapproved(GestaoOutros::class, $user_pad_id);
        $avaliacoesGestaoCoordenacaoProgramaInstitucionais = Avaliacao::getAvaliacoesDisapproved(GestaoCoordenacaoProgramaInstitucional::class, $user_pad_id);
        $avaliacoesGestaoMembroConselhos = Avaliacao::getAvaliacoesDisapproved(GestaoMembroConselho::class, $user_pad_id);
        $avaliacoesGestaoRepresentanteUnidadeEducacoes = Avaliacao::getAvaliacoesDisapproved(GestaoRepresentanteUnidadeEducacao::class, $user_pad_id);
        $avaliacoesGestaoMembroCamaras = Avaliacao::getAvaliacoesDisapproved(GestaoMembroCamaras::class, $user_pad_id);
        $avaliacoesGestaoMembroTitularConselhos = Avaliacao::getAvaliacoesDisapproved(GestaoMembroTitularConselho::class, $user_pad_id);

        return view('pad/dimensao/atividades/reprovadas/index', [

            'menu' => MenuItemsTeacher::PAD,

            'avaliacoesEnsinoAtendimentoDiscentes' => $avaliacoesEnsinoAtendimentoDiscentes,
            'avaliacoesEnsinoCoordenacaoRegencias' => $avaliacoesEnsinoCoordenacaoRegencias,
            'avaliacoesEnsinoOrientacoes' => $avaliacoesEnsinoOrientacoes,
            'avaliacoesEnsinoParticipacoes' => $avaliacoesEnsinoParticipacoes,
            'avaliacoesEnsinoSupervisoes' => $avaliacoesEnsinoSupervisoes,
            'avaliacoesEnsinoAulas' => $avaliacoesEnsinoAulas,
            'avaliacoesEnsinoMembroDocentes' => $avaliacoesEnsinoMembroDocentes,
            'avaliacoesEnsinoOutros' => $avaliacoesEnsinoOutros,
            'avaliacoesEnsinoProjetos' => $avaliacoesEnsinoProjetos,
            'avaliacoesEnsinoOutros' => $avaliacoesEnsinoOutros,

            'avaliacoesPesquisaCoordenacoes' => $avaliacoesPesquisaCoordenacoes,
            'avaliacoesPesquisaLiderancas' => $avaliacoesPesquisaLiderancas,
            'avaliacoesPesquisaOrientacoes' => $avaliacoesPesquisaOrientacoes,
            'avaliacoesPesquisaOutros' => $avaliacoesPesquisaOutros,

            'avaliacoesExtensaoCoordenacoes' => $avaliacoesExtensaoCoordenacoes,
            'avaliacoesExtensaoOrientacoes' => $avaliacoesExtensaoOrientacoes,
            'avaliacoesExtensaoOutros' => $avaliacoesExtensaoOutros,

            'avaliacoesGestaoCoordenacaoLaboratoriosDidaticos' => $avaliacoesGestaoCoordenacaoLaboratoriosDidaticos,
            'avaliacoesGestaoMembroComissoes' => $avaliacoesGestaoMembroComissoes,
            'avaliacoesGestaoOutros' => $avaliacoesGestaoOutros,
            'avaliacoesGestaoCoordenacaoProgramaInstitucionais' => $avaliacoesGestaoCoordenacaoProgramaInstitucionais,
            'avaliacoesGestaoMembroConselhos' => $avaliacoesGestaoMembroConselhos,
            'avaliacoesGestaoRepresentanteUnidadeEducacoes' => $avaliacoesGestaoRepresentanteUnidadeEducacoes,
            'avaliacoesGestaoMembroCamaras' => $avaliacoesGestaoMembroCamaras,
            'avaliacoesGestaoMembroTitularConselhos' => $avaliacoesGestaoMembroTitularConselhos,
        ]);
    }
}
