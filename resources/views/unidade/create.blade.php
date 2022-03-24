@extends('dashboard')

@section('form-unidade-create')
<div class="mt-4">
    <form action="{{ route('unidade_store') }}" method="post">
        @method('POST')
        @csrf
        <div class="form-group">
            <label for="name"> Nome </label>
            <input type="text" name="name" id="name">
        </div>

        <button type="submit" class="btn btn-primary"> Create </button>
    </form>
</div>
@endsection
