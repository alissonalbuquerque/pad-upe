{{--
    @include('pad.components.scripts.dimensao.ensino.show_modal', [
        'btn_edit_class' => '', 
        'route' => '', 
        'modal_id' => '', 
        'header' => '', 
    ])
--}}


<script type="text/javascript">
    $('.{{ $btn_edit_class }}').click(function(e) {

        const id = $(this).attr('id')

        
        $('#modal-label-title-header-{{ $modal_id }}').text('{{ $header }}')

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