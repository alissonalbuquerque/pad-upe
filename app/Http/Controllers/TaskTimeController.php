<?php

namespace App\Http\Controllers;

use App\Models\TaskTime;
use App\Models\Util\Menu;
use Illuminate\Http\Request;

class TaskTimeController extends Controller
{
    public function index($user_pad_id)
    {
        $menu = Menu::PADS;

        $taskTimes = TaskTime::whereUserPadId($user_pad_id)->get();

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

        $array = TaskTime::splitTarefaAndType($request->get('tarefa_id'));

        dd($request->get('tarefa_id'), $array);
    }

    public function updateView() {

    }

    public function update() {

    }

    public function delete() {
        
    }
}
