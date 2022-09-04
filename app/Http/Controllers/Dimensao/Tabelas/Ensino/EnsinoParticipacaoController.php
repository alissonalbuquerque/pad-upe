<?php

namespace App\Http\Controllers\Dimensao\Tabelas\Ensino;

use App\Http\Controllers\Controller;
use App\Models\Avaliacao;
use App\Models\Tabelas\Constants;
use App\Models\Tabelas\Ensino\EnsinoParticipacao;
use App\Models\UserPad;
use App\Models\Util\Avaliacao as UtilAvaliacao;
use App\Models\Util\Dimensao;
use App\Models\Util\MenuItemsTeacher;
use App\Models\Util\Modalidade;
use App\Models\Util\Nivel;
use App\Models\Util\PadTables;
use App\Models\Util\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class EnsinoParticipacaoController extends Controller
{
    public function index($user_pad_id)
    {   
        $atividades = 
                EnsinoParticipacao::initQuery()
                    ->whereUserPad($user_pad_id)
                    ->orderBy('cod_atividade')
                    ->get();
        
        
        $niveis = Nivel::listNivel();
        $modalidades = Modalidade::listModalidade();
        $divs = PadTables::tablesEnsino($user_pad_id);

        return view('pad.components.templates.dimensao.ensino.participacao.form_create', [
            'atividades' => $atividades,

            'divs' => $divs,
            'niveis' => $niveis,
            'modalidades' => $modalidades,
            'user_pad_id' => $user_pad_id,
            'index_menu' => MenuItemsTeacher::PAD,
        ]);
    }

    public function edit($id) {

        $model = EnsinoParticipacao::find($id);
        $niveis = Nivel::listNivel();
        $modalidades = Modalidade::listModalidade();
        
        return view('pad.components.templates.dimensao.ensino.participacao.form_update', [
            'model' => $model,
            'niveis' => $niveis,
            'modalidades' => $modalidades
        ]);
    }

    public function viewResolucao()
    {   
        $resolucoes = EnsinoParticipacao::getPlanejamentos();
        return view('pad.components.templates.resolucao', ['resolucoes' => $resolucoes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {
        
        $validator = Validator::make($request->all(), EnsinoParticipacao::rules(), EnsinoParticipacao::messages());

        if($validator->fails())
        {   
            return redirect()
                        ->route('ensino_participacao_index', ['user_pad_id' => $request->user_pad_id,])
                        ->withErrors($validator)
                        ->withInput();
        }

        $user_pad_id = $request->user_pad_id;

        $model = new EnsinoParticipacao($request->all());
        $model->dimensao = Dimensao::ENSINO;

        if($model->save())
        {
            $avaliacao = new Avaliacao([
                'tarefa_id' => $model->id,
                'type' => UtilAvaliacao::ENSINO_PARTICIPACAO,
                'status' => Status::PENDENTE,
            ]);

            if(!$avaliacao->save())
            {
                return redirect()
                    ->route('ensino_participacao_index', ['user_pad_id' => $user_pad_id])
                    ->with('fail', 'Erro ao cadastrar Atividade!');
            }

            return redirect()
                    ->route('ensino_participacao_index', ['user_pad_id' => $user_pad_id])
                    ->with('success', 'Cadastro realizado com sucesso!');
        } else {
            return redirect()
                    ->route('ensino_participacao_index', ['user_pad_id' => $user_pad_id])
                    ->with('fail', 'Erro ao cadastrar Atividade!');
        }
        
    }

    public function update($id, Request $request) {
    
        $validator = Validator::make($request->all(), EnsinoParticipacao::rules(), EnsinoParticipacao::messages());

        $model = EnsinoParticipacao::find($id);
        $model->fill($request->all());

        $user_pad_id = $model->user_pad_id;

        if($validator->fails())
        {   
            return redirect()
                        ->route('ensino_participacao_index', ['user_pad_id' => $user_pad_id])
                        ->with('fail', 'Erro ao atualizar Atividade!');
        }

        if($model->save()) {
            return redirect()->route('ensino_participacao_index', ['user_pad_id' => $user_pad_id])
                    ->with('success', 'Atualizado com sucesso!');
        } else {
            return redirect()->route('ensino_participacao_index', ['user_pad_id' => $user_pad_id])
                    ->with('fail', 'Erro ao atualizar a Atividade!');
        }
    }

    public function delete($id)
    {
        $model = EnsinoParticipacao::find($id);
        
        $user_pad_id = $model->user_pad_id;

        if($model->delete()) {
            return redirect()
                    ->route('ensino_participacao_index', ['user_pad_id' => $user_pad_id])
                    ->with('success', 'Atividade removida com Sucesso!');
        } else {
            return redirect()
                    ->route('ensino_participacao_index', ['user_pad_id' => $user_pad_id])
                    ->with('fail', 'Erro ao remover atividade!');
        }
    }

    public function search($user_pad_id = null) {

        $query = EnsinoParticipacao::initQuery();

        if($user_pad_id) {
            $query->whereUserPad($user_pad_id)->orderBy('cod_atividade');
        }
        
        return Response::json($query->get());
    }

    public function ajaxValidation(Request $request)
    {   
        $validator = Validator::make($request->all(), EnsinoParticipacao::rules(), EnsinoParticipacao::messages());

        if($validator->passes()) {
            return Response::json(['message' => true, 'status' => 200]);
        }

        return Response::json(['errors' => $validator->errors(), 'status' => 400]);
    }
}