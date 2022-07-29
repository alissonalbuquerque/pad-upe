<div class="container">
    <h1 class="h4"> Resolução </h1>

    @foreach($resolucoes as $resolucao)
    <div class="mb-3">
        <div class="card">
            <h5 class="card-header"> {{ $resolucao->cod_dimensao }} </h5>
            <div class="card-body">
                <p> {{ $resolucao->descricao }} </p>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"> <strong> Carga Horária Semanal : </strong> {{ $resolucao->ch_semanal }} </li>
                    <li class="list-group-item"> <strong> Carga Horária Máxima : </strong> {{ $resolucao->ch_maxima }} </li>
                </ul>                
            </div>
        </div>
    </div>
    @endforeach
</div>