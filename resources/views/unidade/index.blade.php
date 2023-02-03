@extends('layouts.main')

@section('title', 'Unidades')

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
    <h3 class="h3"> Unidades </h3>

    <div>
        @include('components.alerts')

        <div class="d-flex justify-content-end mb-2">
            @include('components.buttons.btn-create', [
                'id' => 'unidade_create',
                'route' => route('unidade_create'),
                'content' => 'Nova Unidade',
            ])
        </div>

        <div class="border rounded px-4">

            <table class="table table-hover mt-4">
                <thead class="thead-dark">
                    <tr>
                        <th class="w-100" scope="col">Nome</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($unidades as $unidade)
                        <tr>
                            <td>{{ $unidade->name }}</td>
                            <td class="">
                                <div class="btn-group" role="group">
                                    <div class="me-1">
                                        @include('components.buttons.btn-edit', [
                                            'route' => route('unidade_edit', ['id' => $unidade->id]),
                                        ])
                                    </div>
                                    <div class="me-1">                                
                                        @include('components.buttons.btn-delete', [
                                            'id' => $unidade->id,
                                            'route' => route('unidade_delete', ['id' => $unidade->id]),
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
