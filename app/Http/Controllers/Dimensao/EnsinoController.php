<?php

namespace App\Http\Controllers\Dimensao;

use App\Http\Controllers\Controller;
use App\Models\Tabelas\Constants;
use App\Models\Tabelas\Ensino\EnsinoAula;
use App\Models\Util\MenuItemsTeacher;
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
    public function index($user_pad_id, $form_selected = null) {
        
        $niveis = Constants::listNivel();
        $modalidades = Constants::listModalidade();
        $orientacoes = Constants::listOrientacao();
        $funcoes_projeto = Constants::listFuncaoProjeto();
        $funcoes_ensino = Constants::listFuncaoEnsino();
        $naturezas = Constants::listNatureza();

        $divs = PadTables::tablesEnsino();

        $ensinoAulas = 
            EnsinoAula::initQuery()
                ->whereUserPad($user_pad_id)
                ->orderBy('cod_atividade')
                ->get();

        return view('pad.dimensao.ensino', [
            'user_pad_id' => $user_pad_id,
            'form_selected' => $form_selected,
            
            'niveis' => $niveis,
            'naturezas' => $naturezas,
            'categorias' => $orientacoes,
            'modalidades' => $modalidades,
            'funcoes_ensino' => $funcoes_ensino,
            'funcoes_projeto' => $funcoes_projeto,

            'divs' => $divs,
            'index_menu' => MenuItemsTeacher::PAD,

            'ensinoAulas' => $ensinoAulas,
        ]);
    }
}
