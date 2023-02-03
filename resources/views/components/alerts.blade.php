{{--
    @include('components.alerts')
--}}
@if( Session::has('success') )
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ Session::get('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </button>
    </div>
@endif

@if( Session::has('fail') )
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ Session::get('fail') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if( Session::has('error') )
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ Session::get('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if( Session::has('warning') )
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ Session::get('warning') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif