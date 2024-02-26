@php
    use App\Models\TaskTime;
@endphp

<form id="form-user_pad" action="{{ route('TaskTimeSave') }}" method="post">
    @csrf
    @method('POST')

    <div class="col-sm-12">
        <div class="mb-3">
            <label for="weekday">Atividade</label>
            <select name="tarefa_id" id="tarefa_id" class="form-select">
                <!-- @foreach(TaskTime::listWeekDays() as $id => $text)
                    <option value="{{$id}}">{{$text}}</option>
                @endforeach -->
            </select>
        </div>
    </div>

    <div class="col-sm-12">
        <div class="mb-3">
            <label for="weekday">Dia da Semana</label>
            <select name="weekday" id="weekday" class="form-select">
                @foreach(TaskTime::listWeekDays() as $id => $text)
                    <option value="{{$id}}">{{$text}}</option>
                @endforeach
            </select>
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

<script type="text/javascript">

    $('#weekday').select2(
    {   
        allowClear: true,
        placeholder: 'Dia da Semana',
        dropdownParent: $('#modal')
    })

    $('#tarefa_id').select2(
    {   
        allowClear: true,
        placeholder: 'Tarefa',
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

</script>