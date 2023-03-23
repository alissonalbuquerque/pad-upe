@extends('layouts.main')

@section('title', 'Campus')
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
    
    <h3 class="h3"> Campus </h3>

    <div>

        @include('components.alerts')

        <div class="d-flex justify-content-end mb-2">
            @include('components.buttons.btn-create', [
                'id' => 'campus_create',
                'route' => route('campus_create'),
                'content' => 'Cadastrar',
            ])
        </div>

        <div class="border rounded px-4">
            <table class="table table-hover mt-4">
                <thead class="thead-dark">
                    <tr>
                        <th class="w-50" scope="col">Nome</th>
                        <th class="w-50" scope="col">Unidade</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($campus as $camp)
                        <tr>
                            <td>{{ $camp->name }}</td>
                            <td>{{ $camp->unidade }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <div class="me-1">
                                        @include('components.buttons.btn-edit', [
                                            'route' => route('campus_edit', ['id' => $camp->id]),
                                        ])
                                    </div>
                                    <div class="me-1">
                                        @include('components.buttons.btn-delete', [
                                            'id' => $camp->id,
                                            'route' => route('campus_delete', ['id' => $camp->id])
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
