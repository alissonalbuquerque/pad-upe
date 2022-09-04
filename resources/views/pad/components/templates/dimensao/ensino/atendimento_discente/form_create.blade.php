
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

    <div id="ensino_atendimento_discente">
        <div>
            <div class="mb-3">
                <h3 class="h3"> Ensino - Atendimento ao Discente </h3 class="h3">
                @include('components.buttons.btn-show-resolucao', [
                    'content' => 'Resolução',
                    'btn_class' => 'show_resolucao',
                ])
            </div>
            <form action="{{route('ensino_atendimento_discente_create')}}" method="post" id="ensino_atendimento_discente-form" class="">
                
                @csrf
            
                <div class="row">
                    
                    <input type="hidden" id="user_pad_id" name="user_pad_id" value="{{$user_pad_id}}">

                    <div class="mb-3 col-sm-2">
                        <label class="form-label" for="cod_atividade">Cód. Atividade</label>
                        <input class="form-control @error('cod_atividade') is-invalid @enderror ajax-errors" type="text" name="cod_atividade" id="cod_atividade" readonly>
                    </div>

                </div>

                <div class="mt-1 text-end">
                    @include('components.buttons.btn-save', [
                        'content' => 'Cadastrar',
                        'id' => 'btn-submit_ensino_atendimento_discente'
                    ])
                </div>
                
            </form>
        </div>

        <div class="border rounded px-4 mt-4">

            <table class="table table-hover" id="ensino_atendimento_discente-table">
                <thead>
                    <tr>
                        <!-- <th scole="col">#</th> -->
                        <th scope="col"> Cód </th>
                    </tr>
                </thead>
                
                <tbody>
                    @foreach($atividades as $atividade)
                    <tr>
                        <td>{{ $atividade->cod_atividade }}</td>
                        <td>
                            @include('components.buttons.btn-edit-task', [
                                'btn_class' => 'btn-edit_ensino_atendimento_discente',
                                'btn_id' => $atividade->id,
                            ])

                            @include('components.buttons.btn-delete', [
                                'id' => $atividade->id,
                                'route' => route('ensino_atendimento_discente_delete', ['id' => $ensinoAula->id])
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
        'header' => 'Ensino - Atendimento ao Discente',
    ])
</div>
@endsection

@section('scripts')
    
    @include('pad.components.scripts.dropdown-eixo', ['divs' => $divs])

    @include('pad.components.scripts.cod_atividade', [
        'cod_atividade' => '5-',
        'form_id' => 'ensino_atendimento_discente-form',
        'div_selected' => 'ensino_atendimento_discente',
        'route' => route('ensino_atendimento_discente_search'),
    ])

    @include('pad.components.scripts.ajaxValidation', [
        'btn_submit_id' => 'btn-submit_ensino_atendimento_discente',
        'form_id' => 'ensino_atendimento_discente-form',
        'form_type' => 'create',
        'route' => route('ensino_atendimento_discente_validate'),
    ])

    @include('pad.components.scripts.dimensao.ensino.show_modal', [
        'modal_id' => 'modal',
        'route' => route('view_ensino_atendimento_discente_update'),
        'btn_class' => 'btn-edit_ensino_atendimento_discente',
    ])

    @include('pad.components.scripts.dimensao.ensino.show_modal', [
        'modal_id' => 'modal',
        'route' => route('view_ensino_atendimento_discente_resolucao'),
        'btn_class' => 'show_resolucao',
    ])
@endsection