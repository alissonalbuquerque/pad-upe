
@extends('layouts.main')

@section('title', 'Usuários')

@section('header')
    @include('layouts.header', [
        'user' => Auth::user(),
    ])
@endsection

@section('nav')
    @include('layouts.navigation', [
        'index_menu' => $menu,
    ])
@endsection

@section('body')

<div class="container">
    
    @include('components.alerts')

    <div class="mb-3">
        <h3 class="h4"> Atualizar - Usuário </h3>
    </div>

    @include('users._form', [
        'action' => route('user_update', ['id' => $model->id]),
        'model' => $model,
        'status' => $status,
        'profiles' => $profiles,
        'tab' => $tab,
    ])

    @include('components.modal', [
        'size' => 'modal-lg',
    ])
</div>

@endsection

@section('scripts')

    @include('pad.components.scripts.dimensao.ensino.show_modal', [
        'modal_id' => 'modal',
        'route' => route('user-type_create', ['user_id' => $model->id]),
        'btn_class' => 'user-type-create',
    ])

    @include('pad.components.scripts.dimensao.ensino.show_modal', [
        'modal_id' => 'modal',
        'route' => route('user-type_edit'),
        'btn_class' => 'btn-edit_user_type',
    ])

    <script text="type/javascript">

        $('#campus_id').select2(
        {   
            placeholder: "Selecione um Campus",
            allowClear: true,
            ajax: {
                url: '{{ route("campus_search") }}',
                dataType: 'json'
            }
        });

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

        $('#status').select2(
        {   
            placeholder: "Selecione um Status",
            allowClear: true,
            hideSearch: true,
            minimumResultsForSearch: -1
        });

    </script>

@endsection