<!doctype html>
<html lang="pt" >

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
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
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
        {{ $slot }}
    </section>

    <div class="stylo p-2"> </div>

    <footer class="pt-3 my-3 align-items-center border-top" alt="Max-width 100%">
        <div class="w-100">
            <p class="copyright-upe d-flex text-center text-muted justify-content-center">
                Copyright &#9400;2022. Universidade de Pernambuco - Todos os direitos reservados
            </p>
        </div>
    </footer>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/popper.js+bootstrap.min.js+main.js.pagespeed.jc.c79nEe_inO.js') }}"></script>
    <script defer src="https://static.cloudflareinsights.com/beacon.min.js/v652eace1692a40cfa3763df669d7439c1639079717194"
        integrity="sha512-Gi7xpJR8tSkrpF7aordPZQlW2DLtzUlZcumS8dMQjwDHEnw9I7ZLyiOj/6tZStRBGtGgN6ceN6cMH8z7etPGlw=="
        data-cf-beacon='{"rayId":"6df01a98acf16055","token":"cd0b4b3a733644fc843ef0b185f98241","version":"2021.12.0","si":100}'
        crossorigin="anonymous">
    </script>
    <script>
        eval(mod_pagespeed_VcNR616gfD);
    </script>
    <script>
        eval(mod_pagespeed_HoJGMAFhmT);
    </script>
    <script>
        eval(mod_pagespeed_u6s2d2DVy8);
    </script>
</body>

</html>
