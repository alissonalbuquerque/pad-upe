
<div class="mb-3">
    <h3 class="h3"> Cadastrar Avaliador (PDA) </h3>
</div>

<form id="form-user_pad" action="{{ route('avaliator-pad_store') }}" method="post">
    @csrf
    @method('POST')

    @include('avaliator-pad.form', [
        'pad' => $pad,
        'model' => $model,
        'users' => $users,
        'status' => $status,
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

@include('pad.components.scripts.ajaxValidationById', [
    'btn_submit_id' => 'btn_submit',
    'form_id' => 'form-user_pad',
    'form_type' => 'create_and_update',
    'route' => route('avaliador-pad_ajax_validation'),
])
