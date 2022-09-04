<?php

namespace App\Http\Controllers\Dimensao\Tabelas\Gestao;

use App\Http\Controllers\Controller;
use App\Models\Avaliacao;
use App\Models\Tabelas\Constants;
use App\Models\Tabelas\Gestao\GestaoMembroConselho;
use App\Models\Util\Avaliacao as UtilAvaliacao;
use App\Models\Util\Dimensao;
use App\Models\Util\MenuItemsTeacher;
use App\Models\Util\PadTables;
use App\Models\Util\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class GestaoMembroConselhoController extends Controller
{
    public function index($user_pad_id)
    {
        $atividades = 
                GestaoMembroConselho::initQuery()
                    ->whereUserPad($user_pad_id)
                    ->orderBy('cod_atividade')
                    ->get();

        $divs = PadTables::tablesGestao($user_pad_id);

        return view('pad.components.templates.dimensao.gestao.membro_conselho.form_create', [
            'atividades' => $atividades,

            'divs' => $divs,
            'user_pad_id' => $user_pad_id,
            'index_menu' => MenuItemsTeacher::PAD,
        ]);
    }
    
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), GestaoMembroConselho::rules(), GestaoMembroConselho::messages());

        if($validator->fails())
        {   
            return redirect()
                        ->route('gestao_membro_conselho_index', ['user_pad_id' => $request->user_pad_id,])
                        ->withErrors($validator)
                        ->withInput();
        }

        $user_pad_id = $request->user_pad_id;

        $model = new GestaoMembroConselho($request->all());
        $model->dimensao = Dimensao::GESTAO;

        if($model->save())
        {
            $avaliacao = new Avaliacao([
                'tarefa_id' => $model->id,
                'type' => UtilAvaliacao::GESTAO_MEMBRO_CONSELHO,
                'status' => Status::PENDENTE,
            ]);

            if(!$avaliacao->save())
            {
                return redirect()
                    ->route('gestao_membro_conselho_index', ['user_pad_id' => $user_pad_id])
                    ->with('fail', 'Erro ao cadastrar Atividade!');
            }

            return redirect()
                    ->route('gestao_membro_conselho_index', ['user_pad_id' => $user_pad_id])
                    ->with('success', 'Cadastro realizado com sucesso!');
        } else {
            return redirect()
                    ->route('gestao_membro_conselho_index', ['user_pad_id' => $user_pad_id])
                    ->with('fail', 'Erro ao cadastrar Atividade!');
        }
    }
    
    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), GestaoMembroConselho::rules(), GestaoMembroConselho::messages());

        $model = GestaoMembroConselho::find($id);
        $model->fill($request->all());

        $user_pad_id = $model->user_pad_id;

        if($validator->fails())
        {   
            return redirect()
                        ->route('gestao_membro_conselho_index', ['user_pad_id' => $user_pad_id])
                        ->with('fail', 'Erro ao atualizar Atividade!');
        }

        if($model->save()) {
            return redirect()->route('gestao_membro_conselho_index', ['user_pad_id' => $user_pad_id])
                    ->with('success', 'Atualizado com sucesso!');
        } else {
            return redirect()->route('gestao_membro_conselho_index', ['user_pad_id' => $user_pad_id])
                    ->with('fail', 'Erro ao atualizar a Atividade!');
        }
    }

    public function edit($id)
    {
        $model = GestaoMembroConselho::find($id);
        
        return view('pad.components.templates.dimensao.gestao.membro_conselho.form_update', [
            'model' => $model,
        ]);
    }

    public function viewResolucao()
    {
        $resolucoes = GestaoMembroConselho::getPlanejamentos();
        return view('pad.components.templates.resolucao', [
            'resolucoes' => $resolucoes
        ]);
    }

    public function delete($id)
    {
        $model = GestaoMembroConselho::find($id);
        
        $user_pad_id = $model->user_pad_id;

        if($model->delete()) {
            return redirect()
                    ->route('gestao_membro_conselho_index', ['user_pad_id' => $user_pad_id])
                    ->with('success', 'Atividade removida com Sucesso!');
        } else {
            return redirect()
                    ->route('gestao_membro_conselho_index', ['user_pad_id' => $user_pad_id])
                    ->with('fail', 'Erro ao remover atividade!');
        }
    }
    
    public function search($user_pad_id = null)
    {
        $query = GestaoMembroConselho::initQuery();

        if($user_pad_id) {
            $query->whereUserPad($user_pad_id)->orderBy('cod_atividade');
        }
        
        return Response::json($query->get());
    }

    public function ajaxValidation(Request $request)
    {   
        $validator = Validator::make($request->all(), GestaoMembroConselho::rules(), GestaoMembroConselho::messages());

        if($validator->passes()) {
            return Response::json(['message' => true, 'status' => 200]);
        }

        return Response::json(['errors' => $validator->errors(), 'status' => 400]);
    }
}