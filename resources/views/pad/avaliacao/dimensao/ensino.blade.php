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

        <h3>Professor 1 - Ensino</h3>

        <div class="card">
            <h5 class="card-header">Cód. Atividade - 1-A</h5>
            <div class="card-body">
                <span class="fw-bold ">Componente Curricular: </span><span class="card-text">Programação II</span><br>
                <span class="fw-bold ">Curso: </span><span class="card-text">Computação</span><br>
                <span class="fw-bold ">Nível: </span><span class="card-text">Pós-graduação Stricto Sensu</span><br>
                <span class="fw-bold ">Modalidade: </span><span class="card-text">Presencial</span><br>
                <span class="fw-bold ">Resolução: </span><span class="card-text">Aula na graduação e/ou pós-graduação stricto sensu</span><br>
                <span class="fw-bold ">CH. Semanal: </span><span class="card-text">6 horas</span><br>


                <div style="width: 100%; " class="btns-avaliar mt-5 d-flex justify-content-end">
                    @include('components.buttons.btn-reprovar', [
                        'route' => route('avaliador_avaliar'),
                        'class' => '',
                        'content' => 'Reprovar',
                        'id' => '',
                    ])
                    <span>&nbsp;&nbsp;</span>
                    @include('components.buttons.btn-aprovar', [
                        'route' => route('avaliador_avaliar'),
                        'class' => 'ml-2',
                        'content' => 'Aprovar',
                        'id' => '',
                    ])

                </div>
            </div>
        </div>
        <div class="card mt-3">
            <h5 class="card-header">Cód. Atividade - 1-B</h5>
            <div class="card-body">
                <span class="fw-bold ">Componente Curricular: </span><span class="card-text">Computação Gráfica</span><br>
                <span class="fw-bold ">Curso: </span><span class="card-text">Computação</span><br>
                <span class="fw-bold ">Nível: </span><span class="card-text">Pós-graduação Stricto Sensu</span><br>
                <span class="fw-bold ">Modalidade: </span><span class="card-text">Presencial</span><br>
                <span class="fw-bold ">Resolução: </span><span class="card-text">Aula na graduação e/ou pós-graduação stricto sensu</span><br>
                <span class="fw-bold ">CH. Semanal: </span><span class="card-text">4 horas</span><br>


                <div style="width: 100%; " class="btns-avaliar mt-5 d-flex justify-content-end">
                    @include('components.buttons.btn-reprovar', [
                        'route' => route('avaliador_avaliar'),
                        'class' => '',
                        'content' => 'Reprovar',
                        'id' => '',
                    ])
                    <span>&nbsp;&nbsp;</span>
                    @include('components.buttons.btn-aprovar', [
                        'route' => route('avaliador_avaliar'),
                        'class' => 'ml-2',
                        'content' => 'Aprovar',
                        'id' => '',
                    ])

                </div>
            </div>
        </div>
    </div>
@endsection
