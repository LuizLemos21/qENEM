<?php
include("conecta.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupere os dados do formulário
    $disciplinas = isset($_POST['disciplina']) ? $_POST['disciplina'] : [];
    $questoes = isset($_POST['questoes']) ? $_POST['questoes'] : 0;
    $dificuldade = isset($_POST['dificuldade']) ? $_POST['dificuldade'] : "";

    // Verifique se há disciplinas selecionadas
    if (!empty($disciplinas)) {
        // Gere o simulado
        if (is_array($disciplinas)) {
            $sql = "SELECT * FROM questao WHERE disciplina IN ('" . implode("','", $disciplinas) . "') AND dificuldade = '$dificuldade' ORDER BY RAND() LIMIT $questoes";
        } else {
            $sql = "SELECT * FROM questao WHERE disciplina = '$disciplinas' AND dificuldade = '$dificuldade' ORDER BY RAND() LIMIT $questoes";
        }
        $result = $conn->query($sql);
    } else {
        // Se nenhuma disciplina for selecionada, exiba uma mensagem
        $result = false;
    }
}

// Defina uma variável de sessão para armazenar as respostas do usuário
if (!isset($_SESSION['respostas'])) {
    $_SESSION['respostas'] = [];
}

// Processamento das respostas enviadas
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['opcao'])) {
    $respostasUsuario = $_POST['opcao'];
    $_SESSION['respostas'][] = $respostasUsuario;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Simulado - QuestENEM</title>
    <style>
        /* Estilos para o elemento fixo */
        #tempo-restante {
            position: fixed;
            top: 10px; /* Distância do topo da tela */
            right: 10px; /* Distância da direita da tela */
            background-color: #f1f1f1;
            padding: 10px;
            border: 1px solid #ddd;
        }

        /* Estilo para ocultar o botão Enviar Respostas inicialmente */
        #enviar-respostas {
            display: none;
        }
    </style>
</head>
<body>
    <header>
        <!-- Adicione o cabeçalho, conforme necessário -->
    </header>
    <section class="midfield">
        <p id="tempo-restante"> </p>
        <form id="quizForm" method="POST" action="avalia_simulado.php">
            <?php
            if ($result && $result->num_rows > 0) {
                $questoesArray = $result->fetch_all(MYSQLI_ASSOC);
                foreach ($questoesArray as $key => $questao) {
                    // Exiba cada questão
                    echo "<div class='questao'>";
                    echo "<h3>Questão " . ($key + 1) . ":</h3>";
                    echo "<p>" . $questao['texto'] . "</p>";
                    if ($questao['img']) {
                        echo "<img src='data:image/png;base64," . base64_encode($questao['img']) . "' alt='imagem da questao'><br>";
                    }
                    // Adicione as alternativas aqui
                    echo "<input type='radio' id='opcaoA$key' name='opcao[$key]' value='a'>A - " . $questao["alternativaA"] . " <br>";
                    echo "<input type='radio' id='opcaoB$key' name='opcao[$key]' value='b'>B - " . $questao["alternativaB"] . " <br>";
                    echo "<input type='radio' id='opcaoC$key' name='opcao[$key]' value='c'>C - " . $questao["alternativaC"] . "<br>";
                    echo "<input type='radio' id='opcaoD$key' name='opcao[$key]' value='d'>D - " . $questao["alternativaD"] . "<br>";
                    echo "<input type='radio' id='opcaoE$key' name='opcao[$key]' value='e'>E - " . $questao["alternativaE"] . "<br>";
                    echo "</div>";
                }
                echo "<button type='submit' id='enviar-respostas'>Enviar Respostas</button>";
            } else {
                echo "Nenhuma disciplina selecionada ou nenhuma questão encontrada para o simulado.";
            }
            ?>
        </form>
    </section>
    <footer>
        <p>&copy; 2023 QuestENEM. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
<script>
    document.getElementById('tempo-restante').innerHTML = 'Tempo Restante: ' + tempoAtual + 's';
    var numquestoes = <?php echo $questoes; ?>;
    var tempoLimite = 210 * numquestoes; // 3.5 minutos em segundos
    var tempoAtual = tempoLimite;

    function formatarTempo(segundos) {
        var horas = Math.floor(segundos / 3600);
        var minutos = Math.floor((segundos % 3600) / 60);
        var segundosFormatados = segundos % 60;

        return `${horas.toString().padStart(2, '0')}:${minutos.toString().padStart(2, '0')}:${segundosFormatados.toString().padStart(2, '0')}`;
    }

    function atualizarTempo() {
        tempoAtual--;

        document.getElementById('tempo-restante').innerHTML = 'Tempo Restante: ' + formatarTempo(tempoAtual);

        if (tempoAtual <= 0) {
            // Redirecionar para a página de avaliação quando o tempo acabar
            document.getElementById('enviar-respostas').click();
        } else {
            // Atualizar a cada segundo
            setTimeout(atualizarTempo, 1000);
        }
    }

    // Iniciar contagem regressiva ao carregar a página
    document.addEventListener('DOMContentLoaded', function () {
        atualizarTempo();
    });

    // Exibir o botão "Enviar Respostas" após responder a todas as questões
    document.getElementById('enviar-respostas').style.display = 'block';
</script>
