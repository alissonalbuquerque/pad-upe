<?php

/**
 * @var $model App\Search\UserPadSearch;
 */

?>

<div class="m-2 p-2">

    <form action="{{ route('pad_edit', ['id' => $model->pad_id]) }}" method="get">

        <div class="row">

            <div>
                <input type="hidden" name="search_tab" value="user_pad">
            </div>

            <div>
                <input type="hidden" name="pad_id" value="{{ $model->pad_id }}">
            </div>

            <div class="mb-3 col-6">
                <div class="form-group">
                    <label class="form-label" for="name"> Nome </label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Nome" value="{{ $model->name }}">
                </div>
            </div>

            <div class="mb-3 col-6">
                <div class="form-group">
                    <label class="form-label" for="email"> E-Mail </label>
                    <input type="text" name="email" id="email" class="form-control" placeholder="E-Mail" value="{{ $model->email }}">
                </div>
            </div>

        </div>

        <button type="submit" class="btn btn-primary"> Buscar </button>

    </form>

</div>

<hr>
