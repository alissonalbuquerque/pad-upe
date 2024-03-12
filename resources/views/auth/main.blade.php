<!doctype html>
<html lang="pt-br">
<head>
    <title>PDA - Plano de Avaliação Docente </title>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    @include('components.frontend-libs')

    <link rel="stylesheet" href="{{ asset('css/auth.css') }}" />
</head>

<body>

    <header>
        <div class="navbar shadow-sm" alt="Max-width 100%">
            <div class="">
                <a class="navbar-brand p-3" href="#">
                    <img src="{{url('images/estado_pe_logo.png')}}" alt="Logo do Estado" class="img-fluid" width="300" height="100"/>
                </a>
            </div>
        </div>
    </header>

    <div class="stylo p-3 n-flex">
        <h2>Portal de acesso ao</h2>
        <h3> Plano Docente de Atividades - PDA </h3>
    </div>

    <div class="container">
        @section('body')
        @show
    </div>

    <div class="stylo p-2"> </div>

    <footer class="pt-3 my-3 align-items-center border-top" alt="Max-width 100%">
        <div class="w-100">
            <p class="copyright-upe d-flex text-center text-muted justify-content-center">
                Copyright &#9400;2022. Universidade de Pernambuco - Todos os direitos reservados
            </p>
        </div>
    </footer>

</body>
</html>