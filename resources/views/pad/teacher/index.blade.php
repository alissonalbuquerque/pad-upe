@extends('layouts.main')

@php
    use App\Models\Tabelas\Constants;
@endphp

@section('title', 'Unidade')
@section('header')
    @include('layouts.header', [
        'user' => Auth::user(),
    ])
@endsection
@section('nav')
    @include('layouts.navigation', [
        'index_menu' => $index_menu,
    ])
@endsection
@section('body')
    <div class="d-flex">
        @foreach($userPads as $userPad)
            <div class="card mx-2" style="width: 12rem;">
                <div class="card-body">
                    @if($userPad->pad->status === Constants::STATUS_ATIVO)
                        <h1 class="text-center"> <i class="bi bi-book-half"></i> </h1>
                    @else
                        <h1 class="text-center"> <i class="bi bi-journal-bookmark-fill"></i> </h1>
                    @endif
                    <h5 class="text-center"> PAD: {{ $userPad->pad->nome }} </h4>
                    <h5 class="text-center"> Status: {{ $userPad->pad->getStatusAsText() }} </h4>
                    <a class="stretched-link" href="{{ route('pad_view', ['id' => $userPad->pad_id]) }}" target="_blank"></a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
