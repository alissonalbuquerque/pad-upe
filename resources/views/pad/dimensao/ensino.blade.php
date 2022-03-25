@extends('layouts.main')

@section('title', 'Unidade')
@section('header')
    @include('layouts.header', [
        'user' => Auth::user(),
    ])
@endsection
@section('nav')
    @include('layouts.navigation', [
        'index_menu' => $index_menu,
    ])
@endsection
@section('body')
    <form>
        <div class="form-row" id="bord">
            <div class="px-4 md:px-10 py-4 md:py-7 bg-gray-100 rounded-tl-lg rounded-tr-lg">
                <h5 class="border-bottom">1 - ENSINO (AULAS EM COMPONENTES CURRICULARES)</h5>
            </div>
            <hr>
            <div class="container">
                <div class="comp" id="compbord">
                    <div class="row clearfix">
                        <div class="col-md-12 table-responsive">
                            <table class="table table-borderless table-hover table-sortable" id="tab_logic">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            CÓDIGO ATIVIDADE
                                        </th>
                                        <th class="text-center">
                                            COMPONENTE CURRICULAR
                                            (NOME DO COMPONENTE)
                                        </th>
                                        <th class="text-center">
                                            CURSO
                                        </th>
                                        <th class="text-center">
                                            NÍVEL
                                        </th>
                                        <th class="text-center">
                                            MODALIDADE
                                        </th>
                                        <th class="text-center">
                                            CH TOTAL
                                        </th>
                                        <th class="text-center">
                                            CH SEMANAL
                                        </th>
                                        <th class="text-center"
                                            style="border-top: 1px solid #ffffff; border-right: 1px solid #ffffff;">
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr id='addr0' data-id="0" class="hidden">
                                        <td data-name="codigoAtividade">
                                            <input type="text" name='codigoAtividade0' placeholder='CÓDIGO ATIVIDADE'
                                                class="form-control"/>
                                        </td>
                                        <td data-name="componentecurricular">
                                            <input type="text" name='componentecurricular0'
                                                placeholder='COMPONENTE CURRICULAR' class="form-control" />
                                        </td>
                                        <td data-name="selcurso">
                                            <select class="custom-select mr-sm-2" name="curso_id" id="curso_id" aria-label="Default select example">
                                                <option selected>Selecionar Curso</option>
                                                @foreach($cursos as $curso)
                                                    <option value="{{ $curso->id }}"> {{ $curso->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td data-name="selnivel">
                                            <select name="selnivel0">
                                                <option value="">Selecionar Nível</option>
                                                <option value="1">Graduação</option>
                                                <option value="2">Pós-graduação Stricto Sensu</option>
                                                <option value="3">Pós-Graduação Lato Sensu</option>
                                            </select>
                                        </td>
                                        <td data-name="selmodalidade">
                                            <select name="selmodalidade0">
                                                <option value="">Selecionar Modalidade</option>
                                                <option value="1">Presencial</option>
                                                <option value="2">EAD</option>
                                            </select>
                                        </td>
                                        <td data-name="chtotal">
                                            <input type="text" name='chtotal0' placeholder='CH TOTAL'
                                                class="form-control" />
                                        </td>
                                        <td data-name="chsemanal">
                                            <input type="text" name='chsemanal0' placeholder='CH SEMANAL'
                                                class="form-control" />
                                        </td>
                                        <td data-name="del">
                                            <button name="del0"
                                                class='btn btn-danger glyphicon glyphicon-remove row-remove'>
                                                <span aria-hidden="true">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                        <path
                                                            d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                                    </svg>
                                                </span>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="addrow">
                        <a id="add_row" class="btn btn-primary float-right">
                            Adicionar Linha
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                                <path
                                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                            </svg>
                        </a>
                    </div>
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    ORIENTAÇÕES DE PREENCHIMENTO
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                                    </svg>
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <strong>1. ENSINO (AULAS EM COMPONENTES CURRICULARES)</strong> <br>
                                    <br>
                                    <strong>• Nome do Componente:</strong> Nome do componente curricular como descrito no
                                    PPC do curso; <br>
                                    <strong>• Curso:</strong> Nome do curso ao qual o componente curricular pertence; <br>
                                    <strong>• Nível:</strong> Preencher o nível do curso ao qual o componente curricular
                                    pertence, sendo as opções: Graduação, Pós-graduação Stricto Sensu, Pós-Graduação Lato
                                    Sensu <br>
                                    <strong>• Modalidade:</strong> Preencher a modalidade que o componente curricular é
                                    ofertado, sendo as opções: Presencial e EAD; <br>
                                    <strong>• Carga Horária Total:</strong> Carga horária total efetiva exercida pelo
                                    docente dentro do(s) componente(s) curricular (es); <br>
                                    <strong>• Carga Horária Semanal:</strong> Carga horária total efetiva exercida pelo
                                    docente dentro do componente curricular dividida pelo número de semanas que o mesmo
                                    ocorre. <br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
