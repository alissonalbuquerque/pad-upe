{{--
    @include('components.buttons.btn-show-modal', [
        '_id' => '',
        '_icon' => '',
        '_class' => '',
        '_content' => '',
        '_target_class' => '',
    ])
--}}

@php
    $_id = !isset($_id) ? '' : $_id;

    $_icon = !isset($_icon) ? '' : "bi bi-{$_icon}";

    $_class = !isset($_class) ? "btn {$_target_class}" : "btn {$_class} {$_target_class}";

    $_content = !isset($_content) ? '' : $_content;
@endphp

<div class="btn-show-modal">
    <button type="button" id="{{$_id}}" class="{{$_class}}">
        <i class="{{$_icon}}"></i> {{$_content}}
    </button>
</div>