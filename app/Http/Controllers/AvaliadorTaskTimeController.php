<?php

namespace App\Http\Controllers;

use App\Models\Util\MenuItemsAvaliador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AvaliadorTaskTimeController extends Controller
{
    public function index()
    {
        $menu =  MenuItemsAvaliador::TASK_TIME;
        $user = Auth::user();
        // $userPads =
        //         AvaliadorPad::where('user_id', '=', $user->id)
        //         ->join('pad', 'avaliador_pad.pad_id', '=', 'pad.id')
        //         ->get();

        return view('avaliador-task-time.index', ['index_menu' => $menu]);
    }
}
