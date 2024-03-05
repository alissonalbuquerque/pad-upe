<div class="card mx-2" style="width: 12rem;">
    <div class="card-body">
        <h3 class="text-center"> <i class="bi bi-clock-fill"></i> </h3>
        <h5 class="text-center"> PAD: {{ $userPad->pad->nome }} </h4>
        <h5 class="text-center"> Status: {{ $userPad->pad->statusAsString() }} </h4>
        <a class="stretched-link" href="{{ route('pad_relatório', ['id' => $userPad->id]) }}"></a>
    </div>
</div>
