<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Curso;
use App\Models\Util\MenuItemsAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('coordenador.create', [
            'index_menu' => MenuItemsAdmin::COORDENADORES,
            'cursos' => Curso::all(),
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
        $validator->type = User::TYPE_COORDINATOR;

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $model->fill($request->all());
        $model->type = User::TYPE_COORDINATOR;
        $model->password = Hash::make($model->password);
        $model->save();

        return redirect()->route('coordenador_index')->with('success', 'Salvo com sucesso!');
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
        return view('coordenador.update', [
            'index_menu' => MenuItemsAdmin::COORDENADORES,
            'cursos' => Curso::all(),
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

        $newPassword = $request->input('password');
        if($newPassword != null){
            $model->password = Hash::make($newPassword);
        }
        
        $model->save();
        return redirect()->route('coordenador_index')->with('success', 'Atualizado com sucesso!');
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
        return redirect()->route('coordenador_index')->with('success', 'Excluído com sucesso!');
    }
}
