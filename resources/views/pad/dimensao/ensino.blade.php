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

        @include('pad.components.templates.dimensao.ensino.ensino_aulas', ['user_pad_id' => $user_pad_id])

        @include('pad.components.templates.dimensao.ensino.ensino_coordenacao_disciplina', ['user_pad_id' => $user_pad_id])

        @include('pad.components.templates.dimensao.ensino.ensino_orientacao', ['user_pad_id' => $user_pad_id])

        @include('pad.components.templates.dimensao.ensino.ensino_supervisao', ['user_pad_id' => $user_pad_id])

        @include('pad.components.templates.dimensao.ensino.ensino_atendimento_discente', ['user_pad_id' => $user_pad_id])

        @include('pad.components.templates.dimensao.ensino.ensino_projeto', ['user_pad_id' => $user_pad_id])

        @include('pad.components.templates.dimensao.ensino.ensino_participacao', ['user_pad_id' => $user_pad_id])

        @include('pad.components.templates.dimensao.ensino.ensino_coordenacao_docente', ['user_pad_id' => $user_pad_id])
        
    </div>
@endsection

@section('scripts')
    
    @include('pad.components.scripts.dropdown-eixo', ['divs' => $divs])
    @include('pad.components.scripts.dimensao.ensino.ensino')
    @include('pad.components.scripts.dimensao.ensino.ensino_aulas')
    @include('pad.components.scripts.dimensao.ensino.ensino_orientacao')
    @include('pad.components.scripts.dimensao.ensino.ensino_supervisao')

@endsection
