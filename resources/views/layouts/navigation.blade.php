<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse">
    <!-- SidebarMenu : Perfil -->
    @if (Auth::check())
        <div class="content mx-auto text-center">
            <div class="d-flex justify-content-center flex-column content-user-info">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                <a id="btn-update-perfil" class="btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-gear-fill" viewBox="0 0 16 16">
                        <path
                            d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z" />
                    </svg>
                    Editar
                </a>
            </div>
        </div>
    @endif

    <!-- SidebarMenu : Admin -->
    @if (Auth::user()->isTypeAdmin())
        @include('layouts.user-navigation.navigation_admin')
    @endif

    <!-- SidebarMenu : Professor -->
    @if (Auth::user()->isTypeTeacher())
        @include('layouts.user-navigation.navigation_teacher')
    @endif

    <!-- SidebarMenu : Diretor -->
    @if (Auth::user()->isTypeMenager())
        @include('layouts.user-navigation.navigation_menager')
    @endif

    <!-- SidebarMenu : Coordenador -->
    @if (Auth::user()->isTypeCoordinator())
        @include('layouts.user-navigation.navigation_coordinator')
    @endif

</nav>
