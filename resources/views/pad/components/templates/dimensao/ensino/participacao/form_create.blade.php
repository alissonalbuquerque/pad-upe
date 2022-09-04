
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

    <div id="ensino_participacao">
        <div>
            <div class="mb-3">
                <h3 class="h3"> Ensino - Participação </h3 class="h3">
                @include('components.buttons.btn-show-resolucao', [
                    'content' => 'Resolução',
                    'btn_class' => 'show_resolucao',
                ])
            </div>
            <form action="{{route('ensino_participacao_create')}}" method="post" id="ensino_participacao-form" class="">
                
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
                        'id' => 'btn-submit_ensino_participacao'
                    ])
                </div>
                
            </form>
        </div>

        <div class="border rounded px-4 mt-4">

            <table class="table table-hover" id="ensino_participacao-table">
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
                                'btn_class' => 'btn-edit_ensino_participacao',
                                'btn_id' => $atividade->id,
                            ])

                            @include('components.buttons.btn-delete', [
                                'id' => $atividade->id,
                                'route' => route('ensino_participacao_delete', ['id' => $ensinoAula->id])
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
        'header' => 'Ensino - Membro Participação',
    ])
</div>
@endsection

@section('scripts')
    
    @include('pad.components.scripts.dropdown-eixo', ['divs' => $divs])

    @include('pad.components.scripts.cod_atividade', [
        'cod_atividade' => '7-',
        'form_id' => 'ensino_participacao-form',
        'div_selected' => 'ensino_participacao',
        'route' => route('ensino_participacao_search'),
    ])

    @include('pad.components.scripts.ajaxValidation', [
        'btn_submit_id' => 'btn-submit_ensino_participacao',
        'form_id' => 'ensino_participacao-form',
        'form_type' => 'create',
        'route' => route('ensino_participacao_validate'),
    ])

    @include('pad.components.scripts.dimensao.ensino.show_modal', [
        'modal_id' => 'modal',
        'route' => route('view_ensino_participacao_update'),
        'btn_class' => 'btn-edit_ensino_participacao',
    ])

    @include('pad.components.scripts.dimensao.ensino.show_modal', [
        'modal_id' => 'modal',
        'route' => route('view_ensino_participacao_resolucao'),
        'btn_class' => 'show_resolucao',
    ])
@endsection