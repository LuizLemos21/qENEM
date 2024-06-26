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
    <title>Quem Somos - QuestENEM</title>
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

    <section class="quem-somos">
        <figure class="quemsomosimg">
            <img src="img/quemsomos.jpg" width="400px" height="400px">
        </figure>
        <h2>Quem Somos</h2>
        <p>A QuestENEM é uma empresa fictícia dedicada a fornecer recursos e soluções de preparação para o Exame Nacional do Ensino Médio (ENEM). <br>Nossa missão é ajudar os estudantes a alcançar seu potencial máximo no ENEM, fornecendo acesso a um amplo banco de questões, simulados personalizados e feedback personalizado.</p>
        <p>Fundada em 2023 por um grupo de apaixonados educadores e desenvolvedores, a QuestENEM nasceu da crença fervorosa de que a educação pode ser transformadora. Nossa jornada começou com a simples ideia de tornar a preparação para o ENEM não apenas eficaz, mas também acessível e inspiradora para estudantes de todos os cantos do Brasil. Impulsionados por esse sonho, dedicamos anos refinando nossa plataforma para oferecer um ambiente de aprendizado digital excepcional. Desde então, ajudamos milhares de estudantes a superar desafios acadêmicos, capacitando-os a alcançar suas metas educacionais.</p>
        <p>Embarcamos nesta missão com um compromisso inabalável com a qualidade, integridade e inovação. Através de parcerias com educadores renomados e uma equipe apaixonada por aprendizado, desenvolvemos um vasto banco de questões, simulados envolventes e recursos personalizados de feedback. Hoje, a QuestENEM não é apenas uma plataforma de estudos; é um ecossistema educacional dinâmico, moldando o futuro de uma geração. Junte-se a nós nessa jornada educacional, onde o conhecimento se encontra com a inspiração, e cada estudante é capacitado para atingir seu potencial máximo.</p>
    </section>

    <section class="contato">
        <h2>Contato</h2>
        <p>Se você tiver alguma dúvida ou precisar entrar em contato conosco, sinta-se à vontade para nos enviar um e-mail ou nos ligar. Estamos aqui para ajudar!</p>
        <ul>
            <li><strong>E-mail:</strong> contato@questenem.com</li>
            <li><strong>Telefone:</strong> (11) 1234-5678</li>
            <li><strong>Endereço:</strong> Rua Fictícia, 1234 - Cidade Imaginária</li>
        </ul>
    </section>
    <footer>
        <p>&copy; 2023 QuestENEM. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
