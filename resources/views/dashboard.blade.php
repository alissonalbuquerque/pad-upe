<x-app-layout>
    @section('title', 'Home')
    <x-slot name="main">
        <div class="tab-content">
            @if(Auth::user()->isTypeAdmin())
                @include('layouts.user-dashboard.dashboard_admin')
            @endif

            @if(Auth::user()->isTypeTeacher())
                @include('layouts.user-dashboard.dashboard_teacher', ['user' => Auth::user(), 'userPads => $userPads'])
            @endif

            @if(Auth::user()->isTypeDirector())
                @include('layouts.user-dashboard.dashboard_director')
            @endif

            @if(Auth::user()->isTypeCoordinator())
                @include('layouts.user-dashboard.dashboard_coordinator')
            @endif

            @if(Auth::user()->isTypeEvaluator())
                @include('layouts.user-dashboard.dashboard_avaliador', ['user' => Auth::user()])
            @endif
        </div>
    </x-slot>
</x-app-layout>
