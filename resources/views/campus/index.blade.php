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
        <h2 class="">TODOS OS CAMPUS</h2>
        @include('components.buttons.btn-create', [
            'route' => route('campus_create'),
            'class' => '',
            'content' => 'Novo Campus',
            'id' => '',
        ])
    </div>

    <!-- Tabela -->
    <div class="table-responsive mt-5">
        <table class="table table-hover table-striped">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Unidade</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($campus as $camp)
                    <tr>
                        <td>{{ $camp->name }}</td>
                        <td>{{ $camp->unidade }}</td>
                        <td>
                            @include('components.buttons.btn-edit', [
                                'btn_class' => 'btn btn-warning',
                                'route' => route('campus_edit', ['id' => $camp->id]),
                            ])
                            @include('components.buttons.btn-soft-delete', [
                                'modal_id' => $camp->id, 'route' => route('campus_delete', ['id' => $camp->id])
                            ])
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
