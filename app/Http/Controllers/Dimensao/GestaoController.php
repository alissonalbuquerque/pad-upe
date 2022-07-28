<?php

namespace App\Http\Controllers\Dimensao;

use App\Http\Controllers\Controller;
use App\Models\Util\MenuItemsTeacher;
use App\Models\Util\PadTables;
use Illuminate\Http\Request;

class GestaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user_pad_id) {

        $divs = PadTables::tablesGestao($user_pad_id);

        return view('pad.dimensao.gestao', [
            'divs' => $divs,
            'index_menu' => MenuItemsTeacher::PAD,
        ]);

    }
}
