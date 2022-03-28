<x-app-layout>
    @section('title', 'Home')
    <x-slot name="main">
        <div class="tab-content">
            @if(Auth::user()->isTypeAdmin())
                @include('layouts.user-dashboard.dashboard_admin')
            @endif

            @if(Auth::user()->isTypeTeacher())
                @include('layouts.user-dashboard.dashboard_teacher', ['user' => Auth::user()])
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
