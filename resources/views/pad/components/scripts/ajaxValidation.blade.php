{{--
    @include('pad.components.scripts.ajaxValidation', [
        'btn_submit_id' => '',
        'form_id' => '',
        'route' => '',
        'div_errors' => '',
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
            url: "{{ route('ensino_aula_validate') }}",
            data: values
        }).done(function(data, status) {
            
            if(data.status == 200) {
                $('#{{ $form_id }}').submit()
            } else {
                Toastify({
                    text: "Erro no preenchimento dos campos",
                    duration: 3000
                }).showToast();
                
                let keys = Object.keys(data.errors)

                keys.forEach((key) => {
                    $('#'+'{{ $div_errors }}'+'_'+key+'-error').addClass('alert alert-danger')
                    $('#'+'{{ $div_errors }}'+'_'+key+'-error span').text(data.errors[key].shift())
                })
                
            }

        }).fail(function(data, status) {
            Toastify({
                text: "Erro ao atualizar a atividade",
                backgroundColor: '#e74c3c',
                duration: 3000
            }).showToast();
        })
    })

</script>
