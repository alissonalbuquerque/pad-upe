{{--
    @include('components.buttons.btn-save', [
        'id' => '',
        'content' => '',
    ])
--}}

@php
    if(!isset($id))
    {
        $id = '';
    }
@endphp

<button class="btn btn-success" id="{{ $id }}" type="submit">
    <i class=""></i>
    {{ $content }}
</button>
