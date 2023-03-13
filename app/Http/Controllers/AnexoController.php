<?php

namespace App\Http\Controllers;

use App\Models\Anexo;
use App\Models\Util\Menu;
use App\Models\Util\YesOrNo;
use Illuminate\Http\Request;

class AnexoController extends Controller
{
    public function edit($user_pad_id)
    {
        $model = Anexo::whereUserPadId($user_pad_id)->first();
        $menu = Menu::PADS;
        $yesOrNo = YesOrNo::listYesOrNo();
        $semestres = Anexo::listSemestre();
        $categorias = Anexo::listCategoria();

        //usado para testes;
        $model = new Anexo();

        return view('pad.anexo.update', [
            'model' => $model,
            'menu' => $menu,
            'yesOrNo' => $yesOrNo,
            'semestres' => $semestres,
            'categorias' => $categorias,
        ]);
    }

    //implementar Request com FormRequest
    public function update(Request $request, $user_pad_id)
    {
        dd($request->all());
    }
}
