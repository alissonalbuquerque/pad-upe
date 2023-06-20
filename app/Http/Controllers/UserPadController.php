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
use Illuminate\Support\Arr;
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
        $dateTime = now()->format('d-m-Y (H:i:s)');
        
        // Geração de array tratado a partir do modelo
        $treated_model = [];
        $treated_nome_dimensao = "";
        $treated_nome_categoria = "";
        
        foreach ($model as $nome_dimensao=>$dimensao)
        {
            $treated_nome_dimensao = strtoupper($nome_dimensao);
            $treated_model = Arr::add($treated_model, $treated_nome_dimensao, []);
            foreach ($dimensao as $nome_categoria=>$categoria)
            {

                if ($categoria == null)
                {
                    continue;
                }
                else
                {
                    $treated_nome_categoria = str_replace(".", ":", $nome_categoria);
                    $treated_model[$treated_nome_dimensao] = 
                        Arr::add($treated_model[$treated_nome_dimensao], $treated_nome_categoria, []);
                    foreach ($categoria as $item_name=>$item)
                    {
                        $treated_model[$treated_nome_dimensao][$treated_nome_categoria] = 
                                Arr::add($treated_model[$treated_nome_dimensao][$treated_nome_categoria], $item_name, []);
                        foreach ($item as $value_name=>$value)
                        {
                            if ($value_name == "id" ||
                                $value_name == "user_pad_id" ||
                                $value_name == "dimensao" ||
                                $value_name == "created_at" ||
                                $value_name == "updated_at" ||
                                $value_name == "deleted_at"
                                )
                            {
                                continue;
                            }
                            elseif ($value_name == 'cod_atividade')
                            {
                                $treated_model[$treated_nome_dimensao][$treated_nome_categoria][$item_name] = 
                                Arr::add($treated_model[$treated_nome_dimensao][$treated_nome_categoria][$item_name],
                                    'Cód', $value);
                            }
                            elseif ($value_name == 'componente_curricular')
                            {
                                $treated_model[$treated_nome_dimensao][$treated_nome_categoria][$item_name] = 
                                Arr::add($treated_model[$treated_nome_dimensao][$treated_nome_categoria][$item_name], 
                                    'Componente Curricular', $value);
                            }
                            elseif ($value_name == 'ch_semanal')
                            {
                                $treated_model[$treated_nome_dimensao][$treated_nome_categoria][$item_name] = 
                                Arr::add($treated_model[$treated_nome_dimensao][$treated_nome_categoria][$item_name], 
                                    'CH Semanal', $value);
                            }
                            elseif ($value_name == 'curso')
                            {
                                $treated_model[$treated_nome_dimensao][$treated_nome_categoria][$item_name] = 
                                Arr::add($treated_model[$treated_nome_dimensao][$treated_nome_categoria][$item_name], 
                                    'Curso', $value);
                            }
                            elseif ($value_name == 'descricao')
                            {
                                $treated_model[$treated_nome_dimensao][$treated_nome_categoria][$item_name] = 
                                Arr::add($treated_model[$treated_nome_dimensao][$treated_nome_categoria][$item_name], 
                                    'Descrição', $value);
                            }
                            elseif ($value_name == 'discente')
                            {
                                $treated_model[$treated_nome_dimensao][$treated_nome_categoria][$item_name] = 
                                Arr::add($treated_model[$treated_nome_dimensao][$treated_nome_categoria][$item_name], 
                                    'Curso', $value);
                            }
                            elseif ($value_name == 'documento')
                            {
                                $treated_model[$treated_nome_dimensao][$treated_nome_categoria][$item_name] = 
                                Arr::add($treated_model[$treated_nome_dimensao][$treated_nome_categoria][$item_name], 
                                    'Documento', $value);
                            }
                            elseif ($value_name == 'titulo_projeto')
                            {
                                $treated_model[$treated_nome_dimensao][$treated_nome_categoria][$item_name] = 
                                Arr::add($treated_model[$treated_nome_dimensao][$treated_nome_categoria][$item_name], 
                                    'Título do Projeto', $value);
                            }
                            elseif ($value_name == 'nome')
                            {
                                $treated_model[$treated_nome_dimensao][$treated_nome_categoria][$item_name] = 
                                Arr::add($treated_model[$treated_nome_dimensao][$treated_nome_categoria][$item_name], 
                                    'Nome', $value);
                            }
                            elseif ($value_name == 'programa_extensao')
                            {
                                $treated_model[$treated_nome_dimensao][$treated_nome_categoria][$item_name] = 
                                Arr::add($treated_model[$treated_nome_dimensao][$treated_nome_categoria][$item_name], 
                                    'Programa de Extensão', $value);
                            }
                            elseif ($value_name == 'linha_grupo_pesquisa')
                            {
                                $treated_model[$treated_nome_dimensao][$treated_nome_categoria][$item_name] = 
                                Arr::add($treated_model[$treated_nome_dimensao][$treated_nome_categoria][$item_name], 
                                    'Linha E Grupo de Pesquisa', $value);
                            }
                            elseif ($value_name == 'atividade')
                            {
                                if ('1. EXTENSÃO (COORDENAÇÃO DE ATIVIDADES DE EXTENSÃO HOMOLOGADA NA PROEC)' == $nome_categoria)
                                {
                                    continue;
                                }
                                else
                                {
                                    $treated_model[$treated_nome_dimensao][$treated_nome_categoria][$item_name] = 
                                    Arr::add($treated_model[$treated_nome_dimensao][$treated_nome_categoria][$item_name], 
                                        'Atividade', $value);
                                }
                            }
                            elseif ($value_name == 'cod_dimensao')
                            {
                                if ('1. EXTENSÃO (COORDENAÇÃO DE ATIVIDADES DE EXTENSÃO HOMOLOGADA NA PROEC)' == $nome_categoria)
                                {
                                    continue;
                                }
                                else
                                {
                                    $treated_model[$treated_nome_dimensao][$treated_nome_categoria][$item_name] = 
                                    Arr::add($treated_model[$treated_nome_dimensao][$treated_nome_categoria][$item_name], 
                                        'Cód Dimensão', $value);
                                }
                            }
                            elseif ($value_name == "nivel")
                            {
                                if ($value == 1)
                                {
                                    $treated_model[$treated_nome_dimensao][$treated_nome_categoria][$item_name] = 
                                    Arr::add($treated_model[$treated_nome_dimensao][$treated_nome_categoria][$item_name], 
                                        'Nível','Graduação');
                                }
                                elseif ($value == 2)
                                {
                                    $treated_model[$treated_nome_dimensao][$treated_nome_categoria][$item_name] = 
                                    Arr::add($treated_model[$treated_nome_dimensao][$treated_nome_categoria][$item_name], 
                                        'Nível','Pós Graduação Lato Sensu');
                                }
                                elseif ($value == 3)
                                {
                                    $treated_model[$treated_nome_dimensao][$treated_nome_categoria][$item_name] = 
                                    Arr::add($treated_model[$treated_nome_dimensao][$treated_nome_categoria][$item_name], 
                                        'Nível','Pós Graduação Stricto Sensu');
                                }
                            }
                            elseif ($value_name == "modalidade") 
                            {
                                if ($value == 1) 
                                {
                                    $treated_model[$treated_nome_dimensao][$treated_nome_categoria][$item_name] = 
                                    Arr::add($treated_model[$treated_nome_dimensao][$treated_nome_categoria][$item_name], 
                                        'Modalidade','EAD');
                                }
                                elseif ($value == 2)
                                {
                                    $treated_model[$treated_nome_dimensao][$treated_nome_categoria][$item_name] = 
                                    Arr::add($treated_model[$treated_nome_dimensao][$treated_nome_categoria][$item_name], 
                                        'Modalidade','Presencial');
                                }
                            }
                            elseif ($value_name == "funcao") 
                            {
                                if ($value == 1) 
                                {
                                    $treated_model[$treated_nome_dimensao][$treated_nome_categoria][$item_name] = 
                                    Arr::add($treated_model[$treated_nome_dimensao][$treated_nome_categoria][$item_name], 
                                        'Função','Coordenador');
                                }
                                elseif ($value == 2) 
                                {
                                    $treated_model[$treated_nome_dimensao][$treated_nome_categoria][$item_name] = 
                                    Arr::add($treated_model[$treated_nome_dimensao][$treated_nome_categoria][$item_name], 
                                        'Função','Colaborador');
                                }
                                elseif ($value == 4) 
                                {
                                    $treated_model[$treated_nome_dimensao][$treated_nome_categoria][$item_name] = 
                                    Arr::add($treated_model[$treated_nome_dimensao][$treated_nome_categoria][$item_name], 
                                        'Função','Orientador');
                                }
                                elseif ($value == 5) 
                                {
                                    $treated_model[$treated_nome_dimensao][$treated_nome_categoria][$item_name] = 
                                    Arr::add($treated_model[$treated_nome_dimensao][$treated_nome_categoria][$item_name], 
                                        'Função','Co-Orientador');
                                }
                                elseif ($value == 6) 
                                {
                                    $treated_model[$treated_nome_dimensao][$treated_nome_categoria][$item_name] = 
                                    Arr::add($treated_model[$treated_nome_dimensao][$treated_nome_categoria][$item_name], 
                                        'Função','Membro');
                                }
                            }
                            elseif ($value_name == "natureza") 
                            {
                                if ($value == 1) 
                                {
                                    $treated_model[$treated_nome_dimensao][$treated_nome_categoria][$item_name] = 
                                    Arr::add($treated_model[$treated_nome_dimensao][$treated_nome_categoria][$item_name], 
                                        'Natureza','Inovação');
                                }
                                elseif ($value == 2) 
                                {
                                    $treated_model[$treated_nome_dimensao][$treated_nome_categoria][$item_name] = 
                                    Arr::add($treated_model[$treated_nome_dimensao][$treated_nome_categoria][$item_name], 
                                        'Natureza','Pedagogia');
                                }
                                elseif ($value == 4) 
                                {
                                    $treated_model[$treated_nome_dimensao][$treated_nome_categoria][$item_name] = 
                                    Arr::add($treated_model[$treated_nome_dimensao][$treated_nome_categoria][$item_name], 
                                        'Natureza','Vivência');
                                }
                                elseif ($value == 5) 
                                {
                                    $treated_model[$treated_nome_dimensao][$treated_nome_categoria][$item_name] = 
                                    Arr::add($treated_model[$treated_nome_dimensao][$treated_nome_categoria][$item_name], 
                                        'Natureza','Outros');
                                }
                            }
                            else
                            { 
                                $treated_model[$treated_nome_dimensao][$treated_nome_categoria][$item_name] = 
                                Arr::add($treated_model[$treated_nome_dimensao][$treated_nome_categoria][$item_name], 
                                    $value_name, $value);
                            }
                        }
                    }
                }
            }
        }

        $data = array(
            'model' =>$treated_model, 
            'horas' => $horas
            );
        // $treated_model = Arr::add($treated_model, '1.2.4. Ensino', "Abc");
        // dd( 
        // //     $userPad->pesquisaCoordenacoes->toArray(),
        //     // ($model['extensao']['1. EXTENSÃO (COORDENAÇÃO DE ATIVIDADES DE EXTENSÃO HOMOLOGADA NA PROEC)']),
        //     $treated_model,
        //     // array_values($model['ensino'])[0],
        //     // array_values($model['ensino'])[0][0],
        //     // array_values($model['ensino'])[0][0]['cod_atividade'],
        //     // $ensinoTotalHoras,
        //     $model,
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
