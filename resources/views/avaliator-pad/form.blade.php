@php
    function field_validate($field)
    {
        $type_form = 'create_and_update';

        return sprintf("%s_%s", $type_form, $field);
    }
@endphp

<div class="row">

    <input type="hidden" name="pad_id" id="pad_id" value="{{ $pad->id }}">

    <div class="mb-3 col-sm-12">
        <label class="form-label" for="user_id"> Avaliador </label>
        <select class="form-select @error('user_id') is-invalid @enderror ajax-errors" name="user_id" id="user_id">
            <option value="0">Selecione um Avaliador</option>
            @foreach($users as $user)
                @if( $user->id == $model->user_id )
                    <option selected value="{{$user->id}}">{{$user->name}}</option>
                @else
                    <option value="{{$user->id}}">{{$user->name}}</option>
                @endif
            @endforeach
        </select>

        @include('components.divs.errors', [
            'field' => field_validate('user_id')
        ])
    </div>

    <div class="mb-3 col-sm-6">
        <label class="form-label" for="pad_name"> PAD </label>
        <input class="form-control" type="text" disabled value="{{ $pad->nome }}">
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

    <div class="mb-3 col-sm-12">
        <label class="form-label" for="status">Dimensões</label>
        <select class="form-select @error('dimensoes_multiples') is-invalid @enderror ajax-errors" id="dimensoes_multiples" name="dimensoes_multiples[]" multiple="multiple">
            @foreach ($dimensoes as $value => $dimensao)
                <option value="{{$value}}">{{$dimensao}}</option>    
            @endforeach
        </select>

        {{-- @include('components.divs.errors', [
            'field' => field_validate('dimensoes_multiples')
        ]) --}}
    </div>

</div>

@php
    $dimensoes_multiples = json_encode($model->dimensoes_multiples);
@endphp

<script type="text/javascript">

    $('#user_id').select2(
    {   
        placeholder: 'Avaliador...',
        allowClear: true,
        ajax: {
            url: '{{ route("user_search") }}',
            data: {remove_avaliators_by_pad_id : {{$pad->id}}},
            dataType: 'json'
        },
        dropdownParent: $('#modal')
    });

    $('#dimensoes_multiples').select2(
    {
        dropdownParent: $('#modal')
    });
    
    $('#dimensoes_multiples').val({!! $dimensoes_multiples !!}).trigger('change')
    
</script>