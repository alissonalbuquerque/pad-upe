{{--
    @include('pad.components.scripts.dimensao.ensino.show_modal', [
        'modal_id' => '',
        'route' => '', 
        'btn_class' => '',
    ])
--}}

<script type="text/javascript">
    $('.{{ $btn_class }}').click(function(e) {

        const id = $(this).attr('id')
        const _url = typeof(id) !== 'undefined'? ("{{ $route }}" + '/' + id) : ("{{ $route }}")

        $('#{{ $modal_id }}-content').empty()

        $.ajax({
            type: 'GET',
            url: _url
        }).done((data, status) => {
            $('#{{ $modal_id }}-content').append(data)    
        }).fail((data, status) => {
            $('#{{ $modal_id }}-content').append('Erro em Carregar Modal')
        })


        $('#{{ $modal_id }}').modal('show')
    })
</script>