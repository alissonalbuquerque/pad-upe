@extends('layouts.main')

@section('title', 'Professores')
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
    <div class="d-flex justify-content-between align-items-center border-bottom">
        <h2 class="">Professores</h2>
        @include('components.buttons.btn-create', [
            'route' => route('professor_create'),
            'class' => '',
            'content' => 'Novo Professor',
            'id' => '',
        ])
    </div>

    <!-- Tabela -->
    <div class="table-responsive mt-5">
        <table class="table table-hover table-striped">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">CPF</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($professores as $professor)
                    <tr>
                        <td>{{ $professor->name }}</td>
                        <td>{{ $professor->document }}</td>
                        <td>
                            @include('components.buttons.btn-edit', [
                                'btn_class' => 'btn btn-warning',
                                'route' => route('professor_edit', ['id' => $professor->id]),
                            ])
                            @include('components.buttons.btn-soft-delete', [
                                'route' => route('professor_delete', ['id' => $professor->id]),
                                'modal_id' => $professor->id,
                            ])
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
