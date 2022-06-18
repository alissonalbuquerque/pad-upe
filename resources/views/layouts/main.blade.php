<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} - @yield('title')</title>

    @include('components.frontend-libs')

    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>

<body>
    <div class="min-h-screen bg-gray-100">

        <!-- Page Header -->
        @section('header')
        @show

        <div class="container-fluid">
            <div class="main-container">
                <!-- Page Header -->
                @section('nav')
                @show

                <main class="container-fluid">
                    @section('body')
                    @show
                </main>
            </div>
        </div>
    </div>

    <footer class="pt-3 my-3 text-center text-muted align-items-center border-top">
        Copyright &copy;2022. Universidade de Pernambuco - Todos os direitos reservados
    </footer>

    @if (Auth::user()->isTypeAdmin())
        @include('layouts.user-jquery.jquery_admin')
    @endif

    @if (Auth::user()->isTypeTeacher())
        @include('layouts.user-jquery.jquery_teacher')
    @endif

    @if (Auth::user()->isTypeMenager())
        @include('layouts.user-jquery.jquery_menager')
    @endif

    @if (Auth::user()->isTypeCoordinator())
        @include('layouts.user-jquery.jquery_coordinator')
    @endif

    @section('scripts')
    @show
</body>

</html>
