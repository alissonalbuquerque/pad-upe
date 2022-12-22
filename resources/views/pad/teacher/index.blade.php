@extends('layouts.main')

@php
    use App\Models\Util\Status;
@endphp

@section('title', 'PADs')

@section('header')
    @include('layouts.header', [
        'user' => Auth::user(),
    ])
@endsection

@section('nav')
    @include('layouts.navigation', [
        'menu' => $menu,
    ])
@endsection

@section('body')
    <div class="d-flex">
        @foreach($userPads as $userPad)
            @if($userPad->pad->status === Status::ATIVO || $userPad->pad->status === Status::ARQUIVADO)
            <div class="card mx-2" style="width: 12rem;">
                @if($userPad->pad->status === Status::ATIVO)
                    <div class="card-body">
                        <div class="text-end">
                            <span class="badge bg-primary">{{ $userPad->pad->statusAsString() }}</span>
                        </div>
                        <h1 class="text-center"> <i class="bi bi-book-half"></i> </h1>
                        <h5 class="text-center"> PAD: {{ $userPad->pad->nome }} </h4>
                        <div class="text-center">
                            <h4 class="h5"> <span class="badge bg-primary">Horas: {{ $userPad->pad->getTotalHoras() }}</span> </h4>
                        </div>
                        <a class="stretched-link" href="{{ route('pad_view', ['id' => $userPad->id]) }}"></a>
                    </div>
                @else
                    <div class="card-body">
                        <div class="text-end">
                            <span class="badge bg-secondary">{{ $userPad->pad->statusAsString() }}</span>
                        </div>
                        <h1 class="text-center"> <i class="bi bi-journal-bookmark-fill"></i> </h1>
                        <h5 class="text-center"> PAD: {{ $userPad->pad->nome }} </h4>
                        <div class="text-center">
                            <h4 class="h5"> <span class="badge bg-primary">Horas: {{ $userPad->pad->getTotalHoras() }}</span> </h4>
                        </div>
                        <a class="stretched-link" href="{{ route('pad_view', ['id' => $userPad->id]) }}"></a>
                    </div>
                @endif
            </div>
            @endif
        @endforeach
    </div>
@endsection
