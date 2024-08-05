<?php

/**
 * @var $model App\Models\TeacherAvaliatorSearch
 */

?>

<form action="{{ route('pad_professores', ['id' => $model->pad_id]) }}  " method="get">

    <div class="row">

        <div class="mb-3 col-6">
            <div class="form-group">
                <label class="form-label" for="name"> Nome </label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Nome" value="{{ $model->name }}">
            </div>
        </div>

        <div class="mb-3 col-6">
            <div class="form-group">
                <label class="form-label" for="email"> E-Mail </label>
                <input type="email" name="email" id="email" class="form-control" placeholder="E-Mail" value="{{ $model->email }}">
            </div>
        </div>

    </div>

    <button type="submit" class="btn btn-primary"> Buscar </button>

</form>
