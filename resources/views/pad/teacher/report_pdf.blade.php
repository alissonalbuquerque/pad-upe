<header style="display: flex; direction: rtl">
</header>

<div style="display: flex; flex-direction: column; gap: 2.5rem">
    @foreach ($data['model'] as $nome_dimensao=>$dimensao)
        <h1 style="font-size: 16px; font-weight: bold">
            {{$nome_dimensao}}
        </h1>
        <div>
        @foreach ($dimensao as $nome_categoria=>$categoria)
            <h4 style="font-size: 14px">
                {{$nome_categoria}}
            </h4>
            
            @foreach ($categoria as $nome_item=>$item)
                <ul style="font-size: 14px">
                    @foreach ($item as $nome_tarefa=>$tarefa)
                    <li style="font-weight: bold">
                        {{$nome_tarefa}}
                    </li>
                    <ul style="font-size: 13px">
                        @foreach ($tarefa as $nome_valor=>$valor)
                            <li>
                                {{$nome_valor}}: {{$valor}}
                            </li>
                        @endforeach 
                    </ul>
                    @endforeach
                </ul>
                <div style="height: 1.5rem"></div>
            @endforeach
            <div style="height: 1rem"></div>
        @endforeach
            <ul style="font-size: 14px; list-style-type: square">
                <li>TOTAL DE HORAS: {{ $data['horas'][$nome_dimensao] }}</li>
            </ul>
    </div>
    @endforeach
</div>