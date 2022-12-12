
@extends('layouts.main')

@section('title', 'Ensino')
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

    <div id="ensino_projeto">
        <div>
            <div class="mb-3">
                <h3 class="h3"> Ensino - Projeto </h3>
                @include('components.buttons.btn-show-resolucao', [
                    'content' => 'Resolução',
                    'btn_class' => 'show_resolucao',
                ])
            </div>
            <form action="{{route('ensino_projeto_create')}}" method="post" id="ensino_projeto-form" class="">
                
                @csrf
            
                <div class="row">
                    
                    <input type="hidden" id="user_pad_id" name="user_pad_id" value="{{$user_pad_id}}">

                    <div class="mb-3 col-sm-2">
                        <label class="form-label" for="cod_atividade">Cód. Atividade</label>
                        <input class="form-control @error('cod_atividade') is-invalid @enderror ajax-errors" type="text" name="cod_atividade" id="cod_atividade" readonly>
                    </div>

                    <div class="mb-3 col-sm-10">
                        <label class="form-label" for="titulo">Título do Projeto</label>
                        <input class="form-control @error('titulo') is-invalid @enderror ajax-errors" type="text" name="titulo" id="titulo" value="{{ old('titulo') }}">
                        
                        @include('components.divs.errors', [
                            'field' => 'titulo_create',
                        ])
                    </div>

                    <div class="mb-3 col-sm-6">
                        <label class="form-label" for="curso">Curso(s) que Desenvolve</label>
                        <input class="form-control @error('curso') is-invalid @enderror ajax-errors" type="text" name="curso" id="curso" value="{{ old('curso') }}">
                        
                        @include('components.divs.errors', [
                            'field' => 'curso_create'
                        ])
                    </div>

                    <div class="mb-3 col-sm-6">
                        <label class="form-label" for="natureza">Natureza</label>
                        <select class="form-select @error('natureza') is-invalid @enderror ajax-errors" name="natureza" id="natureza" value="{{ old('natureza') }}">
                            <option value="0">Selecione um Nível</option>
                            @foreach($naturezas as $value => $natureza)
                                @if( $value == old('natureza') )
                                    <option selected value="{{$value}}">{{$natureza}}</option>
                                @else
                                    <option value="{{$value}}">{{$natureza}}</option>
                                @endif
                            @endforeach
                        </select>

                        @include('components.divs.errors', [
                            'field' => 'natureza_create'
                        ])
                    </div>

                    <div class="mb-3 col-sm-6">
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

                    <div class="mb-3 col-sm-6">
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
                        'id' => 'btn-submit_ensino_projeto'
                    ])
                </div>
                
            </form>
        </div>

        <div class="border rounded px-4 mt-4">

            <table class="table table-hover" id="ensino_projeto-table">
                <thead>
                    <tr>
                        <!-- <th scole="col">#</th> -->
                        <th scope="col"> Cód </th>´
                        <th scope="col"> Título do Projeto </th>
                        <th scope="col"> Curso </th>
                        <th scope="col"> Natureza </th>
                        <th scope="col"> Função </th>
                        <th scope="col"> CH. Semanal </th>
                    </tr>
                </thead>
                
                <tbody>
                    @foreach($atividades as $atividade)
                    <tr>
                        <td>{{ $atividade->cod_atividade }}</td>
                        <td>{{ $atividade->titulo }}</td>
                        <td>{{ $atividade->curso }}</td>
                        <td>{{ $atividade->naturezaAsString() }}</td>
                        <td>{{ $atividade->funcaoAsString() }}</td>
                        <td>{{ $atividade->ch_semanal }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <div class="me-1">
                                    @include('components.buttons.btn-edit-task', [
                                        'btn_class' => 'btn-edit_ensino_projeto',
                                        'btn_id' => $atividade->id,
                                    ])
                                </div>
                                <div class="me-1">
                                    @include('components.buttons.btn-delete', [
                                        'id' => $atividade->id,
                                        'route' => route('ensino_projeto_delete', ['id' => $atividade->id])
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
        'cod_atividade' => '6-',
        'form_id' => 'ensino_projeto-form',
        'div_selected' => 'ensino_projeto',
        'route' => route('ensino_projeto_search'),
    ])

    @include('pad.components.scripts.ajaxValidation', [
        'btn_submit_id' => 'btn-submit_ensino_projeto',
        'form_id' => 'ensino_projeto-form',
        'form_type' => 'create',
        'route' => route('ensino_projeto_validate'),
    ])

    @include('pad.components.scripts.dimensao.ensino.show_modal', [
        'modal_id' => 'modal',
        'route' => route('view_ensino_projeto_update'),
        'btn_class' => 'btn-edit_ensino_projeto',
    ])

    @include('pad.components.scripts.dimensao.ensino.show_modal', [
        'modal_id' => 'modal',
        'route' => route('view_ensino_projeto_resolucao'),
        'btn_class' => 'show_resolucao',
    ])
@endsection
