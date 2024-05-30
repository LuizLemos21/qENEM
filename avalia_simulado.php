<?php
include("conecta.php");
header("Location: manutencao.php");
exit(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Certifique-se de que a sessão esteja iniciada
    session_start();

    // Verifique se há respostas do usuário na sessão
    if (isset($_SESSION['respostas'])) {
        // Recupere as respostas do usuário da sessão
        $respostasUsuario = $_SESSION['respostas'];

        // Recupere as respostas corretas do banco de dados
        $sql = "SELECT respCorreta FROM questao ORDER BY id_questao";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $respostasCorretasArray = $result->fetch_all(MYSQLI_ASSOC);

            // Compare as respostas do usuário com as respostas corretas
            $pontuacao = 0;
            foreach ($respostasCorretasArray as $key => $respostaCorreta) {
                $respostaUsuario = isset($respostasUsuario[$key]) ? $respostasUsuario[$key] : '';

                // Compare a resposta do usuário com a resposta correta
                if ($respostaUsuario === $respostaCorreta['respCorreta']) {
                    $pontuacao++;
                }
            }
            echo $pontuacao;

            // Agora você tem a pontuação do usuário ($pontuacao)
            // Insira ou faça o que for necessário com a pontuação no banco de dados
            // Certifique-se de sanitizar as variáveis antes de executar consultas SQL
            // Exemplo de inserção (não esqueça de adaptar à sua estrutura de banco de dados):
            //$usuarioId = $_SESSION['usuario_id'];  // Substitua pelo ID do usuário atual
            //$sqlInserirPontuacao = "INSERT INTO pontuacao (usuario_id, pontuacao) VALUES ('$usuarioId', '$pontuacao')";
            //$conn->query($sqlInserirPontuacao);

            // Limpe as respostas da sessão
            unset($_SESSION['respostas']);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Avaliação do Simulado - QuestENEM</title>
</head>
<body>
    <header>
        <!-- Adicione o cabeçalho, conforme necessário -->
    </header>
    <section>
        <h2>Avaliação do Simulado</h2>
        <?php
        if (isset($pontuacao)) {
            echo "<p>Sua pontuação: $pontuacao</p>";
        } else {
            echo "<p>Não foi possível calcular a pontuação. Certifique-se de que você respondeu a todas as questões.</p>";
        }
        ?>
    </section>
    <footer>
        <p>&copy; 2023 QuestENEM. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
