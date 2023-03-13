<div class="mb-3">
    <h3 class="h3"> Cadastrar Papel </h3>
</div>

<form id="form-user_type-create" action="{{ route('user-type_store') }}" method="post">
    @csrf
    @method('POST')

    @include('user-type._form', [
        'user' => $user,
        'model' => $model,
        'types' => $types,
        'status' => $status,
        'operation' => $operation
    ])

    <div class="mt-1 text-end">
        <div class="modal-footer">
            @include('components.buttons.btn-save', [
                'id' => 'btn_submit',
                'content' => 'Cadastrar',
            ])

            @include('components.buttons.btn-close_modal')
        </div>
    </div>
</form>

@include('pad.components.scripts.ajaxValidation', [
    'btn_submit_id' => 'btn_submit',
    'form_id' => 'form-user_type-create',
    'route' => route('user-type_ajax_validation'),
    'form_type' => 'create_and_update',
])