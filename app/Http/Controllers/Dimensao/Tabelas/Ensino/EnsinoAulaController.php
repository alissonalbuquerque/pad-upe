<?php

namespace App\Http\Controllers\Dimensao\Tabelas\Ensino;

use App\Http\Controllers\Controller;
use App\Models\Tabelas\Constants;
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
    
        $validator = Validator::make($request->all(), EnsinoAula::rules(), EnsinoAula::messages());

        $model = EnsinoAula::find($id);
        $model->fill($request->all());

        $user_pad_id = $model->user_pad_id;
        $div_selected = 'ensino_aulas';

        if($validator->fails())
        {   
            return redirect()
                        ->route('dimensao_ensino', ['user_pad_id' => $user_pad_id, 'form_selected' => $div_selected])
                        ->with('fail', 'Erro ao atualizar Atividade!');
        }

        if($model->save()) {
            return redirect()->route('dimensao_ensino', ['user_pad_id' => $user_pad_id, 'form_selected' => $div_selected])->with('success', 'Atualizado com sucesso!');
        } else {
            return redirect()->route('dimensao_ensino', ['user_pad_id' => $user_pad_id, 'form_selected' => $div_selected])->with('fail', 'Erro ao atualizar Atividade!');
        }

    }


    public function ajaxValidation(Request $request)
    {   
        $validator = Validator::make($request->all(), EnsinoAula::rules(), EnsinoAula::messages());

        if($validator->passes()) {
            return Response::json(['message' => true, 'status' => 200]);
        }

        return Response::json(['errors' => $validator->errors(), 'status' => 400]);
    }

    public function delete($id)
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

    public function edit($id) {

        $model = EnsinoAula::find($id);
        $niveis = Constants::listNivel();
        $modalidades = Constants::listModalidade();
        
        return view('pad.components.templates.dimensao.ensino.aulas.form_update', [
            'model' => $model,
            'niveis' => $niveis,
            'modalidades' => $modalidades
        ]);
    }
}
