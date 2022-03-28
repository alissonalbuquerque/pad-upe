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
    <table class="table">
        <thead>
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
                        @include('components.buttons.btn-delete', [
                            'route' => route('unidade_delete', ['id' => $unidade->id]),
                        ])
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
