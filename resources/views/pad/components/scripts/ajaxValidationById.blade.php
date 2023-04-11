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

        const form = $('#{{ $form_id }}').serializeArray()
        
        $('.ajax-errors').removeClass('alert alert-danger is-valid is-invalid')
        $('.ajax-errors span').empty();

        $.ajax({
            type: 'POST',
            url: "{{ $route }}",
            data: form
        }).done(function(data, status) {
            
            if(data.status == 200) {

                Toastify({
                    text: "Campos preenchidos com sucesso",
                    style: {
                        background: "linear-gradient(to right, #00b09b, #96c93d)",
                    },
                    duration: 3000
                }).showToast();

                let form_keys = form.map((item) => {
                    return item.id
                })
                form_keys = cleanFormKeys(form_keys, [])

                form_keys.forEach((key) => {
                    $('#{{ $form_id }} #'+key).addClass('is-valid')
                })

                $('#{{ $form_id }}').submit()
            } else {
                
                Toastify({
                    text: "Erro no preenchimento dos campos",
                    style: {
                        background: "linear-gradient(to right, #fe0944, #feae96)"
                    },
                    duration: 3000
                }).showToast();

                
                let form_keys = form.map((item) => {
                    return item.id
                })
                form_keys = cleanFormKeys(form_keys, Object.keys(data.errors))

                form_keys.forEach((key) => {
                    $('#{{ $form_id }} #'+key).addClass('is-valid')
                })
                
                let keys = Object.keys(data.errors)
                keys.forEach((key) => {
                    $('#{{ $form_id }} #'+key).addClass('is-invalid')
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


    function cleanFormKeys(_form_keys, _errors_keys)
    {   
        let errors_keys = _errors_keys
        errors_keys.push('_token')
        errors_keys.push('user_pad_id')
        
        return (
            _form_keys.filter((key) => {
                return !errors_keys.includes(key)
            })
        )
    }
</script>
