<script type="text/javascript">

    $('#get-divs').change(function(e) {
        e.preventDefault()

        const self = $(this)
        const cod_atividade = "1-"
        const user_pad_id = "{{ $user_pad_id }}"
        const field_cod_atividade = $('#ensino_aulas-form input[name=cod_atividade]')

        const route_ensino_aula_search = "{{ route('ensino_aula_search') }}"
        const route_ensino_aula_delete  = "{{ route('ensino_aula_delete') }}"
        const route_ensino_aula_update  = "{{ route('ensino_aula_update') }}"

        $('#ensino_aulas-table > tbody').empty()

        if(self.val() === 'ensino_aulas') {
            $.ajax({
                type: 'GET',
                url: route_ensino_aula_search + '/' + user_pad_id
            }).done(function(data, status) {

                if(!$('#ensino_aulas-form input[name=model_id]').val())
                {
                    let alpha_aulas = data.map((item) => {
                        return item.cod_atividade.split('-').pop();
                    })

                    let new_alpha_aulas = alpha.filter((item) => !alpha_aulas.includes(item))

                    field_cod_atividade.val(cod_atividade+new_alpha_aulas.shift())

                    data.forEach((item) => {
                        $('#ensino_aulas-table > tbody').append(
                            `<tr> 
                                <td> ${item.cod_atividade} </td>
                                <td> ${item.componente_curricular} </td>
                                <td> ${item.curso} </td>
                                <td> ${niveis.get(item.nivel)} </td>
                                <td> ${modalidades.get(item.modalidade)} </td>
                                <td> ${item.ch_semanal} </td>
                                <td> ${item.ch_total} </td>
                                <td>
                                    <div class="edit_ensino_aula">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_ensino_aula_edit-${item.id}">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="modal_ensino_aula_edit-${item.id}" tabindex="-1" aria-labelledby="modal_ensino_aula_edit_label-${item.id}" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title" id="modal_ensino_aula_edit_label_title-${item.id}">Atualizar</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <form action="${route_ensino_aula_update}" method="post" id="ensino_aulas_update_${item.id}-form" class="">
                                                            @csrf
                                                        
                                                            <div class="row">
                                                                
                                                                <input type="hidden" id="id" name="id" value="${item.id}">

                                                                <input type="hidden" name="user_pad_id" value="${item.user_pad_id}">

                                                                <div class="mb-3 col-sm-2">
                                                                    <label class="form-label" for="cod_atividade">Cód. Atividade</label>
                                                                    <input class="form-control @error('cod_atividade') is-invalid @enderror" type="text" name="cod_atividade" id="cod_atividade" value=${item.cod_atividade} readonly>
                                                                </div>

                                                                <div class="mb-3 col-sm-5">
                                                                    <label class="form-label" for="componente_curricular">Componente Curricular</label>
                                                                    <input class="form-control @error('componente_curricular') is-invalid @enderror" type="text" name="componente_curricular" id="componente_curricular" value="${item.componente_curricular}">
                                                                    @error('componente_curricular')
                                                                        <div class="alert alert-danger">
                                                                            <span>{{$message}}</span>
                                                                        </div>
                                                                    @enderror
                                                                </div>

                                                                <div class="mb-3 col-sm-5">
                                                                    <label class="form-label" for="curso">Curso</label>
                                                                    <input class="form-control @error('curso') is-invalid @enderror" type="text" name="curso" id="curso" value="${item.curso}">
                                                                    @error('curso')
                                                                        <div class="alert alert-danger">
                                                                            <span>{{$message}}</span>
                                                                        </div>
                                                                    @enderror
                                                                </div>

                                                                <div class="mb-3 col-sm-3">
                                                                    <label class="form-label" for="nivel">Nível</label>
                                                                    <select class="form-select @error('nivel') is-invalid @enderror" name="nivel" id="nivel">
                                                                        ${nivel_select_options(item.nivel)}
                                                                    </select>
                                                                    @error('nivel')
                                                                        <div class="alert alert-danger">
                                                                            <span>{{$message}}</span>
                                                                        </div>
                                                                    @enderror
                                                                </div>

                                                                <div class="mb-3 col-sm-3">
                                                                    <label class="form-label" for="modalidade">Modalidade</label>
                                                                    <select class="form-select @error('modalidade') is-invalid @enderror" name="modalidade" id="modalidade">
                                                                        ${modalidade_select_options(item.modalidade)}
                                                                    </select>
                                                                    @error('modalidade')
                                                                        <div class="alert alert-danger">
                                                                            <span>{{$message}}</span>
                                                                        </div>
                                                                    @enderror
                                                                </div>

                                                                <div class="mb-3 col-sm-3">
                                                                    <label class="form-label" for="ch_semanal">CH. Semanal</label>
                                                                    <input class="form-control @error('ch_semanal') is-invalid @enderror" type="number" name="ch_semanal" id="ch_semanal" value="${item.ch_semanal}">
                                                                    @error('ch_semanal')
                                                                        <div class="alert alert-danger">
                                                                            <span>{{$message}}</span>
                                                                        </div>
                                                                    @enderror
                                                                </div>

                                                                <div class="mb-3 col-sm-3">
                                                                    <label class="form-label" for="ch_total">CH. Total</label>
                                                                    <input class="form-control @error('ch_total') is-invalid @enderror" type="number" name="ch_total" id="ch_total" value="${item.ch_total}">
                                                                    @error('ch_total')
                                                                        <div class="alert alert-danger">
                                                                            <span>{{$message}}</span>
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>

                                                                <button type="submit" class="btn btn-success rounded">Atualizar</button>
                                                            </div>
                                                            
                                                        </form>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="delete_ensino_aula">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal_ensino_aula_delete-${item.id}">
                                            <i class="bi bi-trash"></i>
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="modal_ensino_aula_delete-${item.id}" tabindex="-1" aria-labelledby="modal_ensino_aula_delete_label-${item.id}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title" id="modal_ensino_aula_delete_label_title-${item.id}">Excluir Item</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Você tem certeza que deseja excluir o item "${item.cod_atividade+' : '+item.componente_curricular}"?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                        <form action="${route_ensino_aula_delete+'/'+item.id}" method="post">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button id="btn-ok" type="submit" class="btn btn-primary">OK</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </td>
                            </tr>`
                        )
                    })
                    
                } else {
                    
                }
                
            }).fail(function(message, status) {

            })
        }

        
    }).change();
    
</script>