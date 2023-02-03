
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

    <div id="ensino_aula">
        <div>
            <div class="mb-3">
                <h3 class="h3"> Ensino - Orientações </h3>
                @include('components.buttons.btn-show-resolucao', [
                    'content' => 'Resolução',
                    'btn_class' => 'show_resolucao',
                ])
            </div>
            <form action="{{route('ensino_orientacao_create')}}" method="post" id="ensino_orientacao-form" class="">
                
                @csrf
            
                <div class="row">
                    
                    <input type="hidden" id="user_pad_id" name="user_pad_id" value="{{$user_pad_id}}">

                    <div class="mb-3 col-sm-3">
                        <label class="form-label" for="cod_atividade">Cód. Atividade</label>
                        <input class="form-control @error('cod_atividade') is-invalid @enderror ajax-errors" type="text" name="cod_atividade" id="cod_atividade" readonly>
                    </div>

                    <div class="mb-3 col-sm-9">
                        <label class="form-label" for="atividade">Atividade: Orientação e/ou Coorientação</label>
                        <input class="form-control @error('atividade') is-invalid @enderror ajax-errors" type="text" name="atividade" id="atividade" value="{{ old('atividade') }}">
                        
                        @include('components.divs.errors', [
                            'field' => 'atividade_create',
                        ])
                    </div>

                    <div class="mb-3 col-sm-12">
                        <label class="form-label" for="curso">Curso</label>
                        <input class="form-control @error('curso') is-invalid @enderror ajax-errors" type="text" name="curso" id="curso" value="{{ old('curso') }}">
                        
                        @include('components.divs.errors', [
                            'field' => 'curso_create'
                        ])
                    </div>

                    <div class="mb-3 col-sm-4">
                        <label class="form-label" for="nivel">Nível</label>
                        <select class="form-select @error('nivel') is-invalid @enderror ajax-errors" name="nivel" id="nivel" value="{{ old('nivel') }}">
                            <option value="0">Selecione um Nível</option>
                            @foreach($niveis as $value => $nivel)
                                @if( $value == old('nivel') )
                                    <option selected value="{{$value}}">{{$nivel}}</option>
                                @else
                                    <option value="{{$value}}">{{$nivel}}</option>
                                @endif
                            @endforeach
                        </select>

                        @include('components.divs.errors', [
                            'field' => 'nivel_create'
                        ])
                    </div>

                    <div class="mb-3 col-sm-4">
                        <label class="form-label" for="type_orientacao">Orientação</label>
                        <select class="form-select @error('type_orientacao') is-invalid @enderror ajax-errors" name="type_orientacao" id="type_orientacao" value="{{ old('type_orientacao') }}">
                            <option value="0">Selecione uma Modalidade</option>
                            @foreach($orientacoes as $value => $orientacao)
                                @if( $value == old('type_orientacao') )
                                    <option selected value="{{$value}}">{{$orientacao}}</option>
                                @else
                                    <option value="{{$value}}">{{$orientacao}}</option>
                                @endif
                            @endforeach
                        </select>
                        
                        @include('components.divs.errors', [
                            'field' => 'type_orientacao_create'
                        ])
                    </div>

                    <div class="mb-3 col-sm-4">
                        <label class="form-label" for="numero_orientandos">Qtd. Participantes</label>
                        <input class="form-control @error('numero_orientandos') is-invalid @enderror ajax-errors" type="number" name="numero_orientandos" id="numero_orientandos" value="{{ old('numero_orientandos') }}">
                        
                        @include('components.divs.errors', [
                            'field' => 'numero_orientandos_create'
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
                        'id' => 'btn-submit_ensino_orientacao'
                    ])
                </div>
                
            </form>
        </div>

        <div class="border rounded px-4 mt-4">

            <table class="table table-hover" id="ensino_aulas-table-">
                <thead>
                    <tr>
                        <!-- <th scole="col">#</th> -->
                        <th scope="col"> Cód </th>
                        <th scope="col"> Atividade </th>
                        <th scope="col"> Curso </th>
                        <th scope="col"> Nível </th>
                        <th scope="col"> Orientação </th>
                        <th scope="col"> CH Semanal </th>
                        <th scope="col"> Opções </th>
                    </tr>
                </thead>
                
                <tbody>
                    @foreach($ensinoOrientacoes as $ensinoOrientacao)
                    <tr>
                        <td>{{ $ensinoOrientacao->cod_atividade }}</td>
                        <td>{{ $ensinoOrientacao->atividade }}</td>
                        <td>{{ $ensinoOrientacao->curso }}</td>
                        <td>{{ $ensinoOrientacao->nivelAsString() }}</td>
                        <td>{{ $ensinoOrientacao->orientacaoAsString() }}</td>
                        <td>{{ $ensinoOrientacao->chSemanal() }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <div class="me-1">
                                    @include('components.buttons.btn-edit-task', [
                                        'btn_class' => 'btn-edit_ensino_orientacao',
                                        'btn_id' => $ensinoOrientacao->id,
                                    ])
                                </div>
                                <div class="me-1">
                                    @include('components.buttons.btn-delete', [
                                        'id' => $ensinoOrientacao->id,
                                        'route' => route('ensino_orientacao_delete', ['id' => $ensinoOrientacao->id])
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
        'cod_atividade' => '3-',
        'form_id' => 'ensino_orientacao-form',
        'div_selected' => 'ensino_orientacao',
        'route' => route('ensino_orientacao_search'),
    ])

    @include('pad.components.scripts.ajaxValidation', [
        'btn_submit_id' => 'btn-submit_ensino_orientacao',
        'form_id' => 'ensino_orientacao-form',
        'form_type' => 'create',
        'route' => route('ensino_orientacao_validate'),
    ])

    @include('pad.components.scripts.dimensao.ensino.show_modal', [
        'modal_id' => 'modal',
        'route' => route('view_ensino_orientacao_update'),
        'btn_class' => 'btn-edit_ensino_orientacao',
    ])

    @include('pad.components.scripts.dimensao.ensino.show_modal', [
        'modal_id' => 'modal',
        'route' => route('view_ensino_orientacao_resolucao'),
        'btn_class' => 'show_resolucao',
    ])

    @include('pad.components.templates.dimensao.ensino.orientacao.numero_orientandos', ['form_id' => 'ensino_orientacao-form'])

@endsection
