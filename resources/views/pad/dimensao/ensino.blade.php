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
                            @foreach ($ensinoAulas as $ensinoAula)
                                <tr>
                                    <td class="text-center">
                                        {{ $ensinoAula->cod_atividade }}
                                    </td>
                                    <td class="text-center">
                                        {{ $ensinoAula->disciplina->name }}
                                    </td>
                                    <td class="text-center">
                                        {{ $ensinoAula->curso->name }}
                                    </td>
                                    <td class="text-center">
                                        {{ $ensinoAula::listNivel($ensinoAula->nivel) }}
                                    </td>
                                    <td class="text-center">
                                        {{ $ensinoAula::listModalidade($ensinoAula->modalidade) }}
                                    </td>
                                    <td class="text-center">
                                        {{ $ensinoAula->ch_semanal }}
                                    </td>
                                    <td class="text-center">
                                        {{ $ensinoAula->ch_total }}
                                    </td>

                                    <td class="text-center">
                                        @include('components.buttons.btn-delete', ['route' => route('ensino_aula_delete', ['id' => $ensinoAula->id])]);
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <form method="POST" action="{{ route('ensino_aula_create') }}" class="form-add-new-dimencao">
                @csrf
                @method('POST')
                <div class="form-group" style="width: 200px;">
                    <label for="inputNameProfessor">CÓDIGO ATIVIDADE</label>
                    <input type="text" name="cod_atividade" class="form-control" disable id="cod_atividade"
                        placeholder="Automomático  " disabled>
                </div><br>
                <div class="form-row">

                    <div class="form-group col-md-6">
                        <label for="selectCurso">CURSO</label>
                        <select name="curso_id" class="custom-select mr-sm-2" id="curso_id"
                            aria-label="Default select example">

                            <option selected>Selecionar Curso</option>
                            @foreach ($cursos as $curso)
                                <option value="{{ $curso->id }}"> {{ $curso->name }}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="selectCurso">COMPONENTE CURRICULAR</label>
                        <select name="componente_curricular" class="custom-select mr-sm-2" id="componente_curricular"
                            aria-label="Default select example">

                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="selectCurso">NÍVEL</label>
                        <select class="custom-select mr-sm-2" name="nivel" id="nivel" aria-label="Default select example">

                            <option value="0" selected>Selecionar Nível</option>
                            @foreach ($niveis as $key => $nivel)
                                <option value="{{ $key }}"> {{ $nivel }}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="selectCurso">Modalidade</label>
                        <select class="custom-select mr-sm-2" name="modalidade" id="modalidade"
                            aria-label="Default select example">

                            <option value="0" selected>Selecionar Modalidade</option>
                            @foreach ($modalidades as $key => $modalidade)
                                <option value="{{ $key }}"> {{ $modalidade }}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="selectCurso">CARGA HORÁRIA SEMANAL</label>
                        <input type="number" name="ch_semanal" id="ch_semanal">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="selectCurso">CARGA HORÁRIA TOTAL</label>
                        <input type="number" name="ch_total" id="ch_semanal">
                    </div>

                    <input type="hidden" value="{{ $pad_id }}" name="pad_id" id="pad_id">
                </div>
                <button type="submit" class="btn btn-success"> Salvar</button>

            </form>
        </div>
    </div>
@endsection

@section('scripts-jquery')

    @include('layouts.pad-ensino-jquery.ensino-aula')

@endsection
