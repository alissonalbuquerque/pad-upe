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

        @include('pad.components.templates.dimensao.ensino.ensino_aulas')

        @include('pad.components.templates.dimensao.ensino.ensino_coordenacao_disciplina')

        @include('pad.components.templates.dimensao.ensino.ensino_orientacao')

        @include('pad.components.templates.dimensao.ensino.ensino_supervisao')

        @include('pad.components.templates.dimensao.ensino.ensino_atendimento_discente')

        @include('pad.components.templates.dimensao.ensino.ensino_projeto')

        @include('pad.components.templates.dimensao.ensino.ensino_participacao')

        @include('pad.components.templates.dimensao.ensino.ensino_coordenacao_docente')
        
    </div>
@endsection

@section('scripts')
    
    @include('pad.components.scripts.dropdown-eixo', ['divs' => $divs])
    @include('pad.components.scripts.dimensao.ensino.ensino_orientacao')
    @include('pad.components.scripts.dimensao.ensino.ensino_supervisao')

@endsection
