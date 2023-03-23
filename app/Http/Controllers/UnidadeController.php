<?php

namespace App\Http\Controllers;

use App\Models\Unidade;
use App\Models\Util\Menu;
use App\Models\Util\MenuItemsAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

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
            'menu' => Menu::UNIDADES,
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
            'menu' => Menu::UNIDADES,
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
        return redirect()->route('unidade_index')->with('success', 'Unidade salva com sucesso!');
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
            'menu' => Menu::UNIDADES,
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
        return redirect()->route('unidade_index')->with('success', 'Unidade atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {   
        $model = Unidade::find($id);
        $model->delete();
        return redirect()->route('unidade_index')->with('success', 'Unidade excluída com sucesso!');
    }

    /**
     *
     * @params Illuminate\Http\Request\Request
     */
    public function search(Request $request)
    {   
        // QueryParams
        $q = $request->query('q'); 
        $id = $request->query('id');

        $unidade = Unidade::where([]);

        if($id) {
            $unidade = $unidade->whereId($id);
        }

        if($q) {
            $unidade = $unidade->where('name', 'like', '%'.$q.'%');
        }

        $unidade = $unidade->get();

        $array = 
            $unidade->map(function($unidade, $key)
            {
                return [
                    'id' => $unidade->id,
                    'text' => $unidade->name,
                ];
            });

        $array = ['results' => $array];

        return Response::json($array);
    }
}
