{{--
    @include('pad.components.scripts.dimensao.ensino.show_modal', [
        'modal_id' => '',
        'route' => '', 
        'btn_edit_class' => '',
    ])
--}}


<script type="text/javascript">
    $('.{{ $btn_edit_class }}').click(function(e) {

        const id = $(this).attr('id')

        $.ajax({
            type: 'GET',
            url: "{{ $route }}" + "/" + id
        }).done((data, status) => {
            $('#{{ $modal_id }}-content').empty()
            $('#{{ $modal_id }}-content').append(data)    
        }).fail((data, status) => {
            $('#{{ $modal_id }}-content').empty()
            $('#{{ $modal_id }}-content').append('Erro em Carregar Modal')
        })


        $('#{{ $modal_id }}').modal('show')
    })
</script>