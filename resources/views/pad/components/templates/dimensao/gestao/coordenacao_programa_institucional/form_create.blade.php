
@extends('layouts.main')

@section('title', 'Gestão')
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

    <div id="gestao_coordenacao_programa_institucional">
        <div>
            <div class="mb-3">
                <h3 class="h3"> Gestão - Coordenação de Programa Institucional </h3>
                @include('components.buttons.btn-show-resolucao', [
                    'content' => 'Resolução',
                    'btn_class' => 'show_resolucao',
                ])
            </div>
            <form action="{{route('gestao_coordenacao_programa_institucional_create')}}" method="post" id="gestao_coordenacao_programa_institucional-form">
                
                @csrf
            
                <div class="row">
                    
                    <input type="hidden" id="user_pad_id" name="user_pad_id" value="{{$user_pad_id}}">

                    <div class="mb-3 col-sm-3">
                        <label class="form-label" for="cod_atividade">Cód. Atividade</label>
                        <input class="form-control @error('cod_atividade') is-invalid @enderror ajax-errors" type="text" name="cod_atividade" id="cod_atividade" readonly>
                    </div>

                    <div class="mb-3 col-sm-9">
                        <label class="form-label" for="nome">Nome do Programa Institucional</label>
                        <input class="form-control @error('nome') is-invalid @enderror ajax-errors" type="text" name="nome" id="nome" value="{{ old('nome') }}">
                        
                        @include('components.divs.errors', [
                            'field' => 'nome_create',
                        ])
                    </div>

                    <div class="mb-3 col-sm-9">
                        <label class="form-label" for="documento">Documento que o Designa</label>
                        <input class="form-control @error('documento') is-invalid @enderror ajax-errors" type="text" name="documento" id="documento" value="{{ old('documento') }}">
                        
                        @include('components.divs.errors', [
                            'field' => 'documento_create',
                        ])
                    </div>

                    <div class="mb-3 col-sm-3">
                        <label class="form-label" for="ch_semanal">CH. Semanal</label>
                        <input class="form-control @error('ch_semanal') is-invalid @enderror ajax-errors" type="number" name="ch_semanal" id="ch_semanal" value="{{ old('ch_semanal') }}">
                        
                        @include('components.divs.errors', [
                            'field' => 'ch_semanal_create'
                        ])
                    </div>
                </div>

                <div class="mt-1 text-end">
                    @include('components.buttons.btn-save', [
                        'content' => 'Cadastrar',
                        'id' => 'btn-submit_gestao_coordenacao_programa_institucional'
                    ])
                </div>

            </form>
        </div>

        <div class="border rounded px-4 mt-4">

            <table class="table table-hover" id="gestao_coordenacao_programa_institucional-table">
                <thead>
                    <tr>
                        <!-- <th scole="col">#</th> -->
                        <th scope="col"> Cód </th>
                        <th scope="col"> Nome do Programa Institucional </th>
                        <th scope="col"> Documento que o Designa</th>
                        <th scope="col"> CH Semanal </th>
                    </tr>
                </thead>
                
                <tbody>
                
                    @foreach($atividades as $atividade)
                    <tr>
                        <td>{{ $atividade->cod_atividade }}</td>
                        <td>{{ $atividade->nome }}</td>
                        <td>{{ $atividade->documento }}</td>
                        <td>{{ $atividade->ch_semanal }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <div class="me-1">
                                    @include('components.buttons.btn-edit-task', [
                                        'btn_class' => 'btn-edit_gestao_coordenacao_programa_institucional',
                                        'btn_id' => $atividade->id,
                                    ])
                                </div>
                                <div class="me-1">
                                    @include('components.buttons.btn-delete', [
                                        'id' => $atividade->id,
                                        'route' => route('gestao_coordenacao_programa_institucional_delete', ['id' => $atividade->id])
                                    ])
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

    @include('components.modal', [
        'size' => 'modal-lg',
        'header' => '',
    ])
</div>
@endsection

@section('scripts')

    @include('pad.components.scripts.dropdown-eixo', ['divs' => $divs])

    @include('pad.components.scripts.cod_atividade', [
        'cod_atividade' => '23-',
        'form_id' => 'gestao_coordenacao_programa_institucional-form',
        'div_selected' => 'gestao_coordenacao_programa_institucional',
        'route' => route('gestao_coordenacao_programa_institucional_search'),
    ])

    @include('pad.components.scripts.ajaxValidation', [
        'btn_submit_id' => 'btn-submit_gestao_coordenacao_programa_institucional',
        'form_id' => 'gestao_coordenacao_programa_institucional-form',
        'form_type' => 'create',
        'route' => route('gestao_coordenacao_programa_institucional_validate'),
    ])

    @include('pad.components.scripts.dimensao.ensino.show_modal', [
        'modal_id' => 'modal',
        'route' => route('view_gestao_coordenacao_programa_institucional_update'),
        'btn_class' => 'btn-edit_gestao_coordenacao_programa_institucional',
    ])

    @include('pad.components.scripts.dimensao.ensino.show_modal', [
        'modal_id' => 'modal',
        'route' => route('view_gestao_coordenacao_programa_institucional_resolucao'),
        'btn_class' => 'show_resolucao',
    ])
@endsection
