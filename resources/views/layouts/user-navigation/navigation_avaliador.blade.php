@php
    use App\Models\Util\MenuItemsAvaliador;

    if(!isset($index_menu)) {
        $index_menu = MenuItemsAvaliador::HOME;
    }

    $home_active = $index_menu === MenuItemsAvaliador::HOME ? 'active' : '';
    $report_active = $index_menu === MenuItemsAvaliador::REPORT ? 'active' : '';    
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
        <a href="{{ route('avaliador_relatorio') }}" class="custom-nav-link {{ $report_active }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-bar-graph-fill" viewBox="0 0 16 16">
                <path d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm-2 11.5v-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-2.5.5a.5.5 0 0 1-.5-.5v-4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5h-1zm-3 0a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-1z"/>
            </svg>
            Relatórios
        </a>
    </li>
</ul>