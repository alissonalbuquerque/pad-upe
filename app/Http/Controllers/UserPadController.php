<?php

namespace App\Http\Controllers;

use App\Mail\EmailPadConfirmacao;
use App\Models\Pad;
use App\Models\Curso;
use App\Models\Campus;
use App\Models\User;
use App\Models\UserPad;
use App\Models\Anexo;
use App\Models\Unidade;
use App\Models\Util\Nivel;
use App\Models\Util\Modalidade;
use App\Models\Util\Natureza;
use App\Models\Util\Funcao;
use App\Models\Util\Dimensao;
use App\Models\Util\Status;
use App\Models\Util\PadTables;
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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
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
    public function enviaEmailConfirmacao(Request $request)
    {
        $userPadId = $request->input('user_pad_id');
        $userPad = UserPad::find($userPadId);

        if (!$userPad) {
            return redirect()->back()->with('error', 'UserPad não encontrado.');
        }

        $user = Auth::user();

        // Enviar email
        // Mail::to($user->email)->send(new EmailPadConfirmacao($userPad));
        Mail::to("murilormleal@gmail.com")->send(new EmailPadConfirmacao($userPad));

        // Retornar a rota para baixar o PDF
        return redirect()->route('user-pad_pdf', ['user_pad_id' => $userPadId]);
    }

    public function savePAD($user_pad_id)
    {
        return view('pad.components.confirm_save', ['user_pad_id' => $user_pad_id]);
    }

    /**
     * Return generated PDF, with a given user_pad_id;
     *
     * Additionally, if a filename is given, function will save PDF in storage;
     *
     * @param  integer  $user_pad_id
     * @param  string  $fileName
     * @return \Illuminate\Http\Response
     */
    public function generatePDF($user_pad_id, $fileName="")
    {
        $niveis = Nivel::listNivel();
        $funcoes = Funcao::listFuncaoEnsino() +
                    Funcao::listFuncaoOrientador() +
                    array_diff(Funcao::listFuncaoProjeto(), Funcao::listFuncaoEnsino());
        ksort($funcoes);
        $naturezas = Natureza::listNatureza();
        $modalidades = Modalidade::listModalidade();
        $unidades_ensino = Unidade::listUnidades();
        $cursos = Curso::whereId(5)->first()->toArray();
        $semestres = Anexo::listSemestre();
        $nomes_valores =
        [
            'componente_curricular' => 'Componente Curricular',
            'ch_semanal' => 'CH Semanal',
            'curso' => 'Curso',
            'descricao' => 'Descrição',
            'discente' => 'Discente',
            'documento' => 'Documento',
            'titulo_projeto' => 'Título do Projeto',
            'nome' => 'Nome',
            'programa_extensao' => 'Programa de Extensão',
            'linha_grupo_pesquisa' => 'Linha e Grupo de Pesquisa',
            'atividade' => 'Atividade',
            'cod_dimensao' => 'Cód Dimensão',
            'nivel' => 'Nível',
            'modalidade' => 'Modalidade',
            'funcao' => 'Função',
            'natureza' => 'Natureza',
            "campus_id" => 'UNIDADE DE EDUCAÇÃO/CAMPUS',
            "curso_id" => 'CURSO',
            "unidade" => 'UNIDADE',
            "semestre" => 'PLANO DE ATIVIDADE DOCENTE - ANO',
            "matricula" => 'MATRÍCULA',
            "carga_horaria" => 'CARGA HORÁRIA',
            "categoria_nivel" => 'CATEGORIA / NÍVEL',
            "afastamento_total" => 'AFASTAMENTO TOTAL?',
            "afastamento_total_desc" => 'PORTARIA DE AFASTAMENTO (TOTAL)',
            "afastamento_parcial" => 'AFASTAMENTO PARCIAL?',
            "afastamento_parcial_desc" => 'PORTARIA DE AFASTAMENTO (PARCIAL)',
            "direcao_sindical" => 'EXERCE FUNÇÃO ADMINISTRATIVA?',
            "licenca" => 'LICENÇA DE ACORDO COM A LEGISLAÇÃO VIGENTE. ESPECIFIQUE',
        ];
        $valores_lista_negra =
        [
            "id",
            "user_pad_id",
            "dimensao",
            "cod_atividade",
            "created_at",
            "updated_at",
            "deleted_at"
        ];
        $ensinoTotalHoras =
            EnsinoAtendimentoDiscente::whereUserPadId($user_pad_id)->sum('ch_semanal')
            + EnsinoAula::whereUserPadId($user_pad_id)->sum('ch_semanal')
            + EnsinoCoordenacaoRegencia::whereUserPadId($user_pad_id)->sum('ch_semanal')
            + EnsinoMembroDocente::whereUserPadId($user_pad_id)->sum('ch_semanal')
            + EnsinoOrientacao::whereUserPadId($user_pad_id)->sum('ch_semanal')
            + EnsinoOutros::whereUserPadId($user_pad_id)->sum('ch_semanal')
            + EnsinoParticipacao::whereUserPadId($user_pad_id)->sum('ch_semanal')
            + EnsinoProjeto::whereUserPadId($user_pad_id)->sum('ch_semanal')
            + EnsinoSupervisao::whereUserPadId($user_pad_id)->sum('ch_semanal');

        $gestaoTotalHoras =
            GestaoCoordenacaoLaboratoriosDidaticos::whereUserPadId($user_pad_id)->sum('ch_semanal')
            + GestaoCoordenacaoProgramaInstitucional::whereUserPadId($user_pad_id)->sum('ch_semanal')
            + GestaoMembroCamaras::whereUserPadId($user_pad_id)->sum('ch_semanal')
            + GestaoMembroComissao::whereUserPadId($user_pad_id)->sum('ch_semanal')
            + GestaoMembroConselho::whereUserPadId($user_pad_id)->sum('ch_semanal')
            + GestaoMembroTitularConselho::whereUserPadId($user_pad_id)->sum('ch_semanal')
            + GestaoOutros::whereUserPadId($user_pad_id)->sum('ch_semanal')
            + GestaoRepresentanteUnidadeEducacao::whereUserPadId($user_pad_id)->sum('ch_semanal');

        $pesquisaTotalHoras =
            PesquisaCoordenacao::whereUserPadId($user_pad_id)->sum('ch_semanal')
            + PesquisaLideranca::whereUserPadId($user_pad_id)->sum('ch_semanal')
            + PesquisaOrientacao::whereUserPadId($user_pad_id)->sum('ch_semanal')
            + PesquisaOutros::whereUserPadId($user_pad_id)->sum('ch_semanal');

        $extensaoTotalHoras =
            ExtensaoCoordenacao::whereUserPadId($user_pad_id)->sum('ch_semanal')
            + ExtensaoOrientacao::whereUserPadId($user_pad_id)->sum('ch_semanal')
            + ExtensaoOutros::whereUserPadId($user_pad_id)->sum('ch_semanal');

        $horas = [
            'ENSINO' => $ensinoTotalHoras,
            'EXTENSAO' => $extensaoTotalHoras,
            'GESTAO' => $gestaoTotalHoras,
            'PESQUISA' => $pesquisaTotalHoras
        ];
        if ( Anexo::whereUserPadId($user_pad_id)->first() != null)
        {
            $anexoPad = Anexo::whereUserPadId($user_pad_id)->first()->toArray();
        }
        else { $anexoPad = null; }
        $userPad = UserPad::whereId($user_pad_id)->first();
        $model['ensino'] =
            [PadTables::tablesEnsino($user_pad_id)[0]['name'] => $userPad->ensinoAulas->toArray(),
            PadTables::tablesEnsino($user_pad_id)[1]['name'] => $userPad->ensinoCoordenacaoRegencias->toArray(),
            PadTables::tablesEnsino($user_pad_id)[2]['name'] => $userPad->ensinoOrientacoes->toArray(),
            PadTables::tablesEnsino($user_pad_id)[3]['name'] => $userPad->ensinoSupervisoes->toArray(),
            PadTables::tablesEnsino($user_pad_id)[4]['name'] => $userPad->ensinoAtendimentoDiscentes->toArray(),
            PadTables::tablesEnsino($user_pad_id)[5]['name'] => $userPad->ensinoProjetos->toArray(),
            PadTables::tablesEnsino($user_pad_id)[6]['name'] => $userPad->ensinoParticipacoes->toArray(),
            PadTables::tablesEnsino($user_pad_id)[7]['name'] => $userPad->ensinoMembroDocentes->toArray(),
            PadTables::tablesEnsino($user_pad_id)[8]['name'] => $userPad->ensinoOutros->toArray()
            ];

        $model['extensao'] =
            [PadTables::tablesExtensao($user_pad_id)[0]['name'] => $userPad->extensaoCoordenacoes->toArray(),
            PadTables::tablesExtensao($user_pad_id)[1]['name'] => $userPad->extensaoOrientacoes->toArray(),
            PadTables::tablesExtensao($user_pad_id)[2]['name'] => $userPad->extensaoOutros->toArray()
            ];
        $model['gestao'] =
            [PadTables::tablesGestao($user_pad_id)[0]['name'] => $userPad->gestaoMembroComissoes->toArray(),
            PadTables::tablesGestao($user_pad_id)[1]['name'] => $userPad->gestaoMembroConselhos->toArray(),
            PadTables::tablesGestao($user_pad_id)[2]['name'] => $userPad->gestaoMembroTitularConselhos->toArray(),
            PadTables::tablesGestao($user_pad_id)[3]['name'] => $userPad->gestaoRepresentanteUnidadeEducacoes->toArray(),
            PadTables::tablesGestao($user_pad_id)[4]['name'] => $userPad->gestaoMembroCamaras->toArray(),
            PadTables::tablesGestao($user_pad_id)[5]['name'] => $userPad->gestaoCoordenacaoLaboratoriosDidaticos->toArray(),
            PadTables::tablesGestao($user_pad_id)[6]['name'] => $userPad->gestaoCoordenacaoProgramasInstitucionais->toArray(),
            PadTables::tablesGestao($user_pad_id)[7]['name'] => $userPad->gestaoOutros->toArray()
            ];
        $model['pesquisa'] =
            [PadTables::tablesPesquisa($user_pad_id)[0]['name'] => $userPad->pesquisaCoordenacoes->toArray(),
            PadTables::tablesPesquisa($user_pad_id)[1]['name'] => $userPad->pesquisaLiderancas->toArray(),
            PadTables::tablesPesquisa($user_pad_id)[2]['name'] => $userPad->pesquisaOrientacoes->toArray(),
            PadTables::tablesPesquisa($user_pad_id)[3]['name'] => $userPad->pesquisaOutros->toArray()
            ];

        // Geração de array tratado a partir do modelo
        $treated_model = [];
        $treated_nome_dimensao = "";
        $treated_nome_categoria = "";
        $treated_tarefa_codigo = "";

        foreach ($model as $nome_dimensao=>$dimensao)
        {
            $treated_nome_dimensao = strtoupper($nome_dimensao);
            $treated_model[$treated_nome_dimensao] = [];
            foreach ($dimensao as $nome_categoria=>$categoria)
            {

                if ($categoria == null)
                {
                    continue;
                }
                else
                {
                    $treated_nome_categoria = str_replace(".", ":", $nome_categoria);
                    $treated_model[$treated_nome_dimensao][$treated_nome_categoria] = [];
                    foreach ($categoria as $nome_item=>$item)
                    {
                        foreach ($item as $nome_valor=>$valor)
                        {
                            if (! array_key_exists('Cód: ' . $item['cod_atividade'], $treated_model[$treated_nome_dimensao][$treated_nome_categoria]))
                            {
                                $treated_model[$treated_nome_dimensao][$treated_nome_categoria]['Cód: ' . $item['cod_atividade']]  = [];
                                $treated_tarefa_codigo = 'Cód: ' . $item['cod_atividade'];
                            }
                            else
                            {
                                if (in_array($nome_valor, $valores_lista_negra))
                                {
                                    continue;
                                }
                                elseif ($nome_valor == "nivel")
                                {
                                    $treated_model[$treated_nome_dimensao][$treated_nome_categoria][$treated_tarefa_codigo][$nomes_valores[$nome_valor]] = $niveis[$valor];
                                }
                                elseif ($nome_valor == "modalidade")
                                {
                                    $treated_model[$treated_nome_dimensao][$treated_nome_categoria][$treated_tarefa_codigo][$nomes_valores[$nome_valor]] = $modalidades[$valor];
                                }
                                elseif ($nome_valor == "funcao")
                                {
                                    $treated_model[$treated_nome_dimensao][$treated_nome_categoria][$treated_tarefa_codigo][$nomes_valores[$nome_valor]] = $funcoes[$valor];
                                }
                                elseif ($nome_valor == "natureza")
                                {
                                    $treated_model[$treated_nome_dimensao][$treated_nome_categoria][$treated_tarefa_codigo][$nomes_valores[$nome_valor]] = $naturezas[$valor];
                                }
                                elseif(array_key_exists($nome_valor, $nomes_valores))
                                {
                                    $treated_model[$treated_nome_dimensao][$treated_nome_categoria][$treated_tarefa_codigo][$nomes_valores[$nome_valor]] = $valor;
                                }
                                else
                                {
                                    $treated_model[$treated_nome_dimensao][$treated_nome_categoria][$treated_tarefa_codigo][$nome_valor] = $valor;
                                }
                            }
                        }
                    }
                }
            }
        }
        $treated_anexo_pad = [];
        if ($anexoPad != null)
        {
            foreach ($anexoPad as $nome_valor=>$valor)
            {
                if (in_array($nome_valor, $valores_lista_negra))
                {
                    continue;
                }
                elseif ($nome_valor == 'campus_id')
                {
                    if ($valor != null)
                    {
                        $campus = Campus::whereId($valor)->first();
                        $treated_anexo_pad[$nomes_valores[$nome_valor]] = $campus->{'name'};
                        // $treated_anexo_pad[$nomes_valores['unidade']] = strToUpper($unidades_ensino[$campus->{'unidade_id'}]);
                    }
                    else
                    {
                        $treated_anexo_pad[$nomes_valores[$nome_valor]] = "";
                        // $treated_anexo_pad[$nomes_valores['unidade']] = "Não especificado";
                    }

                }
                elseif ($nome_valor == 'curso_id')
                {
                    $valor != null ? $treated_anexo_pad[$nomes_valores[$nome_valor]] = Curso::whereId($valor)->first()->{'name'} : $treated_anexo_pad[$nomes_valores[$nome_valor]] = "Não especificado";
                }
                elseif ($nome_valor == 'semestre')
                {
                    $valor != null ? $treated_anexo_pad[$nomes_valores[$nome_valor]] = $semestres[$valor] : $treated_anexo_pad[$nomes_valores[$nome_valor]] = "Não especificado";
                }
                elseif ($nome_valor == 'afastamento_total' || $nome_valor == 'afastamento_parcial' || $nome_valor == 'direcao_sindical')
                {
                    $treated_anexo_pad[$nomes_valores[$nome_valor]] = $valor == 1? 'Sim' : 'Não';
                }
                elseif (array_key_exists($nome_valor, $nomes_valores))
                {
                    $valor != null ? $treated_anexo_pad[$nomes_valores[$nome_valor]] = $valor : $treated_anexo_pad[$nomes_valores[$nome_valor]] = "Não especificado";
                }
                else
                {
                    $valor != null ? $treated_anexo_pad[$nome_valor] = $valor : $treated_anexo_pad[$nome_valor] = "Não especificado";
                }
            }
        }

        date_default_timezone_set("America/Recife");
        $dateTime = now()->format('d-m-Y (H:i:s)');

        $data = array(
            'date'  => $dateTime,
            'user'  => [
                        'nome' => $userPad->user->{'name'},
                        'email' => $userPad->user->{'email'}
                        ],
            'anexo' => $treated_anexo_pad,
            'model' => $treated_model,
            'horas' => $horas
            );
        // dd(
        // //     $userPad->pesquisaCoordenacoes->toArray(),
        //     $treated_anexo_pad,
        //     // ($model['extensao']['1. EXTENSÃO (COORDENAÇÃO DE ATIVIDADES DE EXTENSÃO HOMOLOGADA NA PROEC)']),
        //     // public_path('\images\estado_pe_logo.png'),
        //     // url('images\estado_pe_logo.png'),
        //     // asset('images\estado_pe_logo.png'),
        //     // $model['ensino']['8. ENSINO (COORDENAÇÃO OU MEMBRO DE NÚCLEO DOCENTE ESTRUTURANTE OU NÚCLEO DOCENTE ESTRUTURANTE ASSISTENCIAL)'] == null,
        // //     PadTables::tablesEnsino($user_pad_id)[0]['name'],
        // //     $model,
        // //     "$dateTime",
        // //     empty($model['ensino'][0])
        // );
        view()->share('data', $data);
        // return view('pad.teacher.report_pdf');
        // PDF::setOption(['isRemoteEnabled' => 'true']);

        $pdf_name = " Relatório PAD - " . $userPad->user->{'name'};
        $pdf = PDF::loadView('pad.teacher.report_pdf', $data);
        if ($fileName == "")
        {
            return $pdf->download($pdf_name . ".pdf");
        }
        else
        {
            $pdf->save($fileName);
        }

    }

    /**
     *
     */
    public function action_change_status($id) {

        $user_pad = UserPad::find($id);

        if(in_array($user_pad->status, [UserPad::STATUS_DEFAULT, UserPad::STATUS_ATIVO])) {
            $user_pad->status = UserPad::STATUS_INATIVO;
        } else {
            $user_pad->status = UserPad::STATUS_ATIVO;
        }

        $user_pad->save();

        return redirect()->route('pad_edit', $user_pad->pad_id)->with('success', 'Status Atualizado!');
    }
}
