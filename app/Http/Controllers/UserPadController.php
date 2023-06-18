<?php

namespace App\Http\Controllers;

use App\Models\Pad;
use App\Models\Curso;
use App\Models\User;
use App\Models\UserPad;
use App\Models\Util\Status;
use App\Models\Util\PadTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use PDF;

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

    public function generatePDF($user_pad_id)
    {
        $userPad = UserPad::whereId($user_pad_id)->first();
        $model['ensino'] = 
            [PadTables::tablesEnsino($user_pad_id)[4]['name'] => $userPad->ensinoAtendimentoDiscentes->all(),
            PadTables::tablesEnsino($user_pad_id)[0]['name'] => $userPad->ensinoAulas->all(),
            PadTables::tablesEnsino($user_pad_id)[1]['name'] => $userPad->ensinoCoordenacaoRegencias->all(),
            PadTables::tablesEnsino($user_pad_id)[7]['name'] => $userPad->ensinoMembroDocentes->all(),
            PadTables::tablesEnsino($user_pad_id)[2]['name'] => $userPad->ensinoOrientacoes->all(),
            PadTables::tablesEnsino($user_pad_id)[8]['name'] => $userPad->ensinoOutros->all(),
            PadTables::tablesEnsino($user_pad_id)[6]['name'] => $userPad->ensinoParticipacoes->all(),
            PadTables::tablesEnsino($user_pad_id)[5]['name'] => $userPad->ensinoProjetos->all(),
            PadTables::tablesEnsino($user_pad_id)[3]['name'] => $userPad->ensinoSupervisoes->all()
            ];
        $model['extensao'] =
            [PadTables::tablesExtensao($user_pad_id)[0]['name'] => $userPad->extensaoCoordenacoes->all(),
            PadTables::tablesExtensao($user_pad_id)[1]['name'] => $userPad->extensaoOrientacoes->all(),
            PadTables::tablesExtensao($user_pad_id)[2]['name'] => $userPad->extensaoOutros->all()
            ];
        $model['gestao'] =
            [PadTables::tablesGestao($user_pad_id)[5]['name'] => $userPad->gestaoCoordenacaoLaboratoriosDidaticos->all(),
            PadTables::tablesGestao($user_pad_id)[6]['name'] => $userPad->gestaoCoordenacaoProgramasInstitucionais->all(),
            PadTables::tablesGestao($user_pad_id)[4]['name'] => $userPad->gestaoMembroCamaras->all(),
            PadTables::tablesGestao($user_pad_id)[0]['name'] => $userPad->gestaoMembroComissoes->all(),
            PadTables::tablesGestao($user_pad_id)[1]['name'] => $userPad->gestaoMembroConselhos->all(),
            PadTables::tablesGestao($user_pad_id)[2]['name'] => $userPad->gestaoMembroTitularConselhos->all(),
            PadTables::tablesGestao($user_pad_id)[7]['name'] => $userPad->gestaoOutros->all(),
            PadTables::tablesGestao($user_pad_id)[3]['name'] => $userPad->gestaoRepresentanteUnidadeEducacoes->all()
            ];
        $model['pesquisa'] =
            [PadTables::tablesPesquisa($user_pad_id)[0]['name'] => $userPad->pesquisaCoordenacoes->all(), 
            PadTables::tablesPesquisa($user_pad_id)[1]['name'] => $userPad->pesquisaLiderancas->all(),
            PadTables::tablesPesquisa($user_pad_id)[2]['name'] => $userPad->pesquisaOrientacoes->all(),
            PadTables::tablesPesquisa($user_pad_id)[3]['name'] => $userPad->pesquisaOutros->all()
            ];
        $dateTime = now()->format('d-m-Y (H:i:s)');
        dd(
            PadTables::tablesEnsino($user_pad_id)[0]['name'],
            $model,
            "$dateTime",
            empty($model['ensino'][0])
        );
        return view();
        // view()->share($model);
        // $pdf = PDF::loadView('', $model);

        // return $pdf->download("Relatório PAD: ");
    }

}
