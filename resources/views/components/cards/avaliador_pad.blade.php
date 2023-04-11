{{--
    @include('components.cards.avaliador_pad', ['userPad' => $userPad])
--}}

<div class="card mx-2" style="width: 12rem;">
    <div class="card-body">
        <h3 class="text-center"> <i class="bi bi-book-half"></i> </h3>
        <h5 class="text-center"> PAD: {{ $userPad->pad->nome }} </h4>
        <h5 class="text-center"> Status: {{ $userPad->pad->statusAsString() }} </h4>
        <a class="stretched-link" href="{{ route('pad_view', ['id' => $userPad->id]) }}"></a>
    </div>
</div>
