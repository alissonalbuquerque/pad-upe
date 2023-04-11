<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Curso;
use App\Models\Util\MenuItemsAvaliador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AvaliadorController extends Controller
{
    /**
     * Show last PAD.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // $professores = User::where('type', '=', User::->isTypeTeacher())->get();
        return view('pad.avaliacao.index', [
            'index_menu' => MenuItemsAvaliador::PADs,
            'professores' =>  null
        ]);
    }

    public function avaliar()
    {
        // $professores = User::where('type', '=', User::->isTypeTeacher())->get();
        return view('pad.avaliacao.dimensao.ensino', [
            'index_menu' => MenuItemsAvaliador::PADs,
            'user_pad_id' =>  1
        ]);
    }

    /**
     * @param integer $id
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {
    }

    public function anexo()
    {
        return view('pad.anexo', ['index_menu' => 1]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  integer  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }


    public function delete($id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
