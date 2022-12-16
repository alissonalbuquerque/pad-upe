@php
    use App\Models\Pad;

    <!-- dd('pad'); -->
@endphp

<div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Bem Vindo ao PAD</h1>
    </div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
        <h3>
            <i class="bi bi-exclamation-octagon-fill"></i>
            Atividades pendentes
        </h3>
    </div>
    <div class="d-flex">
        @foreach($userPads as $userPad)
            <div class="card mx-2" style="width: 12rem;">
                <div class="card-body">
                    
                    <h3 class="text-center"> <i class="bi bi-book-half"></i> </h3>
                    
                    <h5 class="text-center"> PAD: {{ $userPad->pad->nome }} </h4>
                    <h5 class="text-center"> Status: {{ $userPad->pad->statusAsString() }} </h4>
                    <a class="stretched-link" href="{{ route('pad_view', ['id' => $userPad->id]) }}"></a>
                </div>
            </div>
        @endforeach
    </div>
</div>

<div class="tab-pane" id="pad" role="tabpanel" aria-labelledby="pad-tab">
    <div
        class="d-flex flex-column justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dimenções-PAD</h1>
    </div>
    <div class="d-flex justify-content-start ">
        <div class="card text-center" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Special title treatment</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
        <div class="card text-center" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Special title treatment</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
            </div>
        </div>
        <div class="card text-center" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Special title treatment</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
    </div>
</div>
