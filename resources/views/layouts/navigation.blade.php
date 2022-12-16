<nav id="sidebar_menu" class="col-md-3 col-lg-2 d-md-block sidebar collapse">
    <!-- SidebarMenu : Perfil -->

    @php
        use App\Models\Util\Menu;

        $edit_active = 'btn btn-outline-primary btn-sm';

        if(isset($menu)) {
            $edit_active = $menu == Menu::USER ? 'btn btn-primary btn-sm' : 'btn btn-outline-primary btn-sm';
        }
    @endphp

    @if (Auth::check())
        <div class="content">
            <div class="d-flex justify-content-center">

                <div class="content-user-info">
                    <div class="text-center">

                        <div class="font-medium text-base text-gray-800">{{ Auth::user()->dashboardName() }}</div>
                        
                        <div class="mt-3">
                            <a class="{{ $edit_active }}" href="{{ route('edit_perfil') }}">
                                <i class="bi bi-gear-fill"></i>
                                Editar Perfil
                            </a>
                        </div>

                    </div>
                </div>

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
    @if (Auth::user()->isTypeDirector())
        @include('layouts.user-navigation.navigation_director')
    @endif

    <!-- SidebarMenu : Coordenador -->
    @if (Auth::user()->isTypeCoordinator())
        @include('layouts.user-navigation.navigation_coordinator')
    @endif

    <!-- SidebarMenu : Avaliador -->
    @if (Auth::user()->isTypeEvaluator())
        @include('layouts.user-navigation.navigation_avaliador')
    @endif

</nav>
