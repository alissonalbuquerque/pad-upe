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
    <form action="{{ route('campus_store') }}" method="post">
        @csrf
        @method('POST')
        <input type="text" name="name" id="name" placeholder="Nome">

        <select name="unidade_id" id="unidade_id">
            <option value="" disabled selected hidden> selecione... </option>
            @foreach ($unidades as $unidade)
                <option value="{{ $unidade->id }}"> {{ $unidade->name }} </option>
            @endforeach
        </select>

        <button type="submit"> Enviar </button>
    </form>
@endsection
