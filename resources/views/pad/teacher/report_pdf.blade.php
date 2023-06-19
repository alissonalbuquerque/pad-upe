@extends('layouts.main')

@section('body')
    <header style="display: flex; direction: rtl">
    </header>

    <div style="display: flex; flex-direction: column; gap: 4rem">
        @foreach ($data['model'] as $nome_dimensao=>$dimensao)
            <h3>{{strtoupper($nome_dimensao)}}</h3>
            <div>
            @foreach ($dimensao as $nome_categoria=>$categoria)
                @if ($categoria == null)
                    @continue
                @else
                    <h3>{{$nome_categoria}}</h3>
                    
                    @foreach ($categoria as $item_name=>$item)
                        <table style="border-radius: 5px; background-color: #F2F2F2;
                        min-width: 600px; box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25); min-height: 50px; ">
                            
                            <thead class="thead-dark">
                                <tr>
                                    @foreach ($item as $value_name=>$value)
                                        @if ($value_name == "id" ||
                                            $value_name == "user_pad_id" ||
                                            $value_name == "dimensao" ||
                                            $value_name == "created_at" ||
                                            $value_name == "updated_at" ||
                                            $value_name == "deleted_at"
                                            )
                                            @continue
                                        @elseif ($value_name == 'atividade' || $value_name == 'cod_dimensao')
                                            @if ('1. EXTENSÃO (COORDENAÇÃO DE ATIVIDADES DE EXTENSÃO HOMOLOGADA NA PROEC)' == $nome_categoria)
                                                    @continue
                                            @endif
                                        @else 
                                            <th class="p-1.5 text-black" scope="col">
                                                {{$value_name}}
                                            </th>
                                        @endif
                                    @endforeach
                                </tr>
                            </thead>
                            
                            <tbody>
                                <tr>
                                    @foreach ($item as $value_name=>$value)
                                        @if ($value_name == "id" ||
                                            $value_name == "user_pad_id" ||
                                            $value_name == "dimensao" ||
                                            $value_name == "created_at" ||
                                            $value_name == "updated_at" ||
                                            $value_name == "deleted_at"
                                            )
                                            @continue
                                        @elseif ($value_name == 'atividade' || $value_name == 'cod_dimensao')
                                            @if ('1. EXTENSÃO (COORDENAÇÃO DE ATIVIDADES DE EXTENSÃO HOMOLOGADA NA PROEC)' == $nome_categoria)
                                                    @continue
                                            @endif
                                        @elseif ($value_name == "nivel")
                                            @if ($value == 1)
                                                <td style="border-top: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; vertical-align: middle; padding: 0.7rem">
                                                    Graduação
                                                </td>
                                            @elseif ($value == 2)
                                                <td style="border-top: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; vertical-align: middle; padding: 0.7rem">
                                                    Pós Graduação Lato Sensu
                                                </td>
                                            @elseif ($value == 3)
                                                <td style="border-top: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; vertical-align: middle; padding: 0.7rem">
                                                    Pós Graduação Stricto Sensu
                                                </td>
                                            @endif
                                        @elseif ($value_name == "modalidade")
                                            @if ($value == 1)
                                                <td style="border-top: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; vertical-align: middle; padding: 0.7rem">
                                                    EAD
                                                </td>
                                            @elseif ($value == 2)
                                                <td style="border-top: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; vertical-align: middle; padding: 0.7rem">
                                                    Presencial
                                                </td>
                                            @endif
                                        @elseif ($value_name == "funcao")
                                            @if ($value == 1)
                                                <td style="border-top: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; vertical-align: middle; padding: 0.7rem">
                                                    Coordenador
                                                </td>
                                            @elseif ($value == 2)
                                                <td style="border-top: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; vertical-align: middle; padding: 0.7rem">
                                                    Colaborador
                                                </td>
                                            @elseif ($value == 4)
                                                <td style="border-top: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; vertical-align: middle; padding: 0.7rem">
                                                    Orientador
                                                </td>
                                            @elseif ($value == 5)
                                                <td style="border-top: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; vertical-align: middle; padding: 0.7rem">
                                                    Co-Orientador
                                                </td>
                                            @elseif ($value == 6)
                                                <td style="border-top: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; vertical-align: middle; padding: 0.7rem">
                                                    Membro
                                                </td>
                                            @endif
                                        @elseif ($value_name == "natureza")
                                            @if ($value == 1)
                                                <td style="border-top: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; vertical-align: middle; padding: 0.7rem">
                                                    Inovação
                                                </td>
                                            @elseif ($value == 2)
                                                <td style="border-top: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; vertical-align: middle; padding: 0.7rem">
                                                    Pedagogia
                                                </td>
                                            @elseif ($value == 4)
                                                <td style="border-top: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; vertical-align: middle; padding: 0.7rem">
                                                    Vivência
                                                </td>
                                            @elseif ($value == 5)
                                                <td style="border-top: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; vertical-align: middle; padding: 0.7rem">
                                                    Outros
                                                </td>
                                            @endif
                                        @else
                                            <td style="border-top: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; vertical-align: middle; padding: 0.7rem">
                                                {{$value}}
                                            </td>
                                        @endif
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                        <div style="height: 3rem"></div>
                    @endforeach
                    <div style="height: 1.5rem"></div>
                @endif
            @endforeach
            <table style="border-radius: 10px; background-color: #F2F2F2;
            min-width: 600px; box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25);
            min-height: 50px;">
                
                <thead class="thead-dark">
                    <tr>
                        <th style="text-align: center" scope="col">TOTAL DE HORAS</th>
                    </tr>
                </thead>
                
                <tbody>
                    <tr>
                        <td style="text-align: center; border-top: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; vertical-align: middle">
                            {{ $data['horas'][$nome_dimensao] }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        @endforeach
    </div>
@endsection
