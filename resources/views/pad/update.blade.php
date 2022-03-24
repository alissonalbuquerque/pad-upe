
@extends('layouts.main')

@section('title', 'PAD - Edição')

@section('body')
    <form action="{{ route('unidade_update', ['id' => $unidade->id]) }}" method="post">
        @method('POST')
        @csrf
        <div class="form-group">
            <label for="name"> Nome </label>
            <input type="text" name="name" id="name" value="{{ $unidade->name }}">
        </div>

        <button type="submit" class="btn btn-primary"> Create </button>
    </form>
@endsection
