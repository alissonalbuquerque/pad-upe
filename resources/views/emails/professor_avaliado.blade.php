<!DOCTYPE html>
<html>
<head>
    <title>Avaliação de Atividades</title>
</head>
<body>
    <h1>Olá, {{ $professor->name }}</h1>

    <p>Suas atividades foram avaliadas. Aqui estão os detalhes:</p>

    <ul>
        @foreach($atividadesDetalhes as $atividade)
            <li>
                <strong>Nome:</strong> {{ $atividade['nome'] ?? 'Nome não disponível' }}<br>
                <strong>Status:</strong>
                @if($atividade['status'] == 7)
                    Aprovada
                @elseif($atividade['status'] == 6)
                    Reprovada<br>
                    <strong>Horas Reajustadas:</strong> {{ $atividade['horas_reajuste'] ?? 'N/A' }}<br>
                    <strong>Comentário:</strong> {{ $atividade['descricao'] ?? 'Nenhum comentário' }}
                @else
                    Pendente
                @endif
            </li>
        @endforeach
    </ul>

    <p>Obrigado,</p>
    <p>Sua equipe de avaliação</p>
</body>
</html>
