@php
    use App\Models\TaskTime;
@endphp

<form id="task-time-form" action="{{ route('TaskTimeSave') }}" method="post">
    @csrf
    @method('POST')

    <div class="row">

        <input type="hidden" id="user_pad_id" name="user_pad_id" value="{{ $user_pad_id }}">

        <input type="hidden" id="tarefa_id" name="tarefa_id" value="">

        <input type="hidden" id="type" name="type" value="">

        <input type="hidden" id="id" name="id" value="">

        <div class="mb-4 col-sm-2">
            <div class="">
                <label class="form-label" for="cod_atividade">Cód. Atividade</label>
                <input class="form-control @error('cod_atividade') is-invalid @enderror ajax-errors" type="text" name="cod_atividade" id="cod_atividade" readonly>
            </div>

            @include('components.divs.errors', [
                'field' => 'cod_atividade_create'
            ])
        </div>

        <div class="col-sm-10">
            <div class="mt-3">
                <label for="weekday">Dia da Semana</label>
                <select name="weekday" id="weekday" class="form-select @error('weekday') is-invalid @enderror ajax-errors">
                    @foreach(TaskTime::listWeekDays() as $id => $text)
                        <option value="{{$id}}">{{$text}}</option>
                    @endforeach
                </select>

                @include('components.divs.errors', [
                    'field' => 'weekday_create'
                ])
            </div>
        </div>

        <div class="col-sm-12">
            <div class="">
                <label for="slct_tarefa_id">Atividade</label>
                <select name="slct_tarefa_id" id="slct_tarefa_id" class="form-select @error('slct_tarefa_id') is-invalid @enderror ajax-errors">
                </select>
            </div>

            @include('components.divs.errors', [
                'field' => 'slct_tarefa_id_create'
            ])
        </div>

        <div class="col-sm-6">
            <div class="mt-3">
                <label class="form-label" for="start_time">Horário Inicial</label>
                <input type="time" min="07:30" max="21:15" name="start_time" id="start_time" class="form-control @error('start_time') is-invalid @enderror ajax-errors" >
                
                @include('components.divs.errors', [
                    'field' => 'start_time_create',
                ])
            </div>
        </div>

        <div class="col-sm-6">
            <div class="mt-3">
                <label class="form-label" for="end_time">Horário Final</label>
                <input type="time" min="07:30" max="21:15" name="end_time" id="end_time" class="form-control @error('end_time') is-invalid @enderror ajax-errors" >
                
                @include('components.divs.errors', [
                    'field' => 'end_time_create',
                ])
            </div>
        </div>

    </div>

    <div class="mt-1 text-end">
        <div class="modal-footer">
            @include('components.buttons.btn-save', [
                'id' => 'btn_submit',
                'content' => 'Cadastrar',
            ])

            @include('components.buttons.btn-close_modal')
        </div>
    </div>

</form>

@include('pad.components.scripts.ajaxValidation', [
    'btn_submit_id' => 'btn_submit',
    'form_id' => 'task-time-form',
    'route' => route('TaskTimeValidation'),
    'form_type' => 'create',
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
                    user_pad_id : {{$user_pad_id}}
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
