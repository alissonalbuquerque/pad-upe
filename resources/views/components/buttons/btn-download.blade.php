{{--
    @include('components.buttons.btn-download', [
        'id' => '',
        'route' => '',
        'content' => ''
    ])
--}}

<a class="btn btn-primary" href="{{$route}}" id="{{$id}}">
    <i class="bi bi-cloud-arrow-down"></i>
    {{$content}}
</a>
