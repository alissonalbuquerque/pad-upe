<script type="text/javascript">

    $(document).ready(() => {

        if( $('#curso_id').val() === '0' ) {
            $('#componente_curricular').prop('disabled', true)
        }

    })

    

    $('#curso_id').change(() => {

        $('#componente_curricular').children('option').remove();

        const _curso_id = $('#curso_id').val()

        const _endpoint = "{{ route('get_disciplina_by_curso', 'curso_id') }}"

        const _url = _endpoint.replace('curso_id', _curso_id)

        if( $('#curso_id').val() === '0' ) {
            $('#componente_curricular').prop('disabled', true)
        } else {
            $('#componente_curricular').prop('disabled', false)
        }
        
        $.ajax({
            type: "get",
            url: _url,
            success: (disciplinas) => {
                $('#componente_curricular').append(`<option value='0' selected> Selecionar Disciplina </option>`)

                disciplinas.forEach( (disciplina) => {
                    $('#componente_curricular').append(`<option value=${disciplina.id}> ${disciplina.name} </option>`)
                })
            },
        });

    })

</script>
