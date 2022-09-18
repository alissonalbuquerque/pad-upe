<?php

namespace App\Http\Controllers\Dimensao\Tabelas\Ensino;

use App\Http\Controllers\Controller;
use App\Models\Avaliacao;
use App\Models\Planejamento;
use App\Models\Tabelas\Constants;
use App\Models\Tabelas\Ensino\EnsinoSupervisao;
use App\Models\Util\Avaliacao as UtilAvaliacao;
use App\Models\Util\CargaHorariaValidation;
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
        $planejamentos = EnsinoSupervisao::listPlanejamentos();
        $divs = PadTables::tablesEnsino($user_pad_id);

        return view('pad.components.templates.dimensao.ensino.supervisao.form_create', [
            'atividades' => $atividades,

            'divs' => $divs,
            'niveis' => $niveis,
            'supervisoes' => $supervisoes,
            'planejamentos' => $planejamentos,
            'user_pad_id' => $user_pad_id,
            'index_menu' => MenuItemsTeacher::PAD,
        ]);
    }

    public function edit($id) {

        $model = EnsinoSupervisao::find($id);
        $niveis = Nivel::listNivel();
        $supervisoes = Supervisao::listSupervisao();
        $planejamentos = EnsinoSupervisao::listPlanejamentos();
        
        return view('pad.components.templates.dimensao.ensino.supervisao.form_update', [
            'model' => $model,
            'niveis' => $niveis,
            'supervisoes' => $supervisoes,
            'planejamentos' => $planejamentos,
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
    public function create(Request $request)
    {
        $ch_semanal_temp = $request->ch_semanal;

        if($request->cod_dimensao)
        {   
            $planejamento = Planejamento::initQuery()->whereCodDimensao($request->cod_dimensao)->first();
            
            $ch_min = $planejamento->ch_semanal;
            $ch_max = $planejamento->ch_maxima;

            $cargaHoraria = new CargaHorariaValidation($ch_min, $ch_max, ['field' => 'Qtd. Participantes', 'value' => $request->numero_orientandos]);

            $request->merge(['ch_semanal' => $request->ch_semanal * ($request->numero_orientandos?? 1)]);

            $validator = Validator::make(
                $request->all(),
                array_merge(EnsinoSupervisao::rules(), $cargaHoraria->rules()),
                array_merge(EnsinoSupervisao::messages(), $cargaHoraria->messages())
            );
        } else {
            $validator = Validator::make(
                $request->all(), 
                array_merge(EnsinoSupervisao::rules(), CargaHorariaValidation::defaultRules()),
                array_merge(EnsinoSupervisao::messages(), CargaHorariaValidation::defaultMessages())
            );
        }
        
        if($validator->fails())
        {   
            $request->merge(['ch_semanal' => $ch_semanal_temp]);
            return redirect()
                        ->route('ensino_supervisao_index', ['user_pad_id' => $request->user_pad_id,])
                        ->withErrors($validator)
                        ->withInput();
        }

        $user_pad_id = $request->user_pad_id;
        $request->merge(['ch_semanal' => $ch_semanal_temp]);

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

    public function update($id, Request $request)
    {   
        $model = EnsinoSupervisao::find($id);

        $ch_semanal_temp = $request->ch_semanal;

        if($request->cod_dimensao)
        {   
            $planejamento = Planejamento::initQuery()->whereCodDimensao($request->cod_dimensao)->first();
            
            $ch_min = $planejamento->ch_semanal;
            $ch_max = $planejamento->ch_maxima;

            $cargaHoraria = new CargaHorariaValidation($ch_min, $ch_max, ['field' => 'Qtd. Participantes', 'value' => $request->numero_orientandos]);

            $request->merge(['ch_semanal' => $request->ch_semanal * ($request->numero_orientandos?? 1)]);

            $validator = Validator::make(
                $request->all(),
                array_merge(EnsinoSupervisao::rules(), $cargaHoraria->rules()),
                array_merge(EnsinoSupervisao::messages(), $cargaHoraria->messages())
            );
        } else {
            $validator = Validator::make(
                $request->all(), 
                array_merge(EnsinoSupervisao::rules(), CargaHorariaValidation::defaultRules()),
                array_merge(EnsinoSupervisao::messages(), CargaHorariaValidation::defaultMessages())
            );
        }

        $user_pad_id = $model->user_pad_id;

        if($validator->fails())
        {   
            return redirect()
                        ->route('ensino_supervisao_index', ['user_pad_id' => $user_pad_id])
                        ->with('fail', 'Erro ao atualizar Atividade!');
        }

        $request->merge(['ch_semanal' => $ch_semanal_temp]);
        $model->fill($request->all());

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
        $ch_semanal_temp = $request->ch_semanal;

        if($request->cod_dimensao)
        {   
            $planejamento = Planejamento::initQuery()->whereCodDimensao($request->cod_dimensao)->first();
            
            $ch_min = $planejamento->ch_semanal;
            $ch_max = $planejamento->ch_maxima;

            $cargaHoraria = new CargaHorariaValidation($ch_min, $ch_max, ['field' => 'Qtd. Participantes', 'value' => $request->numero_orientandos]);

            $request->merge(['ch_semanal' => $request->ch_semanal * ($request->numero_orientandos?? 1)]);

            $validator = Validator::make(
                $request->all(),
                array_merge(EnsinoSupervisao::rules(), $cargaHoraria->rules()),
                array_merge(EnsinoSupervisao::messages(), $cargaHoraria->messages())
            );
        } else {
            $validator = Validator::make(
                $request->all(), 
                array_merge(EnsinoSupervisao::rules(), CargaHorariaValidation::defaultRules()),
                array_merge(EnsinoSupervisao::messages(), CargaHorariaValidation::defaultMessages())
            );
        }

        if($validator->passes()) {
            $request->merge(['ch_semanal' => $ch_semanal_temp]);
            return Response::json(['message' => true, 'status' => 200]);
        }

        return Response::json(['errors' => $validator->errors(), 'status' => 400]);
    }
}