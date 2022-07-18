<?php

namespace App\Http\Controllers\Dimensao\Tabelas\Pesquisa;

use App\Http\Controllers\Controller;
use App\Models\Tabelas\Constants;
use App\Models\Tabelas\Pesquisa\PesquisaCoordenacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class PesquisaCoordenacaoController extends Controller
{

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), PesquisaCoordenacao::rules(), PesquisaCoordenacao::messages());

        if($validator->fails())
        {
            return redirect()
                ->route('dimensao_pesquisa', [
                    'user_pad_id' => $request->user_pad_id,
                    'form_selected' => 'pesquisa_coordenacao',
                ])
                ->withErrors($validator->errors())
                ->withInput();
        }

        $model = new PesquisaCoordenacao($request->all());
        $model->dimensao = Constants::DIMENSAO_PESQUISA;

        if($model->save()) {
            return redirect()->route(
                'dimensao_pesquisa', ['user_pad_id' => $request->user_pad_id, 'form_selected' => 'pesquisa_coordenacao'
            ])->with('success', 'Cadastro realizado com sucesso!');
        } else {
            return redirect()->route(
                'dimensao_pesquisa', ['user_pad_id' => $request->user_pad_id, 'form_selected' => 'pesquisa_coordenacao'
            ])->with('fail', 'Erro ao cadastrar Atividade!');
        }

    }

    public function update($id, Request $request)
    {

    }

    public function delete($id)
    {

    }

    public function edit($id)
    {   
        $model = PesquisaCoordenacao::find($id);
        $funcoesProjeto = Constants::listFuncaoProjeto();

        return view('pad.components.templates.dimensao.pesquisa.coordenacao.form_update', [
            'model' => $model, 
            'funcoesProjeto' => $funcoesProjeto
        ]);
    }

    public function ajaxValidation(Request $request)
    {

    }

    public function search($user_pad_id = null)
    {   
        $query = PesquisaCoordenacao::initQuery();

        if($user_pad_id)
        {
            $query->whereUserPad($user_pad_id);
        }

        return Response::json($query->get());
    }

}