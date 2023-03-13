<form action="{{ $route }}" method="POST">
    @csrf
    <div class="row">

        <div class="col-sm-12">
            <div class="mb-3">
                <input type="text" class="form-control" value="UNIVERSIDADE DE PERNAMBUCO" disabled>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="mb-3">
                <label for="campus_id"> UNIDADE DE EDUCAÇÃO/CAMPUS </label>
                <select name="campus_id" id="campus_id" class="form-select"></select>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="mb-3">
                <label for="curso_id"> CURSO </label>
                <select name="curso_id" id="curso_id" class="form-select"></select>
            </div>
            
        </div>

        <div class="col-sm-12">
            <div class="mb-3">
                <label for="semestre">PLANO DE ATIVIDADE DOCENTE - ANO</label>
                <select name="semestre" id="semestre" class="form-select"></select>
            </div>
        </div>

        <div class="col-sm-8">
            <div class="mb-3">
                <label for="docente"> DOCENTE </label>
                <input type="text" id="docente" class="form-control" value="" disabled>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="mb-3">
                <label for="docente"> CPF </label>
                <input type="text" id="document" class="form-control" value="" disabled>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="mb-3">
                <label for="matricula"> MATRÍCULA </label>
                <input type="text" id="matricula" name="matricula" class="form-control" value="">
            </div>
        </div>

        <div class="col-sm-4">
            <div class="mb-3">
                <label for="carga_horaria"> CARGA HORÁRIA </label>
                <input type="text" id="carga_horaria" name="carga_horaria" class="form-control" value="">
            </div>
        </div>

        <div class="col-sm-4">
            <div class="mb-3">
                <label for="semestre"> CATEGORIA / NÍVEL </label>
                <select name="categoria_nivel" id="categoria_nivel" class="form-select"></select>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="mb-3">
                <label for="afastamento_total"> AFASTAMENTO TOTAL </label>
                <select name="afastamento_total" id="afastamento_total" class="form-select"></select>
            </div>
        </div>

        <div class="col-sm-8">
            <div class="afastamento_total_desc_field">
                <div class="mb-3">
                    <label for="afastamento_total_desc" class="form-label"> PORTARIA DE AFASTAMENTO (TOTAL) </label>
                    <textarea class="form-control" name="afastamento_total_desc" id="afastamento_total_desc"></textarea>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="mb-3">
                <label for="afastamento_parcial"> AFASTAMENTO PARCIAL </label>
                <select name="afastamento_parcial" id="afastamento_parcial" class="form-select"></select>
            </div>
        </div>

        <div class="col-sm-8">
            <div class="afastamento_parcial_desc_field">
                <div class="mb-3">
                    <label for="afastamento_parcial_desc" class="form-label"> PORTARIA DE AFASTAMENTO (PARCIAL) </label>
                    <textarea class="form-control" name="afastamento_parcial_desc" id="afastamento_parcial_desc"></textarea>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="mb-3">
                <label for="direcao_sindical"> EXERCE FUNÇÃO ADMINISTRATIVA </label>
                <select name="direcao_sindical" id="direcao_sindical" class="form-select"></select>
            </div>
        </div>

        <div class="col-sm-8">
            <div class="licenca_field">
                <div class="mb-3">
                    <label for="licenca" class="form-label"> LICENÇA DE ACORDO COM A LEGISLAÇÃO VIGENTE. ESPECIFIQUE </label>
                    <textarea class="form-control" name="licenca" id="licenca"></textarea>
                </div>
            </div>
        </div>

    </div>


    <div class="mt-4 text-end">
        @include('components.buttons.btn-save', [
            'btn_class' => 'btn btn-outline-success',
            'content' => 'Salvar',
        ])

        @include('components.buttons.btn-cancel', [
            'route' => route('pad_index'),
            'content' => 'Cancelar'
        ])
    </div>
</form>

@php
    use App\Models\Util\YesOrNo;

    $yes = YesOrNo::YES;
    $no = YesOrNo::NO;
@endphp

<script type="text/javascript">

    /** Interpolação: PHP => JS*/
    const yes = "{{ $yes }}"
    const no = "{{ $no }}"
    /** Interpolação: PHP => JS */

    $('#document').mask('###.###.###-##')

    $('#carga_horaria').mask('')
    $('#carga_horaria').keypress(() => {
        $('#carga_horaria').mask('')
    })
    
    //Config : select2

    $('#campus_id').select2(
    {   
        placeholder: 'Unidade - Campus',
        allowClear: true,
        ajax: {
            url: '{{ route("campus_search") }}',
            dataType: 'json'
        }
    });

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

    $('#semestre').select2(
    {
        placeholder: 'Semestre',
        allowClear: true
    })

    $('#afastamento_total').on('change', () =>
    {
        
    }).change()

</script>