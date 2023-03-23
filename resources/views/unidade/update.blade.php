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
    <div class="mb-3">
        <h3 class="h4"> Atualizar Unidade </h3>
    </div>    

    <div>
        <form action="{{ route('unidade_update', ['id' => $unidade->id]) }}" method="post">
            @csrf
            @method('POST')

            <div class="row">

                <div class="mb-3 col">
                    <div class="form-group">
                        <label for="name">Nome da Unidade</label>
                        <input type="text" class="form-control" name="name" value="{{ $unidade->name }}" placeholder="Unidade">
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
                        'content' => 'Atualizar',
                    ])
                </div>

            </div>

        </form>
    </div>
    
@endsection
