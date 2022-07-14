
<div class="mb-3 row">
    <div class="">
        <select class="form-select" name="get-divs" id="get-divs">
            <option value="0">Selecione uma categoria</option>
            @foreach ($divs as $div)
                @if(isset($form_selected))
                    @if($div['id'] === $form_selected)
                        <option selected value="{{ $div['id'] }}"> {{ $div['name'] }}</option>
                    @else
                        <option value="{{ $div['id'] }}"> {{ $div['name'] }}</option>
                    @endif
                @else
                    <option value="{{ $div['id'] }}"> {{ $div['name'] }}</option>
                @endif

            @endforeach
        </select>
    </div>
</div>
