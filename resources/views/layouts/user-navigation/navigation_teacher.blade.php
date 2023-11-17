@php
    use App\Models\Util\Menu;

    if(!isset($menu)) {
        $menu = Menu::HOME;
    }

    $home_active = $menu == Menu::HOME ? 'active' : '';
    $pads_active = $menu == Menu::PADS ? 'active' : '';
    $download_active = $menu == Menu::FILES ? 'active' : '';
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
            PDAs
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('download_index') }}" class="custom-nav-link {{ $download_active }}">
            <i class="bi bi-file-earmark-arrow-down-fill"></i>
            Arquivos
        </a>
    </li>
</ul>
