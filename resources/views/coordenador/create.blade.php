@extends('layouts.main')

@section('title', 'Cadastro - Coordenador')

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

    @include('components.alerts')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"> Cadastrar novo Coordenador</h1>
    </div>

    <div class="content">
        <form class="" method="post" action="{{ route('coordenador_store') }}">
            @csrf
            @method('POST')

            <div class="row">

                <div class="mb-3 col-sm-6">
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" placeholder="Nome">
                    </div>
                </div>

                <div class="mb-3 col-sm-6">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="email@upe.br">
                    </div>
                </div>

                <div class="mb-3 col-sm-6">
                    <div class="form-group">
                        <label for="document">Documento (CPF)</label>
                        <input type="text" class="form-control" id="document" name="document" placeholder="000.000.000-00">
                    </div>
                </div>

                <div class="mb-3 col-sm-6">
                    <div class="form-group">
                        <label for="matricula">Matricula</label>
                        <input type="text" class="form-control" id="matricula" name="matricula" placeholder="Nº Matricula">
                    </div>
                </div>

                <div class="mb-3 col-sm-6">
                    <div class="form-group">
                        <label for="dimensao_type">Dimensão de Atuação</label>
                        <select class="form-select" id="dimensao_type" name="dimensao_type">
                            <option selected>Selecione</option>
                            <option value="1">ENSINO</option>
                            <option value="2">PESQUISA</option>
                            <option value="3">EXTENSÃO</option>
                            <option value="4">GESTÃO</option>
                        </select>
                    </div>
                </div>

                <div class="mt-1 text-end">

                    @include('components.buttons.btn-cancel', [
                        'route' => route('coordenador_index'),
                        'content' => 'Cancelar'
                    ])
                    
                    @include('components.buttons.btn-save', [
                        'content' => 'Cadastrar'
                    ])
                </div>
            
            <!--
               <div class="form-row">
               <div class="form-group col-md-6">
                 <label for="selectCampus">Campus</label>
                     <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" aria-label="Default select example">
                         <option selected>Selecionar Campus</option>
                         <option value="1">Um</option>
                         <option value="2">Dois</option>
                         <option value="3">Três</option>
                       </select>
                 </div>
               <div class="form-group col-md-6">
                 <label for="selectCurso">Curso</label>
                     <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" aria-label="Default select example">
                         <option selected>Selecionar Curso</option>
                         <option value="1">Um</option>
                         <option value="2">Dois</option>
                         <option value="3">Três</option>
                       </select>
               </div>
               </div>
               -->

            </div>

            <div class="d-flex justify-content-end">
                <button class="btn btn-success" type="submit"> Salvar </button>
            </div>
        </form>
    </div>
@endsection
