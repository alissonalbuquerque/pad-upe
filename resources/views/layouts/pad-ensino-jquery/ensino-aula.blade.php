<script type="text/javascript">
    $('#curso_id').change(() => {
        const curso_id = $('#curso_id').val()
        const endpoint = "{{ route('get_disciplina_by_curso', 'curso_id') }}"
        const url = endpoint.replace('curso_id', curso_id)

        console.log(url);
        $.get(url, function(resultado){
           console.log(resultado);
        })
    })
</script>
