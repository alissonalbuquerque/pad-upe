@extends('layouts.main')

@section('title', 'Campus')
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
    <div class="content mx-auto">
        <h1 class="titulo pt-4 pb-4 mb-3 border-bottom">CADASTRO DE CORRDENADORES</h1>
        <p class="pb-4 mb-3 text-center text-muted align-items-center">
            Insira os dados correspondentes nos campos exibidos abaixo
        </p>
        <!-- Formulario -->


        <form action="{{ route('diretor_store') }}" method="post">
            @csrf
            @method('POST')
            <div class="form-group">
               <label for="inputNameCoordenador">Nome</label>
               <input type="text" class="form-control" id="inputNameCoordenador" placeholder="Nome">
            </div>
            <div class="form-group">
               <label for="inputEmailCoordenador">Email</label>
               <input type="email" class="form-control" id="inputEmailCoordenador" placeholder="nome@upe.br">
            </div>
            <div class="form-row">
               <div class="form-group col-md-6">
                  <label for="inputCPF">CPF</label>
                  <input type="text" class="form-control" id="inputCPF" placeholder="000.000.000-00">
               </div>
               <div class="form-group col-md-6">
                  <label for="inputMatricula">Matricula</label>
                  <input type="text" class="form-control" id="inputMatricula" placeholder="Nº Matricula">
               </div>
            </div>
            <div class="form-group">
               <label for="selectArea">Dimensão de atuação</label>
               <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" aria-label="Default select example">
                  <option selected>Selecionar dimensão de atuação</option>
                  <option value="1">ENSINO</option>
                  <option value="2">PESQUISA</option>
                  <option value="3">EXTENSÃO</option>
                  <option value="4">GESTÃO</option>
               </select>
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
               <div class="d-flex justify-content-between">
                @include('components.buttons.btn-cancel', [
                    'route' => route('unidade_index'),
                ])
                @include('components.buttons.btn-save')
            </div>
         </form>
    </div>
@endsection
