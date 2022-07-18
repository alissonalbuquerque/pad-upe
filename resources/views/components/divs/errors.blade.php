{{--
    @include('components.divs.errors', [
        'form' => '',
        'field' => '',
    ])
--}}

@php
    if(!isset($form)) {
        $div_id = $field;
    } else {
        $div_id = $form . '_' . $field;
    }
@endphp

@if( $errors->has($field) )
    @error($field)
        <div class="alert alert-danger">
            <span>{{$message}}</span>
        </div>
    @enderror
@endif

@if( !$errors->has($field) )
    <div id="{{ $div_id }}-error" class="ajax-errors">
        <span></span>
    </div>
@endif