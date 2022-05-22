<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Util\MenuItemsAdmin;
use Illuminate\Http\Request;

class CoordenadorController extends Controller
{

    public function index()
    {
        $coordenadores = User::where('type', '=', User::TYPE_COORDINATOR)->get();
        return view('coordenador.index', [
            'index_menu' => MenuItemsAdmin::COORDENADORES,
            'coordenadores' =>  $coordenadores
        ]);
    }

    /**
     * @param Request $request
     * @param mixed $id
     * 
     * @return Response
     */
    public function create()
    {
        return view('coordenador.create', [
            'index_menu' => MenuItemsAdmin::COORDENADORES,
        ]);
    }

    /**
     * Update the specified user.
     *
     * @param  Request  $request
     * @param  string  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }
}
