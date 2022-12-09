<?php

namespace App\Http\Controllers;

use App\Models\Campus;
use App\Models\Unidade;
use App\Models\Util\Menu;
use App\Queries\CampusQuery;
use Illuminate\Http\Request;
use App\Models\Util\MenuItemsAdmin;
use Illuminate\Log\Logger;


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
            'menu' => Menu::CAMPUS,
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
            'menu' => Menu::CAMPUS,
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
        $validator = Campus::validator($request->all());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $model->fill($request->all());
        $model->save();
        return redirect()->route('campus_index')->with('success', 'Salvo com sucesso!');
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
        $campus = Campus::findOrFail($id);
        return view('campus.update', [
            'unidades' => Unidade::all(),
            'menu' => Menu::CAMPUS,
            'campus' => $campus,
        ]);
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
        $model = Campus::findOrFail($id);
        $validator = Campus::validator($request->all());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $model->fill($request->all());
        $model->save();
        return redirect()->route('campus_index')->with('success', 'Atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Campus::find($id);
        $model->delete();
        return redirect()->route('campus_index')->with('success', 'Excluído com sucesso!');
    }

    public function findByUnidade(int $unidade_id)
    {
        return Campus::initQuery()->whereUnidadeId($unidade_id)->orderBy('name')->get();
    }
}
