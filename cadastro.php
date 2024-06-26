<?php
        include('conecta.php');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $username = $_POST['username'];
            $senha = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $stmt = $conn->prepare("INSERT INTO usuario (nome, senha, email) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $senha, $email);

            if ($stmt->execute()) {
                echo "Cadastro realizado com sucesso!";
                header("Location: login.php");
            } else {
                echo "Erro ao cadastrar usuário: " . $stmt->error;
            }

            $stmt->close();
        }

        $conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Cadastro - QuestENEM</title>
</head>
<body>
    <header>
        <h1>QuestENEM</h1>
    </header>
    <section class="midfield">
        <h2>Cadastro</h2>
        <form action="cadastro.php" method="POST">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br>
            
            <label for="username">Nome de Usuário:</label>
            <input type="text" id="username" name="username" required><br>

            <label for="password">Senha:</label>
            <input type="password" id="password" name="password" required><br>

            <label for="confirm-password">Confirmar Senha:</label>
            <input type="password" id="confirm-password" name="confirm-password" required><br>

            <input type="submit" value="Cadastrar">
        </form>
        <p>Já tem uma conta? <a href="login.php">Faça login</a></p>
    </section>

    <footer>
        <p>&copy; 2023 QuestENEM. Todos os direitos reservados.</p>
    </footer>
</body>
</html>

