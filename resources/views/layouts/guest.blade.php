<!doctype html>
<html lang="pt">

<head>

    <title>Avaliação de Desempanho Docente - PDA</title>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    @include('components.frontend-libs')

    <!-- Estilos customizados para esse template -->
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}" />
</head>

<body>
    <header>
        <div class="navbar shadow-sm" alt="Max-width 100%">
            <div class="container d-flex justify-content-between">
                <a class="navbar-brand d-flex align-items-center" href="#">
                    <img src="http://www.avaliacaodocente.upe.br/assets/img/logo-upe.png" class="img-fluid"
                        width="128" height="93" alt="" />
                </a>
                <a class="navbar-brand d-flex align-items-center" href="#">
                    <img src="https://www.gestaododesempenho.pe.gov.br/AvaliacaoDesempenho/public/resources/images/logos-direita.png"
                        class="img-fluid" width="268" height="100" alt="" />
                </a>
            </div>
        </div>
    </header>

    <div class="stylo p-3 n-flex">
        <!-- <h2>Portal de acesso ao</h2> -->
        <h3>Portal de acesso ao Plano de Atividades Docentes - PDA</h3>
    </div>

    <section class="ftco-section">
        {{ $content }}
    </section>

    <div class="stylo p-2"> </div>

    <footer class="pt-3 my-3 align-items-center border-top" alt="Max-width 100%">
        <div class="w-100">
            <p class="copyright-upe d-flex text-center text-muted justify-content-center">
            Copyright &copy;{{ date('Y') }}. Universidade de Pernambuco - Todos os direitos reservados.
            <br>Versão do software: {{ config('app.version') }} 
            </p>
            <p>Fale com nosso suporte: <a href="mailto:pessoa@email.com">sistema.pda@upe.br</a></p>
        </div>
    </footer>

</body>
</html>
