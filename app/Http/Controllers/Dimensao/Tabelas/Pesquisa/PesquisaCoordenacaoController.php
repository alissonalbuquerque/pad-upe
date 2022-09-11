<?php

namespace App\Http\Controllers\Dimensao\Tabelas\Pesquisa;

use App\Http\Controllers\Controller;
use App\Models\Avaliacao;
use App\Models\Planejamento;
use App\Models\Tabelas\Constants;
use App\Models\Tabelas\Pesquisa\PesquisaCoordenacao;
use App\Models\Util\Avaliacao as UtilAvaliacao;
use App\Models\Util\CargaHorariaValidation;
use App\Models\Util\Dimensao;
use App\Models\Util\MenuItemsTeacher;
use App\Models\Util\PadTables;
use App\Models\Util\Status;
use App\Queries\Tabelas\TablesGenericGrouped;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class PesquisaCoordenacaoController extends Controller
{
    public function index($user_pad_id)
    {
        $atividades =
                PesquisaCoordenacao::initQuery()
                        ->whereUserPad($user_pad_id)
                        ->orderBy('cod_atividade')
                        ->get();

        $funcoes = Constants::listFuncaoProjeto();

        $planejamentos = PesquisaCoordenacao::listPlanejamentos();

        $divs = PadTables::tablesPesquisa($user_pad_id);

        return view('pad.components.templates.dimensao.pesquisa.coordenacao.form_create', [
            'atividades' => $atividades,

            'divs' => $divs,
            'funcoes' => $funcoes,
            'planejamentos' => $planejamentos,

            'user_pad_id' => $user_pad_id,
            'index_menu' => MenuItemsTeacher::PAD,
        ]);
    }
    
    public function edit($id) {

        $model = PesquisaCoordenacao::find($id);
        $funcoes = Constants::listFuncaoProjeto();
        $planejamentos = PesquisaCoordenacao::listPlanejamentos();
        
        return view('pad.components.templates.dimensao.pesquisa.coordenacao.form_update', [
            'model' => $model,
            'funcoes' => $funcoes,
            'planejamentos' => $planejamentos,
        ]);
    }

    public function viewResolucao()
    {   
        $resolucoes = PesquisaCoordenacao::getPlanejamentos();
        return view('pad.components.templates.resolucao', ['resolucoes' => $resolucoes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if($request->user_pad_id && $request->cod_dimensao)
        {   
            $agroup = new TablesGenericGrouped(PesquisaCoordenacao::class, $request->user_pad_id, $request->cod_dimensao);
            $planejamento = Planejamento::initQuery()->whereCodDimensao($request->cod_dimensao)->first();
            
            $ch_min = $planejamento->ch_semanal;
            $ch_max = $planejamento->ch_maxima;
            $ch_sum = $agroup->agroup()->sum('ch_semanal');

            $cargaHoraria = new CargaHorariaValidation($ch_min, $ch_max, $ch_sum);

            $validator = Validator::make(
                $request->all(), 
                array_merge(PesquisaCoordenacao::rules(), $cargaHoraria->rules()),
                array_merge(PesquisaCoordenacao::messages(), $cargaHoraria->messages())
            );
        } else {
            $validator = Validator::make(
                $request->all(), 
                array_merge(PesquisaCoordenacao::rules(), CargaHorariaValidation::defaultRules()),
                array_merge(PesquisaCoordenacao::messages(), CargaHorariaValidation::defaultMessages())
            );
        }

        if($validator->fails())
        {   
            return redirect()
                        ->route('pesquisa_coordenacao_index', ['user_pad_id' => $request->user_pad_id,])
                        ->withErrors($validator)
                        ->withInput();
        }

        $user_pad_id = $request->user_pad_id;

        $model = new PesquisaCoordenacao($request->all());
        $model->dimensao = Dimensao::PESQUISA;

        if($model->save())
        {
            $avaliacao = new Avaliacao([
                'tarefa_id' => $model->id,
                'type' => UtilAvaliacao::PESQUISA_COORDENACAO,
                'status' => Status::PENDENTE,
            ]);

            if(!$avaliacao->save())
            {
                return redirect()
                    ->route('pesquisa_coordenacao_index', ['user_pad_id' => $user_pad_id])
                    ->with('fail', 'Erro ao cadastrar Atividade!');
            }

            return redirect()
                    ->route('pesquisa_coordenacao_index', ['user_pad_id' => $user_pad_id])
                    ->with('success', 'Cadastro realizado com sucesso!');
        } else {
            return redirect()
                    ->route('pesquisa_coordenacao_index', ['user_pad_id' => $user_pad_id])
                    ->with('fail', 'Erro ao cadastrar Atividade!');
        }
        
    }
    
    public function update($id, Request $request)
    {
        if($request->user_pad_id && $request->cod_dimensao)
        {   
            $agroup = new TablesGenericGrouped(PesquisaCoordenacao::class, $request->user_pad_id, $request->cod_dimensao);
            $planejamento = Planejamento::initQuery()->whereCodDimensao($request->cod_dimensao)->first();
            
            $ch_min = $planejamento->ch_semanal;
            $ch_max = $planejamento->ch_maxima;
            $ch_sum = $agroup->agroup()->sum('ch_semanal');

            $cargaHoraria = new CargaHorariaValidation($ch_min, $ch_max, $ch_sum);

            $validator = Validator::make(
                $request->all(), 
                array_merge(PesquisaCoordenacao::rules(), $cargaHoraria->rules()),
                array_merge(PesquisaCoordenacao::messages(), $cargaHoraria->messages())
            );
        } else {
            $validator = Validator::make(
                $request->all(), 
                array_merge(PesquisaCoordenacao::rules(), CargaHorariaValidation::defaultRules()),
                array_merge(PesquisaCoordenacao::messages(), CargaHorariaValidation::defaultMessages())
            );
        }

        $model = PesquisaCoordenacao::find($id);
        $model->fill($request->all());

        $user_pad_id = $model->user_pad_id;

        if($validator->fails())
        {   
            return redirect()
                        ->route('pesquisa_coordenacao_index', ['user_pad_id' => $user_pad_id])
                        ->with('fail', 'Erro ao atualizar Atividade!');
        }

        if($model->save()) {
            return redirect()
                    ->route('pesquisa_coordenacao_index', ['user_pad_id' => $user_pad_id])
                    ->with('success', 'Atualizado com sucesso!');
        } else {
            return redirect()
                    ->route('pesquisa_coordenacao_index', ['user_pad_id' => $user_pad_id])
                    ->with('fail', 'Erro ao atualizar a Atividade!');
        }
    }
    
    public function delete($id)
    {
        $model = PesquisaCoordenacao::find($id);
        
        $user_pad_id = $model->user_pad_id;

        if($model->delete()) {
            return redirect()
                    ->route('pesquisa_coordenacao_index', ['user_pad_id' => $user_pad_id])
                    ->with('success', 'Atividade removida com Sucesso!');
        } else {
            return redirect()
                    ->route('pesquisa_coordenacao_index', ['user_pad_id' => $user_pad_id])
                    ->with('fail', 'Erro ao remover atividade!');
        }
    }

    public function search($user_pad_id = null) {

        $query = PesquisaCoordenacao::initQuery();

        if($user_pad_id) {
            $query->whereUserPad($user_pad_id)->orderBy('cod_atividade');
        }
        
        return Response::json($query->get());
    }

    public function ajaxValidation(Request $request)
    {   
        if($request->user_pad_id && $request->cod_dimensao)
        {   
            $agroup = new TablesGenericGrouped(PesquisaCoordenacao::class, $request->user_pad_id, $request->cod_dimensao);
            $planejamento = Planejamento::initQuery()->whereCodDimensao($request->cod_dimensao)->first();
            
            $ch_min = $planejamento->ch_semanal;
            $ch_max = $planejamento->ch_maxima;
            $ch_sum = $agroup->agroup()->sum('ch_semanal');

            $cargaHoraria = new CargaHorariaValidation($ch_min, $ch_max, $ch_sum);

            $validator = Validator::make(
                $request->all(), 
                array_merge(PesquisaCoordenacao::rules(), $cargaHoraria->rules()),
                array_merge(PesquisaCoordenacao::messages(), $cargaHoraria->messages())
            );
        } else {
            $validator = Validator::make(
                $request->all(), 
                array_merge(PesquisaCoordenacao::rules(), CargaHorariaValidation::defaultRules()),
                array_merge(PesquisaCoordenacao::messages(), CargaHorariaValidation::defaultMessages())
            );
        }

        if($validator->passes()) {
            return Response::json(['message' => true, 'status' => 200]);
        }

        return Response::json(['errors' => $validator->errors(), 'status' => 400]);
    }
}
