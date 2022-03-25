<?php

namespace App\Http\Controllers\Dimensao;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GestaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('pad.dimensao.gestao');
    }
}
