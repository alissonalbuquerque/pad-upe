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
        <form action="{{ route('unidade_store') }}" method="post">
            @csrf
            @method('POST')

            <div class="row">

                <div class="mb-3 col">
                    <div class="form-group">
                        <label for="name">Nome da Unidade</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Unidade">
                        @error('name')
                            <span class="text-danger"> {{ $message }} </span>
                        @enderror
                    </div>
                </div>

                <div class="mt-1 text-end">
                    @include('components.buttons.btn-cancel', [
                        'route' => route('unidade_index'),
                        'content' => 'Cancelar'
                    ])

                    @include('components.buttons.btn-save', [
                        'content' => 'Cadastrar',
                    ])
                </div>

            </div>

        </form>
    </div>
@endsection
