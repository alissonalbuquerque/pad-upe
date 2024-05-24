<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\UserPadController;
use App\Models\Avaliacao;
use App\Models\AvaliadorPad;
use App\Models\AvaliadorPadDimensao;
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
use App\Models\TaskTime;
use App\Models\User;
use App\Models\UserPad;
use App\Models\UserType;
use App\Models\UserTypePad;
use App\Models\Util\Avaliacao as AvaliacaoUtil;
use App\Models\Util\Dimensao;
use App\Models\Util\Menu;
use App\Models\Util\MenuItemsAdmin;
use App\Models\Util\MenuItemsTeacher;
use App\Models\Util\Status;
use App\Models\Util\MenuItemsAvaliador;
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
        if (Auth::user()->isTypeAdmin()) {
            $users = User::initQuery()->whereType(UserType::TEACHER)->get();
            $pads = Pad::all();
            $menu = Menu::PADS;
            return view('pad.admin.index', ['menu' => $menu, 'pads' => $pads]);
        }

        if (Auth::user()->isTypeTeacher()) {
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
        $validated = $request->validate(
            [
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
            ]
        );

        if ($validated) {
            $model = new Pad($request->all());

            $users = User::initQuery()->whereType(UserType::TEACHER)->get();

            if ($model->save()) {
                $users = User::initQuery()->whereType(UserType::TEACHER)->get();

                foreach ($users as $user) {
                    $profile = $user->profile(UserType::TEACHER);

                    if ($profile) {
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
        $menu = Menu::PADS;
        $pad = PAD::find($id);
        $userPads = $pad->userPads()->paginate(50);
        $avaliatorsPads = $pad->avaliadorPads;
        $status = Constants::listStatus();

        

        //Se a página atual for 1 remova o previous
        //Se a página atual for lastPage remova o next
        //Se houver um page="" no query selecionar a opção de professor por padrão [list]
        //Criar variavel para retornar o active tab selecionado

        // dd($pad->id);
        // dd($userPads, $userPads->links());

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
        $validated = $request->validate(
            [
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
            ]
        );

        if ($validated) {
            $model = Pad::find($id);
            $model->fill($request->all());

            if ($model->save()) {
                return redirect()->route('pad_index')->with('success', 'PAD atualizado com sucesso!');
            } else {
                return redirect()->route('pad_index')->with('success', 'Erro ao atualizar o PAD!');
            }
        }
    }


    public function delete($id)
    {
        $model = Pad::find($id);

        if ($model->delete()) {
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

    public function professores($id)
    {
        $user = Auth::user();
        $pad = Pad::find($id);
        $index_menu = MenuItemsAvaliador::HOME;

        // [$user_id, $campus_id, $pad_id, $status_active] = [$user->id, $user->campus_id, $pad->id, PAD::STATUS_ATIVO];
        // $professores =
        //         User::join('user_pad', 'user_pad.user_id', '=', 'users.id')
        //             ->join('pad', 'user_pad.pad_id', '=', 'pad.id')
        //             ->where(function ($query) use ($user_id, $campus_id, $pad_id, $status_active)
        //             {
        //                 $query->where('pad.status', '=', $status_active);
        //                 $query->where('users.campus_id', '=', $campus_id);
        //                 $query->where('users.id', '!=', $user_id);
        //                 $query->where('pad.id', '=', $pad_id);
        //             })
        //             ->select('users.id', 'users.name', 'users.email')
        //             ->orderBy('users.name')
        //             ->limit(10)
        //             ->get();

        // dd($professores);

       $professores = User::join('user_pad', 'user_pad.user_id', '=', 'users.id')
           ->join('pad', 'user_pad.pad_id', '=', 'pad.id')
           ->where(function ($query) use ($user, $id) {
               $query->where('pad.status', '=', Status::ATIVO);
               $query->where('users.campus_id', '=', $user->campus_id);
               $query->where('users.id', '!=', $user->id);
               $query->where('pad.id', '=', $id);
           })
           ->select('users.id', 'users.name')
           ->orderBy('name')
           ->get();

       //Informando se o PAD foi enviado ou não
       $avaliador_pad = AvaliadorPad::where(function ($query) use ($pad, $user) {
           $query->where('user_id', '=', $user->id);
           $query->where('pad_id', '=', $pad->id);
       })->first();


       foreach ($professores as $professor){
           $professor->status = "Pendente";
           $userPad = $professor->userPads()->where('pad_id', '=', $pad->id)->first();

           $avaliacoes = $this->get_avaliacoes($userPad, $avaliador_pad);

           $avaliacoes_ensino = !empty($avaliacoes['ensino']) ? $avaliacoes['ensino'] : null;
           $avaliacoes_pesquisa = !empty($avaliacoes['pesquisa']) ? $avaliacoes['pesquisa'] : null;
           $avaliacoes_extensao = !empty($avaliacoes['extensao']) ? $avaliacoes['extensao'] : null;
           $avaliacoes_gestao = !empty($avaliacoes['gestao']) ? $avaliacoes['gestao'] : null;


           $avaliacoes_ensino_all = $avaliacoes_ensino? $avaliacoes_ensino->all() : null;
           $avaliacoes_pesquisa_all = $avaliacoes_pesquisa? $avaliacoes_pesquisa->all() : null;
           $avaliacoes_extensao_all = $avaliacoes_extensao? $avaliacoes_extensao->all() : null;
           $avaliacoes_gestao_all = $avaliacoes_gestao? $avaliacoes_gestao->all() : null;


           if($avaliacoes_ensino_all || $avaliacoes_pesquisa_all || $avaliacoes_extensao_all || $avaliacoes_gestao_all) {
               $professor->status = "Enviado";
           }

           $professor->ch = $this->get_carga_horaria_total($avaliacoes);
           $professor->ch_corrigida = $this->get_carga_horaria_corrigida($avaliacoes_ensino, $avaliacoes_pesquisa, $avaliacoes_extensao, $avaliacoes_gestao);
       }

        return view("pad.avaliacao.professores", compact('professores', 'pad', 'index_menu'));
    }
    
    public function view_calender($id) {

        $user_pad_ids = explode("-", $id);

        $pad_data = explode("_", $user_pad_ids[0]);
        $user_data = explode("_", $user_pad_ids[1]);
        
        [$pad_id, $user_id] = [$pad_data[1], $user_data[1]];
        
        $user_pad = UserPad::where("pad_id", "=", "{$pad_id}")->where("user_id", "=", "{$user_id}")->first();

        return view("pad.avaliacao.view_modal", ['user_pad' => $user_pad]);
    }

    public function professor_atividades($id, $professor_id, $aba=null)
    {
        $pad = Pad::find($id);
        $user = Auth::user();
        $index_menu = MenuItemsAvaliador::HOME;
        $avaliador_pad = AvaliadorPad::where(function ($query) use ($pad, $user) {
            $query->where('user_id', '=', $user->id);
            $query->where('pad_id', '=', $pad->id);
        })->first();

        $professor = User::find($professor_id);
        $user_pad = UserPad::where(function ($query) use ($pad, $professor) {
            $query->where('user_id', '=', $professor->id);
            $query->where('pad_id', '=', $pad->id);
        })->first();

        $niveis = Constants::listNivel();
        $modalidades = Constants::listModalidade();
        $status = Status::listStatus();

        $avaliacoes = $this->get_avaliacoes_with_pagination($user_pad, $avaliador_pad);
        $avaliacoes_ensino   = !empty($avaliacoes['ensino']) && $avaliacoes['ensino']->count()     ? $avaliacoes['ensino']->paginate(5)   : [];
        $avaliacoes_pesquisa = !empty($avaliacoes['pesquisa']) && $avaliacoes['pesquisa']->count() ? $avaliacoes['pesquisa']->paginate(5) : [];
        $avaliacoes_extensao = !empty($avaliacoes['extensao']) && $avaliacoes['extensao']->count() ? $avaliacoes['extensao']->paginate(5) : [];
        $avaliacoes_gestao   = !empty($avaliacoes['gestao'])   && $avaliacoes['gestao']->count()   ? $avaliacoes['gestao']->paginate(5)   : [];

        //Informando quais tipos (ensino, pesquisa, extensão ou gestão) de atividades podem ser avaliadas pelo usuário logado.
        $avalPad = $user->avaliadorPad()->first();

        $dimensoes = [];
        foreach ($avalPad->dimensions()->get() as $dimensao){
            array_push($dimensoes, $dimensao->dimensao);
        }
        // dd($aba);
        if($aba == null){
            $caminho = 'pad.avaliacao.tarefas_'.Dimensao::getDimensaoToRoute($dimensoes[0]);
        } else {
            $caminho = 'pad.avaliacao.tarefas_'.$aba;
        }

        return view($caminho, compact('pad', 'index_menu', 'professor', 'avaliacoes_ensino', 'avaliacoes_pesquisa', 'avaliacoes_extensao', 'avaliacoes_gestao', 'niveis', 'modalidades'));
    }

    private function add_tipo_atividade($query, $type)
    {
        foreach ($query as &$atividade) {
            $atividade['tipo_atividade'] = $type;
        }

        return $query;
    }

    private function get_avaliacoes($user_pad, $avaliador_pad)
    {
        $avaliacoes_ensino = [];
        $avaliacoes_pesquisa = [];
        $avaliacoes_extensao = [];
        $avaliacoes_gestao = [];

        $dimensoes_permitidas = AvaliadorPadDimensao::where(
            'avaliador_pad_id', '=', $avaliador_pad->id)
            ->select('avaliador_pad_dimensao.dimensao')
            ->get();

        $dimensoes = [];

        foreach ($dimensoes_permitidas as $dimensao) {
            array_push($dimensoes, $dimensao->dimensao);
        }


        if (in_array(Dimensao::ENSINO, $dimensoes)) {

            $ensino_grouped_ids = [
                [
                    'ids' => EnsinoAtendimentoDiscente::whereUserPadId($user_pad->id)->pluck('id')->toArray(),
                    'type' => AvaliacaoUtil::ENSINO_ATENDIMENTO_DISCENTE
                ],
                [
                    'ids' => EnsinoAula::whereUserPadId($user_pad->id)->pluck('id')->toArray(),
                    'type' => AvaliacaoUtil::ENSINO_AULA
                ],
                [
                    'ids' => EnsinoCoordenacaoRegencia::whereUserPadId($user_pad->id)->pluck('id')->toArray(),
                    'type' => AvaliacaoUtil::ENSINO_COORDENACAO_REGENCIA
                ],
                [
                    'ids' => EnsinoMembroDocente::whereUserPadId($user_pad->id)->pluck('id')->toArray(),
                    'type' => AvaliacaoUtil::ENSINO_MEMBRO_DOCENTE
                ],
                [
                    'ids' => EnsinoOrientacao::whereUserPadId($user_pad->id)->pluck('id')->toArray(),
                    'type' => AvaliacaoUtil::ENSINO_ORIENTACAO
                ],
                [
                    'ids' => EnsinoOutros::whereUserPadId($user_pad->id)->pluck('id')->toArray(),
                    'type' => AvaliacaoUtil::ENSINO_OUTROS
                ],
                [
                    'ids' => EnsinoParticipacao::whereUserPadId($user_pad->id)->pluck('id')->toArray(),
                    'type' => AvaliacaoUtil::ENSINO_PARTICIPACAO
                ],
                [
                    'ids' => EnsinoProjeto::whereUserPadId($user_pad->id)->pluck('id')->toArray(),
                    'type' => AvaliacaoUtil::ENSINO_PROJETO
                ],
                [
                    'ids' => EnsinoSupervisao::whereUserPadId($user_pad->id)->pluck('id')->toArray(),
                    'type' => AvaliacaoUtil::ENSINO_SUPERVISAO
                ],
            ];

            //
            $avaliacoes_ensino_ids = [];
            foreach($ensino_grouped_ids as $ensino_group)
            {
                $avaliacao_ids = Avaliacao::whereIn('tarefa_id', $ensino_group['ids'])->whereType($ensino_group['type'])->pluck('id')->toArray();

                $avaliacoes_ensino_ids = array_merge($avaliacoes_ensino_ids, $avaliacao_ids);
            }

            $avaliacoes_ensino = Avaliacao::whereIn('id', $avaliacoes_ensino_ids)->orderBy('status')->get();
            //
        }

        if (in_array(Dimensao::PESQUISA, $dimensoes)) {

            $pesquisa_grouped_ids = [
                [
                    'ids' => PesquisaCoordenacao::whereUserPadId($user_pad->id)->pluck('id')->toArray(),
                    'type' => AvaliacaoUtil::PESQUISA_COORDENACAO
                ],
                [
                    'ids' => PesquisaLideranca::whereUserPadId($user_pad->id)->pluck('id')->toArray(),
                    'type' => AvaliacaoUtil::PESQUISA_LIDERANCA
                ],
                [
                    'ids' => PesquisaOrientacao::whereUserPadId($user_pad->id)->pluck('id')->toArray(),
                    'type' => AvaliacaoUtil::PESQUISA_ORIENTACAO
                ],
                [
                    'ids' => PesquisaOutros::whereUserPadId($user_pad->id)->pluck('id')->toArray(),
                    'type' => AvaliacaoUtil::PESQUISA_OUTROS
                ],
            ];

            $avaliacoes_pesquisa_ids = [];
            foreach($pesquisa_grouped_ids as $pesquisa_group)
            {
                $avaliacao_ids = Avaliacao::whereIn('tarefa_id', $pesquisa_group['ids'])->whereType($pesquisa_group['type'])->pluck('id')->toArray();

                $avaliacoes_pesquisa_ids = array_merge($avaliacoes_pesquisa_ids, $avaliacao_ids);
            }

            $avaliacoes_pesquisa = Avaliacao::whereIn('id', $avaliacoes_pesquisa_ids)->orderBy('status')->get();
        }

        if (in_array(Dimensao::EXTENSAO, $dimensoes)) {

            $extensao_grouped_ids = [
                [
                    'ids' => ExtensaoCoordenacao::whereUserPadId($user_pad->id)->pluck('id')->toArray(),
                    'type' => AvaliacaoUtil::EXTENSAO_COORDENACAO
                ],
                [
                    'ids' => ExtensaoOrientacao::whereUserPadId($user_pad->id)->pluck('id')->toArray(),
                    'type' => AvaliacaoUtil::EXTENSAO_ORIENTACAO
                ],
                [
                    'ids' => ExtensaoOutros::whereUserPadId($user_pad->id)->pluck('id')->toArray(),
                    'type' => AvaliacaoUtil::EXTENSAO_OUTROS
                ]
            ];

            $avaliacoes_extensao_ids = [];
            foreach($extensao_grouped_ids as $extensao_group)
            {
                $avaliacao_ids = Avaliacao::whereIn('tarefa_id', $extensao_group['ids'])->whereType($extensao_group['type'])->pluck('id')->toArray();

                $avaliacoes_extensao_ids = array_merge($avaliacoes_extensao_ids, $avaliacao_ids);
            }

            $avaliacoes_extensao = Avaliacao::whereIn('id', $avaliacoes_extensao_ids)->orderBy('status')->get();
        }

        if (in_array(Dimensao::GESTAO, $dimensoes)) {

            $gestao_grouped_ids = [
                [
                    'ids' => GestaoCoordenacaoLaboratoriosDidaticos::whereUserPadId($user_pad->id)->pluck('id')->toArray(),
                    'type' => AvaliacaoUtil::GESTAO_COORDENACAO_LABORATORIOS_DIDATICOS,
                ],
                [
                    'ids' => GestaoCoordenacaoProgramaInstitucional::whereUserPadId($user_pad->id)->pluck('id')->toArray(),
                    'type' => AvaliacaoUtil::GESTAO_COORDENACAO_PROGRAMA_INSTITUCIONAL
                ],
                [
                    'ids' => GestaoMembroCamaras::whereUserPadId($user_pad->id)->pluck('id')->toArray(),
                    'type' => AvaliacaoUtil::GESTAO_MEMBRO_CAMARAS
                ],
                [
                    'ids' => GestaoMembroComissao::whereUserPadId($user_pad->id)->pluck('id')->toArray(),
                    'type' => AvaliacaoUtil::GESTAO_MEMBRO_COMISSAO
                ],
                [
                    'ids' => GestaoMembroConselho::whereUserPadId($user_pad->id)->pluck('id')->toArray(),
                    'type' => AvaliacaoUtil::GESTAO_MEMBRO_CONSELHO
                ],
                [
                    'ids' => GestaoMembroTitularConselho::whereUserPadId($user_pad->id)->pluck('id')->toArray(),
                    'type' => AvaliacaoUtil::GESTAO_MEMBRO_TITULAR_CONSELHO
                ],
                [
                    'ids' => GestaoOutros::whereUserPadId($user_pad->id)->pluck('id')->toArray(),
                    'type' => AvaliacaoUtil::GESTAO_OUTROS
                ],
                [
                    'ids' => GestaoRepresentanteUnidadeEducacao::whereUserPadId($user_pad->id)->pluck('id')->toArray(),
                    'type' => AvaliacaoUtil::GESTAO_REPRESENTANTE_UNIDADE_EDUCACAO
                ]
            ];

            $avaliacoes_gestao_ids = [];
            foreach($gestao_grouped_ids as $gestao_group)
            {
                $avaliacao_ids = Avaliacao::whereIn('tarefa_id', $gestao_group['ids'])->whereType($gestao_group['type'])->pluck('id')->toArray();

                $avaliacoes_gestao_ids = array_merge($avaliacoes_gestao_ids, $avaliacao_ids);
            }

            $avaliacoes_gestao = Avaliacao::whereIn('id', $avaliacoes_gestao_ids)->orderBy('status')->get();
        }


        return [
            'ensino'   => $avaliacoes_ensino,
            'pesquisa' => $avaliacoes_pesquisa,
            'extensao' => $avaliacoes_extensao,
            'gestao'   => $avaliacoes_gestao
        ];
    }

    private function get_avaliacoes_with_pagination($user_pad, $avaliador_pad)
    {
        $avaliacoes_ensino = [];
        $avaliacoes_pesquisa = [];
        $avaliacoes_extensao = [];
        $avaliacoes_gestao = [];

        $dimensoes_permitidas = AvaliadorPadDimensao::where(
            'avaliador_pad_id', '=', $avaliador_pad->id)
            ->select('avaliador_pad_dimensao.dimensao')
            ->get();

        $dimensoes = [];

        foreach ($dimensoes_permitidas as $dimensao) {
            array_push($dimensoes, $dimensao->dimensao);
        }

        if (in_array(Dimensao::ENSINO, $dimensoes)) {

            $ensino_grouped_ids = [
                [
                    'ids' => EnsinoAtendimentoDiscente::whereUserPadId($user_pad->id)->pluck('id')->toArray(),
                    'type' => AvaliacaoUtil::ENSINO_ATENDIMENTO_DISCENTE
                ],
                [
                    'ids' => EnsinoAula::whereUserPadId($user_pad->id)->pluck('id')->toArray(),
                    'type' => AvaliacaoUtil::ENSINO_AULA
                ],
                [
                    'ids' => EnsinoCoordenacaoRegencia::whereUserPadId($user_pad->id)->pluck('id')->toArray(),
                    'type' => AvaliacaoUtil::ENSINO_COORDENACAO_REGENCIA
                ],
                [
                    'ids' => EnsinoMembroDocente::whereUserPadId($user_pad->id)->pluck('id')->toArray(),
                    'type' => AvaliacaoUtil::ENSINO_MEMBRO_DOCENTE
                ],
                [
                    'ids' => EnsinoOrientacao::whereUserPadId($user_pad->id)->pluck('id')->toArray(),
                    'type' => AvaliacaoUtil::ENSINO_ORIENTACAO
                ],
                [
                    'ids' => EnsinoOutros::whereUserPadId($user_pad->id)->pluck('id')->toArray(),
                    'type' => AvaliacaoUtil::ENSINO_OUTROS
                ],
                [
                    'ids' => EnsinoParticipacao::whereUserPadId($user_pad->id)->pluck('id')->toArray(),
                    'type' => AvaliacaoUtil::ENSINO_PARTICIPACAO
                ],
                [
                    'ids' => EnsinoProjeto::whereUserPadId($user_pad->id)->pluck('id')->toArray(),
                    'type' => AvaliacaoUtil::ENSINO_PROJETO
                ],
                [
                    'ids' => EnsinoSupervisao::whereUserPadId($user_pad->id)->pluck('id')->toArray(),
                    'type' => AvaliacaoUtil::ENSINO_SUPERVISAO
                ],
            ];

            //
            $avaliacoes_ensino_ids = [];
            foreach($ensino_grouped_ids as $ensino_group)
            {
                $avaliacao_ids = Avaliacao::whereIn('tarefa_id', $ensino_group['ids'])->whereType($ensino_group['type'])->pluck('id')->toArray();

                $avaliacoes_ensino_ids = array_merge($avaliacoes_ensino_ids, $avaliacao_ids);
            }

            $avaliacoes_ensino = Avaliacao::whereIn('id', $avaliacoes_ensino_ids)->orderBy('status');
            //
        }

        if (in_array(Dimensao::PESQUISA, $dimensoes)) {

            $pesquisa_grouped_ids = [
                [
                    'ids' => PesquisaCoordenacao::whereUserPadId($user_pad->id)->pluck('id')->toArray(),
                    'type' => AvaliacaoUtil::PESQUISA_COORDENACAO
                ],
                [
                    'ids' => PesquisaLideranca::whereUserPadId($user_pad->id)->pluck('id')->toArray(),
                    'type' => AvaliacaoUtil::PESQUISA_LIDERANCA
                ],
                [
                    'ids' => PesquisaOrientacao::whereUserPadId($user_pad->id)->pluck('id')->toArray(),
                    'type' => AvaliacaoUtil::PESQUISA_ORIENTACAO
                ],
                [
                    'ids' => PesquisaOutros::whereUserPadId($user_pad->id)->pluck('id')->toArray(),
                    'type' => AvaliacaoUtil::PESQUISA_OUTROS
                ],
            ];

            $avaliacoes_pesquisa_ids = [];
            foreach($pesquisa_grouped_ids as $pesquisa_group)
            {
                $avaliacao_ids = Avaliacao::whereIn('tarefa_id', $pesquisa_group['ids'])->whereType($pesquisa_group['type'])->pluck('id')->toArray();

                $avaliacoes_pesquisa_ids = array_merge($avaliacoes_pesquisa_ids, $avaliacao_ids);
            }

            $avaliacoes_pesquisa = Avaliacao::whereIn('id', $avaliacoes_pesquisa_ids)->orderBy('status');
        }

        if (in_array(Dimensao::EXTENSAO, $dimensoes)) {

            $extensao_grouped_ids = [
                [
                    'ids' => ExtensaoCoordenacao::whereUserPadId($user_pad->id)->pluck('id')->toArray(),
                    'type' => AvaliacaoUtil::EXTENSAO_COORDENACAO
                ],
                [
                    'ids' => ExtensaoOrientacao::whereUserPadId($user_pad->id)->pluck('id')->toArray(),
                    'type' => AvaliacaoUtil::EXTENSAO_ORIENTACAO
                ],
                [
                    'ids' => ExtensaoOutros::whereUserPadId($user_pad->id)->pluck('id')->toArray(),
                    'type' => AvaliacaoUtil::EXTENSAO_OUTROS
                ]
            ];

            $avaliacoes_extensao_ids = [];
            foreach($extensao_grouped_ids as $extensao_group)
            {
                $avaliacao_ids = Avaliacao::whereIn('tarefa_id', $extensao_group['ids'])->whereType($extensao_group['type'])->pluck('id')->toArray();

                $avaliacoes_extensao_ids = array_merge($avaliacoes_extensao_ids, $avaliacao_ids);
            }

            $avaliacoes_extensao = Avaliacao::whereIn('id', $avaliacoes_extensao_ids)->orderBy('status');
        }

        if (in_array(Dimensao::GESTAO, $dimensoes)) {

            $gestao_grouped_ids = [
                [
                    'ids' => GestaoCoordenacaoLaboratoriosDidaticos::whereUserPadId($user_pad->id)->pluck('id')->toArray(),
                    'type' => AvaliacaoUtil::GESTAO_COORDENACAO_LABORATORIOS_DIDATICOS,
                ],
                [
                    'ids' => GestaoCoordenacaoProgramaInstitucional::whereUserPadId($user_pad->id)->pluck('id')->toArray(),
                    'type' => AvaliacaoUtil::GESTAO_COORDENACAO_PROGRAMA_INSTITUCIONAL
                ],
                [
                    'ids' => GestaoMembroCamaras::whereUserPadId($user_pad->id)->pluck('id')->toArray(),
                    'type' => AvaliacaoUtil::GESTAO_MEMBRO_CAMARAS
                ],
                [
                    'ids' => GestaoMembroComissao::whereUserPadId($user_pad->id)->pluck('id')->toArray(),
                    'type' => AvaliacaoUtil::GESTAO_MEMBRO_COMISSAO
                ],
                [
                    'ids' => GestaoMembroConselho::whereUserPadId($user_pad->id)->pluck('id')->toArray(),
                    'type' => AvaliacaoUtil::GESTAO_MEMBRO_CONSELHO
                ],
                [
                    'ids' => GestaoMembroTitularConselho::whereUserPadId($user_pad->id)->pluck('id')->toArray(),
                    'type' => AvaliacaoUtil::GESTAO_MEMBRO_TITULAR_CONSELHO
                ],
                [
                    'ids' => GestaoOutros::whereUserPadId($user_pad->id)->pluck('id')->toArray(),
                    'type' => AvaliacaoUtil::GESTAO_OUTROS
                ],
                [
                    'ids' => GestaoRepresentanteUnidadeEducacao::whereUserPadId($user_pad->id)->pluck('id')->toArray(),
                    'type' => AvaliacaoUtil::GESTAO_REPRESENTANTE_UNIDADE_EDUCACAO
                ]
            ];

            $avaliacoes_gestao_ids = [];
            foreach($gestao_grouped_ids as $gestao_group)
            {
                $avaliacao_ids = Avaliacao::whereIn('tarefa_id', $gestao_group['ids'])->whereType($gestao_group['type'])->pluck('id')->toArray();

                $avaliacoes_gestao_ids = array_merge($avaliacoes_gestao_ids, $avaliacao_ids);
            }

            $avaliacoes_gestao = Avaliacao::whereIn('id', $avaliacoes_gestao_ids)->orderBy('status');
        }

        return [
            'ensino'   => $avaliacoes_ensino,
            'pesquisa' => $avaliacoes_pesquisa,
            'extensao' => $avaliacoes_extensao,
            'gestao'   => $avaliacoes_gestao
        ];
    }

    private function get_carga_horaria_total($avaliacoes)
    {
        //
        $ch = 0;
        $avaliacoes_ensino = !empty($avaliacoes['ensino']) ? $avaliacoes['ensino'] : null;
        $avaliacoes_pesquisa = !empty($avaliacoes['pesquisa']) ? $avaliacoes['pesquisa'] : null;
        $avaliacoes_extensao = !empty($avaliacoes['extensao']) ? $avaliacoes['extensao'] : null;
        $avaliacoes_gestao = !empty($avaliacoes['gestao']) ? $avaliacoes['gestao'] : null;

        if($avaliacoes_ensino) {
            for ($i = 0; $i < count($avaliacoes_ensino->all()); $i++){
                $ch += $avaliacoes_ensino[$i]->tarefa()->first()->ch_semanal;
            }
        }

        if($avaliacoes_pesquisa) {
            for ($i = 0; $i < count($avaliacoes_pesquisa->all()); $i++){
                $ch += $avaliacoes_pesquisa[$i]->tarefa()->first()->ch_semanal;
            }
        }

        if($avaliacoes_extensao) {
            for ($i = 0; $i < count($avaliacoes_extensao->all()); $i++){
                $ch += $avaliacoes_extensao[$i]->tarefa()->first()->ch_semanal;
            }
        }

        if($avaliacoes_gestao) {
            for ($i = 0; $i < count($avaliacoes_gestao->all()); $i++){
                $ch += $avaliacoes_gestao[$i]->tarefa()->first()->ch_semanal;
            }
        }

        return $ch;
    }


    private function get_carga_horaria_corrigida($ensino, $pesquisa, $extensao, $gestao)
    {
        $ch = 0;

        if($ensino) {
            for ($i = 0; $i < count($ensino->all()); $i++){
                if($ensino[$i]->status != Status::REPROVADO){
                    $ch += $ensino[$i]->tarefa()->first()->ch_semanal;
                }
            }
        }

        if($pesquisa) {
            for ($i = 0; $i < count($pesquisa->all()); $i++){
                if($pesquisa[$i]->status != Status::REPROVADO){
                    $ch += $pesquisa[$i]->tarefa()->first()->ch_semanal;
                }
            }
        }

        if($extensao) {
            for ($i = 0; $i < count($extensao->all()); $i++){
                if($extensao[$i]->status != Status::REPROVADO){
                    $ch += $extensao[$i]->tarefa()->first()->ch_semanal;
                }
            }
        }

        if($gestao) {
            for ($i = 0; $i < count($gestao->all()); $i++){
                if($gestao[$i]->status != Status::REPROVADO){
                    $ch += $gestao[$i]->tarefa()->first()->ch_semanal;
                }
            }
        }

        return $ch;
    }

    public function relatorio($id){
        $user = Auth::user();
        $pad = Pad::find($id);
        $index_menu = MenuItemsAvaliador::REPORT;
        $professores = User::join('user_pad', 'user_pad.user_id', '=', 'users.id')
            ->join('pad', 'user_pad.pad_id', '=', 'pad.id')
            ->where(function ($query) use ($user, $id) {
                $query->where('pad.status', '=', Status::ATIVO);
                $query->where('users.campus_id', '=', $user->campus_id);
                $query->where('users.id', '!=', $user->id);
                $query->where('pad.id', '=', $id);
            })
            ->select('users.id', 'users.name', 'users.curso_id', 'users.campus_id')
            ->orderBy('name')
            ->get();

        //Informando se o PAD foi enviado ou não
        $avaliador_pad = AvaliadorPad::where(function ($query) use ($pad, $user) {
            $query->where('user_id', '=', $user->id);
            $query->where('pad_id', '=', $pad->id);
        })->first();


        foreach ($professores as $professor){
            $professor->status = "Pendente";
            $userPad = $professor->userPads()->where('pad_id', '=', $pad->id)->first();

            $avaliacoes = $this->get_avaliacoes($userPad, $avaliador_pad);

            $professor->ch_ensino   = $this->get_carga_horaria($avaliacoes['ensino'])? $this->get_carga_horaria($avaliacoes['ensino']) : 0;
            $professor->ch_pesquisa = $this->get_carga_horaria($avaliacoes['pesquisa'])? $this->get_carga_horaria($avaliacoes['pesquisa']) : 0;
            $professor->ch_extensao = $this->get_carga_horaria($avaliacoes['extensao'])? $this->get_carga_horaria($avaliacoes['extensao']) : 0;
            $professor->ch_gestao   = $this->get_carga_horaria($avaliacoes['gestao'])? $this->get_carga_horaria($avaliacoes['gestao']) : 0;

            if($professor->ch_ensino || $professor->ch_pesquisa || $professor->ch_extensao || $professor->ch_gestao ) {
                $professor->status = "Enviado";
                $professor->pad_id = $userPad->{'id'};
            }

        }

        return view('pad.relatorio.relatorio', [
                    'pad' => $pad,
                    'index_menu' => $index_menu,
                    'professores' => $professores]);
    }

    public function generatePDF($id){
        $user = Auth::user();
        $pad = Pad::find($id);
        $userPadGeneratePDF = new UserPadController();
        $professores = User::join('user_pad', 'user_pad.user_id', '=', 'users.id')
            ->join('pad', 'user_pad.pad_id', '=', 'pad.id')
            ->where(function ($query) use ($user, $id) {
                $query->where('pad.status', '=', Status::ATIVO);
                $query->where('users.campus_id', '=', $user->campus_id);
                $query->where('users.id', '!=', $user->id);
                $query->where('pad.id', '=', $id);
            })
            ->select('users.id', 'users.name', 'users.curso_id', 'users.campus_id')
            ->orderBy('name')
            ->get();

        //Informando se o PAD foi enviado ou não
        $avaliador_pad = AvaliadorPad::where(function ($query) use ($pad, $user) {
            $query->where('user_id', '=', $user->id);
            $query->where('pad_id', '=', $pad->id);
        })->first();


        $pads = [];
        set_time_limit(240);
        foreach ($professores as $professor){
            $userPad = $professor->userPads()->where('pad_id', '=', $pad->id)->first();

            $avaliacoes = $this->get_avaliacoes($userPad, $avaliador_pad);

            $professor->ch_ensino   = $this->get_carga_horaria($avaliacoes['ensino'])? $this->get_carga_horaria($avaliacoes['ensino']) : 0;
            $professor->ch_pesquisa = $this->get_carga_horaria($avaliacoes['pesquisa'])? $this->get_carga_horaria($avaliacoes['pesquisa']) : 0;
            $professor->ch_extensao = $this->get_carga_horaria($avaliacoes['extensao'])? $this->get_carga_horaria($avaliacoes['extensao']) : 0;
            $professor->ch_gestao   = $this->get_carga_horaria($avaliacoes['gestao'])? $this->get_carga_horaria($avaliacoes['gestao']) : 0;

            if($professor->ch_ensino || $professor->ch_pesquisa || $professor->ch_extensao || $professor->ch_gestao ) {
                $resource = tmpfile();
                $path = stream_get_meta_data($resource)['uri'];


                $fileName = storage_path($professor->{'name'} . "_.pdf");
                $userPadGeneratePDF->GeneratePDF($userPad->{'id'}, $fileName);
                $pads[$professor->{'name'}] = $fileName;
            }
        }
        $zipFile = storage_path(random_int(1000, 9999) . ".zip");
        $zip = new \ZipArchive();
        $zip->open($zipFile, \ZipArchive::CREATE);
        foreach ($pads as $profName=>$file)
        {
            $zip->addFile($file, "PAD - Professor ".$profName."_.pdf");
        }
        $zip->close();
        foreach ($pads as $profName=>$file)
        {
            unlink($file);
        }
        header('Content-type: application/zip');
        header('Content-Disposition: attachment; filename= Relatórios PAD -- Avaliador-'.$user->name.'.zip');
        readfile($zipFile);
        unlink($zipFile);
    }


    private function get_carga_horaria($avaliacoes){
        $ch = 0;

        foreach ($avaliacoes as $avaliacao){
            $ch += $avaliacao->tarefa->ch_semanal;
        }

        return $ch;
    }

}
