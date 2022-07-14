<?php

namespace App\Http\Controllers\Dimensao\Tabelas\Ensino;

use App\Http\Controllers\Controller;
use App\Models\Tabelas\Ensino\EnsinoAula;
use App\Models\UserPad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class EnsinoAulaController extends Controller
{   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {
        
        $validator = Validator::make($request->all(), EnsinoAula::rules(), EnsinoAula::messages());

        if($validator->fails())
        {   
            return redirect()
                        ->route('dimensao_ensino', [
                            'user_pad_id' => $request->user_pad_id,
                            'form_selected' => 'ensino_aulas'
                        ])
                        ->withErrors($validator)
                        ->withInput();
        }

        $user_pad_id = $request->user_pad_id;
        $div_selected = 'ensino_aulas';

        $model = new EnsinoAula($request->all());

        if($model->save()) {
            return redirect()->route('dimensao_ensino', ['user_pad_id' => $user_pad_id, 'form_selected' => $div_selected])->with('success', 'Cadastro realizado com sucesso!');
        } else {
            return redirect()->route('dimensao_ensino', ['user_pad_id' => $user_pad_id, 'form_selected' => $div_selected])->with('fail', 'Erro ao cadastrar Atividade!');
        }
        
    }

    public function update($id, Request $request) {
        
        dd($request->id);
    }

    public function delete($id = null, $user_pad_id = null)
    {   
        $model = EnsinoAula::find($id);
        $user_pad_id = $model->user_pad_id;
        $model->delete();
        $div_selected = 'ensino_aulas';
        return redirect()->route('dimensao_ensino', ['user_pad_id' => $user_pad_id, 'form_selected' => $div_selected])->with('success', 'Cadastro realizado com sucesso!');
    }

    public function search($user_pad_id = null) {

        $query = EnsinoAula::initQuery();

        if($user_pad_id) {
            $query->whereUserPad($user_pad_id)->orderBy('cod_atividade');
        }
        
        return Response::json($query->get());
    }
}
