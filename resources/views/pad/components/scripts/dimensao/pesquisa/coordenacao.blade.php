<script type="text/javascript">

    $('#get-divs').change(function(e) {
        e.preventDefault()

        const self = $(this)
        const cod_atividade = "1-"
        const user_pad_id = $('#user_pad_id').val()
        const field_cod_atividade = $('#pesquisa_coordenacao-form input[name=cod_atividade]')

        if(self.val() === 'pesquisa_coordenacao') {
            $.ajax({
                type: 'GET',
                url: "{{route('pesquisa_coordenacao_search')}}" + '/' + user_pad_id
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


    $('.btn-edit_pesquisa_coordenacao').click(function(e) {

        const id = $(this).attr('id')
        const route_pesquisa_coordenacao_edit = "{{route('pesquisa_coordenacao_edit')}}" + "/" + id

        $('#modal-label-title-header').text('Pesquisa - Coordenação')

        $.ajax({
            type: 'GET',
            url: route_pesquisa_coordenacao_edit
        }).done((data, status) => {
            $('#modal-content').empty()
            $('#modal-content').append(data)    
        }).fail((data, status) => {
            $('#modal-content').empty()
            $('#modal-content').append('Erro em Carregar Modal')
        })


        $('#modal').modal('show')
    })
    
</script>