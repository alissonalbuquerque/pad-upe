
@extends('layouts.main')

@section('title', 'Usuários')

@section('header')
    @include('layouts.header', [
        'user' => Auth::user(),
    ])
@endsection

@section('nav')
    @include('layouts.navigation', ['menu' => $menu])
@endsection

@section('body')

<div>

    <div>
        <h3 class="h3"> Usuários </h3>
        <hr>
    </div>

    <div>
        @include('components.alerts')

        @include('users/_search', ['model' => $model_search])

        <div class="d-flex justify-content-end mb-2">
            @include('components.buttons.btn-create', [
                'id' => 'user_create',
                'content' => 'Cadastrar',
                'route' => route('user_create'),
            ])
        </div>

        <div class="border rounded px-4">
            <table class="table table-hover mt-4">
                <thead>
                    <tr>
                        <th scole="col">Nome</th>
                        <th scole="col">E-mail</th>
                        <th scole="col">Status</th>
                        <th scole="col">Campus</th>
                        <th scole="col">Curso</th>
                        <th scole="col">Opções</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->statusAsText() }}</td>
                            <td>{{ $user->campus }}</td>
                            <td>{{ $user->curso }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <div class="me-1">
                                        @include('components.buttons.btn-edit', [
                                            'route' => route('user_edit', ['id' => $user->id])
                                        ])
                                    </div>
                                    <div class="me-1">
                                        @include('components.buttons.btn-delete', [
                                            'id' => $user->id,
                                            'route' => route('user_delete',  ['id' => $user->id])
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
