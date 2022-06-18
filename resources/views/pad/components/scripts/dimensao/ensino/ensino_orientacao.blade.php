@php
    use App\Models\Tabelas\Constants;
    
    $type_group = Constants::ORIENTACAO_GRUPO;
@endphp

<script type="text/javascript">

    const orientacao_numero_individuos = $('#container_ensino_orientacao-numero_individuos');

    $('#ensino_orientacao-categoria').change(function() {
        if($(this).val() == {{$type_group}}) {
            orientacao_numero_individuos.show()
        } else {
            orientacao_numero_individuos.hide()
        }
    }).change()

</script>