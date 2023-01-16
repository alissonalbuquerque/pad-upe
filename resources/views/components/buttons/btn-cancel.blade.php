{{--
    @include('components.buttons.btn-cancel', [
        'route' => '',
        'content' => ''
    ])
--}}

<a class="btn btn-danger" href="{{ $route }}">
    <i class="bi bi-x-circle"></i>
    {{ $content }}
</a>
