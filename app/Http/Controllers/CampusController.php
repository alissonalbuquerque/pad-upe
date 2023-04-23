<?php

namespace App\Http\Controllers;

use App\Models\Campus;
use App\Models\Unidade;
use App\Models\Util\Menu;
use App\Queries\CampusQuery;
use Illuminate\Http\Request;
use App\Models\Util\MenuItemsAdmin;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\Response;

class CampusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $campus = Campus::orderBy('unidade_id', 'asc')->get();
        
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
        return redirect()->route('campus_index')->with('success', 'Campus salvo com sucesso!');
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
        return redirect()->route('campus_index')->with('success', 'Campus atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $model = Campus::find($id);
        $model->delete();
        return redirect()->route('campus_index')->with('success', 'Campus excluído com sucesso!');
    }

    /**
     *
     * @params Illuminate\Http\Request\Request
     */
    public function actionSearch(Request $request)
    {   
        // QueryParams
        $q = $request->query('q'); 
        $id = $request->query('id');

        $campus = Campus::where([]);

        if($id) {
            $campus = $campus->whereId($id);
        }

        if($q) {
            $campus = $campus->where('name', 'like', '%'.$q.'%');
        }

        $campus = $campus->orderBy('unidade_id', 'asc')->get();

        $array = 
            $campus->map(function($campus, $key)
            {
                return [
                    'id' => $campus->id,
                    'text' => $campus->name,
                ];
            });

        $array = ['results' => $array];

        return Response::json($array);
    }
}
