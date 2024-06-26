<?php
// Inicie a sessão
session_start();
// Verifique se o usuário está autenticado
if (!isset($_SESSION['username'])){
    // Se não estiver autenticado, redirecione para a página de login
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Criar Simulado - QuestENEM</title>
</head>
<body>
    <header>
        <h1>QuestENEM</h1>
        <nav>
            <ul>
                <li><a href="index.php">Início</a></li>
                <li><a href="banco.php">Banco de Questões</a></li>
                <li><a href="simul.php">Criar Simulado</a></li>
                <li><a href="feedback.php">Feedback Personalizado</a></li>
                <li><a href="quemsomos.php">Quem Somos?</a></li>
                <li><a href="logout.php">Sair</a></li>
                
            </ul>
        </nav>
    </header>
    <section class="midfield" >
        <h2>Criar Simulado</h2>
        <form action="gera_simulado.php" method="POST">
            <fieldset>
                <legend>Disciplinas:</legend>
                <input type="checkbox" id="matematica" name="disciplina" value="matematica">Matemática
                <input type="checkbox" id="ciencias-natureza" name="disciplina" value="ciencias-natureza">Ciencias da Natureza
                <input type="checkbox" id="Ciencias Humanas" name="disciplina" value="ciências humanas">Ciencias Humanas
                <input type="checkbox" id="linguagens" name="disciplina" value="linguagens">Linguagens
                <input type="checkbox" id="ingles" name="disciplina" value="ingles">Ingles
                <input type="checkbox" id="espanhol" name="disciplina" value="espanhol">Espanhol
            </fieldset><br>

            Quantidade de Questões (máx. 90):<input type="number" id="questoes" name="questoes" min="1" max="90" required>

            Nível de Dificuldade:
            <select id="dificuldade" name="dificuldade" required>
                <option value="fácil">Fácil</option>
                <option value="intermediária">Intermediária</option>
                <option value="avançada">Avançada</option>
            </select><br><br>

            <input type="submit" value="Criar Simulado">
        </form>
    </section>
    <footer>
        <p>&copy; 2023 QuestENEM. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
