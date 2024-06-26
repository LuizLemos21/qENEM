<?php
header("Location: manutencao.php");
exit(); 
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Feedback - QuestENEM</title>
</head>
<body>
    <header>
        <h1>QuestENEM</h1>
        <nav>
            <ul>
            <li><a href="login.php">Login</a></li>
                <li><a href="index.php">Início</a></li>
                <li><a href="banco.php">Banco de Questões</a></li>
                <li><a href="simul.php">Criar Simulado</a></li>
                <li><a href="feedback.php">Feedback Personalizado</a></li>
                <li><a href="quemsomos.php">Quem Somos?</a></li>
                
            </ul>
        </nav>
    </header>
    <section class="midfield">
        <h2>Feedback</h2>
        
        <h3>% de Acertos: 85%</h3>
        <select id="acertos" name="acertos">
            <option value="geral">Geral</option>
            <option value="matematica">Matemática</option>
            <option value="ciencias-natureza">Ciencias da Natureza</option>
            <option value="ciencias-humanas">Ciencias Humanas</option>
            <option value="linguagens">Linguagens</option>
        </select>
        
        <h3>Simulados Realizados: 3</h3>
        <select id="simulados-realizados" name="simulados-realizados">
            <option value="geral">Geral</option>
            <option value="matematica">Matemática</option>
            <option value="ciencias-natureza">Ciencias da Natureza</option>
            <option value="ciencias-humanas">Ciencias Humanas</option>
            <option value="linguagens">Linguagens</option>
        </select>
        
        <h3>Simulados:</h3>
        <select id="simulados-menu" name="simulados-menu">
            <option value="sample-text1">22-09-23 19:44</option>
            <option value="sample-text2">21-09-23 00:15</option>
            <option value="sample-text3">14-09-23 16:12</option>
        </select>
        
        <h3>Nota:</h3>
        <select id="nota" name="nota">
            <option value="geral">Geral</option>
            <option value="matematica">Matemática</option>
            <option value="ciencias-natureza">Ciencias da Natureza</option>
            <option value="ciencias-humanas">Ciencias Humanas</option>
            <option value="linguagens">Linguagens</option>
        </select>
        
        <h3>Progresso:</h3>
        <select id="progresso" name="progresso">
            <option value="geral">Geral</option>
            <option value="matematica">Matemática</option>
            <option value="ciencias-natureza">Ciencias da Natureza</option>
            <option value="ciencias-humanas">Ciencias Humanas</option>
            <option value="linguagens">Linguagens</option>
        </select>
    </section>
    <footer>
        <p>&copy; 2023 QuestENEM. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
