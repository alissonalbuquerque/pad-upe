{{--
    @include('components.buttons.btn-edit-task', [
        'btn_class' => '',
        'btn_id' => ''
    ])
--}}

<div class="btn-edit-tasks">
    <button type="button" class="btn btn-primary btn-sm {{ $btn_class }}" id="{{ $btn_id }}">
        <i class="bi bi-pencil-square"></i>
    </button>
</div>