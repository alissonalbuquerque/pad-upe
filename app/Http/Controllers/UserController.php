<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    const MENU_UPDATE_PERFIL = 0;

    public function editPerfil()
    {
        return view('user.update_perfil', ['index_menu' => self::MENU_UPDATE_PERFIL]);
    }

    public function updatePerfil(Request $request)
    {

        $validator = User::validator($request->all());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $user = User::find(Auth::user()->id);
        $user->fill($request->all());
        $user->save();

        return redirect()->route('edit_perfil')->with('success', 'Salvo com sucesso!');

    }

    public function updatePassword(Request $request)
    {

        $validator = User::validator($request->all(), true);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $user = User::find(Auth::user()->id);
        $newData = $request->all();

        if($request->all()['password'] == $request->all()['password_confirmation']){
            $newData['password'] = Hash::make($request->password);
        }
        
        $user->fill($newData);
        $user->save();

        return redirect()->route('edit_perfil')->with('success', 'Salvo com sucesso!');
    }
}