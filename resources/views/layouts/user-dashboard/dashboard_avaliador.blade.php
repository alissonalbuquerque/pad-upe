<div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Bem-vindo ao PDA!</h1>
    </div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
        <h3>
            <i class="bi bi-exclamation-octagon-fill"></i>
            Atividades pendentes do Avaliador
        </h3>
    </div>
    <div class="d-flex">
        {{-- Lista de pads onde o meu usuário é avaliador naquele pad --}}
        @foreach($userPads as $userPad)
            @include('components.cards.avaliador_pad', ['userPad' => $userPad])
        @endforeach
    </div>
</div>
