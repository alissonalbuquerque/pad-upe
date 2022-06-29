<?php

namespace App\Http\Controllers;

use App\Models\PAD;
use App\Queries\UnidadeQuery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function index() {

        $user = Auth::user();

        if($user->isTypeAdmin()){
            return view('dashboard', ['unidades' => UnidadeQuery::all(), 'unidade_index' => 1]);
        }elseif ($user->isTypeTeacher()) {
            return view('dashboard', ['PADs' => PAD::all(), 'menu_index'=> 0]);
        }elseif ($user->isTypeDirector()) {
            return view('dashboard', ['PADs' => PAD::all(), 'menu_index'=> 0]);
        }elseif ($user->isTypeCoordinator()) {
            return view('dashboard', ['PADs' => PAD::all(), 'menu_index'=> 0]);
        } 

        //return redirect()->route('login');
    }
}
