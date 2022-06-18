<?php

namespace App\Http\Controllers\Dimensao;

use App\Http\Controllers\Controller;
use App\Models\Tabelas\Constants;
use App\Models\Util\PadTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsinoController extends Controller
{   

    const MENU_HOME = 1;
    const MENU_PAD = 2;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $user = Auth::user();
        $niveis = Constants::listNivel();
        $modalidades = Constants::listModalidade();
        $orientacoes = Constants::listOrientacao();
        $funcoes_projeto = Constants::listFuncao();
        $funcoes_ensino = Constants::listFuncao();
        $naturezas = Constants::listNatureza();
        

        $divs = PadTables::tablesEnsino();

        return view('pad.dimensao.ensino', [
            'pad_id' => 1,
            'niveis' => $niveis,
            'modalidades' => $modalidades,
            'categorias' => $orientacoes,
            'funcoes_ensino' =>  array_diff($funcoes_ensino, [Constants::listFuncao(Constants::FUNCAO_COLABORADOR)]),
            'funcoes_projeto' => array_diff($funcoes_projeto, [Constants::listFuncao(Constants::FUNCAO_MEMBRO)]),
            'naturezas' => $naturezas,
            'divs' => $divs,
            'index_menu' => self::MENU_PAD,
        ]);
    }
}
