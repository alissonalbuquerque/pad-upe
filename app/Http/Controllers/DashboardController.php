<?php

namespace App\Http\Controllers;

use App\Models\AvaliadorPad;
use App\Models\Pad;
use App\Models\Tabelas\Constants;
use App\Models\UserPad;
use App\Models\UserType;
use App\Models\Util\Menu;
use App\Models\Util\MenuItemsAdmin;
use App\Models\Util\MenuItemsTeacher;
use App\Models\Util\Status;
use App\Queries\UnidadeQuery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {   
        $user = Auth::user();

        if ($user->isTypeAdmin()) {
            return view('dashboard', ['menu' => Menu::HOME]);
        }

        if ($user->isTypeTeacher()) {
            
            $userPads = UserPad::whereUserId($user->id)->whereStatus(Status::ATIVO)->get();

            return view('dashboard', ['userPads' => $userPads, 'menu' => Menu::HOME]);
        }

        if ($user->isTypeDirector()) {
            return view('dashboard', ['PADs' => Pad::all(), 'menu' => Menu::HOME]);
        }

        if ($user->isTypeCoordinator()) {
            return view('dashboard', ['PADs' => Pad::all(), 'menu' => Menu::HOME]);
        }

        if ($user->isTypeEvaluator()) {
            $userPads =
                AvaliadorPad::where('user_id', '=', $user->id)
                ->join('pad', 'avaliador_pad.pad_id', '=', 'pad.id')
                ->where('pad.status', '=', Status::ATIVO)
                ->get();

            return view('dashboard', ['userPads' => $userPads, 'menu' => Menu::HOME]);
        }

        //return redirect()->route('login');
    }
}
