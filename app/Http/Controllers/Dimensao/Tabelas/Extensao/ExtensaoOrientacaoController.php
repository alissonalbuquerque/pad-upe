<?php

namespace App\Http\Controllers\Dimensao\Tabelas\Extensao;

use App\Http\Controllers\Controller;
use App\Models\Avaliacao;
use App\Models\Planejamento;
use App\Models\Tabelas\Constants;
use App\Models\Tabelas\Extensao\ExtensaoOrientacao;
use App\Models\Util\Avaliacao as UtilAvaliacao;
use App\Models\Util\CargaHorariaValidation;
use App\Models\Util\Dimensao;
use App\Models\Util\MenuItemsTeacher;
use App\Models\Util\PadTables;
use App\Models\Util\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class ExtensaoOrientacaoController extends Controller
{
    public function index($user_pad_id)
    {   
        $atividades =
                ExtensaoOrientacao::initQuery()
                        ->whereUserPad($user_pad_id)
                        ->orderBy('cod_atividade')
                        ->get();

        $funcoes = Constants::listFuncaoOrientador();

        $divs = PadTables::tablesExtensao($user_pad_id);

        return view('pad.components.templates.dimensao.extensao.orientacao.form_create', [
            'atividades' => $atividades,

            'divs' => $divs,
            'funcoes' => $funcoes,

            'user_pad_id' => $user_pad_id,
            'index_menu' => MenuItemsTeacher::PAD,
        ]);
    }
    
    public function edit($id) {

        $model = ExtensaoOrientacao::find($id);
        $funcoes = Constants::listFuncaoOrientador();
        
        return view('pad.components.templates.dimensao.extensao.orientacao.form_update', [
            'model' => $model,
            'funcoes' => $funcoes
        ]);
    }

    public function viewResolucao()
    {   
        $resolucoes = ExtensaoOrientacao::getPlanejamentos();
        return view('pad.components.templates.resolucao', ['resolucoes' => $resolucoes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {    
        $planejamento = Planejamento::initQuery()->whereCodDimensao('X-2')->first();
        
        $ch_min = $planejamento->ch_semanal;
        $ch_max = $planejamento->ch_maxima;

        $cargaHoraria = new CargaHorariaValidation($ch_min, $ch_max);

        $validator = Validator::make(
            $request->all(), 
            array_merge(ExtensaoOrientacao::rules(), $cargaHoraria->rules()),
            array_merge(ExtensaoOrientacao::messages(), $cargaHoraria->messages())
        );

        if($validator->fails())
        {   
            return redirect()
                        ->route('extensao_orientacao_index', ['user_pad_id' => $request->user_pad_id,])
                        ->withErrors($validator)
                        ->withInput();
        }

        $user_pad_id = $request->user_pad_id;

        $model = new ExtensaoOrientacao($request->all());
        $model->dimensao = Dimensao::EXTENSAO;

        if($model->save())
        {
            $avaliacao = new Avaliacao([
                'tarefa_id' => $model->id,
                'type' => UtilAvaliacao::EXTENSAO_ORIENTACAO,
                'status' => Status::PENDENTE,
            ]);

            if(!$avaliacao->save())
            {
                return redirect()
                    ->route('extensao_orientacao_index', ['user_pad_id' => $user_pad_id])
                    ->with('fail', 'Erro ao cadastrar Atividade!');
            }

            return redirect()
                    ->route('extensao_orientacao_index', ['user_pad_id' => $user_pad_id])
                    ->with('success', 'Cadastro realizado com sucesso!');
        } else {
            return redirect()
                    ->route('extensao_orientacao_index', ['user_pad_id' => $user_pad_id])
                    ->with('fail', 'Erro ao cadastrar Atividade!');
        }
        
    }
    
    public function update($id, Request $request)
    {
        $planejamento = Planejamento::initQuery()->whereCodDimensao('X-2')->first();
        
        $ch_min = $planejamento->ch_semanal;
        $ch_max = $planejamento->ch_maxima;

        $cargaHoraria = new CargaHorariaValidation($ch_min, $ch_max);

        $validator = Validator::make(
            $request->all(), 
            array_merge(ExtensaoOrientacao::rules(), $cargaHoraria->rules()),
            array_merge(ExtensaoOrientacao::messages(), $cargaHoraria->messages())
        );

        $model = ExtensaoOrientacao::find($id);
        $model->fill($request->all());

        $user_pad_id = $model->user_pad_id;

        if($validator->fails())
        {   
            return redirect()
                        ->route('extensao_orientacao_index', ['user_pad_id' => $user_pad_id])
                        ->with('fail', 'Erro ao atualizar Atividade!');
        }

        if($model->save()) {
            return redirect()
                    ->route('extensao_orientacao_index', ['user_pad_id' => $user_pad_id])
                    ->with('success', 'Atualizado com sucesso!');
        } else {
            return redirect()
                    ->route('extensao_orientacao_index', ['user_pad_id' => $user_pad_id])
                    ->with('fail', 'Erro ao atualizar a Atividade!');
        }
    }
    
    public function delete($id)
    {
        $model = ExtensaoOrientacao::find($id);
        
        $user_pad_id = $model->user_pad_id;

        if($model->delete()) {
            return redirect()
                    ->route('extensao_orientacao_index', ['user_pad_id' => $user_pad_id])
                    ->with('success', 'Atividade removida com Sucesso!');
        } else {
            return redirect()
                    ->route('extensao_orientacao_index', ['user_pad_id' => $user_pad_id])
                    ->with('fail', 'Erro ao remover atividade!');
        }
    }

    public function search($user_pad_id = null) {

        $query = ExtensaoOrientacao::initQuery();

        if($user_pad_id) {
            $query->whereUserPad($user_pad_id)->orderBy('cod_atividade');
        }
        
        return Response::json($query->get());
    }

    public function ajaxValidation(Request $request)
    {   
        $planejamento = Planejamento::initQuery()->whereCodDimensao('X-2')->first();
        
        $ch_min = $planejamento->ch_semanal;
        $ch_max = $planejamento->ch_maxima;

        $cargaHoraria = new CargaHorariaValidation($ch_min, $ch_max);

        $validator = Validator::make(
            $request->all(), 
            array_merge(ExtensaoOrientacao::rules(), $cargaHoraria->rules()),
            array_merge(ExtensaoOrientacao::messages(), $cargaHoraria->messages())
        );

        if($validator->passes()) {
            return Response::json(['message' => true, 'status' => 200]);
        }

        return Response::json(['errors' => $validator->errors(), 'status' => 400]);
    }
}