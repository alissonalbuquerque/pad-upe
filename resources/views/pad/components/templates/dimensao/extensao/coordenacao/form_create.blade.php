
@extends('layouts.main')

@section('title', 'Extensão')
@section('header')
    @include('layouts.header', [
        'user' => Auth::user(),
    ])
@endsection
@section('nav')
    @include('layouts.navigation', [
        'index_menu' => $index_menu,
    ])
@endsection
@section('body')

<div class="container"> 
    
    @include('pad.components.templates.dropdown-eixo', ['divs' => $divs])
        
    @include('components.alerts')

    <div id="coordenacao_extensao">
        <div>
            <div class="mb-3">
                <h3 class="h3"> Extensão - Coordenação </h3 class="h3">
                @include('components.buttons.btn-show-resolucao', [
                    'content' => 'Resolução',
                    'btn_class' => 'show_resolucao',
                ])
            </div>
            <form action="{{route('extensao_coordenacao_create')}}" method="post" id="extensao_coordenacao-form" class="">
                
                @csrf
            
                <div class="row">
                    
                    <input type="hidden" id="user_pad_id" name="user_pad_id" value="{{$user_pad_id}}">

                    <div class="mb-3 col-sm-2">
                        <label class="form-label" for="cod_atividade">Cód. Atividade</label>
                        <input class="form-control @error('cod_atividade') is-invalid @enderror ajax-errors" type="text" name="cod_atividade" id="cod_atividade" readonly>
                    </div>

                    <div class="mb-3 col-sm-6">
                        <label class="form-label" for="programa_extensao">Programa de Extensão</label>
                        <input class="form-control @error('programa_extensao') is-invalid @enderror ajax-errors" type="text" name="programa_extensao" id="programa_extensao" value="{{ old('programa_extensao') }}">
                        
                        @include('components.divs.errors', [
                            'field' => 'programa_extensao_create'
                        ])
                    </div>

                    <div class="mb-3 col-sm-4">
                        <label class="form-label" for="funcao">Função</label>
                        <select class="form-select @error('funcao') is-invalid @enderror ajax-errors" name="funcao" id="funcao" value="{{ old('funcao') }}">
                            <option value="0">Selecione uma Função</option>
                            @foreach($funcoes as $value => $funcao)
                                @if( $value == old('funcao') )
                                    <option selected value="{{$value}}">{{$funcao}}</option>
                                @else
                                    <option value="{{$value}}">{{$funcao}}</option>
                                @endif
                            @endforeach
                        </select>

                        @include('components.divs.errors', [
                            'field' => 'funcao_create'
                        ])
                    </div>

                    <div class="mb-3 col-sm-9">
                        <label class="form-label" for="titulo_projeto">Título do Projeto</label>
                        <input class="form-control @error('titulo_projeto') is-invalid @enderror ajax-errors" type="text" name="titulo_projeto" id="titulo_projeto" value="{{ old('titulo_projeto') }}">
                        
                        @include('components.divs.errors', [
                            'field' => 'titulo_projeto_create',
                        ])
                    </div>

                    <div class="mb-3 col-sm-3">
                        <label class="form-label" for="ch_semanal">CH. Semanal</label>
                        <input class="form-control @error('ch_semanal') is-invalid @enderror ajax-errors" type="number" name="ch_semanal" id="ch_semanal" value="{{ old('ch_semanal') }}">
                        
                        @include('components.divs.errors', [
                            'field' => 'ch_semanal_create'
                        ])
                    </div>

                    <div class="mb-3 col-">
                        <div class="form-group">
                            <textarea class="form-control @error('atividade') is-invalid @enderror ajax-errors" name="atividade" id="atividade" cols="30" rows="5" placeholder="Atividade: Informar/descrever a(s) atividade(s) desenvolvida(s)"></textarea>
                        </div>
                        
                        @include('components.divs.errors', [
                            'field' => 'atividade_create'
                        ])
                    </div>

                </div>

                <div class="mt-1 text-end">
                    @include('components.buttons.btn-save', [
                        'content' => 'Cadastrar',
                        'id' => 'btn-submit_extensao_coordenacao'
                    ])
                </div>
                
            </form>
        </div>

        <div class="border rounded px-4 mt-4">

            <table class="table table-hover" id="coordenacao_extensao-table">
                <thead>
                    <tr>
                        <!-- <th scole="col">#</th> -->
                        <th scope="col"> Cód </th>
                        <th scope="col"> Programa de Extensão </th>
                        <th scope="col"> Título do Projeto </th>
                        <th scope="col"> Função </th>
                        <th scope="col"> CH Semanal </th>
                        <th scope="col"> Opções </th>
                    </tr>
                </thead>
                
                <tbody>
                    @foreach($atividades as $atividade)
                    <tr>
                        <td>{{ $atividade->cod_atividade }}</td>
                        <td>{{ $atividade->programa_extensao }}</td>
                        <td>{{ $atividade->titulo_projeto }}</td>
                        <td>{{ $atividade->funcaoAsString() }}</td>
                        <td>{{ $atividade->ch_semanal }}</td>
                        <td>
                            @include('components.buttons.btn-edit-task', [
                                'btn_class' => 'btn-edit_extensao_coordenacao',
                                'btn_id' => $atividade->id,
                            ])

                            @include('components.buttons.btn-delete', [
                                'id' => $atividade->id,
                                'route' => route('extensao_coordenacao_delete', ['id' => $atividade->id])
                            ])
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

    @include('components.modal', [
        'size' => 'modal-lg',
        'header' => 'Extensão - Coordenação',
    ])
</div>
@endsection

@section('scripts')
    
    @include('pad.components.scripts.dropdown-eixo', ['divs' => $divs])

    @include('pad.components.scripts.cod_atividade', [
        'cod_atividade' => '1-',
        'form_id' => 'extensao_coordenacao-form',
        'div_selected' => 'extensao_coordenacao',
        'route' => route('extensao_coordenacao_search'),
    ])

    @include('pad.components.scripts.ajaxValidation', [
        'btn_submit_id' => 'btn-submit_extensao_coordenacao',
        'form_id' => 'extensao_coordenacao-form',
        'form_type' => 'create',
        'route' => route('extensao_coordenacao_validate'),
    ])

    @include('pad.components.scripts.dimensao.ensino.show_modal', [
        'modal_id' => 'modal',
        'route' => route('view_extensao_coordenacao_update'),
        'btn_class' => 'btn-edit_extensao_coordenacao',
    ])

    @include('pad.components.scripts.dimensao.ensino.show_modal', [
        'modal_id' => 'modal',
        'route' => route('view_extensao_coordenacao_resolucao'),
        'btn_class' => 'show_resolucao',
    ])
@endsection
