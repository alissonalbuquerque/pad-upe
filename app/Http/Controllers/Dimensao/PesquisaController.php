<?php

namespace App\Http\Controllers\Dimensao;

use App\Http\Controllers\Controller;
use App\Models\Tabelas\Constants;
use App\Models\Tabelas\Pesquisa\PesquisaCoordenacao;
use App\Models\Tabelas\Pesquisa\PesquisaLideranca;
use App\Models\Tabelas\Pesquisa\PesquisaOrientacao;
use App\Models\Util\MenuItemsTeacher;
use App\Models\Util\PadTables;
use Illuminate\Http\Request;

class PesquisaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user_pad_id, $form_selected = null)
    {   
        $divs = PadTables::tablesPesquisa();
        $funcoesProjeto = Constants::listFuncaoProjeto();

        $pesquisasCoordenacao = 
            PesquisaCoordenacao::initQuery()
                ->whereUserPad($user_pad_id)
                ->orderBy('cod_atividade')
                ->get();
        
        $pesquisasLideranca = 
            PesquisaLideranca::initQuery()
                ->whereUserPad($user_pad_id)
                ->orderBy('cod_atividade')
                ->get();

        $pesquisasOrientacao = 
            PesquisaOrientacao::initQuery()
                ->whereUserPad($user_pad_id)
                ->orderBy('cod_atividade')
                ->get();

        return view('pad.dimensao.pesquisa', [
            'user_pad_id' => $user_pad_id, 
            'form_selected' => $form_selected,

            'pesquisasCoordenacao' => $pesquisasCoordenacao,
            'pesquisasLideranca' => $pesquisasLideranca,
            'pesquisasOrientacao' => $pesquisasOrientacao,

            'funcoesProjeto' => $funcoesProjeto,

            'divs' => $divs,
            'index_menu' => MenuItemsTeacher::PAD,
        ]);
    }
}
