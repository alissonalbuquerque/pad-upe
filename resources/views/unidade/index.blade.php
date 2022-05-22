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
            'route' => route('unidade_create'),
            'css' => '',
            'text' => 'Nova Unidade',
            'id' => '',
        ])
    </div>
    <table class="table mt-5">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Opções</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($unidades as $unidade)
                <tr>
                    <td scope="row">{{ $unidade->id }}</td>
                    <td>{{ $unidade->name }}</td>
                    <td>
                        @include('components.buttons.btn-edit', [
                            'route' => route('unidade_edit', ['id' => $unidade->id]),
                        ])
                        @include('components.buttons.btn-soft-delete', [
                            'route' => route('unidade_delete', ['id' => $unidade->id]),
                            'modal_id' => $unidade->id,
                        ])
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
