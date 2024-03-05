@php
    use App\Models\Util\MenuItemsAvaliador;

    if(!isset($index_menu)) {
        $index_menu = MenuItemsAvaliador::HOME;
    }

    $home_active = $index_menu === MenuItemsAvaliador::HOME ? 'active' : '';
    $report_active = $index_menu === MenuItemsAvaliador::REPORT ? 'active' : '';    
    $task_time_active = $index_menu === MenuItemsAvaliador::TASK_TIME ? 'active' : '';    
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
            <i class="bi bi-file-earmark-word-fill"></i> Relatórios
        </a>
    </li>
    {{-- <li class="nav-item">
        <a href="{{ route('avaliador_task_time_index') }}" class="custom-nav-link {{ $task_time_active }}">
            <i class="bi bi-clock-fill"></i> Horários
        </a>
    </li> --}}
</ul>