<?php
include('conecta.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $senha = $_POST['password'];

    $stmt = $conn->prepare("SELECT idUser, senha, isAdmin FROM usuario WHERE nome = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($id, $hashed_password, $isAdmin);
    $stmt->fetch();

    


    if (password_verify($senha, $hashed_password)) {
        $_SESSION['username'] = $username;
        $_SESSION['isAdmin'] = $isAdmin;
        echo "Login bem-sucedido!";
        header("Location: index.php");
        exit(); 
    } else {

        echo "Credenciais inválidas!";
    $stmt->close();
    }}
$conn->close();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login - QuestENEM</title>
</head>
<body>
    <header>
        <h1>QuestENEM</h1>
    </header>
    <section class="midfield">
        <h2>Login</h2>
        <?php
            // Exiba mensagens de erro (se houver)
            if (isset($erro)) {
                echo "<p>$erro</p>";
            }
            ?>
        <!--<form action="login.php" method="POST">-->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="username">Usuário:</label>
            <input type="text" id="username" name="username" required><br>
            
            <label for="password">Senha:</label>
            <input type="password" id="password" name="password" required><br>

            <input type="submit" value="Entrar">
        </form>
        <p>Não tem uma conta? <a href="cadastro.php">Cadastre-se</a></p>
    </section>
    <footer>
        <p>&copy; 2023 QuestENEM. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
