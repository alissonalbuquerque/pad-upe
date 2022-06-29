<!-- Botoes link lista vertical sidebarMenu -->
<ul class="nav flex-column nav-pills" id="myTab" role="tablist" aria-orientation="vertical">
    <li class="nav-item">
        <a class="custom-nav-link {{ ((!empty($index_menu) ? $index_menu : 0) == 0? "active": "") }}" href="{{ route('dashboard') }}"
            aria-selected="true">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-fill"
                viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6zm5-.793V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
                <path fill-rule="evenodd"
                    d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z" />
            </svg>
            Home
        </a>
    </li>

    <li class="nav-item">
        <a class="custom-nav-link {{ ((!empty($index_menu) ? $index_menu : 0) == 1? "active": "") }}" id="pad-tab" href="{{ route('pad_index') }}"
            aria-controls="pad" aria-selected="false">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-book-half"
                viewBox="0 0 16 16">
                <path
                    d="M8.5 2.687c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z" />
            </svg>
            PAD
        </a>
    </li>

    <li class="nav-item">
        <a class="custom-nav-link" id="update-perfil-tab" data-toggle="tab" href="#update-perfil" role="tab"
            aria-controls="update-perfil" aria-selected="true">
            <!-- Update Perfil - Hidden -->
        </a>
    </li>
</ul>
