<?php

namespace App\Http\Controllers;

use App\Models\Pad;
use App\Models\User;
use App\Models\UserPad;
use App\Models\Util\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class UserPadController extends Controller
{
    public function actionStore(Request $request)
    {
        $validator = Validator::make(
            $request->all(), UserPad::rules(), UserPad::messages()
        );

        if($validator->fails())
        {

        }

        $model = new UserPad();
        $model->fill($request->all());
        $model->save();

        $pad = Pad::find($request->pad_id);

        return redirect()
                ->route('pad_edit', ['id' => $request->pad_id])
                ->with('success', sprintf('Professor cadastrado no PAD(%s) com Sucesso!', $pad->nome));
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
        $model = new UserPad();
        $status = Status::listStatus();
        $users = User::all();

        return view('user-pad.create', [
            'pad' => $pad,
            'model' => $model,
            'users' => $users,
            'status' => $status,
        ]);
    }

    public function actionEdit($id)
    {

    }

    public function ajaxValidation(Request $request)
    {   
        $validator = Validator::make(
            $request->all(), UserPad::rules(), UserPad::messages()
        );

        if($validator->passes()) {
            return Response::json(['message' => true, 'status' => 200]);
        }

        return Response::json(['errors' => $validator->errors(), 'status' => 400]);
    }
}
