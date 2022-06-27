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
    <div class="d-flex justify-content-between align-items-center border-bottom">
        <h2 class="">TODOS OS COORDENADORES</h2>
        @include('components.buttons.btn-create', [
            'route' => route('coordenador_create'),
            'class' => '',
            'content' => 'Novo Coordenador',
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
                @foreach ($coordenadores as $coordenador)
                    <tr>
                        <td>{{ $coordenador->name }}</td>
                        <td>{{ $coordenador->document }}</td>
                        <td>
                            @include('components.buttons.btn-edit', [
                                'btn_class' => 'btn btn-warning',
                                'route' => route('coordenador_edit', ['id' => $coordenador->id]),
                            ])
                            @include('components.buttons.btn-delete', [
                                'route' => route('coordenador_delete', ['id' => $coordenador->id]),
                                'modal_id' => $coordenador->id,
                            ])
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
