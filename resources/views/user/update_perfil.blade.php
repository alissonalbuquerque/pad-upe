@extends('layouts.main')

@section('title', 'Atualizar Perfil')

@section('header')
@include('layouts.header', [
'user' => Auth::user(),
])
@endsection

@section('nav')
    @include('layouts.navigation', [
        'menu' => $menu
    ])
@endsection

@php
    $user = Auth::user();

    $tabUser = '';
    $containerUser = '';

    $tabPassword = '';
    $containerPassword = '';

    if($tab == null || $tab == 'user')
    {
        $tabUser = 'active';
        $containerUser = 'show active';

    } else {

        $tabPassword = 'active';
        $containerPassword = 'show active';
    }
@endphp

@section('body')
        
    <div class="container">

        @include('components.alerts')

        <div class="mb-3">
            <h3 class="h4"> Editar Perfil </h3>
        </div>

        <!-- Tabs -->
        <div>
            <ul class="nav nav-tabs">
                <li class="nav-item" role="presentation">
                    <button class="nav-link {{$tabUser}}" id="user-tab" data-bs-toggle="tab" data-bs-target="#user-container" type="button" role="tab" aria-controls="user-container" arial-selected="true"> Usuário </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link {{$tabPassword}}" id="password-tab" data-bs-toggle="tab" data-bs-target="#password-container" type="button" role="tab" aria-controls="password-container" arial-selected="false"> Senha </button>
                </li>
            </ul>
        </div>

        <!-- Panels -->
        <div id="tab-containers" class="tab-content">

            <div id="user-container" class="tab-pane fade {{$containerUser}}" role="tabpanel" aria-labelledby="user-tab">

                <form class="" method="post" action="{{ route('update_perfil') }}" >    
                    @csrf
                    @method('POST')

                    <div class="border border-rounded mt-2 p-2">

                        <div class="row">
                            <div class="mb-4 col-12">
                                <div class="form-group">
                                    <label class="form-label" for="name"> Nome </label>
                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nome" value="{{ $user->name }}">
                                    @include('components.divs.errors', ['field' => 'name'])
                                </div>
                            </div>

                            <div class="mb-4 col-12">
                                <div class="form-group">
                                    <label class="form-label" for="document"> CPF </label>
                                    <input type="text" name="document" id="document" class="form-control @error('document') is-invalid @enderror" placeholder="###.###.###-##" value="{{ $user->document }}">
                                    @include('components.divs.errors', ['field' => 'document'])
                                </div>
                            </div>

                            <div class="mb-4 col-12">
                                <div class="form-group">
                                    <label class="form-label" for="email"> E-Mail </label>
                                    <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="E-Mail" value="{{ $user->email }}">
                                    @include('components.divs.errors', ['field' => 'email'])
                                </div>
                            </div>

                            <div class="mb-4 col-6">
                                <div class="form-group">
                                    <label class="form-label" for="campus_id"> Campus </label>
                                    <select class="form-control" name="campus_id" id="campus_id">
                                        @if($user->campus_id) 
                                            <option value="{{$user->campus_id}}" selected> {{$user->campus}} </option>
                                        @endif
                                    </select>
                                    @error('campus_id')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>
                            
                            
                            <div class="mb-4 col-6">
                                <div class="form-group">
                                    <label class="form-label" for="curso_id"> Curso </label>
                                    <select class="form-control" name="curso_id" id="curso_id">
                                        @if($user->curso_id) 
                                            <option value="{{$user->curso_id}}" selected> {{$user->curso}} </option>
                                        @endif
                                    </select>
                                    @error('curso_id')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>
                            
                        </div>

                    </div>

                    <div class="mt-1 text-end">
                        <div class="modal-footer">
                            @include('components.buttons.btn-save', ['id' => 'submit_perfil', 'content' => 'Atualizar'])

                            @include('components.buttons.btn-cancel', ['content' => 'Cancelar', 'route' => route('dashboard')])
                        </div>
                    </div>
                </form>
            </div>


            <div id="password-container" class="tab-pane fade {{$containerPassword}}" role="tabpanel" aria-labelledby="password-tab">
                <form method="post" action="{{ route('update_password') }}">
                    @csrf
                    @method('POST')
                    
                    <div class="border border-rounded mt-2 p-2">
                        <div class="row">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="password"> Senha </label>
                                        <input type="password" class="form-control" name="password" id="password" placeholder="Senha">
                                        @include('components.divs.errors', [
                                            'field' => 'password',
                                        ])
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="password_confirmation"> Confirmar Senha </label>
                                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirmar Senha">
                                        @include('components.divs.errors', [
                                            'field' => 'password_confirmation',
                                        ])
                                        @error('password_confirmation')
                                            <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-1 text-end">
                        <div class="modal-footer">
                            @include('components.buttons.btn-save', ['id' => 'submit_password', 'content' => 'Atualizar'])

                            @include('components.buttons.btn-cancel', ['content' => 'Cancelar', 'route' => route('dashboard')])
                        </div>
                    </div>
                </form>
            </div>
            
        </div>

    </div>

@endsection 

@section('scripts')
    <script type="text/javascript">

        //document
        $('#document').mask('000.000.000-00')
        $('#document').keypress(function() {
            $(this).mask('000.000.000-00')
        })

        //campus_id
        $('#campus_id').select2(
        {   
            placeholder: "Selecione um Campus",
            allowClear: true,
            ajax: {
                url: '{{ route("campus_search") }}',
                dataType: 'json'
            }
        });

        $('#campus_id').on('change', function (e) {
            $('#curso_id').empty()
        });

        //curso_id
        $('#curso_id').select2(
        {   
            placeholder: "Selecione um Curso",
            allowClear: true,
            ajax: {
                url: '{{ route("curso_search") }}',
                data: function(params) {
                    return {
                        q: params.term,
                        campus_id: $('#campus_id').val()
                    }
                },
                dataType: 'json'
            },
        });
    </script>               
@endsection