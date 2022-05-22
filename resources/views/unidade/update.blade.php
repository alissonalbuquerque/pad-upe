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
    <div class="content mx-auto">
        <h1 class="titulo pt-4 pb-4 mb-3 border-bottom">CADASTRO DE UNIDADE</h1>
        <p class="pb-4 mb-3 text-center text-muted align-items-center">
            Insira os dados correspondentes nos campos exibidos abaixo
        </p>
        <!-- Formulario -->
        <form action="{{ route('unidade_update', ['id' => $unidade->id]) }}" method="post">
            @csrf
            @method('POST')
            <div class="form-group">
                <label for="inputNameCurso">Nome da Unidade</label>
                <input type="text" class="form-control" name="name" value="{{ $unidade->name }}">
                @error('name')
                    <span class="text-danger"> {{ $message }} </span>
                @enderror
            </div>
            <div class="d-flex justify-content-between">
                @include('components.buttons.btn-cancel', [
                    'route' => route('unidade_index'),
                ])
                @include('components.buttons.btn-save')
            </div>
        </form>
    </div>
@endsection
