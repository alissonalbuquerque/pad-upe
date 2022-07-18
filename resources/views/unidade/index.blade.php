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
        <h2 class="">TODAS AS UNIDADES</h2>
        @include('components.buttons.btn-create', [
            'id' => 'unidade_create',
            'route' => route('unidade_create'),
            'content' => 'Nova Unidade',
        ])
    </div>

    <div class="table-responsive mt-5">
        <table class="table table-hover table-striped">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($unidades as $unidade)
                    <tr>
                        <td>{{ $unidade->name }}</td>
                        <td>
                            @include('components.buttons.btn-edit', [
                                'route' => route('unidade_edit', ['id' => $unidade->id]),
                            ])
                            
                            @include('components.buttons.btn-delete', [
                                'id' => $unidade->id,
                                'route' => route('unidade_delete', ['id' => $unidade->id]),
                            ])
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
