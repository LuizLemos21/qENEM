<?php

include("conecta.php");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id']) && !empty($_GET['id'])) {
    $idquestao = $_GET['id'];
    
    // Verifique se uma questão foi selecionada antes de prosseguir
    if (!empty($idquestao)) {
        // Execute a remoção da questão do banco de dados
        $sql = "DELETE FROM `questao` WHERE `idquest` = $idquestao";
        $conn->query($sql);
    }
}

// Redirecione de volta à página principal
header("Location: banco.php");
exit();



?>