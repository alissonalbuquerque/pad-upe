<?php

namespace App\Http\Controllers;

use App\Models\Unidade;
use App\Models\User;
use App\Models\Util\MenuItemsAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DiretorController extends Controller
{

    /**
     * @return Response
     */
    public function index()
    {
        $diretores = User::where('type', '=', User::TYPE_MANAGER)->get();
        return view('diretor.index', [
            'index_menu' => MenuItemsAdmin::DIRETORES,
            'diretores' =>  $diretores
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('diretor.create', [
            'index_menu' => MenuItemsAdmin::DIRETORES,
            'unidades' => Unidade::all()
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
        $model = new User();
        $validator = User::validator($request->all());
        $validator->type = User::TYPE_MANAGER;

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $model->fill($request->all());
        $model->type = User::TYPE_MANAGER;
        $model->password = Hash::make($model->password);
        $model->save();

        return redirect()->route('diretor_index')->with('success', 'Salvo com sucesso!');
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
        $user = User::findOrFail($id);
        return view('diretor.update', [
            'index_menu' => MenuItemsAdmin::DIRETORES,
            'unidades' => Unidade::all(),
            'user' => $user,
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
        $model = User::findOrFail($id);
        $validator = User::validator($request->all());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $model->fill($request->all());
        $model->save();
        return redirect()->route('diretor_index')->with('success', 'Atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = User::find($id);
        $model->delete();
        return redirect()->route('diretor_index')->with('success', 'Excluído com sucesso!');
    }
}
