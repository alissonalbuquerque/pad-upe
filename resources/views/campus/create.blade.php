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
        <h1 class="titulo pt-4 pb-4 mb-3 border-bottom">CADASTRO CAMPUS</h1>
        <p class="pb-4 mb-3 text-center text-muted align-items-center">
            Insira os dados correspondentes nos campos exibidos abaixo
        </p>
     
        <!-- Formulario -->
        <form action="{{ route('campus_store') }}" method="post">
            @csrf
            @method('POST')

            <div class='row'>

                <div class='mb-3 col-sm-6'>
                    <div class="form-group">
                        <label for="name">Nome do Campus</label>
                        <input type="text" name="name" class="form-control" id="name"
                            placeholder="Campus" value="{{ old('name') }}">
                        @error('name')
                            <span class="text-danger"> {{ $message }} </span>
                        @enderror
                    </div>
                </div>

                <div class='mb-3 col-sm-6'>
                    <div class="form-group">
                        <label for="unidade_id">Unidade</label>
                        <select class="form-select" name="unidade_id" id="unidade_id">
                            <option value="" disabled selected hidden> selecione... </option>
                            @foreach ($unidades as $unidade)
                                <option value="{{ $unidade->id }}" {{ old('unidade_id') == $unidade->id ? 'selected' : '' }}>
                                    {{ $unidade->name }} </option>
                            @endforeach
                        </select>
                        @error('unidade_id')
                            <span class="text-danger"> {{ $message }} </span>
                        @enderror
                    </div>
                </div>

                <div class='mt-1 text-end'>
                    @include('components.buttons.btn-cancel', [
                        'route' => route('campus_index'),
                        'content' => 'Cancelar'
                    ])
                    
                    @include('components.buttons.btn-save', [
                        'content' => 'Cadastrar'
                    ])
                </div>
                
            </div>

        </form>

    </div>
@endsection