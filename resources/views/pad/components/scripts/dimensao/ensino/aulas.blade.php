@include('pad.components.scripts.cod_atividade', [
    'cod_atividade' => '1-',
    'form_id' => 'ensino_aulas-form',
    'div_selected' => 'ensino_aulas',
    'route' => route('ensino_aula_search'),
])

@include('pad.components.scripts.ajaxValidation', [
    'btn_submit_id' => 'btn-submit_ensino_aulas',
    'form_id' => 'ensino_aulas-form',
    'route' => route('ensino_aula_validate'),
    'div_errors' => 'ensino_aulas_form_create',
])

@include('pad.components.scripts.dimensao.ensino.show_modal', [
    'btn_edit_class' => 'btn-edit_ensino_aula', 
    'route' => route('view_ensino_aula_update'), 
    'modal_id' => 'modal', 
    'header' => 'Ensino - Aulas', 
])