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
    <title>QuestENEM - Sua Preparação para o ENEM</title>
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
    <section class="bg">
    <section class="hero">
        <h2>Bem-vindo, <?php echo $_SESSION["username"]; ?>
        <?php if($_SESSION["isAdmin"]){ echo("<small> ADM</small>"); } ?>
        </h2>
        <h2>Preparando-se para o ENEM?</h2>
        <p>Pratique com questões reais e melhore seus resultados!</p>
    </section>
    <section class="features">
        <div class="feature">
            <h3>Banco de Questões</h3>
            <p>Acesse uma vasta coleção de questões do ENEM em várias disciplinas.</p>
            <a href="banco.php">Saiba Mais</a>
        </div>
        <div class="feature">
            <h3>Crie Simulados</h3>
            <p>Crie simulados personalizados com questões de sua escolha.</p>
            <a href="simul.php">Saiba Mais</a>
        </div>
        <div class="feature">
            <h3>Feedback Personalizado</h3>
            <p>Receba correção instantânea e feedback detalhado após cada simulado.</p>
            <a href="feedback.php">Saiba Mais</a>
        </div>
    </section>
</section>
    <footer>
        <p>&copy; 2023 QuestENEM. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
