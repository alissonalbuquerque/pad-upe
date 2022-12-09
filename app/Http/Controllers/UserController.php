<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Util\Menu;
use App\Models\Util\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use NunoMaduro\Collision\Adapters\Phpunit\State;

class UserController extends Controller
{   
    public function editPerfil() {
        return view('user.update_perfil', ['menu' => Menu::USER]);
    }

    public function updatePerfil(Request $request) {

        $validator = User::validator($request->all());

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $user = User::find(Auth::user()->id);
        $user->fill($request->all());
        $user->save();
        
        return redirect()->route('edit_perfil')->with('success', 'Salvo com sucesso!');

    }

    public function updatePassword(Request $request) {

        $validator = User::validator($request->all(), true);

        // if($validator->fails()) {
        //     return redirect()->back()->withErrors($validator->errors());
        // }

        // $user = User::find(Auth::user()->id);
        // $user->fill($request->all());
        // $user->save();
        
        // return redirect()->route('edit_perfil')->with('success', 'Salvo com sucesso!');

    }

    public function actionIndex(Request $request)
    {   
        $users = 
            User::initQuery();

        $users = $users->get();
        return view('users.index', [
            'users' => $users,
            'menu' => Menu::USERS,
        ]);
    }

    public function actionCreate(Request $request)
    {
        return view('users.create', [
            'menu' => Menu::USERS,
        ]);
    }

    public function actionStore(Request $request)
    {
        dd($request->all());
    }

    public function actionEdit($id, Request $request)
    {

    }

    public function actionUpdate($id, Request $request)
    {

    }

    public function actionDelete($id) {

    }
}
