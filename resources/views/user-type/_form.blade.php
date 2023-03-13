<div class="row">

    <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}">
    <input type="hidden" name="id" id="id" value="{{ $model !== null? $model->id : null }}">
    <input type="hidden" name="operation" id="operation" value="{{ $operation }}">

    <div class="mb-3 col-sm-12">
        <label class="form-label" for="user_name"> Usuário </label>
        <input class="form-control" type="text" disabled value="{{ $user->name }}">
    </div>

    @php
        $select_disabled = $operation === 'update'? 'disabled' : '';
    @endphp
    <div class="mb-3 col-sm-6">
        <label class="form-label" for="type">Papel</label>
        <select class="form-select @error('papel') is-invalid @enderror ajax-errors" name="type" id="type" {{ $select_disabled }}>
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
            'field' => 'type_create_and_update'
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
            'field' => 'status_create_and_update'
        ])
    </div>

</div>
