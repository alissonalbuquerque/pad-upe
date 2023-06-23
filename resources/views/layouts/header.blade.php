<header class="navbar p-0">
    <div class="header-left-side">
        <a class="navbar-brand p-3" href="#">
            {{-- <img src="http://www.avaliacaodocente.upe.br/assets/img/logo-upe.png" class="img-fluid mr-3" width="128"
                height="93" alt="" />
            <img src="https://www.gestaododesempenho.pe.gov.br/AvaliacaoDesempenho/public/resources/images/logos-direita.png"
                class="img-fluid" width="268" height="100" alt="" /> --}}
            <img src="{{url('images/estado_pe_logo.png')}}" alt="Logo do Estado" class="img-fluid" width="300" height="100"/>
        </a>
    </div>
    <div class="header-divider"></div>
    <div class="mt-3 space-y-1 header-right-side">
        <div class="btn-group" role="group">
            {{-- Profiles --}}
            <div class="me-1">
                <div class="dropdown">
                    <button class="btn btn-outline-primary btn-sm" type="button" id="dropdown-profiles" data-bs-toggle="dropdown" aria-expanded="false">
                        Papeis <i class="bi bi-file-earmark"></i>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdown-profiles">
                        @foreach (Auth::user()->profiles as $profile)
                            <li><a class="dropdown-item" href="{{ route('change_profile', ['user_id' => Auth::user()->id, 'user_type_id' => $profile->id]) }}">{{ $profile->typeAsString() }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            {{-- Logout --}}
            <div class="me-1">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-outline-danger btn-sm" type="submit">
                       Sair <i class="bi bi-box-arrow-right"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>
