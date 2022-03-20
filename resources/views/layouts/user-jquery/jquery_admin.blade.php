<script type="text/javascript">

$( document ).ready(() => {

    $("#update-perfil-tab").hide()

    const table_unidades = $('#table_unidades')

    $.ajax({
        type: 'get',
        url: "{{ route('listar_unidades') }}",
        success: (unidades) => {

            table_unidades.append(`
                <tr>
                    <th scope="col"> # <th>
                    <th scope="col"> Nome <th>
                    <th scope="col"> Opções <th>
                </tr>
            `)

            unidades.forEach( (unidade, index) => {
                table_unidades.append(`
                    <tr>
                        <td scope="row"> ${index+1} <td>  
                        <td> ${unidade.name} <td>
                        <td>
                            @include('components.buttons.btn-edit', ['route' => ''])
                            @include('components.buttons.btn-delete', ['route' => ''])
                        </td>
                    </tr>
                `)
            })
        }
    })


    const table = $('#list_campus')

    @if(false)
    $.ajax({
        type: 'get',
        url: "{{ route('list_campus_by_unidade', ['unidade_id' => Auth::user()->unidade_id]) }}",
        success: (campus) => {

            table.append(`
                <tr>
                    <th scope="col"> # <th>
                    <th scope="col"> Nome <th>
                </tr>
            `)

            campus.forEach( (campi, index) => {
                table.append(`
                    <tr>
                        <td scope="row"> ${index+1} <td>  
                        <td> ${campi.name} <td>
                    </tr>
                `)
            })
        }
    })
    @endif

})

$("#btn-update-perfil").on('click', () => {
    $("#update-perfil-tab").click()
})

</script>
