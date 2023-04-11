<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pad;
use App\Models\Tabelas\Constants;
use App\Models\Tabelas\Ensino\EnsinoAtendimentoDiscente;
use App\Models\Tabelas\Ensino\EnsinoAula;
use App\Models\Tabelas\Ensino\EnsinoCoordenacaoRegencia;
use App\Models\Tabelas\Ensino\EnsinoMembroDocente;
use App\Models\Tabelas\Ensino\EnsinoOrientacao;
use App\Models\Tabelas\Ensino\EnsinoOutros;
use App\Models\Tabelas\Ensino\EnsinoParticipacao;
use App\Models\Tabelas\Ensino\EnsinoProjeto;
use App\Models\Tabelas\Ensino\EnsinoSupervisao;
use App\Models\Tabelas\Extensao\ExtensaoCoordenacao;
use App\Models\Tabelas\Extensao\ExtensaoOrientacao;
use App\Models\Tabelas\Extensao\ExtensaoOutros;
use App\Models\Tabelas\Gestao\GestaoCoordenacaoLaboratoriosDidaticos;
use App\Models\Tabelas\Gestao\GestaoCoordenacaoProgramaInstitucional;
use App\Models\Tabelas\Gestao\GestaoMembroCamaras;
use App\Models\Tabelas\Gestao\GestaoMembroComissao;
use App\Models\Tabelas\Gestao\GestaoMembroConselho;
use App\Models\Tabelas\Gestao\GestaoMembroTitularConselho;
use App\Models\Tabelas\Gestao\GestaoOutros;
use App\Models\Tabelas\Gestao\GestaoRepresentanteUnidadeEducacao;
use App\Models\Tabelas\Pesquisa\PesquisaCoordenacao;
use App\Models\Tabelas\Pesquisa\PesquisaLideranca;
use App\Models\Tabelas\Pesquisa\PesquisaOrientacao;
use App\Models\Tabelas\Pesquisa\PesquisaOutros;
use App\Models\User;
use App\Models\UserPad;
use App\Models\UserType;
use App\Models\UserTypePad;
use App\Models\Util\Menu;
use App\Models\Util\MenuItemsAdmin;
use App\Models\Util\MenuItemsTeacher;
use App\Models\Util\Status;
use Database\Seeders\PadSeeder;
use Exception;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PadController extends Controller
{
    /**
     * Show last PAD.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if(Auth::user()->isTypeAdmin())
        {
            $users = User::initQuery()->whereType(UserType::TEACHER)->get();
            $pads = Pad::all();
            $menu = Menu::PADS;
            return view('pad.admin.index', ['menu' => $menu, 'pads' => $pads]);
        }

        if(Auth::user()->isTypeTeacher())
        {
            $menu = Menu::PADS;
            $userPads = UserPad::whereUserId(Auth::user()->id)->get();

            return view('pad.teacher.index', ['menu' => $menu, 'userPads' => $userPads]);
        }
    }

    /**
     * @param integer $id
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
        $ensinoTotalHoras =
            EnsinoAtendimentoDiscente::whereUserPadId($id)->sum('ch_semanal')
            + EnsinoAula::whereUserPadId($id)->sum('ch_semanal')
            + EnsinoCoordenacaoRegencia::whereUserPadId($id)->sum('ch_semanal')
            + EnsinoMembroDocente::whereUserPadId($id)->sum('ch_semanal')
            + EnsinoOrientacao::whereUserPadId($id)->sum('ch_semanal')
            + EnsinoOutros::whereUserPadId($id)->sum('ch_semanal')
            + EnsinoParticipacao::whereUserPadId($id)->sum('ch_semanal')
            + EnsinoProjeto::whereUserPadId($id)->sum('ch_semanal')
            + EnsinoSupervisao::whereUserPadId($id)->sum('ch_semanal');

        $gestaoTotalHoras =
            GestaoCoordenacaoLaboratoriosDidaticos::whereUserPadId($id)->sum('ch_semanal')
            + GestaoCoordenacaoProgramaInstitucional::whereUserPadId($id)->sum('ch_semanal')
            + GestaoMembroCamaras::whereUserPadId($id)->sum('ch_semanal')
            + GestaoMembroComissao::whereUserPadId($id)->sum('ch_semanal')
            + GestaoMembroConselho::whereUserPadId($id)->sum('ch_semanal')
            + GestaoMembroTitularConselho::whereUserPadId($id)->sum('ch_semanal')
            + GestaoOutros::whereUserPadId($id)->sum('ch_semanal')
            + GestaoRepresentanteUnidadeEducacao::whereUserPadId($id)->sum('ch_semanal');

        $pesquisaTotalHoras =
            PesquisaCoordenacao::whereUserPadId($id)->sum('ch_semanal')
            + PesquisaLideranca::whereUserPadId($id)->sum('ch_semanal')
            + PesquisaOrientacao::whereUserPadId($id)->sum('ch_semanal')
            + PesquisaOutros::whereUserPadId($id)->sum('ch_semanal');

        $extensaoTotalHoras =
            ExtensaoCoordenacao::whereUserPadId($id)->sum('ch_semanal')
            + ExtensaoOrientacao::whereUserPadId($id)->sum('ch_semanal')
            + ExtensaoOutros::whereUserPadId($id)->sum('ch_semanal');

        $menu = Menu::PADS;
        return view('pad.teacher.view', [
            'menu' => $menu,
            'user_pad_id' => $id,
            'gestaoTotalHoras' => $gestaoTotalHoras,
            'ensinoTotalHoras' => $ensinoTotalHoras,
            'pesquisaTotalHoras' => $pesquisaTotalHoras,
            'extensaoTotalHoras' => $extensaoTotalHoras,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menu = Menu::PADS;

        $status = [
            Status::ATIVO => Status::listStatus(Status::ATIVO)
        ];

        return view('pad.admin.create', [
            'menu' => $menu,
            'status' => $status
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => ['required', 'string', 'min:6', 'max:255'],
            'status' => ['required', 'integer'],
            'data_inicio' => ['required', 'date', 'before_or_equal:data_fim'],
            'data_fim' => ['required', 'date', 'after_or_equal:data_inicio'],
        ],
        [
            'required' => 'O campo de :attribute é obrigatório',
            'nome.min' => 'O campo de :attribute deve ter no mínimo 6 letras',
            'nome.max' => 'O campo de :attribute deve ter no máximo 255 letras',
            'data_inicio.before_or_equal' => 'A :attribute deve ser uma data anterior ou igual a data de fim',
            'data_fim.after_or_equal' => 'A :attribute deve ser uma data posterior ou igual a data de início',
        ]);

        if($validated)
        {
            $model = new Pad($request->all());

            $users = User::initQuery()->whereType(UserType::TEACHER)->get();

            if($model->save())
            {
                $users = User::initQuery()->whereType(UserType::TEACHER)->get();

                foreach($users as $user)
                {
                    $profile = $user->profile(UserType::TEACHER);

                    if($profile)
                    {
                        $userPad = new UserPad();
                        $userPad->pad_id = $model->id;
                        $userPad->user_id = $user->id;
                        $userPad->status = Status::ATIVO;

                        $userPad->save();
                    }
                }

                return redirect()->route('pad_index')->with('success', 'PAD cadastrado com sucesso!');
            } else {
                return redirect()->route('pad_index')->with('success', 'Erro ao cadastrar o PAD!');
            }
        }

    }

    public function anexo()
    {
        return view('pad.anexo', ['index_menu' => 1 ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menu = Menu::PADS;
        $pad = PAD::find($id);
        $userPads = $pad->userPads;
        $avaliatorsPads = $pad->avaliadorPads;
        $status = Constants::listStatus();


        return view('pad.admin.edit', [
            'pad' => $pad,
            'menu' => $menu,
            'status' => $status,
            'userPads' => $userPads,
            'avaliatorsPads' => $avaliatorsPads
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  integer  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nome' => ['required', 'string', 'min:6', 'max:255'],
            'status' => ['required', 'integer'],
            'data_inicio' => ['required', 'date', 'before_or_equal:data_fim'],
            'data_fim' => ['required', 'date', 'after_or_equal:data_inicio'],
        ],
        [
            'required' => 'O campo de :attribute é obrigatório',
            'nome.min' => 'O campo de :attribute deve ter no mínimo 6 letras',
            'nome.max' => 'O campo de :attribute deve ter no máximo 255 letras',
            'data_inicio.before_or_equal' => 'A :attribute deve ser uma data anterior ou igual a data de fim',
            'data_fim.after_or_equal' => 'A :attribute deve ser uma data posterior ou igual a data de início',
        ]);

        if($validated) {
            $model = Pad::find($id);
            $model->fill($request->all());

            if($model->save()) {
                return redirect()->route('pad_index')->with('success', 'PAD atualizado com sucesso!');
            } else {
                return redirect()->route('pad_index')->with('success', 'Erro ao atualizar o PAD!');
            }
        }
    }


    public function delete($id) {
        $model = Pad::find($id);

        if($model->delete()) {
            return redirect()->route('pad_index')->with('success', 'PAD removido com sucesso!');
        } else {
            return redirect()->route('pad_index')->with('fail', 'Não foi possível remover o PAD!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = PAD::find($id);
        $model->delete();

        return redirect('/pad/index');
    }
}
