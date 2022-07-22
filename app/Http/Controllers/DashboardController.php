<?php

namespace App\Http\Controllers;

use App\Models\PAD;
use App\Models\Tabelas\Constants;
use App\Models\UserPad;
use App\Models\Util\MenuItemsAdmin;
use App\Models\Util\MenuItemsTeacher;
use App\Models\Util\Status;
use App\Queries\UnidadeQuery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function index() {

        $user = Auth::user();

        if($user->isTypeAdmin())
        {
            return view('dashboard',['menu_index' => MenuItemsAdmin::HOME]);
        }

        if($user->isTypeTeacher())
        {   
            $userPads = 
                UserPad::initQuery()
                    ->whereUser($user->id)
                    ->wherePadStatus(Status::ATIVO)
                    ->get();

            return view('dashboard', ['userPads' => $userPads, 'menu_index'=> MenuItemsTeacher::HOME]);
        }
        
        if($user->isTypeDirector())
        {
            return view('dashboard', ['PADs' => PAD::all(), 'menu_index'=> 0]);
        }

        if($user->isTypeCoordinator())
        {
            return view('dashboard', ['PADs' => PAD::all(), 'menu_index'=> 0]);
        } 

        //return redirect()->route('login');
    }
}
