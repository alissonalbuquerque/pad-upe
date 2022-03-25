<?php

namespace App\Http\Controllers\Tabelas\Ensino;

use App\Http\Controllers\Controller;
use App\Models\Tabelas\Ensino\EnsinoAula;
use Illuminate\Http\Request;

class EnsinoAulaController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {
        $model = new EnsinoAula();
        $model->fill($request->all());
        $model->save();

        return redirect()->route('dimensao_ensino');
    }

    public function delete($id){
        $model = EnsinoAula::find($id);
        $model->delete();
        return redirect()->route('dimensao_ensino');
    }
}
