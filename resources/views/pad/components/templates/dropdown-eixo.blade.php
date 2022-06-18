
<div class="mb-3 row">
    <div class="">
        <select class="form-select" name="get-divs" id="get-divs">
            <option selected value="0">Selecione uma categoria</option>
            @foreach ($divs as $div)
                <option value="{{ $div['id'] }}"> {{ $div['name'] }}</option>
            @endforeach
        </select>
    </div>
</div>
