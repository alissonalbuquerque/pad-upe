{{--
    @include('pad.components.scripts.cod_atividade', [
        'cod_atividade' => '',
        'form_id' => '',
        'div_selected' => '',
        'route' => '',
    ])
--}}

<script type="text/javascript">

    $('#get-divs').change(function(e) {
        e.preventDefault()

        const self = $(this)
        const cod_atividade = "{{ $cod_atividade }}"
        const user_pad_id = $('#user_pad_id').val()
        const field_cod_atividade = $('#{{ $form_id }} input[name=cod_atividade]')

        if(self.val() === '{{ $div_selected }}') {
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
        }

    }).change();

</script>