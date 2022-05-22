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
        <h1 class="titulo pt-4 pb-4 mb-3 border-bottom">Atualizar CAMPUS</h1>
        <p class="pb-4 mb-3 text-center text-muted align-items-center">
            Insira os dados correspondentes nos campos exibidos abaixo
        </p>
        <!-- Formulario -->
        <form action="{{ route('campus_update', $campus->id) }}" method="post">
            @csrf
            @method('POST')
            <div class="form-group">
                <label for="inputNameCampus">Nome do Campus</label>
                <input type="text" name="name" class="form-control" id="inputNameCampus"
                    placeholder="Insira o nome do Campus" value="{{ $campus->name }}{{ old('name') }}">
                @error('name')
                    <span class="text-danger"> {{ $message }} </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="selectCampus">Campus</label>
                <select class="custom-select" name="unidade_id" id="unidade_id">                
                    <option value="" disabled selected hidden> selecione... </option>
                    @foreach ($unidades as $unidade)
                        <option value="{{ $unidade->id }}" {{ $campus->unidade->id == $unidade->id ? 'selected' : '' }}>
                            {{ $unidade->name }} </option>
                    @endforeach
                </select>
                @error('unidade_id')
                    <span class="text-danger"> {{ $message }} </span>
                @enderror
            </div>
            <div class="d-flex justify-content-between">
                @include('components.buttons.btn-cancel', [
                    'route' => route('campus_index'),
                ])
                @include('components.buttons.btn-save')
            </div>
        </form>
    </div>
@endsection