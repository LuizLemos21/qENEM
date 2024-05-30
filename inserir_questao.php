<?php
include("conecta.php"); // Certifique-se de incluir seu arquivo de conexão
// Recupere os dados do formulário
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


// SQL para inserir na tabela questao

$sql = "INSERT INTO questao (numero, texto, img, alternativaA, alternativaB, alternativaC, alternativaD, alternativaE, respCorreta, dificuldade, textoResposta, disciplina, enem) 
        VALUES ('$num', '$texto', '$img', '$alt_a', '$alt_b', '$alt_c', '$alt_d', '$alt_e', '$respCorreta', '$dificuldade', '$textoCorrecao', '$disciplina','$idEnem')";

if ($conn->query($sql) === TRUE) {
    echo "Questão inserida com sucesso.";
} else {
    echo "Erro ao inserir questão: " . $conn->error;
}

$conn->close();
?>