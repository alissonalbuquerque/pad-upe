<?php

namespace App\Http\Controllers;

use App\Models\Campus;
use App\Models\Unidade;
use App\Queries\CampusQuery;
use Illuminate\Http\Request;
use App\Models\Util\MenuItemsAdmin;

class CampusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $campus = Campus::all();
        return view('campus.index', [
            'index_menu' => MenuItemsAdmin::CAMPUS,
            'campus' =>  $campus
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('campus.create', [
            'unidades' => Unidade::all(),
            'index_menu' => MenuItemsAdmin::CAMPUS,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model = new Campus();
        $model->name = $request->name;
        $model->unidade_id = $request->unidade_id;
        $model->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function findByUnidade(int $unidade_id)
    {
        return CampusQuery::whereUnidadeId($unidade_id)->orderBy('name')->get();
    }
}
