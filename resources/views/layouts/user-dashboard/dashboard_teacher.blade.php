@php
    use App\Models\Util\Status;
    use App\Models\Pad;
    use App\Models\UserPad;
@endphp

<div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Bem-vindo ao PDA!</h1>
    </div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
        {{-- <h3>
            <i class="bi bi-exclamation-octagon-fill"></i>
            Atividades pendentes
        </h3> --}}
    </div>
    <div class="d-flex">
        @foreach($userPads as $user_pad)

            @if($user_pad->pad_status === Pad::STATUS_ATIVO || $user_pad->status === UserPad::STATUS_ATIVO)

                <div class="card mx-2" style="width: 12rem;">
                    <div class="card-body">
                        <div class="text-end">
                            <span class="badge bg-primary">{{ $user_pad->pad->statusAsString() }}</span>
                        </div>
                        <h1 class="text-center"> <i class="bi bi-book-half"></i> </h1>
                        <h5 class="text-center"> PDA: {{ $user_pad->pad->nome }} </h4>
                        <div class="text-center">
                            <h4 class="h5"> <span class="badge bg-primary">Horas: {{ $user_pad->totalHoras() }}</span> </h4>
                        </div>
                        <a class="stretched-link" href="{{ route('pad_view', ['id' => $user_pad->id]) }}"></a>
                    </div>
                </div>

            @endif

            @if($user_pad->pad->status === Pad::STATUS_EM_AVALIACAO && $user_pad->status !== UserPad::STATUS_ATIVO)

                <div class="card mx-2 bg-secondary" style="width: 12rem;">
                    <div class="card-body">
                        <div class="text-end">
                            <span class="badge bg-primary">{{ $user_pad->pad->statusAsString() }}</span>
                        </div>
                        <h1 class="text-center"> <i class="bi bi-book-half"></i> </h1>
                        <h5 class="text-center"> PDA: {{ $user_pad->pad->nome }} </h4>
                        <div class="text-center">
                            <h4 class="h5"> <span class="badge bg-primary">Horas: {{ $user_pad->totalHoras() }}</span> </h4>
                        </div>
                    </div>
                </div>

            @endif
        @endforeach
    </div>
</div>
