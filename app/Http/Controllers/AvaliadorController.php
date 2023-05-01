<?php

namespace App\Http\Controllers;

use App\Models\Avaliacao;
use App\Models\User;
use App\Models\Curso;
use App\Models\Util\MenuItemsAvaliador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AvaliadorController extends Controller
{
    /**
     * Show last PAD.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // $professores = User::where('type', '=', User::->isTypeTeacher())->get();
        return view('pad.avaliacao.index', [
            'index_menu' => MenuItemsAvaliador::PADs,
            'professores' =>  null
        ]);
    }

    public function avaliar(Request $req)
    {
        $validated = $req->validate(
            [
                'tarefa_id' => ['required', 'integer'],
                'status' => ['required', 'integer'],
                'professor_id' => ['required', 'integer'],
                'atividade_type' => ['required', 'integer'],
                'descricao' => ['nullable', 'string'],
                'hora_reajuste' => ['nullable', 'integer'],
            ],
            [
                'required' => 'O campo de :attribute é obrigatório',
            ]
        );

        if ($validated) {
            $user = Auth::user();
            $avaliacao = Avaliacao::find($req->avaliacao_id);
            // $avaliacao = Avaliacao::where(function ($query) use ($req) {
            //     $query->where('tarefa_id', '=', $req->tarefa_id);
            //     $query->where('type', '=', $req->atividade_type);
            // })->first();

            if (!$avaliacao) {
                dd('Avaliação não encontrada');
            }

            $avaliacao->status = $req->status;
            $avaliacao->avaliador_id = $user->id;
            $avaliacao->descricao = $req->descricao ? $req->descricao : NULL;
            $avaliacao->horas_reajuste = $req->hora_reajuste;

            if ($avaliacao->save()) {
                return redirect()->back()->with(['mensage'=>'Atividade avaliada!']);
            }
        }
    }

    /**
     * @param integer $id
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {
    }

    public function anexo()
    {
        return view('pad.anexo', ['index_menu' => 1]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
    }


    public function delete($id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
