<?php
include("conecta.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupere os dados do formulário
    $idquestao = $_POST['idquestao'];
    $num = $_POST['num'];
    $texto = $_POST['texto'];
    $disciplina = $_POST['disciplina']; 
    $img = $_POST['img'];
    $alt_a = $_POST['alt_a'];
    $alt_b = $_POST['alt_b'];
    $alt_c = $_POST['alt_c'];
    $alt_d = $_POST['alt_d'];
    $alt_e = $_POST['alt_e'];
    $respCorreta = $_POST['respCorreta'];
    $dificuldade = $_POST['dificuldade'];
    $textoCorrecao = $_POST['textoCorrecao'];
    $textoCorrecao = mysqli_real_escape_string($conn, $textoCorrecao);
    $idEnem = $_POST['idEnem'];

    // Atualize a questão no banco de dados
    $sql = "UPDATE `questao` SET 
    `numero` = $num,
    `texto` = '$texto',
    `disciplina` = '$disciplina',
    `img` = '$img',
    `alternativaA` = '$alt_a',
    `alternativaB` = '$alt_b',
    `alternativaC` = '$alt_c',
    `alternativaD` = '$alt_d',
    `alternativaE` = '$alt_e',
    `respCorreta` = '$respCorreta',
    `dificuldade` = '$dificuldade',
    `textoResposta` = '$textoCorrecao',
    `enem` = $idEnem
    WHERE `idquest` = $idquestao";
    
$conn->query($sql);

    // Redirecione de volta à página principal após a atualização
    header("Location: banco.php");
    exit();
}
?>
