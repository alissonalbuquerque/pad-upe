<?php

namespace App\Http\Controllers;

use App\Models\AvaliadorPad;
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
        dd($request->all());

        // $validator = Validator::make(
        //     $request->all(), UserPad::rules(), UserPad::messages()
        // );

        // if($validator->fails())
        // {

        // }

        // $model = new UserPad();
        // $model->fill($request->all());
        // $model->save();

        // $pad = Pad::find($request->pad_id);

        // return redirect()
        //         ->route('pad_edit', ['id' => $request->pad_id])
        //         ->with('success', sprintf('Professor cadastrado no PAD(%s) com Sucesso!', $pad->nome));
    }

    public function actionUpdate(Request $request, $id)
    {
    }

    public function actionDelete($id)
    {
    }

    public function actionCreate($pad_id)
    {
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
