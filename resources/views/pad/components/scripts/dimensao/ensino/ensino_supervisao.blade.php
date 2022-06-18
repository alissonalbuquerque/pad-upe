@php
    use App\Models\Tabelas\Constants;
    
    $type_group = Constants::ORIENTACAO_GRUPO;
@endphp

<script type="text/javascript">

    const supervisao_numero_individuos = $('#container_ensino_supervisao-numero_individuos');

    $('#ensino_supervisao-categoria').change(function() {
        if($(this).val() == {{$type_group}}) {
            supervisao_numero_individuos.show()
        } else {
            supervisao_numero_individuos.hide()
        }
    }).change()

</script>