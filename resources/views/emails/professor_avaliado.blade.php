<!DOCTYPE html>
<html>
<head>
    <title>Avaliação de Atividades</title>
</head>
<body>
    <h1>Olá, {{ $professor->name }}</h1>

    <p>Suas atividades foram avaliadas. Aqui estão os detalhes:</p>

    <p>Quantidade de atividades aprovadas: {{ $aprovadas }}</p>
    <p>Quantidade de atividades reprovadas: {{ $reprovadas }}</p>

    <ul>
        @foreach($atividadesDetalhes as $atividade)
                @if($atividade['status'] == 6)
                <li>
                    <strong>Status:</strong>
                    Reprovada<br>
                    <strong>Horas Reajustadas:</strong> {{ $atividade['horas_reajuste'] ?? 'N/A' }}<br>
                    <strong>Comentário:</strong> {{ $atividade['descricao'] ?? 'Nenhum comentário' }}
                </li>
                @elseif(($atividade['status'] == 3))
                    Pendente
                @endif
        @endforeach
    </ul>

    <p>Obrigado,</p>
    <p>Sua equipe de avaliação</p>
</body>
</html>
