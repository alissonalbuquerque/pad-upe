<?php

namespace App\Http\Controllers;

use App\Models\TaskTime;
use App\Models\Util\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class TaskTimeController extends Controller
{
    public function index($user_pad_id)
    {
        $menu = Menu::PADS;

        return view('task-time.index', [
            'menu' => $menu,
            'user_pad_id' => $user_pad_id
        ]);
    }

    public function create($user_pad_id) {
        return view('task-time.create', [
            'user_pad_id' => $user_pad_id]
        );
    }

    public function save(Request $request) {

        $model = new TaskTime($request->all());

        if($model->save()) {
            return redirect()
                ->route('task_time_index', ['user_pad_id' => $model->user_pad_id])
                ->with('success', 'Cadastro realizado com sucesso!');
        }
    }

    public function edit($id) {
        $model = TaskTime::find($id);
        return view('task-time.update', [
            'model' => $model
        ]);
    }

    public function update($id, Request $request) {

        $request->merge(['start_time' => TaskTime::traitHour($request->get('start_time'))]);
        $request->merge(['end_time' => TaskTime::traitHour($request->get('end_time'))]);

        $model = TaskTime::find($id);
        $model->fill($request->all());

        if($model->save()) {
            return redirect()
                ->route('task_time_index', ['user_pad_id' => $model->user_pad_id])
                ->with('success', 'Atualizado com sucesso!');
        }

        return redirect()
            ->route('task_time_index', ['user_pad_id' => $model->user_pad_id])
            ->with('fail', 'Erro ao Atualizar!');
        
    }

    public function delete($id) {
        
        $model = TaskTime::find($id);

        if($model->delete()) {
            return redirect()
                ->route('task_time_index', ['user_pad_id' => $model->user_pad_id])
                ->with('success', 'Deletado com sucesso!');
        }

        return redirect()
            ->route('task_time_index', ['user_pad_id' => $model->user_pad_id])
            ->with('fail', 'Erro ao Deletar!');

    }

    public function searchTask(Request $request) {

        $type = $request->get('type');
        $tarefa_id = $request->get('tarefa_id');

        $model = new TaskTime();
        $model->tarefa_id = $tarefa_id;
        $model->type = $type;

        $attributes = $model->tarefa->getAttributes();

        return Response::json(['task' => $attributes]);
    }

    public function ajaxValidation(Request $request)
    {
        $request->merge(['start_time' => TaskTime::traitHour($request->get('start_time'))]);
        $request->merge(['end_time' => TaskTime::traitHour($request->get('end_time'))]);

        $attributes = [
            'id' => $request->get('id'),
            'user_pad_id' => $request->get('user_pad_id'),
            'tarefa_id' => $request->get('tarefa_id'),
            'type' => $request->get('type'),
            'weekday' => $request->get('weekday'),
            'start_time' => $request->get('start_time'),
            'end_time' => $request->get('end_time'),
        ];

        $validator = Validator::make($request->all(), TaskTime::rules($attributes), TaskTime::messages());

        if($validator->passes()) {
            return Response::json(['message' => true, 'status' => 200]);
        }

        return Response::json(['errors' => $validator->errors(), 'status' => 400]);
    }
}
