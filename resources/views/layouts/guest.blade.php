<!doctype html>
<html lang="pt">

<head>

    <title>Avaliação de Desempanho Docente - PAD</title>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <!-- Principal CSS do Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous" />

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
        <h2>Portal de acesso ao</h2>
        <h3>Plano de Atividades Docentes - PAD</h3>
    </div>

    <section class="ftco-section">
        {{ $content }}
    </section>

    <div class="stylo p-2"> </div>

    <footer class="pt-3 my-3 align-items-center border-top" alt="Max-width 100%">
        <div class="w-100">
            <p class="copyright-upe d-flex text-center text-muted justify-content-center">
                Copyright &#9400;2022. Universidade de Pernambuco - Todos os direitos reservados
            </p>
        </div>
    </footer>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>

</body>
</html>
