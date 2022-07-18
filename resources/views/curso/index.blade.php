@extends('layouts.main')

@section('title', 'Cursos')
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
    <div class="d-flex justify-content-between align-items-center border-bottom">
        <h2 class="">TODOS OS CURSO</h2>
        @include('components.buttons.btn-create', [
            'route' => route('curso_create'),
            'class' => '',
            'content' => 'Novo Curso',
            'id' => '',
        ])
    </div>
    <!-- Tabela -->
    <div class="table-responsive mt-5">
        <table class="table table-hover table-striped">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Campus</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($campusWithCursos as $campusWithCurso)
                    @foreach ($campusWithCurso->cursos as $curso)
                        <tr>
                            <td>{{ $curso->name }}</td>
                            <td>{{ $curso->campus }}</td>
                            <td>
                                @include('components.buttons.btn-edit', [
                                    'route' => route('curso_edit', ['id' => $curso->id]),
                                ])

                                @include('components.buttons.btn-delete', [
                                    'id' => $curso->id,
                                    'route' => route('curso_delete', ['id' => $curso->id]),
                                ])
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
