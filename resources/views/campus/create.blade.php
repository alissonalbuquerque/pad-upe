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
        <h3 class="h4"> Cadastrar Campus </h3>
    </div>
        
    <div>
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

                [<div class='mb-3 col-sm-6'>]
                [    <div class="form-group">]
                [        <label for="unidade_id">Unidade</label>]
                [        <select class="form-select" name="unidade_id" id="unidade_id">]
                [            <option value="" disabled selected hidden> Selecione... </option>]
                [            @foreach ($unidades as $unidade)]
                [                <option value="{{ $unidade->id }}" {{ old('unidade_id') == $unidade->id ? 'selected' : '' }}>]
                [                    {{ $unidade->name }} </option>]
                [            @endforeach]
                [        </select>]
                [        @error('unidade_id')]
                [            <span class="text-danger"> {{ $message }} </span>]
                [        @enderror]
                [    </div>]
                [</div>]

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

@section('scripts')
    <script type="text/javascript">

        $('#unidade_id').select2(
        {   
            placeholder: 'Unidade...',
            allowClear: true,
            ajax: {
                url: '{{ route("unidade_search") }}',
                dataType: 'json'
            }
        });
        
    </script>
@endsection
