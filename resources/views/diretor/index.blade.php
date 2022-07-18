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
    @include('components.alerts')
    <div class="d-flex justify-content-between align-items-center border-bottom">
        <h2 class="">TODOS OS Diretores</h2>
        @include('components.buttons.btn-create', [
            'route' => route('diretor_create'),
            'class' => '',
            'content' => 'Novo Diretor',
            'id' => '',
        ])
    </div>
    <!-- Tabela -->
    <div class="table-responsive mt-5">
        <table class="table table-hover table-striped">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Documento</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
             
                @foreach ($diretores as $diretor)
                    <tr>
                        <td>{{ $diretor->name }}</td>
                        <td>{{ $diretor->document }}</td>
                        <td>
                            @include('components.buttons.btn-edit', [
                                'route' => route('diretor_edit', ['id' => $diretor->id]),
                            ])

                            @include('components.buttons.btn-delete', [
                                'id' => $diretor->id,
                                'route' => route('diretor_delete', ['id' => $diretor->id]),
                            ])
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
