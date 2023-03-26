<?php

namespace App\Http\Controllers;

use App\Models\Util\Menu;
use Illuminate\Http\Request;

class PadAvaliadorController extends Controller
{
    public function index()
    {
        $menu = Menu::PADS;
        // filtrar apenas pads onde o usuário é avaliador
        // $userPads = UserPad::whereUserId(Auth::user()->id)->get();
    }
}
