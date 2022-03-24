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
    <div class="content mx-auto">
        <div class="header" id="bordcab">
            <h1 class="titulo pt-4 pb-4 mb-3 border-bottom">PLANO DE ATIVIDADES DOCENTES (PAD)</h1>
            <p class="pb-4 mb-3 text-center text-muted align-items-center">ANEXO B</p>
            <p class="pb-4 mb-3 text-center text-muted align-items-center">
                Insira os dados correspondentes nos campos exibidos abaixo
            </p>
        </div>
        <!-- Formulario -->
        <form>
            <div class="form-row" id="bord">
                <div class="form-group col-md-6">
                    <label for="selectCampus">UNIDADE DE EDUCAÇÃO/CAMPUS:</label>
                    <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" aria-label="Default select example">
                        <option selected>Selecionar o Campus</option>
                        <option value="1">ARCOVERDE</option>
                        <option value="2">CARUARU</option>
                        <option value="3">GARANHUNS</option>
                        <option value="4">NAZARE DA MATA</option>
                        <option value="5">PALMARES</option>
                        <option value="6">PETROLINA</option>
                        <option value="7">RECIFE</option>
                        <option value="8">SALGUEIRO</option>
                        <option value="9">SERRA TALHADA</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="selectCurso">CURSO:</label>
                    <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" aria-label="Default select example">
                        <option selected>Selecionar Curso</option>
                        <option value="1">Um</option>
                        <option value="2">Dois</option>
                        <option value="3">Três</option>
                    </select>
                </div>
            </div>
            <div class="row" id="bord">
                <div class="col-sm">
                    <label for="selectCurso">PLANO DE ATIVIDADE DOCENTE - ANO:</label>
                    <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" aria-label="Default select example">
                        <option selected>2022</option>
                    </select>
                </div>
                <div class="col-sm">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="opcao1"
                            checked>
                        <label class="form-check-label" for="exampleRadios1">
                            1º SEMESTRE - janeiro a julho
                        </label>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2"
                            value="opcao2">
                        <label class="form-check-label" for="exampleRadios2">
                            2º SEMESTRE - agosto a dezembro
                        </label>
                    </div>
                </div>
            </div>
            <div class="row" id="bord">
                <div class="col-8">
                    <label for="inputNameProfessor">DOCENTE:</label>
                    <input type="text" class="form-control" id="inputNameProfessor" placeholder="Nome">
                </div>
                <div class="col-4">
                    <label for="inputCPF">CPF</label>
                    <input type="text" class="form-control" id="inputCPF" placeholder="000.000.000-00">
                </div>

                <div class="col-5">
                    <label for="inputMatricula">MATRÍCULA:</label>
                    <input type="text" class="form-control" id="inputMatricula" placeholder="Nº Matricula">
                </div>
                <div class="col">
                    <label for="inputMatricula">CARGA HORÁRIA:</label>
                    <input type="text" class="form-control" id="inputMatricula" placeholder="Valor Carga Horária">
                </div>
                <div class="col-5">
                    <label for="inputMatricula">CATEGORIA/NÍVEL:</label>
                    <input type="text" class="form-control" id="inputMatricula" placeholder="Vazio">
                </div>
            </div>

            <div class="row" id="bord">
                <div class="col-8">
                    <p class="pt-4 border-top"> AFASTAMENTO TOTAL? </p>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1"
                            value="opcao1">
                        <label class="form-check-label" for="inlineRadio1">SIM</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2"
                            value="opcao2">
                        <label class="form-check-label" for="inlineRadio2">NÃO</label>
                    </div>
                </div>

                <div class="col-6">
                    PORTARIA DE AFASTAMENTO:
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="customFile">
                        <label class="custom-file-label" for="customFile">Anexar arquivo</label>
                    </div>
                </div>

                <div class="col-8">
                    <p class="pt-4 border-top"> AFASTAMENTO PARCIAL? </p>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1"
                            value="opcao1">
                        <label class="form-check-label" for="inlineRadio1">SIM</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2"
                            value="opcao2">
                        <label class="form-check-label" for="inlineRadio2">NÃO</label>
                    </div>
                </div>

                <div class="col-6">
                    PORTARIA DE AFASTAMENTO:
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="customFile">
                        <label class="custom-file-label" for="customFile">Anexar arquivo</label>
                    </div>
                </div>
            </div>
    </div>
    <div class="row justify-content-between text-center align-items-center pt-5">
        <div class="col-4">
            <button type="button" class="btn btn-success">
                Salvar
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-sd-card-fill" viewBox="0 0 16 16">
                    <path
                        d="M12.5 0H5.914a1.5 1.5 0 0 0-1.06.44L2.439 2.853A1.5 1.5 0 0 0 2 3.914V14.5A1.5 1.5 0 0 0 3.5 16h9a1.5 1.5 0 0 0 1.5-1.5v-13A1.5 1.5 0 0 0 12.5 0Zm-7 2.75a.75.75 0 0 1 .75.75v2a.75.75 0 0 1-1.5 0v-2a.75.75 0 0 1 .75-.75Zm2 0a.75.75 0 0 1 .75.75v2a.75.75 0 0 1-1.5 0v-2a.75.75 0 0 1 .75-.75Zm2.75.75v2a.75.75 0 0 1-1.5 0v-2a.75.75 0 0 1 1.5 0Zm1.25-.75a.75.75 0 0 1 .75.75v2a.75.75 0 0 1-1.5 0v-2a.75.75 0 0 1 .75-.75Z" />
                </svg>
            </button>
        </div>
        <div class="col-4">
            <button type="button" class="btn btn-secondary">
                Cancelar
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square"
                    viewBox="0 0 16 16">
                    <path
                        d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                    <path
                        d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                </svg>
            </button>
        </div>
    </div>
    </form>
    </div>
@endsection
