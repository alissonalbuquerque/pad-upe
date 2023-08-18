{{--
    @include('components.buttons.btn-download', [
        'route'     => '',
        'id'        => '',
        'content'   => ''
    ])
--}}

<a class="btn btn-primary" href="{{$route}}" id="{{$id}}">
    <i class="bi bi-cloud-arrow-down"></i>
    {{$content}}
</a>
