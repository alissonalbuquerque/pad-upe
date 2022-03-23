<x-app-layout>
    <x-slot name="main">

        <div class="tab-content">
            
            @if(Auth::check())
                @include('layouts.user-dashboard.update_perfil', ['user' => Auth::user()])
            @endif

            @if(Auth::user()->isTypeAdmin())
                @include('layouts.user-dashboard.dashboard_admin')
            @endif

            @if(Auth::user()->isTypeTeacher())
                @include('layouts.user-dashboard.dashboard_teacher')
            @endif

            @if(Auth::user()->isTypeMenager())
                @include('layouts.user-dashboard.dashboard_menager')
            @endif

            @if(Auth::user()->isTypeCoordinator())
                @include('layouts.user-dashboard.dashboard_coordinator')
            @endif

        </div>
    </x-slot>
</x-app-layout>
