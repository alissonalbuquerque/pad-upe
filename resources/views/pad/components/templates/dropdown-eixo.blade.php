
<div class="mb-3">
    
    <div class="">

        <form action="" method="get" id="alter_task-form">
            <div class="row">
                <div class="text-end">
                    <div class="mb-3 col">
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

                    <div class="mb-3 col">
                        @include('components.buttons.btn-save', [
                            'id' => 'alter_task',
                            'content' => 'Carregar',
                        ])
                    </div>
                </div>
            </div>
        </form>
        
    </div>
</div>
