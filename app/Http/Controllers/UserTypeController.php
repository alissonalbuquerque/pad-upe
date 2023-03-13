<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserType;
use App\Models\Util\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class UserTypeController extends Controller
{   
    public function actionStore(Request $request)
    {   
        $validator = Validator::make($request->all(), UserType::rules(), UserType::messages());

        $profiles = UserType::whereUserId($request->user_id)->get();
        $profiles->each(function(UserType $model) {
            $model->selected = false;
            $model->save();
        });

        $modelDeleted = UserType::whereUserId($request->user_id)->whereType($request->type)->onlyTrashed()->first();

        if($modelDeleted)
        {   
            $modelDeleted->restore();
            $modelDeleted->status = $request->status;
            $modelDeleted->selected = true;
            $modelDeleted->save();

            return redirect()
                ->route('user_edit', ['id' => $request->user_id, 'tab_active' => 'paper'])
                ->with('success', 'Papel cadastrado com Sucesso!');
        }

        $model = new UserType();
        $model->fill($request->all());
        $model->selected = true;
        $model->save();

        return redirect()
                ->route('user_edit', ['id' => $request->user_id, 'tab_active' => 'paper'])
                ->with('success', 'Papel cadastrado com Sucesso!');
    }

    public function actionUpdate(Request $request, $id)
    {   
        $model = UserType::find($id);
        $model->status = $request->status;
        //voltar e corrigir expressao logica
        if($model->status == Status::INATIVO) {
            $model->selected = false;
        }
        $model->save();

        return redirect()
                ->route('user_edit', ['id' => $request->user_id, 'tab_active' => 'paper'])
                ->with('success', 'Papel atualizado com Sucesso!');
    }

    public function actionDelete($id)
    {
        $model = UserType::find($id);
        $model->selected = false;
        $model->delete();

        return redirect()
            ->route('user_edit', ['id' => $model->user_id, 'tab_active' => 'paper'])
            ->with('success', 'Papel removido com Sucesso!');
    }

    public function actionCreate($user_id)
    {   
        $model = new UserType();
        $user = User::find($user_id);
        $types = UserType::listType();
        $status = Status::listUserTypeStatus();

        return view('user-type.create', [
            'user' => $user,
            'model' => $model,
            'types' => $types,
            'status' => $status,
            'operation' => 'create'
        ]);
    }

    public function actionEdit($id)
    {   
        $model = UserType::find($id);
        $user = $model->user;
        $types = UserType::listType();
        $status = Status::listUserTypeStatus();

        return view('user-type.update', [
            'user' => $user,
            'model' => $model,
            'types' => $types,
            'status' => $status,
            'operation' => 'update',
        ]);
    }

    public function ajaxValidation(Request $request)
    {   
        $id = $request->id;
        $user_id = $request->user_id;
        $type = $request->type;
        $operation = $request->operation;
        
        $validator = Validator::make(
            $request->all(), UserType::rules($id, $user_id, $type, $operation), UserType::messages()
        );

        if($validator->passes()) {
            return Response::json(['message' => true, 'status' => 200]);
        }

        return Response::json(['errors' => $validator->errors(), 'status' => 400]);
    }
}
