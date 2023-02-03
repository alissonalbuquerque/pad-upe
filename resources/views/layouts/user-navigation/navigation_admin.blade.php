@php
    use App\Models\Util\Menu;

    if(!isset($menu)) {
        $menu = Menu::HOME;
    }

    $home_active = $menu == Menu::HOME ? 'active' : '';
    $pads_active = $menu == Menu::PADS ? 'active' : '';
    $cursos_active = $menu == Menu::CURSOS ? 'active' : '';
    $campus_active = $menu == Menu::CAMPUS ? 'active' : '';
    $Unidades_active = $menu == Menu::UNIDADES ? 'active' : '';
    $users_active = $menu == Menu::USERS ? 'active' : '';
@endphp

<!-- SidebarMenu :  Vertical Options -->
<ul class="nav flex-column nav-pills" id="myTab" role="tablist" aria-orientation="vertical">
    <li class="nav-item">
        <a href="{{ route('dashboard') }}" class="custom-nav-link {{ $home_active }}">
            <i class="bi bi-house-fill"></i>
            Home
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('pad_index') }}" class="custom-nav-link {{ $pads_active }}">
            <i class="bi bi-book-half"></i>
            PADs
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('curso_index') }}" class="custom-nav-link {{ $cursos_active }}">
            <i class="bi bi-mortarboard-fill"></i>
            Cursos
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('campus_index') }}" class="custom-nav-link {{ $campus_active }}">
            <i class="bi bi-bank2"></i>
            Campus
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('unidade_index') }}" class="custom-nav-link {{ $Unidades_active }}">
            <i class="bi bi-geo-fill"></i>
            Unidades
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('user_index') }}" class="custom-nav-link {{ $users_active }}">
            <i class="bi bi-person-fill"></i>
            Usuários
        </a>
    </li>
    
    <div> - - - </div>
    <li class="nav-item">
        <a href="{{ route('diretor_index') }}" class="custom-nav-link {{ ((($menu ?? 0) == 11 ? 0: $menu ) == 4? "active": "") }}">
            <i class="bi bi-people-fill"></i>
            Diretores
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('coordenador_index') }}" class="custom-nav-link {{ ((($menu ?? 0) == 11 ? 0: $menu ) == 5? "active": "") }}">
            <i class="bi bi-person-video3"></i>
            Coordenadores
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('professor_index') }}" class="custom-nav-link {{ ((($menu ?? 0) == 11 ? 0: $menu ) == 7? "active": "") }}">
            <i class="bi bi-eyeglasses"></i>
            Professores
        </a>
    </li>
</ul>
