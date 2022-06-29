<header class="navbar p-0">
    <div class="header-left-side">
        <a class="navbar-brand p-3" href="#">
            <img src="http://www.avaliacaodocente.upe.br/assets/img/logo-upe.png" class="img-fluid mr-3" width="128"
                height="93" alt="" />
            <img src="https://www.gestaododesempenho.pe.gov.br/AvaliacaoDesempenho/public/resources/images/logos-direita.png"
                class="img-fluid" width="268" height="100" alt="" />
        </a>
    </div>
    <div class="header-divider"></div>
    <div class="mt-3 space-y-1 header-right-side">
        <!-- Authentication -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                this.closest('form').submit();">
                Sair <i class="bi bi-box-arrow-right"></i>
            </x-responsive-nav-link>
        </form>
    </div>
</header>
