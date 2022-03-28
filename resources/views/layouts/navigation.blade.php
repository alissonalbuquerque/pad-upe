<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse">
    <!-- SidebarMenu : Perfil -->
    @if (Auth::check())
        <div class="content mx-auto text-center">
            <div class="d-flex justify-content-center flex-column content-user-info">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                <a id="btn-update-perfil" class="btn" href="{{ route('edit_perfil') }}">
                    <i class="bi bi-gear"></i>
                    Editar Perfil
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
        @include('layouts.user-navigation.navigation_teacher', [
            'index_menu' => (!empty($index_menu) ? $index_menu : 0),
        ])
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
