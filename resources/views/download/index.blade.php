@extends('layouts.main')

@section('title', 'Arquivos')
@section('header')
    @include('layouts.header', [
        'user' => Auth::user(),
    ])
@endsection
@section('nav')
    @include('layouts.navigation', [
        'menu' => $menu,
    ])
@endsection
@section('body')

    <div class="d-flex">

        @include('components.cards.file_view', [
            'title' => 'Grade de Horário (.docx)',
            'route' => 'download_grade_horario'
        ])

        @include('components.cards.file_view', [
            'title' => 'Manual (.pdf)',
            'route' => 'download_manual'
        ])
        
    </div>

@endsection
