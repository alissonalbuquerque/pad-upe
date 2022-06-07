<?php

namespace App\Http\Controllers\Dimensao;

use App\Http\Controllers\Controller;
use App\Models\Curso;
use App\Models\Tabelas\Ensino\EnsinoAula;
use App\Models\Util\PadTables;
use App\Queries\CursoQuery;
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

        $cursos = (new CursoQuery())->getQuery()->get();
        $niveis = EnsinoAula::listNivel();
        $modalidades = EnsinoAula::listModalidade();
        $ensinoAulas = EnsinoAula::all();
        $divs = PadTables::tablesEnsino();

        return view('pad.dimensao.ensino', [
            'pad_id' => 1,
            'cursos' => $cursos,
            'niveis' => $niveis,
            'ensinoAulas' => $ensinoAulas,
            'modalidades' => $modalidades,
            'divs' => $divs,
            'index_menu' => self::MENU_PAD,
        ]);
    }
}
