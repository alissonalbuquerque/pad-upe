
@extends('layouts.main')

@section('title', 'Pesquisa')
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

    <div id="pesquisa_lideranca">
        <div>
            <div class="mb-3">
                <h3 class="h3"> Pesquisa - Liderança </h3 class="h3">
                @include('components.buttons.btn-show-resolucao', [
                    'content' => 'Resolução',
                    'btn_class' => 'show_resolucao',
                ])
            </div>
            <form action="{{route('pesquisa_lideranca_create')}}" method="post" id="pesquisa_lideranca-form" class="">
                
                @csrf
            
                <div class="row">
                    
                    <input type="hidden" id="user_pad_id" name="user_pad_id" value="{{$user_pad_id}}">

                    <div class="mb-3 col-sm-2">
                        <label class="form-label" for="cod_atividade">Cód. Atividade</label>
                        <input class="form-control @error('cod_atividade') is-invalid @enderror ajax-errors" type="text" name="cod_atividade" id="cod_atividade" readonly>
                    </div>

                    <div class="mb-3 col-sm-10">
                        <label class="form-label" for="grupo_pesquisa">Título do Projeto</label>
                        <input class="form-control @error('grupo_pesquisa') is-invalid @enderror ajax-errors" type="text" name="grupo_pesquisa" id="grupo_pesquisa" value="{{ old('grupo_pesquisa') }}">
                        
                        @include('components.divs.errors', [
                            'field' => 'grupo_pesquisa_create',
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
                        'id' => 'btn-submit_pesquisa_lideranca'
                    ])
                </div>
                
            </form>
        </div>

        <div class="border rounded px-4 mt-4">

            <table class="table table-hover" id="pesquisa_lideranca-table">
                <thead>
                    <tr>
                        <!-- <th scole="col">#</th> -->
                        <th scope="col"> Cód </th>
                        <th scope="col"> Grupo de Pesquisa </th>
                        <th scope="col"> Função </th>
                        <th scope="col"> CH Semanal </th>
                        <th scope="col"> Opções </th>
                    </tr>
                </thead>
                
                <tbody>
                    @foreach($atividades as $atividade)
                    <tr>
                        <td>{{ $atividade->cod_atividade }}</td>
                        <td>{{ $atividade->grupo_pesquisa }}</td>
                        <td>{{ $atividade->funcaoAsString() }}</td>
                        <td>{{ $atividade->ch_semanal }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <div class="me-1">
                                    @include('components.buttons.btn-edit-task', [
                                        'btn_class' => 'btn-edit_pesquisa_lideranca',
                                        'btn_id' => $atividade->id,
                                    ])
                                </div>
                                <div class="me-1">
                                    @include('components.buttons.btn-delete', [
                                        'id' => $atividade->id,
                                        'route' => route('pesquisa_lideranca_delete', ['id' => $atividade->id])
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
        'cod_atividade' => '11-',
        'form_id' => 'pesquisa_lideranca-form',
        'div_selected' => 'pesquisa_lideranca',
        'route' => route('pesquisa_lideranca_search'),
    ])

    @include('pad.components.scripts.ajaxValidation', [
        'btn_submit_id' => 'btn-submit_pesquisa_lideranca',
        'form_id' => 'pesquisa_lideranca-form',
        'form_type' => 'create',
        'route' => route('pesquisa_lideranca_validate'),
    ])

    @include('pad.components.scripts.dimensao.ensino.show_modal', [
        'modal_id' => 'modal',
        'route' => route('view_pesquisa_lideranca_update'),
        'btn_class' => 'btn-edit_pesquisa_lideranca',
    ])

    @include('pad.components.scripts.dimensao.ensino.show_modal', [
        'modal_id' => 'modal',
        'route' => route('view_pesquisa_lideranca_resolucao'),
        'btn_class' => 'show_resolucao',
    ])
@endsection
