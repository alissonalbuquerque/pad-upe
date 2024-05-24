<?php

/**
 * @var $model App\Models\UserSearch
*/

?>

<form action="{{ route('user_index') }}" method="get">
    
    <div class="row">
    
        <div class="mb-3 col-6">
            <div class="form-group">
                <label class="form-label" for="name"> Nome </label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Nome" value="{{ $model->name }}">
            </div>
        </div>

        <div class="mb-3 col-6">
            <div class="form-group">
                <label class="form-label" for="email"> E-mail </label>
                <input type="email" name="email" id="email" class="form-control" placeholder="E-mail" value="{{ $model->email }}">
            </div>
        </div>

    </div>

    <div class="row">

        <div class="mb-3 col-6">
            <div class="form-group">
                <label class="form-label" for="campus_id"> Campus </label>
                <select class="form-control" name="campus_id" id="campus_id">
                    @if($model->campus_id) 
                        <option value="{{$model->campus_id}}" selected> {{$model->campus}} </option>
                    @endif
                </select>
            </div>
        </div>

        <div class="mb-3 col-6">
            <div class="form-group">
                <label class="form-label" for="curso_id"> Curso </label>
                <select class="form-control" name="curso_id" id="curso_id">
                    @if($model->curso_id) 
                        <option value="{{$model->curso_id}}" selected> {{$model->curso}} </option>
                    @endif
                </select>
            </div>
        </div>

    </div>

    <button type="submit" class="btn btn-primary"> Buscar </button>
    
</form>

<script>

    //campus_id
    $('#campus_id').select2(
    {
        placeholder: 'Unidade - Campus',
        allowClear: true,
        ajax: {
            url: '{{ route("campus_search") }}',
            dataType: 'json'
        }
    }).on('change', () => {
        $('#curso_id').empty()
    });

    //curso_id
    $('#curso_id').select2(
    {   
        placeholder: 'Curso',
        allowClear: true,
        ajax: {
            url: '{{ route("curso_search") }}',
            dataType: 'json',
            data: function(params) {
                return {
                    q: params.terms,
                    campus_id: $('#campus_id').val(),
                }
            },
        },
    });

</script>