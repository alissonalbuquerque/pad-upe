<?php

namespace App\Http\Controllers\Dimensao\Tabelas\Ensino;

use App\Http\Controllers\Controller;
use App\Models\Avaliacao;
use App\Models\Tabelas\Constants;
use App\Models\Tabelas\Ensino\EnsinoSupervisao;
use App\Models\Util\Avaliacao as UtilAvaliacao;
use App\Models\Util\Dimensao;
use App\Models\Util\MenuItemsTeacher;
use App\Models\Util\Nivel;
use App\Models\Util\PadTables;
use App\Models\Util\Status;
use App\Models\Util\Supervisao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class EnsinoSupervisaoController extends Controller
{
    public function index($user_pad_id)
    {   
        $atividades = 
                EnsinoSupervisao::initQuery()
                    ->whereUserPad($user_pad_id)
                    ->orderBy('cod_atividade')
                    ->get();
        
        
        $niveis = Nivel::listNivel();
        $supervisoes = Supervisao::listSupervisao();
        $divs = PadTables::tablesEnsino($user_pad_id);

        return view('pad.components.templates.dimensao.ensino.supervisao.form_create', [
            'atividades' => $atividades,

            'divs' => $divs,
            'niveis' => $niveis,
            'supervisoes' => $supervisoes,
            'user_pad_id' => $user_pad_id,
            'index_menu' => MenuItemsTeacher::PAD,
        ]);
    }

    public function edit($id) {

        $model = EnsinoSupervisao::find($id);
        $niveis = Nivel::listNivel();
        $modalidades = Supervisao::listSupervisao();
        
        return view('pad.components.templates.dimensao.ensino.supervisao.form_update', [
            'model' => $model,
            'niveis' => $niveis,
            'modalidades' => $modalidades
        ]);
    }

    public function viewResolucao()
    {   
        $resolucoes = EnsinoSupervisao::getPlanejamentos();
        return view('pad.components.templates.resolucao', ['resolucoes' => $resolucoes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {
        
        $validator = Validator::make($request->all(), EnsinoSupervisao::rules(), EnsinoSupervisao::messages());

        if($validator->fails())
        {   
            return redirect()
                        ->route('ensino_supervisao_index', ['user_pad_id' => $request->user_pad_id,])
                        ->withErrors($validator)
                        ->withInput();
        }

        $user_pad_id = $request->user_pad_id;

        $model = new EnsinoSupervisao($request->all());
        $model->dimensao = Dimensao::ENSINO;

        if($model->save())
        {
            $avaliacao = new Avaliacao([
                'tarefa_id' => $model->id,
                'type' => UtilAvaliacao::ENSINO_SUPERVISAO,
                'status' => Status::PENDENTE,
            ]);

            if(!$avaliacao->save())
            {
                return redirect()
                    ->route('ensino_supervisao_index', ['user_pad_id' => $user_pad_id])
                    ->with('fail', 'Erro ao cadastrar Atividade!');
            }

            return redirect()
                    ->route('ensino_supervisao_index', ['user_pad_id' => $user_pad_id])
                    ->with('success', 'Cadastro realizado com sucesso!');
        } else {
            return redirect()
                    ->route('ensino_supervisao_index', ['user_pad_id' => $user_pad_id])
                    ->with('fail', 'Erro ao cadastrar Atividade!');
        }
        
    }

    public function update($id, Request $request) {
    
        $validator = Validator::make($request->all(), EnsinoSupervisao::rules(), EnsinoSupervisao::messages());

        $model = EnsinoSupervisao::find($id);
        $model->fill($request->all());

        $user_pad_id = $model->user_pad_id;

        if($validator->fails())
        {   
            return redirect()
                        ->route('ensino_supervisao_index', ['user_pad_id' => $user_pad_id])
                        ->with('fail', 'Erro ao atualizar Atividade!');
        }

        if($model->save()) {
            return redirect()->route('ensino_supervisao_index', ['user_pad_id' => $user_pad_id])
                    ->with('success', 'Atualizado com sucesso!');
        } else {
            return redirect()->route('ensino_supervisao_index', ['user_pad_id' => $user_pad_id])
                    ->with('fail', 'Erro ao atualizar a Atividade!');
        }
    }

    public function delete($id)
    {
        $model = EnsinoSupervisao::find($id);
        
        $user_pad_id = $model->user_pad_id;

        if($model->delete()) {
            return redirect()
                    ->route('ensino_supervisao_index', ['user_pad_id' => $user_pad_id])
                    ->with('success', 'Atividade removida com Sucesso!');
        } else {
            return redirect()
                    ->route('ensino_supervisao_index', ['user_pad_id' => $user_pad_id])
                    ->with('fail', 'Erro ao remover atividade!');
        }
    }

    public function search($user_pad_id = null) {

        $query = EnsinoSupervisao::initQuery();

        if($user_pad_id) {
            $query->whereUserPad($user_pad_id)->orderBy('cod_atividade');
        }
        
        return Response::json($query->get());
    }

    public function ajaxValidation(Request $request)
    {   
        $validator = Validator::make($request->all(), EnsinoSupervisao::rules(), EnsinoSupervisao::messages());

        if($validator->passes()) {
            return Response::json(['message' => true, 'status' => 200]);
        }

        return Response::json(['errors' => $validator->errors(), 'status' => 400]);
    }
}