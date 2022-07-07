<!-- SidebarMenu :  Vertical Options -->
<ul class="nav flex-column nav-pills" id="myTab" role="tablist" aria-orientation="vertical">
    <li class="nav-item">
        <a href="{{ route('dashboard') }}" class="custom-nav-link {{ ((($index_menu ?? 0) == 0 ? 0: $index_menu ) == 0? "active": "") }}">
            <i class="bi bi-house-fill"></i>
            Home
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('pad_index') }}" class="custom-nav-link {{ ((($index_menu ?? 0) == 0 ? 0: $index_menu ) == 6? "active": "") }}">
            <i class="bi bi-book-half"></i>
            PADs
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('campus_index') }}" class="custom-nav-link {{ ((($index_menu ?? 0) == 0 ? 0: $index_menu ) == 1? "active": "") }}">
            <i class="bi bi-bank2"></i>
            Campus
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('curso_index') }}" class="custom-nav-link {{ ((($index_menu ?? 0) == 0 ? 0: $index_menu ) == 2? "active": "") }}">
            <i class="bi bi-mortarboard-fill"></i>
            Cursos
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('unidade_index') }}" class="custom-nav-link {{ ((($index_menu ?? 0) == 0 ? 0: $index_menu ) == 3? "active": "") }}">
            <i class="bi bi-geo-fill"></i>
            Unidades
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('diretor_index') }}" class="custom-nav-link {{ ((($index_menu ?? 0) == 0 ? 0: $index_menu ) == 4? "active": "") }}">
            <i class="bi bi-people-fill"></i>
            Diretores
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('coordenador_index') }}" class="custom-nav-link {{ ((($index_menu ?? 0) == 0 ? 0: $index_menu ) == 5? "active": "") }}">
            <i class="bi bi-person-video3"></i>
            Coordenadores
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('professor_index') }}" class="custom-nav-link {{ ((($index_menu ?? 0) == 0 ? 0: $index_menu ) == 7? "active": "") }}">
            <i class="bi bi-eyeglasses"></i>
            Professores
        </a>
    </li>
</ul>
