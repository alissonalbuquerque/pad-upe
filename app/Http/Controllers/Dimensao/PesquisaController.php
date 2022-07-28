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
    public function index($user_pad_id) {

        $divs = PadTables::tablesPesquisa($user_pad_id);

        return view('pad.dimensao.pesquisa', [
            'divs' => $divs,
            'index_menu' => MenuItemsTeacher::PAD,
        ]);

    }
}
