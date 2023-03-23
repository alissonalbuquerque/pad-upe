@extends('layouts.main')

@section('title', 'Cursos')
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
        <h3 class="h4"> Cadastrar Curso </h3>
    </div>

    <div>
        <form action="{{ route('curso_store') }}" method="post">
            @csrf
            @method('POST')

            <div class="row">

                <div class="mb-3 col-sm-6">
                    <div class="form-group">
                        <label for="inputNameCurso">Nome do Curso</label>
                        <input type="text" class="form-control" name="name" id="name"
                            placeholder="Curso" value="{{ old('name') }}">
                        @error('name')
                            <span class="text-danger"> {{ $message }} </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 col-sm-6">
                    <div class="form-group">
                        <label for="campus_id">Campus</label>
                        <select class="form-select" name="campus_id" id="campus_id"
                            aria-label="Default select example">
                            <option value="" disabled selected hidden> selecione... </option>
                            @foreach ($allCampus as $campus)
                                <option value="{{ $campus->id }}" {{ old('campus_id') == $campus->id ? 'selected' : '' }}>{{ $campus->name }}</option>
                            @endforeach
                        </select>
                        @error('campus_id')
                            <span class="text-danger"> {{ $message }} </span>
                        @enderror
                    </div>
                </div>

                <div class="mt-1 text-end">
                    @include('components.buttons.btn-cancel', [
                        'route' => route('curso_index'),
                        'content' => 'Cancelar'
                    ])

                    @include('components.buttons.btn-save', [
                        'btn_class' => 'btn btn-outline-success',
                        'content' => 'Cadastrar',
                    ])
                </div>

            </div>

        </form>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">

        $('#campus_id').select2(
        {   
            placeholder: 'Campus...',
            allowClear: true,
            ajax: {
                url: '{{ route("campus_search") }}',
                dataType: 'json'
            }
        });
        
    </script>
@endsection