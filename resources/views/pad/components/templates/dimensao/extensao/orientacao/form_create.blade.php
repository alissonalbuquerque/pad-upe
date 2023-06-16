
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
                <h3 class="h3"> Extensão - Orientação </h3 class="h3">
                @include('components.buttons.btn-show-resolucao', [
                    'content' => 'Resolução',
                    'btn_class' => 'show_resolucao',
                ])
            </div>
            <form action="{{route('extensao_orientacao_create')}}" method="post" id="extensao_orientacao-form" class="">
                
                @csrf
            
                <div class="row">
                    
                    <input type="hidden" id="user_pad_id" name="user_pad_id" value="{{$user_pad_id}}">

                    <div class="mb-3 col-sm-2">
                        <label class="form-label" for="cod_atividade">Cód. Atividade</label>
                        <input class="form-control @error('cod_atividade') is-invalid @enderror ajax-errors" type="text" name="cod_atividade" id="cod_atividade" readonly>
                    </div>

                    <div class="mb-3 col-sm-10">
                        <label class="form-label" for="titulo_projeto">Título do Projeto</label>
                        <input class="form-control @error('titulo_projeto') is-invalid @enderror ajax-errors" type="text" name="titulo_projeto" id="titulo_projeto" value="{{ old('titulo_projeto') }}">
                        
                        @include('components.divs.errors', [
                            'field' => 'titulo_projeto_create'
                        ])
                    </div>
                    
                    <div class="mb-3 col-sm-12">
                        <label class="form-label" for="discente">Nome do Orientando</label>
                        <input class="form-control @error('discente') is-invalid @enderror ajax-errors" type="text" name="discente" id="discente" value="{{ old('discente') }}">
                        
                        @include('components.divs.errors', [
                            'field' => 'discente_create'
                        ])
                    </div>

                    <div class="mb-3 col-sm-8">
                        <label class="form-label" for="cod_dimensao">Resolução</label>
                        <select class="form-select @error('cod_dimensao') is-invalid @enderror ajax-errors" name="cod_dimensao" id="cod_dimensao" value="{{ old('cod_dimensao') }}">
                            <option value="0">Selecione uma Resolução</option>
                            @foreach($planejamentos as $value => $cod_dimensao)
                                @if( $value == old('cod_dimensao') )
                                    <option selected value="{{$value}}">{{$cod_dimensao}}</option>
                                @else
                                    <option value="{{$value}}">{{$cod_dimensao}}</option>
                                @endif
                            @endforeach
                        </select>

                        @include('components.divs.errors', [
                            'field' => 'cod_dimensao_create'
                        ])
                    </div>

                    <div class="mb-3 col-sm-4">
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
                        'id' => 'btn-submit_extensao_orientacao'
                    ])
                </div>
                
            </form>
        </div>

        <div class="border rounded px-4 mt-4">

            <table class="table table-hover" id="extensao_orientacao-table">
                <thead>
                    <tr>
                        <!-- <th scole="col">#</th> -->
                        <th scope="col"> Cód </th>
                        <th scope="col"> Título do Projeto </th>
                        <th scope="col"> Nome do Orientando </th>
                        <th scope="col"> CH Semanal </th>
                        <th scope="col"> Opções </th>
                    </tr>
                </thead>
                
                <tbody>
                    @foreach($atividades as $atividade)
                    <tr>
                        <td>{{ $atividade->cod_atividade }}</td>
                        <td>{{ $atividade->titulo_projeto }}</td>
                        <td>{{ $atividade->discente }}</td>
                        <td>{{ $atividade->ch_semanal }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <div class="me-1">
                                    @include('components.buttons.btn-edit-task', [
                                        'btn_class' => 'btn-edit_extensao_orientacao',
                                        'btn_id' => $atividade->id,
                                    ])
                                </div>
                                <div class="me-1">
                                    @include('components.buttons.btn-delete', [
                                        'id' => $atividade->id,
                                        'route' => route('extensao_orientacao_delete', ['id' => $atividade->id])
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
        'cod_atividade' => '15-',
        'form_id' => 'extensao_orientacao-form',
        'div_selected' => 'extensao_coordenacao',
        'route' => route('extensao_orientacao_search'),
    ])

    @include('pad.components.scripts.ajaxValidation', [
        'btn_submit_id' => 'btn-submit_extensao_orientacao',
        'form_id' => 'extensao_orientacao-form',
        'form_type' => 'create',
        'route' => route('extensao_orientacao_validate'),
    ])

    @include('pad.components.scripts.dimensao.ensino.show_modal', [
        'modal_id' => 'modal',
        'route' => route('view_extensao_orientacao_update'),
        'btn_class' => 'btn-edit_extensao_orientacao',
    ])

    @include('pad.components.scripts.dimensao.ensino.show_modal', [
        'modal_id' => 'modal',
        'route' => route('view_extensao_orientacao_resolucao'),
        'btn_class' => 'show_resolucao',
    ])
@endsection
