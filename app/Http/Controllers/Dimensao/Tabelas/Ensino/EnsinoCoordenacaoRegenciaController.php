<?php

namespace App\Http\Controllers\Dimensao\Tabelas\Ensino;

use App\Http\Controllers\Controller;
use App\Models\Avaliacao;
use App\Models\Planejamento;
use App\Models\Tabelas\Constants;
use App\Models\Tabelas\Ensino\EnsinoCoordenacaoRegencia;
use App\Models\Util\Avaliacao as UtilAvaliacao;
use App\Models\Util\CargaHorariaValidation;
use App\Models\Util\Dimensao;
use App\Models\Util\MenuItemsTeacher;
use App\Models\Util\Modalidade;
use App\Models\Util\Nivel;
use App\Models\Util\PadTables;
use App\Models\Util\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class EnsinoCoordenacaoRegenciaController extends Controller
{
    public function index($user_pad_id)
    {
        $coordenacaoRegencias = 
                EnsinoCoordenacaoRegencia::initQuery()
                    ->whereUserPad($user_pad_id)
                    ->orderBy('cod_atividade')
                    ->get();
        
        
        $niveis = Nivel::listNivel();
        $modalidades = Modalidade::listModalidade();
        $planejamentos = EnsinoCoordenacaoRegencia::listPlanejamentos();

        $divs = PadTables::tablesEnsino($user_pad_id);

        return view('pad.components.templates.dimensao.ensino.regencia.form_create', [
            'coordenacaoRegencias' => $coordenacaoRegencias,

            'divs' => $divs,
            'niveis' => $niveis,
            'modalidades' => $modalidades,
            'planejamentos' => $planejamentos,
            'user_pad_id' => $user_pad_id,
            'index_menu' => MenuItemsTeacher::PAD,
        ]);
    }
    
    public function edit($id) {

        $model = EnsinoCoordenacaoRegencia::find($id);
        $niveis = Nivel::listNivel();
        $modalidades = Modalidade::listModalidade();
        $planejamentos = EnsinoCoordenacaoRegencia::listPlanejamentos();
        
        return view('pad.components.templates.dimensao.ensino.regencia.form_update', [
            'model' => $model,
            'niveis' => $niveis,
            'modalidades' => $modalidades,
            'planejamentos' => $planejamentos
        ]);
    }

    public function viewResolucao()
    {   
        $resolucoes = EnsinoCoordenacaoRegencia::getPlanejamentos();
        return view('pad.components.templates.resolucao', ['resolucoes' => $resolucoes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if($request->cod_dimensao)
        {   
            $planejamento = Planejamento::initQuery()->whereCodDimensao($request->cod_dimensao)->first();
            
            $ch_min = $planejamento->ch_semanal;
            $ch_max = $planejamento->ch_maxima;

            $cargaHoraria = new CargaHorariaValidation($ch_min, $ch_max);

            $validator = Validator::make(
                $request->all(), 
                array_merge(EnsinoCoordenacaoRegencia::rules(), $cargaHoraria->rules()),
                array_merge(EnsinoCoordenacaoRegencia::messages(), $cargaHoraria->messages())
            );
        } else {
            $validator = Validator::make(
                $request->all(), 
                array_merge(EnsinoCoordenacaoRegencia::rules(), CargaHorariaValidation::defaultRules()),
                array_merge(EnsinoCoordenacaoRegencia::messages(), CargaHorariaValidation::defaultMessages())
            );
        }

        if($validator->fails())
        {   
            return redirect()
                        ->route('ensino_coordenacao_regencia_index', ['user_pad_id' => $request->user_pad_id,])
                        ->withErrors($validator)
                        ->withInput();
        }

        $user_pad_id = $request->user_pad_id;

        $model = new EnsinoCoordenacaoRegencia($request->all());
        $model->dimensao = Dimensao::ENSINO;

        if($model->save())
        {
            $avaliacao = new Avaliacao([
                'tarefa_id' => $model->id,
                'type' => UtilAvaliacao::ENSINO_COORDENACAO_REGENCIA,
                'status' => Status::PENDENTE,
            ]);

            if(!$avaliacao->save())
            {
                return redirect()
                    ->route('ensino_coordenacao_regencia_index', ['user_pad_id' => $user_pad_id])
                    ->with('fail', 'Erro ao cadastrar Atividade!');
            }

            return redirect()
                    ->route('ensino_coordenacao_regencia_index', ['user_pad_id' => $user_pad_id])
                    ->with('success', 'Cadastro realizado com sucesso!');
        } else {
            return redirect()
                    ->route('ensino_coordenacao_regencia_index', ['user_pad_id' => $user_pad_id])
                    ->with('fail', 'Erro ao cadastrar Atividade!');
        }
        
    }
    
    public function update($id, Request $request)
    {
        if($request->cod_dimensao)
        {   
            $planejamento = Planejamento::initQuery()->whereCodDimensao($request->cod_dimensao)->first();
            
            $ch_min = $planejamento->ch_semanal;
            $ch_max = $planejamento->ch_maxima;

            $cargaHoraria = new CargaHorariaValidation($ch_min, $ch_max);

            $validator = Validator::make(
                $request->all(), 
                array_merge(EnsinoCoordenacaoRegencia::rules(), $cargaHoraria->rules()),
                array_merge(EnsinoCoordenacaoRegencia::messages(), $cargaHoraria->messages())
            );
        } else {
            $validator = Validator::make(
                $request->all(), 
                array_merge(EnsinoCoordenacaoRegencia::rules(), CargaHorariaValidation::defaultRules()),
                array_merge(EnsinoCoordenacaoRegencia::messages(), CargaHorariaValidation::defaultMessages())
            );
        }

        $model = EnsinoCoordenacaoRegencia::find($id);
        $model->fill($request->all());

        $user_pad_id = $model->user_pad_id;

        if($validator->fails())
        {   
            return redirect()
                        ->route('ensino_aula_index', ['ensino_coordenacao_regencia_id' => $user_pad_id])
                        ->with('fail', 'Erro ao atualizar Atividade!');
        }

        if($model->save()) {
            return redirect()->route('ensino_aula_index', ['ensino_coordenacao_regencia_id' => $user_pad_id])
                    ->with('success', 'Atualizado com sucesso!');
        } else {
            return redirect()->route('ensino_aula_index', ['ensino_coordenacao_regencia_id' => $user_pad_id])
                    ->with('fail', 'Erro ao atualizar a Atividade!');
        }
    }
    
    public function delete($id)
    {
        $model = EnsinoCoordenacaoRegencia::find($id);
        
        $user_pad_id = $model->user_pad_id;

        if($model->delete()) {
            return redirect()
                    ->route('ensino_coordenacao_regencia_index', ['user_pad_id' => $user_pad_id])
                    ->with('success', 'Atividade removida com Sucesso!');
        } else {
            return redirect()
                    ->route('ensino_coordenacao_regencia_index', ['user_pad_id' => $user_pad_id])
                    ->with('fail', 'Erro ao remover atividade!');
        }
    }
    
    public function search($user_pad_id = null) {

        $query = EnsinoCoordenacaoRegencia::initQuery();

        if($user_pad_id) {
            $query->whereUserPad($user_pad_id)->orderBy('cod_atividade');
        }
        
        return Response::json($query->get());
    }

    public function ajaxValidation(Request $request)
    {   
        if($request->cod_dimensao)
        {   
            $planejamento = Planejamento::initQuery()->whereCodDimensao($request->cod_dimensao)->first();
            
            $ch_min = $planejamento->ch_semanal;
            $ch_max = $planejamento->ch_maxima;

            $cargaHoraria = new CargaHorariaValidation($ch_min, $ch_max);

            $validator = Validator::make(
                $request->all(), 
                array_merge(EnsinoCoordenacaoRegencia::rules(), $cargaHoraria->rules()),
                array_merge(EnsinoCoordenacaoRegencia::messages(), $cargaHoraria->messages())
            );
        } else {
            $validator = Validator::make(
                $request->all(), 
                array_merge(EnsinoCoordenacaoRegencia::rules(), CargaHorariaValidation::defaultRules()),
                array_merge(EnsinoCoordenacaoRegencia::messages(), CargaHorariaValidation::defaultMessages())
            );
        }

        if($validator->passes()) {
            return Response::json(['message' => true, 'status' => 200]);
        }

        return Response::json(['errors' => $validator->errors(), 'status' => 400]);
    }
    
}