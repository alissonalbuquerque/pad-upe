<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-sm-3 col-md-1 mr-0" href="#">
        <img src="http://www.avaliacaodocente.upe.br/assets/img/logo-upe.png" class="img-fluid" width="128"
            height="93" alt="" />
    </a>
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">
        <img src="https://www.gestaododesempenho.pe.gov.br/AvaliacaoDesempenho/public/resources/images/logos-direita.png"
            class="img-fluid" width="268" height="100" alt="" />
    </a>
    <div class="mt-3 space-y-1">
        <!-- Authentication -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <x-responsive-nav-link :href="route('logout')"
                    onclick="event.preventDefault();
                                this.closest('form').submit();">
                {{ __('Log Out') }}
            </x-responsive-nav-link>
        </form>
    </div>
</header>
