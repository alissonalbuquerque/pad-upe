<script>

    $( document ).ready(() => {
        console.log('Ready')
    })

    $('#curso_id').change(() => {
        console.log('OK');
    })
    function getComponentesCurriculares(){
        let url = $("#urlGetDisciplinaByCurso").val();
        url = url.replace("#", $('#curso_id').val());
        $.get(url, function(result){
            console.log(result);
        })
    }
</script>
