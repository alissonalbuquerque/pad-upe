@extends('layouts.main')

@section('title', 'Ensino')
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

    <div class="container">

        @include('components.pad.dropdown-eixo', ['divs' => $divs])

        <div id="ensino_aulas" class="">
            <div>
                <div class="mb-3">
                    <h3 class="h3"> Ensino - Aulas </h3 class="h3">
                </div>
                <form action="" method="post" id="ensino_aulas-form" class="">

                    <div class="row">
                        
                        <input type="hidden" name="pad_id" value={{1}}>

                        <div class="mb-3 col-sm-2">
                            <label class="form-label" for="ensino_aulas-cod_atividade">Cód. Atividade</label>
                            <input class="form-control" type="text" name="ensino_aulas-cod_atividade" id="ensino_aulas-cod_atividade" disabled readonly>
                        </div>

                        <div class="mb-3 col-sm-5">
                            <label class="form-label" for="ensino_aulas-componente_curricular">Componente Curricular</label>
                            <input class="form-control" type="text" name="ensino_aulas-componente_curricular" id="ensino_aulas-componente_curricular">
                        </div>

                        <div class="mb-3 col-sm-5">
                            <label class="form-label" for="ensino_aulas-curso">Curso</label>
                            <input class="form-control" type="text" name="ensino_aulas-curso" id="ensino_aulas-curso">
                        </div>

                        <div class="mb-3 col-sm-3">
                            <label class="form-label" for="ensino_aulas-nivel">Nível</label>
                            <select class="form-select" name="ensino_aulas-nivel" id="ensino_aulas-nivel">
                                <option selected value="0">Selecione um Nível</option>
                                <option value="1">Graduação</option>
                                <option value="2">Pós-Graduação</option>
                            </select>
                        </div>

                        <div class="mb-3 col-sm-3">
                            <label class="form-label" for="ensino_aulas-modalidade">Modalidade</label>
                            <select class="form-select" name="ensino_aulas-modalidade" id="ensino_aulas-modalidade">
                                <option selected value="0">Selecione uma Modalidade</option>
                                <option value="1">Presencial</option>
                                <option value="2">Remoto</option>
                            </select>
                        </div>

                        <div class="mb-3 col-sm-2">
                            <label class="form-label" for="ensino_aulas-ch_total">CH. Total</label>
                            <input class="form-control" type="number" name="ensino_aulas-ch_total" id="ensino_aulas-ch_total">
                        </div>

                        <div class="mb-3 col-sm-2">
                            <label class="form-label" for="ensino_aulas-ch_semanal">CH. Semanal</label>
                            <input class="form-control" type="number" name="ensino_aulas-ch_semanal" id="ensino_aulas-ch_semanal">
                        </div>
                    </div>

                    <div class="mt-1 text-end">
                        <button type="submit" class="btn btn-success rounded">Cadastrar</button>
                    </div>
                    
                </form>
            </div>

            <div>
                LISTA
            </div>
        </div>

        <div id="ensino_coordenacao_disciplina" class="">
            <h1> ensino_coordenacao_disciplina <h1>
        </div>

        <div id="ensino_orientacao" class="">
            <h1>ensino_orientacao</h1>
        </div>

        <div id="ensino_supervisao" class="">
            <h1>ensino_supervisao</h1>
        </div>

        <div id="ensino_atendimento_discente" class="">
            <h1>ensino_atendimento_discente</h1>
        </div>

        <div id="ensino_projeto" class="">
            <h1>ensino_projeto</h1>
        </div>

        <div id="ensino_participacao" class="">
            <h1>ensino_participacao</h1>
        </div>

        <div id="ensino_coordenacao_docente" class="">
            <h1>ensino_coordenacao_docente</h1>
        </div>
        
    </div>
@endsection

@section('scripts-jquery')
    @include('layouts.pad-ensino-jquery.ensino-aula')
    @include('components.pad.dropdown-eixo-script', ['divs' => $divs])
@endsection
