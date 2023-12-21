<?php

namespace App\Http\Controllers;

use App\Models\AvaliadorPad;
use App\Models\AvaliadorPadDimensao;
use App\Models\Pad;
use App\Models\User;
use App\Models\Util\Dimensao;
use App\Models\Util\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class AvaliadorPadController extends Controller
{
    public function actionStore(Request $request)
    {
        //Verificar se um avaliador estiver deletado via soft delete, rehabilitar os dados e atualizalos em relação ao request, busca via user_id

        // $validator = Validator::make(
        //     $request->all(), UserPad::rules(), UserPad::messages()
        // );

        // if($validator->fails())
        // {

        // }

        $pad = Pad::find($request->pad_id);

        //Recebe registro deletado via softdelete de AvaliadorPad se existir
        $model = AvaliadorPad::wherePadId($request->pad_id)->whereUserId($request->user_id)->onlyTrashed()->first();

        if($model) {
            $model->restore();
            $model->fill($request->all());
        } else {
            $model = new AvaliadorPad();
            $model->fill($request->all());
        }

        if($model->save())
        {   
            if($model->id) {
                AvaliadorPadDimensao::whereAvaliadorPadId($model->id)->delete();
            }

            foreach($request->dimensoes_multiples as $dimensao) {
                $avaliadorPadDimensao = new AvaliadorPadDimensao();

                $avaliadorPadDimensao->avaliador_pad_id = $model->id;
                $avaliadorPadDimensao->dimensao = $dimensao;
                $avaliadorPadDimensao->save();
            }
            
            return redirect()
                ->route('pad_edit', ['id' => $request->pad_id])
                ->with('success', sprintf('Avaliador cadastrado no PAD(%s) com sucesso!', $pad->nome));
        }     
    }

    public function actionUpdate(Request $request, $id)
    {
        // $validator = Validator::make(
        //     $request->all(), UserPad::rules(), UserPad::messages()
        // );

        // if($validator->fails())
        // {

        // }

        $model = AvaliadorPad::find($id);
        $model->fill($request->all());
        
        $pad = $model->pad;

        if($model->save())
        {
            AvaliadorPadDimensao::whereAvaliadorPadId($model->id)->delete();

            foreach($request->dimensoes_multiples as $dimensao) {
                $avaliadorPadDimensao = new AvaliadorPadDimensao();

                $avaliadorPadDimensao->avaliador_pad_id = $model->id;
                $avaliadorPadDimensao->dimensao = $dimensao;
                $avaliadorPadDimensao->save();
            }
            
            return redirect()
                ->route('pad_edit', ['id' => $request->pad_id])
                ->with('success', sprintf('Avaliador atualizado no PAD(%s) com sucesso!', $pad->nome));
        }
    }

    public function actionDelete($id)
    {
        $model = AvaliadorPad::find($id);
        $pad = $model->pad;

        if($model->delete())
        {
            return redirect()
                ->route('pad_edit', ['id' => $pad->id])
                ->with('success', sprintf('Avaliador removido do PAD(%s) com sucesso!', $pad->nome));
        }

        return redirect()
                ->route('pad_edit', ['id' => $model->pad_id])
                ->with('fail', sprintf('Erro ao tentar remover Avaliador! PAD(%s)!', $pad->nome));
    }

    public function actionCreate($pad_id)
    {   
        dd('create');
        $pad = Pad::find($pad_id);
        $model = new AvaliadorPad();

        $status = Status::listStatus();
        $users = User::all();
        $dimensoes = Dimensao::listDimensao();

        return view('avaliator-pad.create', [
            'pad' => $pad,
            'model' => $model,
            'users' => $users,
            'status' => $status,
            'dimensoes' => $dimensoes,
        ]);
    }

    public function actionEdit($id)
    {   
        $model = AvaliadorPad::find($id);
        $model->dimensoes_multiples = $model->dimensions->pluck('dimensao')->toArray();
        $pad = Pad::find($model->pad_id);

        $status = Status::listStatus();
        $users = User::all();
        $dimensoes = Dimensao::listDimensao();

        return view('avaliator-pad.update', [
            'pad' => $pad,
            'model' => $model,
            'users' => $users,
            'status' => $status,
            'dimensoes' => $dimensoes,
        ]);
    }

    public function ajaxValidation(Request $request)
    {
        return Response::json(['message' => true, 'status' => 200]);

        $validator = Validator::make(
            $request->all(),
            AvaliadorPad::rules(),
            AvaliadorPad::messages()
        );

        if ($validator->passes()) {
            return Response::json(['message' => true, 'status' => 200]);
        }

        return Response::json(['errors' => $validator->errors(), 'status' => 400]);
    }
}
