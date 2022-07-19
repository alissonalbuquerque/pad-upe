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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user_pad_id) {

        $divs = PadTables::tablesEnsino($user_pad_id);

        return view('pad.dimensao.ensino', [
            'divs' => $divs,
            'index_menu' => MenuItemsTeacher::PAD,
        ]);

    }
    
}
