{{--
    @include('pad.components.scripts.ajaxValidation', [
        'btn_submit_id' => '',
        'form_id' => '',
        'route' => '',
        'form_type' => '',
    ])
--}}

<script type="text/javascript">

    $('#{{ $btn_submit_id }}').click(function(e) {
        e.preventDefault()

        const values = $('#{{ $form_id }}').serializeArray()
        
        $('.ajax-errors').removeClass('alert alert-danger')
        $('.ajax-errors span').empty();

        $.ajax({
            type: 'POST',
            url: "{{ $route }}",
            data: values
        }).done(function(data, status) {
            
            if(data.status == 200) {

                Toastify({
                    text: "Campos preenchidos com sucesso",
                    style: {
                        background: "linear-gradient(to right, #00b09b, #96c93d)",
                    },
                    duration: 3000
                }).showToast();

                $('#{{ $form_id }}').submit()
            } else {
                
                Toastify({
                    text: "Erro no preenchimento dos campos",
                    style: {
                        background: "linear-gradient(to right, #fe0944, #feae96)"
                    },
                    duration: 3000
                }).showToast();
                
                let keys = Object.keys(data.errors)

                keys.forEach((key) => {
                    $('#'+key+'_'+'{{ $form_type }}'+'-error').addClass('alert alert-danger')
                    $('#'+key+'_'+'{{ $form_type }}'+'-error span').text(data.errors[key].shift())
                })
                
            }

        }).fail(function(data, status) {
            Toastify({
                text: "Erro ao atualizar a atividade",
                style: {
                    background: "linear-gradient(to right, #fe0944, #feae96)"
                },
                duration: 3000
            }).showToast();
        })
    })

</script>
