@php
    use App\Models\TaskTime;

    /**
     * @var App\Models\TaskTime $model
    */
@endphp

<form id="form-delete-{{$model->id}}" action="{{ route('TaskTimeDelete', ['id' => $model->id]) }}" method="post">
    @method('DELETE')
    @csrf
</form>

<form id="task-time-update-form" action="{{ route('TaskTimeUpdate', ['id' => $model->id]) }}" method="post">
    @csrf
    @method('POST')

    <div class="row">

        <input type="hidden" id="user_pad_id" name="user_pad_id" value="{{ $model->user_pad_id }}">

        <input type="hidden" id="tarefa_id" name="tarefa_id" value="{{ $model->tarefa_id }}">

        <input type="hidden" id="type" name="type" value="{{ $model->type }}">´

        <input type="hidden" id="id" name="id" value="{{ $model->id }}">

        <div class="mb-4 col-sm-2">
            <div class="">
                <label class="form-label" for="cod_atividade">Cód. Atividade</label>
                <input type="text" id="cod_atividade" name="cod_atividade" value="{{ $model->tarefa->cod_atividade }}" readonly class="form-control @error('cod_atividade') is-invalid @enderror ajax-errors">
            </div>

            @include('components.divs.errors', [
                'field' => 'cod_atividade_update'
            ])
        </div>

        <div class="col-sm-10">
            <div class="mt-3">
                <label for="weekday">Dia da Semana</label>
                <select name="weekday" id="weekday" class="form-select @error('weekday') is-invalid @enderror ajax-errors">
                    @foreach(TaskTime::listWeekDays() as $id => $text)
                        @if( $model->weekday == $id)
                            <option selected value="{{$id}}">{{$text}}</option>
                        @else
                            <option value="{{$id}}">{{$text}}</option>
                        @endif
                    @endforeach
                </select>

                @include('components.divs.errors', [
                    'field' => 'weekday_update'
                ])
            </div>
        </div>

        <div class="col-sm-12">
            <div class="">
                <label for="slct_tarefa_id">Atividade</label>
                <select name="slct_tarefa_id" id="slct_tarefa_id" class="form-select @error('slct_tarefa_id') is-invalid @enderror ajax-errors">
                    <option selected value="{{$model->tarefa_id}}">{{$model->getName()}}</option>
                </select>
            </div>

            @include('components.divs.errors', [
                'field' => 'slct_tarefa_id'
            ])
        </div>

        <div class="col-sm-6">
            <div class="mt-3">
                <label class="form-label" for="start_time">Horário Inicial</label>
                <input type="time" name="start_time" id="start_time" value="{{$model->start_time}}" class="form-control @error('start_time') is-invalid @enderror ajax-errors" >
                
                @include('components.divs.errors', [
                    'field' => 'start_time_update',
                ])
            </div>
        </div>

        <div class="col-sm-6">
            <div class="mt-3">
                <label class="form-label" for="end_time">Horário Final</label>
                <input type="time" name="end_time" id="end_time" value="{{$model->end_time}}" class="form-control @error('end_time') is-invalid @enderror ajax-errors" >
                
                @include('components.divs.errors', [
                    'field' => 'end_time_update',
                ])
            </div>
        </div>
    </div>
    
    <div class="mt-4">
        <div class="modal-footer">
            <div class="text-start">
                @include('components.buttons.btn-delete-by-alert', [
                    '_id' => $model->id,
                    '_class' => "delete_task_time",
                ])
            </div>
            <div class="text-end">
                @include('components.buttons.btn-save', [
                    'id' => 'btn_submit',
                    'content' => 'Atualizar',
                ])

                @include('components.buttons.btn-close_modal')
            </div>
        </div>
    </div>

</form>

@include('pad.components.scripts.ajaxValidation', [
    'btn_submit_id' => 'btn_submit',
    'form_id' => 'task-time-update-form',
    'route' => route('TaskTimeValidation'),
    'form_type' => 'update',
])

<script type="text/javascript">

    $('#weekday').select2(
    {   
        allowClear: true,
        placeholder: 'Dia da Semana',
        dropdownParent: $('#modal')
    })

    $('#slct_tarefa_id').select2(
    {
        allowClear: true,
        placeholder: 'Tarefa',
        language: {
            noResults: function() {
                return "Resultados não Encontrados";
            }
        },
        ajax: {
            url: '{{ route("TaskSearch") }}',
            data: function(params) {
                return {
                    q: params.term,
                    user_pad_id : {{$model->user_pad_id}}
                }
            },
            dataType: 'json'
        },
        dropdownParent: $('#modal')
    })

    $('#slct_tarefa_id').on('change', function(e)
    {   
        const type = $('#type')
        const tarefa_id = $('#tarefa_id')

        $('#cod_atividade').val('')

        if($(this).val()) {
            const value = $(this).val()
            const split_data = value.split('|')

            const split_tarefa_id = split_data[0].split('_')
            const split_type = split_data[1].split('_')

            const _tarefa_id = split_tarefa_id[1]
            const _type = split_type[1]

            type.val(_type)
            tarefa_id.val(_tarefa_id)

            $.ajax({
                url: '{{ route("TaskTimeSearchTask") }}',
                type: 'GET',
                data: {
                    tarefa_id: _tarefa_id,
                    type: _type
                },
                dataType: 'json',
                success: (response) => {
                    const cod_atividade = response.task.cod_atividade
                    $('#cod_atividade').val(cod_atividade)
                },
                error: (xhr, status, error) => {
                    console.error('Erro na requisição!');
                }
            });   
        }
    })

</script>
