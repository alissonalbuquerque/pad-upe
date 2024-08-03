<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} - @yield('title')</title>

    @include('components.frontend-libs')

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>

<body>
    <div class="min-h-screen bg-gray-100">

        <!-- Page Header -->
        @include('layouts.header')

        <div class="container-fluid">
            <div class="main-container">
                <!-- Page Header -->
                @include('layouts.navigation')

                <main class="">
                    {{ $main }}
                </main>
            </div>
        </div>
    </div>

    <footer class="pt-3 my-3 text-center text-muted align-items-center border-top">
        <footer class="pt-3 my-3 text-center text-muted align-items-center border-top">
            <p>Copyright &copy;2022. Universidade de Pernambuco - Todos os direitos reservados.</p>
            <p>Fale com nosso suporte: <a href="mailto:pessoa@email.com">sistema.pda@upe.br</a></p>
        </footer>
    </footer>
    @include('layouts.user-jquery.jquery_all_users')
    @if(Auth::user()->isTypeAdmin())
        @include('layouts.user-jquery.jquery_admin')
    @endif

    @if(Auth::user()->isTypeTeacher())
        @include('layouts.user-jquery.jquery_teacher')
    @endif

    @if(Auth::user()->isTypeDirector())
        @include('layouts.user-jquery.jquery_director')
    @endif

    @if(Auth::user()->isTypeCoordinator())
        @include('layouts.user-jquery.jquery_coordinator')
    @endif
</body>

</html>
