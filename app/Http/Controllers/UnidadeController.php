<?php

namespace App\Http\Controllers;

use App\Models\Unidade;
use App\Models\Util\MenuItemsAdmin;
use App\Queries\UnidadeQuery;
use Illuminate\Http\Request;

class UnidadeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('unidade.index', [
            'unidades' => Unidade::all(),
            'index_menu' => MenuItemsAdmin::UNIDADES
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('unidade.create', [
            'unidades' => Unidade::all(),
            'index_menu' => MenuItemsAdmin::UNIDADES
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
        $model = new Unidade();
        $validator = Unidade::validator($request->all());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $model->fill($request->all());
        $model->save();
        return redirect()->route('unidade_index')->with('success', 'Salvo com sucesso!');
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
        $model = Unidade::find($id);
        return view('unidade.update', [
            'unidade' => $model,
            'index_menu' => MenuItemsAdmin::UNIDADES
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
        $model = Unidade::findOrFail($id);
        $validator = Unidade::validator($request->all());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $model->fill($request->all());
        $model->save();
        return redirect()->route('unidade_index')->with('success', 'Atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Unidade::find($id);
        $model->delete();
        return redirect()->route('unidade_index')->with('success', 'Excluído com sucesso!');
    }

    /**
     * @return array
     */
    public function getAll()
    {
        return UnidadeQuery::all();
    }
}
