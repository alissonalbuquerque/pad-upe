{{--
    @include('components.buttons.btn-create', [
        'id' => '',
        'route' => '',
        'content' => ''
    ])
--}}

<a class="btn btn-primary" href="{{$route}}" id="{{$id}}">
    {{-- <i class="bi bi-plus-circle"></i> --}}
    {{$content}}
</a>
