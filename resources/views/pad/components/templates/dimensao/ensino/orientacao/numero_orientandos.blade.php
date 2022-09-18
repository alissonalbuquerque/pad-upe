{{--
    @include('pad.components.templates.dimensao.ensino.orientacao.numero_orientandos', ['form_id' = ''])
--}}

@php
    use App\Models\Util\Orientacao;

    $orientacao_grupo = Orientacao::GRUPO;
@endphp

<script type="text/javascript">

    $(document).ready(function() {

        $('#{{$form_id}} #type_orientacao').on('change', function() {
            if($(this).val() == {{$orientacao_grupo}}) {
                $('#{{$form_id}} #numero_orientandos').show()
                $("#{{$form_id}} label[for='numero_orientandos']").show()
            } else {
                $('#{{$form_id}} #numero_orientandos').hide()
                $("#{{$form_id}} label[for='numero_orientandos']").hide()
                
                $('#{{$form_id}} #numero_orientandos').val('1')
            }
        }).change()
    });

</script>