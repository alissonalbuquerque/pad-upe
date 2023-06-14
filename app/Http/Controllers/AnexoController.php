<?php

namespace App\Http\Controllers;

use App\Models\Anexo;
use App\Models\UserPad;
use App\Models\Util\Menu;
use App\Models\Util\YesOrNo;
use Illuminate\Http\Request;

class AnexoController extends Controller
{
    public function edit($user_pad_id)
    {   
        $model = Anexo::whereUserPadId($user_pad_id)->first();
        $model = $model ?? new Anexo();

        $userPad = UserPad::whereId($user_pad_id)->first();
        $menu = Menu::PADS;
        $yesOrNo = YesOrNo::listYesOrNo();
        $semestres = Anexo::listSemestre();
        $categorias = Anexo::listCategoria();

        return view('pad.anexo.update', [
            'userPad' => $userPad,
            'model' => $model,
            'menu' => $menu,
            'yesOrNo' => $yesOrNo,
            'semestres' => $semestres,
            'categorias' => $categorias,
            'user_pad_id' => $user_pad_id
        ]);
    }

    public function update(Request $request, $user_pad_id)
    {   
        $model = Anexo::whereUserPadId($user_pad_id)->first();
        $model = $model ?? new Anexo();
        $model->fill($request->all());

        $model->save();

        session()->flash('success', 'Anexo atualizado com sucesso!');
        return redirect()->route('edit_anexo', ['user_pad_id' => $user_pad_id]);
    }
}
