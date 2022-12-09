<?php

namespace App\Http\Controllers;

use App\Models\Campus;
use App\Models\Curso;
use App\Models\Unidade;
use App\Models\Util\Menu;
use App\Models\Util\MenuItemsAdmin;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $campusWithCursos = [];
        $allCampus = Campus::all();
        foreach($allCampus as $campus){
            $campus->cursos = Curso::where('campus_id', '=', $campus->id)->get();
            array_push($campusWithCursos, $campus);
        }

        return view('curso.index', [
            'campusWithCursos' => $campusWithCursos,
            'menu' => Menu::CURSOS
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $allCampus = Campus::all();

        return view('curso.create', [
            'allCampus' => $allCampus,
            'menu' => Menu::CURSOS
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
        $model = new Curso();
        $validator = Curso::validator($request->all());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $model->fill($request->all());
        $model->save();
        return redirect()->route('curso_index')->with('success', 'Salvo com sucesso!');
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
        $curso = Curso::findOrFail($id);
        return view('curso.update', [
            'allCampus' => Campus::all(),
            'menu' => Menu::CURSOS,
            'curso' => $curso,
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
        $model = Curso::findOrFail($id);
        $validator = Curso::validator($request->all());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $model->fill($request->all());
        $model->save();
        return redirect()->route('curso_index')->with('success', 'Atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Curso::find($id);
        $model->delete();
        return redirect()->route('curso_index')->with('success', 'Excluído com sucesso!');
    }
}
