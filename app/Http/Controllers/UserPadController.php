<?php

namespace App\Http\Controllers;

use App\Models\Pad;
use App\Models\Curso;
use App\Models\User;
use App\Models\UserPad;
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

    public function savePAD($user_pad_id)
    {
        return view('pad.components.confirm_save', ['user_pad_id' => $user_pad_id]);
    }

    public function generatePDF($user_pad_id)
    {
        $user_id = UserPad::whereId($user_pad_id)->first()->{'id'};
        $user_data = [
            'nome' => User::whereId($user_id)->first()->{'name'},
            'email' => User::whereId($user_id)->first()->{'email'}
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

        $userPad = UserPad::whereId($user_pad_id)->first();
        $model['ensino'] = 
            [PadTables::tablesEnsino($user_pad_id)[4]['name'] => $userPad->ensinoAtendimentoDiscentes->toArray(),
            PadTables::tablesEnsino($user_pad_id)[0]['name'] => $userPad->ensinoAulas->toArray(),
            PadTables::tablesEnsino($user_pad_id)[1]['name'] => $userPad->ensinoCoordenacaoRegencias->toArray(),
            PadTables::tablesEnsino($user_pad_id)[7]['name'] => $userPad->ensinoMembroDocentes->toArray(),
            PadTables::tablesEnsino($user_pad_id)[2]['name'] => $userPad->ensinoOrientacoes->toArray(),
            PadTables::tablesEnsino($user_pad_id)[8]['name'] => $userPad->ensinoOutros->toArray(),
            PadTables::tablesEnsino($user_pad_id)[6]['name'] => $userPad->ensinoParticipacoes->toArray(),
            PadTables::tablesEnsino($user_pad_id)[5]['name'] => $userPad->ensinoProjetos->toArray(),
            PadTables::tablesEnsino($user_pad_id)[3]['name'] => $userPad->ensinoSupervisoes->toArray()
            ];
        $model['extensao'] =
            [PadTables::tablesExtensao($user_pad_id)[0]['name'] => $userPad->extensaoCoordenacoes->toArray(),
            PadTables::tablesExtensao($user_pad_id)[1]['name'] => $userPad->extensaoOrientacoes->toArray(),
            PadTables::tablesExtensao($user_pad_id)[2]['name'] => $userPad->extensaoOutros->toArray()
            ];
        $model['gestao'] =
            [PadTables::tablesGestao($user_pad_id)[5]['name'] => $userPad->gestaoCoordenacaoLaboratoriosDidaticos->toArray(),
            PadTables::tablesGestao($user_pad_id)[6]['name'] => $userPad->gestaoCoordenacaoProgramasInstitucionais->toArray(),
            PadTables::tablesGestao($user_pad_id)[4]['name'] => $userPad->gestaoMembroCamaras->toArray(),
            PadTables::tablesGestao($user_pad_id)[0]['name'] => $userPad->gestaoMembroComissoes->toArray(),
            PadTables::tablesGestao($user_pad_id)[1]['name'] => $userPad->gestaoMembroConselhos->toArray(),
            PadTables::tablesGestao($user_pad_id)[2]['name'] => $userPad->gestaoMembroTitularConselhos->toArray(),
            PadTables::tablesGestao($user_pad_id)[7]['name'] => $userPad->gestaoOutros->toArray(),
            PadTables::tablesGestao($user_pad_id)[3]['name'] => $userPad->gestaoRepresentanteUnidadeEducacoes->toArray()
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
                        $treated_model[$treated_nome_dimensao][$treated_nome_categoria][$nome_item] = [];
                        foreach ($item as $nome_valor=>$valor)
                        {
                            if (! array_key_exists($treated_tarefa_codigo, $treated_model[$treated_nome_dimensao][$treated_nome_categoria][$nome_item]))
                            {
                                if ($nome_valor == 'cod_atividade')
                                {
                                    $treated_model[$treated_nome_dimensao][$treated_nome_categoria][$nome_item]['Cód: ' . $valor]  = [];
                                    $treated_tarefa_codigo = 'Cód: ' . $valor;
                                    // break;
                                }
                            }
                            else 
                            {
                                if ($nome_valor == "id" ||
                                    $nome_valor == "user_pad_id" ||
                                    $nome_valor == "dimensao" ||
                                    $nome_valor == "created_at" ||
                                    $nome_valor == "updated_at" ||
                                    $nome_valor == "deleted_at"
                                    )
                                {
                                    continue;
                                }
                                elseif ($nome_valor == 'componente_curricular')
                                {
                                    $treated_model[$treated_nome_dimensao][$treated_nome_categoria][$nome_item][$treated_tarefa_codigo]['Componente Curricular'] = $valor;
                                }
                                elseif ($nome_valor == 'ch_semanal')
                                {
                                    $treated_model[$treated_nome_dimensao][$treated_nome_categoria][$nome_item][$treated_tarefa_codigo]['CH Semanal'] = $valor;
                                }
                                elseif ($nome_valor == 'curso')
                                {
                                    $treated_model[$treated_nome_dimensao][$treated_nome_categoria][$nome_item][$treated_tarefa_codigo]['Curso'] = $valor;
                                }
                                elseif ($nome_valor == 'descricao')
                                {
                                    $treated_model[$treated_nome_dimensao][$treated_nome_categoria][$nome_item][$treated_tarefa_codigo]['Descrição'] = $valor;
                                }
                                elseif ($nome_valor == 'discente')
                                {
                                    $treated_model[$treated_nome_dimensao][$treated_nome_categoria][$nome_item][$treated_tarefa_codigo]['Curso'] = $valor;
                                }
                                elseif ($nome_valor == 'documento')
                                {
                                    $treated_model[$treated_nome_dimensao][$treated_nome_categoria][$nome_item][$treated_tarefa_codigo]['Documento'] = $valor;
                                }
                                elseif ($nome_valor == 'titulo_projeto')
                                {
                                    $treated_model[$treated_nome_dimensao][$treated_nome_categoria][$nome_item][$treated_tarefa_codigo]['Título do Projeto'] = $valor;
                                }
                                elseif ($nome_valor == 'nome')
                                {
                                    $treated_model[$treated_nome_dimensao][$treated_nome_categoria][$nome_item][$treated_tarefa_codigo]['Nome'] = $valor;
                                }
                                elseif ($nome_valor == 'programa_extensao')
                                {
                                    $treated_model[$treated_nome_dimensao][$treated_nome_categoria][$nome_item][$treated_tarefa_codigo]['Programa de Extensão'] = $valor;
                                }
                                elseif ($nome_valor == 'linha_grupo_pesquisa')
                                {
                                    $treated_model[$treated_nome_dimensao][$treated_nome_categoria][$nome_item][$treated_tarefa_codigo]['Linha E Grupo de Pesquisa'] = $valor;
                                }
                                elseif ($nome_valor == 'atividade')
                                {
                                    if ('1. EXTENSÃO (COORDENAÇÃO DE ATIVIDADES DE EXTENSÃO HOMOLOGADA NA PROEC)' == $nome_categoria)
                                    {
                                        continue;
                                    }
                                    else
                                    {
                                        $treated_model[$treated_nome_dimensao][$treated_nome_categoria][$nome_item][$treated_tarefa_codigo]['Atividade'] = $valor;
                                    }
                                }
                                elseif ($nome_valor == 'cod_dimensao')
                                {
                                    if ('1. EXTENSÃO (COORDENAÇÃO DE ATIVIDADES DE EXTENSÃO HOMOLOGADA NA PROEC)' == $nome_categoria)
                                    {
                                        continue;
                                    }
                                    else
                                    {
                                        $treated_model[$treated_nome_dimensao][$treated_nome_categoria][$nome_item][$treated_tarefa_codigo]['Cód Dimensão'] = $valor;
                                    }
                                }
                                elseif ($nome_valor == "nivel")
                                {
                                    if ($valor == 1)
                                    {
                                        $treated_model[$treated_nome_dimensao][$treated_nome_categoria][$nome_item][$treated_tarefa_codigo]['Nível'] = 'Graduação';
                                    }
                                    elseif ($valor == 2)
                                    {
                                        $treated_model[$treated_nome_dimensao][$treated_nome_categoria][$nome_item][$treated_tarefa_codigo]['Nível'] = 'Pós Graduação Lato Sensu';
                                    }
                                    elseif ($valor == 3)
                                    {
                                        $treated_model[$treated_nome_dimensao][$treated_nome_categoria][$nome_item][$treated_tarefa_codigo]['Nível'] = 'Pós Graduação Stricto Sensu';
                                    }
                                }
                                elseif ($nome_valor == "modalidade") 
                                {
                                    if ($valor == 1) 
                                    {
                                        $treated_model[$treated_nome_dimensao][$treated_nome_categoria][$nome_item][$treated_tarefa_codigo]['Modalidade'] = 'EAD';
                                    }
                                    elseif ($valor == 2)
                                    {
                                        $treated_model[$treated_nome_dimensao][$treated_nome_categoria][$nome_item][$treated_tarefa_codigo]['Modalidade'] = 'Presencial';
                                    }
                                }
                                elseif ($nome_valor == "funcao") 
                                {
                                    if ($valor == 1) 
                                    {
                                        $treated_model[$treated_nome_dimensao][$treated_nome_categoria][$nome_item][$treated_tarefa_codigo]['Função'] = 'Coordenador';
                                    }
                                    elseif ($valor == 2) 
                                    {
                                        $treated_model[$treated_nome_dimensao][$treated_nome_categoria][$nome_item][$treated_tarefa_codigo]['Função'] = 'Colaborador';
                                    }
                                    elseif ($valor == 4) 
                                    {
                                        $treated_model[$treated_nome_dimensao][$treated_nome_categoria][$nome_item][$treated_tarefa_codigo]['Função'] = 'Orientador';
                                    }
                                    elseif ($valor == 5) 
                                    {
                                        $treated_model[$treated_nome_dimensao][$treated_nome_categoria][$nome_item][$treated_tarefa_codigo]['Função'] = 'Co-Orientador';
                                    }
                                    elseif ($valor == 6) 
                                    {
                                        $treated_model[$treated_nome_dimensao][$treated_nome_categoria][$nome_item][$treated_tarefa_codigo]['Função'] = 'Membro';
                                    }
                                }
                                elseif ($nome_valor == "natureza") 
                                {
                                    if ($valor == 1) 
                                    {
                                        $treated_model[$treated_nome_dimensao][$treated_nome_categoria][$nome_item][$treated_tarefa_codigo]['Natureza'] = 'Inovação';
                                    }
                                    elseif ($valor == 2) 
                                    {
                                        $treated_model[$treated_nome_dimensao][$treated_nome_categoria][$nome_item][$treated_tarefa_codigo]['Natureza'] = 'Pedagogia';
                                    }
                                    elseif ($valor == 4) 
                                    {
                                        $treated_model[$treated_nome_dimensao][$treated_nome_categoria][$nome_item][$treated_tarefa_codigo]['Natureza'] = 'Vivência';
                                    }
                                    elseif ($valor == 5) 
                                    {
                                        $treated_model[$treated_nome_dimensao][$treated_nome_categoria][$nome_item][$treated_tarefa_codigo]['Natureza'] = 'Outros';
                                    }
                                }
                                else
                                { 
                                    $treated_model[$treated_nome_dimensao][$treated_nome_categoria][$nome_item][$treated_tarefa_codigo][$nome_valor] = $valor;
                                }
                            }
                        }
                    }
                }
            }
        }

        date_default_timezone_set("America/Recife");
        $dateTime = now()->format('d/m/Y (H:i:s)');

        $data = array(
            'date'  => $dateTime,
            'user'  => $user_data,
            'model' => $treated_model, 
            'horas' => $horas
            );

        // dd( 
        // //     $userPad->pesquisaCoordenacoes->toArray(),
        //     // ($model['extensao']['1. EXTENSÃO (COORDENAÇÃO DE ATIVIDADES DE EXTENSÃO HOMOLOGADA NA PROEC)']),
        //     // public_path('\images\estado_pe_logo.png'),
        //     // url('images\estado_pe_logo.png'),
        //     // asset('images\estado_pe_logo.png'),
        //     UserPad::wherePadId($user_pad_id)->first()->{'id'},
        //     $user_data,
        //     $treated_model,
        //     // array_values($model['ensino'])[0],
        //     // array_values($model['ensino'])[0][0],
        //     // array_values($model['ensino'])[0][0]['cod_atividade'],
        //     // $ensinoTotalHoras,
        //     // $model,
        //     // $horas,
        //     // $data,
        //     // $model['ensino']['8. ENSINO (COORDENAÇÃO OU MEMBRO DE NÚCLEO DOCENTE ESTRUTURANTE OU NÚCLEO DOCENTE ESTRUTURANTE ASSISTENCIAL)'] == null,
        // //     PadTables::tablesEnsino($user_pad_id)[0]['name'],
        // //     $model,
        // //     "$dateTime",
        // //     empty($model['ensino'][0])
        // );
        view()->share('data', $data);
        // return view('pad.teacher.report_pdf');
        $pdf = PDF::loadView('pad.teacher.report_pdf', $data);
        set_time_limit(300);
        return $pdf->download("Relatório PAD: " . $dateTime . ".pdf");
    }

}
