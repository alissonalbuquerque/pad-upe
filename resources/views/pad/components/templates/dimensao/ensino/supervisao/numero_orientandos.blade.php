{{--
    @include('pad.components.templates.dimensao.ensino.supervisao.numero_orientandos', ['form_id' => ''])
--}}

@php
    use App\Models\Util\Supervisao;

    $supervisao_grupo = Supervisao::GRUPO;
@endphp

<script type="text/javascript">

    $(document).ready(function() {

        $('#{{$form_id}} #type_supervisao').on('change', function() {
            if($(this).val() == {{$supervisao_grupo}}) {
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