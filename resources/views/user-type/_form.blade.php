@php
    function field_validate($field)
    {
        $type_form = 'create_and_update';

        return sprintf("%s_%s", $type_form, $field);
    }
@endphp

<div class="row">

    <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}">

    <div class="mb-3 col-sm-12">
        <label class="form-label" for="user_name"> Usuário </label>
        <input class="form-control" type="text" disabled value="{{ $user->name }}">
    </div>

    <div class="mb-3 col-sm-6">
        <label class="form-label" for="type">Papel</label>
        <select class="form-select @error('papel') is-invalid @enderror ajax-errors" name="type" id="type">
            <option value="0">Selecione um Papel</option>
            @foreach($types as $value => $type)
                @if( $value == $model->type )
                    <option selected value="{{$value}}">{{$type}}</option>
                @else
                    <option value="{{$value}}">{{$type}}</option>
                @endif
            @endforeach
        </select>

        @include('components.divs.errors', [
            'field' => field_validate('type')
        ])
    </div>

    <div class="mb-3 col-sm-6">
        <label class="form-label" for="status">Status</label>
        <select class="form-select @error('status') is-invalid @enderror ajax-errors" name="status" id="status">
            <option value="0">Selecione um Status</option>
            @foreach($status as $value => $stat)
                @if( $value == $model->status )
                    <option selected value="{{$value}}">{{$stat}}</option>
                @else
                    <option value="{{$value}}">{{$stat}}</option>
                @endif
            @endforeach
        </select>

        @include('components.divs.errors', [
            'field' => field_validate('nivel')
        ])
    </div>

</div>
