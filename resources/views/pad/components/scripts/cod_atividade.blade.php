{{--
    @include('pad.components.scripts.cod_atividade', [
        'route' => '',
        'form_id' => '',
        'cod_atividade' => '',
    ])
--}}

<script type="text/javascript">

    const cod_atividade = "{{ $cod_atividade }}"
    const user_pad_id = $('#user_pad_id').val()
    const field_cod_atividade = $('#{{ $form_id }} input[name=cod_atividade]')

    const alpha = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];

    $.ajax({
        type: 'GET',
        url: "{{ $route }}" + '/' + user_pad_id
    }).done(function(data, status) {

        let alpha_aulas = data.map((item) => {
            return item.cod_atividade.split('-').pop();
        })

        let new_alpha_aulas = alpha.filter((item) => !alpha_aulas.includes(item))

        field_cod_atividade.val(cod_atividade+new_alpha_aulas.shift())
        
    }).fail(function(message, status) {

    })

</script>