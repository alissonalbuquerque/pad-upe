@extends('layouts.main')

@section('title', 'Cursos')

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

<div>
    <h3 class="h3"> Cursos </h3>

    <div>   
        @include('components.alerts')

        <div class="d-flex justify-content-end mb-2 gap-3">
            @include('components.buttons.btn-download', [
                'route' => route('cursos_print'),
                'content' => 'Baixar Tabela',
                'id' => '',
                'class' => '',
            ])
            @include('components.buttons.btn-create', [
                'route' => route('curso_create'),
                'content' => 'Cadastrar',
                'id' => '',
                'class' => '',
            ])
        </div>

        <div class="border rounded px-4">
            <table class="table table-hover mt-4">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Campus</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cursos as $curso)
                        <tr>
                            <td>{{ $curso->name }}</td>
                            <td>{{ $curso->campus }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <div class="me-1">
                                        @include('components.buttons.btn-edit', [
                                            'route' => route('curso_edit', ['id' => $curso->id]),
                                        ])
                                    </div>
                                    <div class="me-1">
                                        @include('components.buttons.btn-delete', [
                                            'id' => $curso->id,
                                            'route' => route('curso_delete', ['id' => $curso->id]),
                                        ])
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
