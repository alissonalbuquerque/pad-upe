
<body style="width: 210mm; display: flex; flex-direction: column; max-width: 190mm">
    <header style="display: flex; flex-direction: column; padding: 3mm 4mm 0mm 4mm">
        <div style="width: 300px; margin: auto">
            <img style="width: 300px; height: max-content" src="{{public_path('images\estado_pe_logo.png')}}" alt="Logo Pernambuco">
        </div>
        
        <div style="display: flex; flex-direction: column">
            <p style="margin: 1.1mm"><span>Autor do PAD: {{$data['user']['nome']}}</span></p>
            <p style="margin: 1.1mm"><span>E-mail do Autor: {{$data['user']['email']}}</span></p>
            <p style="margin: 1.1mm"><span>PDF gerado em: {{$data['date']}}</span></p>            
        </div>
    </header>

    <div style="display: flex; flex-direction: column; padding-left:5mm; gap: 10mm">
        @foreach ($data['model'] as $nome_dimensao=>$dimensao)
            <h1 style="font-size: 16px; font-weight: bold">
                {{$nome_dimensao}}
            </h1>
            @foreach ($dimensao as $nome_categoria=>$categoria)
                <h4 style="font-size: 14px">
                    {{$nome_categoria}}
                </h4>
                <ul style="font-size: 14px">
                    @foreach ($categoria as $nome_tarefa=>$tarefa)
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
                <div style="height: 6mm"></div>
                <div style="height: 4.5mm"></div>
            @endforeach
                <ul style="font-size: 14px; list-style-type: square">
                    <li>TOTAL DE HORAS: {{ $data['horas'][$nome_dimensao] }}</li>
                </ul>
        </div>
        @endforeach
    </div>
    <footer style="padding-top: 4mm; margin-top: 4mm; border-top: 1px solid #000; text-align: center;">
        <u>
            Copyright &copy;2023. Universidade de Pernambuco - Todos os direitos reservados
        </u>
    </footer>
</body>