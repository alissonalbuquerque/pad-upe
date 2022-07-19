{{--
    @include('components.divs.errors', [
        'field' => '',
    ])
--}}

@if( $errors->has($field) )
    @error($field)
        <div class="alert alert-danger">
            <span>{{$message}}</span>
        </div>
    @enderror
@endif

@if( !$errors->has($field) )
    <div id="{{ $field }}-error" class="ajax-errors">
        <span></span>
    </div>
@endif