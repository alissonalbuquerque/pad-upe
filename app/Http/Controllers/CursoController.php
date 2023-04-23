<?php

namespace App\Http\Controllers;

use App\Models\Campus;
use App\Models\Curso;
use App\Models\Util\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cursos = Curso::orderBy('campus_id')->orderBy('name')->get();
        
        return view('curso.index', [
            'cursos' => $cursos,
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
        return redirect()->route('curso_index')->with('success', 'Curso salvo com sucesso!');
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
        return redirect()->route('curso_index')->with('success', 'Curso atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param string $q
     * @param string $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $model = Curso::find($id);
        $model->delete();
        return redirect()->route('curso_index')->with('success', 'Curso excluído com sucesso!');
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
        $campus_id = $request->query('campus_id');

        $cursos = Curso::where([]);

        if($q) {
            $cursos = $cursos->where('name', 'like', '%'.$q.'%');
        }

        if($id) {
            $cursos = $cursos->whereId($id);
        }

        if($campus_id) {
            $cursos = $cursos->whereCampusId($campus_id);
        }

        $cursos = $cursos->orderBy('campus_id', 'asc')->get();

        $array = 
            $cursos->map(function($curso, $key)
            {
                return [
                    'id' => $curso->id, 
                    'text' => $curso->name,
                ];
            });

        $array = ['results' => $array];

        return Response::json($array);
    }
}
