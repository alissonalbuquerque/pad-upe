<?php

namespace App\Http\Controllers\Dimensao\Tabelas\Ensino;

use App\Http\Controllers\Controller;
use App\Models\Tabelas\Ensino\EnsinoAula;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class EnsinoAulaController extends Controller
{   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {

        dd($request->all());

        $model = new EnsinoAula();
        $model->fill($request->all());
        $model->save();

        return redirect()->route('dimensao_ensino');
    }

    public function update(integer $id, Request $request) {
        dd('UPDATE');
    }

    public function delete($id){

        dd('DELETE');

        $model = EnsinoAula::find($id);
        $model->delete();
        return redirect()->route('dimensao_ensino');
    }

    public function getAll($pad_id = null) {
        return Response::json(['message' => 'teste']);
    }
}
