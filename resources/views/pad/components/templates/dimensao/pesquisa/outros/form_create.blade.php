
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

    <div id="pesquisa_outros">
        <div>
            <div class="mb-3">
                <h3 class="h3"> Pesquisa - Outros </h3>
                @include('components.buttons.btn-show-resolucao', [
                    'content' => 'Resolução',
                    'btn_class' => 'show_resolucao',
                ])
            </div>
            <form action="{{route('pesquisa_outros_create')}}" method="post" id="pesquisa_outros-form" class="">
                
                @csrf
            
                <div class="row">
                    
                    <input type="hidden" id="user_pad_id" name="user_pad_id" value="{{$user_pad_id}}">

                    <div class="mb-3 col-sm-2">
                        <label class="form-label" for="cod_atividade">Cód. Atividade</label>
                        <input class="form-control @error('cod_atividade') is-invalid @enderror ajax-errors" type="text" name="cod_atividade" id="cod_atividade" readonly>
                    </div>

                    <div class="mb-3 col-sm-10">
                        <label class="form-label" for="atividade">Atividade ( Nome da Atividade Realizada )</label>
                        <input class="form-control @error('atividade') is-invalid @enderror ajax-errors" type="text" name="atividade" id="atividade" value="{{ old('atividade') }}">
                        
                        @include('components.divs.errors', [
                            'field' => 'atividade_create',
                        ])
                    </div>
                    
                    <div class="mb-3 col-">
                        <div class="form-group">
                            <textarea class="form-control @error('descricao') is-invalid @enderror ajax-errors" name="descricao" id="atividade" cols="30" rows="5" placeholder="Atividade: Informar/descrever a(s) atividade(s) desenvolvida(s)"></textarea>
                        </div>
                        
                        @include('components.divs.errors', [
                            'field' => 'descricao_create'
                        ])
                    </div>
                    
                    <div class="d-flex justify-content-end">
                        <div class="mb-3 col-sm-4">
                            <label class="form-label" for="ch_semanal">CH. Semanal</label>
                            <input class="form-control @error('ch_semanal') is-invalid @enderror ajax-errors" type="number" name="ch_semanal" id="ch_semanal" value="{{ old('ch_semanal') }}">
                            
                            @include('components.divs.errors', [
                                'field' => 'ch_semanal_create'
                            ])
                        </div>
                    </div>
                </div>

                <div class="mt-1 text-end">
                    @include('components.buttons.btn-save', [
                        'content' => 'Cadastrar',
                        'id' => 'btn-submit_pesquisa_outros'
                    ])
                </div>
                
            </form>
        </div>

        <div class="border rounded px-4 mt-4">

            <table class="table table-hover" id="pesquisa_outros-table-">
                <thead>
                    <tr>
                        <!-- <th scole="col">#</th> -->
                        <th scope="col"> Cód </th>
                        <th scope="col"> Atividade </th>
                        <th scope="col"> Descrição </th>
                        <th scope="col"> CH Semanal </th>
                        <th scope="col"> Opções </th>
                    </tr>
                </thead>
                
                <tbody>
                    @foreach($atividades as $atividade)
                    <tr>
                        <td>{{ $atividade->cod_atividade }}</td>
                        <td>{{ $atividade->atividade }}</td>
                        <td>{{ $atividade->descricao }}</td>
                        <td>{{ $atividade->ch_semanal }}</td>
                        <td>
                            @include('components.buttons.btn-edit-task', [
                                'btn_class' => 'btn-edit_pesquisa_outros',
                                'btn_id' => $atividade->id,
                            ])

                            @include('components.buttons.btn-delete', [
                                'id' => $atividade->id,
                                'route' => route('pesquisa_outros_delete', ['id' => $atividade->id])
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
        'header' => '',
    ])
</div>
@endsection

@section('scripts')
    
    @include('pad.components.scripts.dropdown-eixo', ['divs' => $divs])

    @include('pad.components.scripts.cod_atividade', [
        'cod_atividade' => '13-',
        'form_id' => 'pesquisa_outros-form',
        'div_selected' => 'pesquisa_outros',
        'route' => route('pesquisa_outros_search'),
    ])

    @include('pad.components.scripts.ajaxValidation', [
        'btn_submit_id' => 'btn-submit_pesquisa_outros',
        'form_id' => 'pesquisa_outros-form',
        'form_type' => 'create',
        'route' => route('pesquisa_outros_validate'),
    ])

    @include('pad.components.scripts.dimensao.ensino.show_modal', [
        'modal_id' => 'modal',
        'route' => route('view_pesquisa_outros_update'),
        'btn_class' => 'btn-edit_pesquisa_outros',
    ])

    @include('pad.components.scripts.dimensao.ensino.show_modal', [
        'modal_id' => 'modal',
        'route' => route('view_pesquisa_outros_resolucao'),
        'btn_class' => 'show_resolucao',
    ])
@endsection
