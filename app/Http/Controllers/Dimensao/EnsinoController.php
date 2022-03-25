<?php

namespace App\Http\Controllers\Dimensao;

use App\Http\Controllers\Controller;
use App\Models\Curso;
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
        return view('pad.dimensao.ensino', [
            'index_menu' => self::MENU_PAD,
            'cursos' => $cursos,
        ]);
    }

}
