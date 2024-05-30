<?php
include("conecta.php");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id']) && !empty($_GET['id'])) {
    $idquestao = $_GET['id'];
    $sql = "SELECT * FROM `questao` JOIN `enem` ON (questao.enem = enem.idenem) WHERE `idquest` = $idquestao";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
?>
        <!DOCTYPE html>
        <html lang="pt-BR">
        <head>
            <!-- Adicione os metadados necessários e links de estilo -->
            <title>Editar Questão - QuestENEM</title>
        </head>
        <body>
            <h1>Editar Questão</h1>
            <a href="banco.php"><h2>Cancelar</h2></a>

            <form action="atualiza_questao.php" method="POST" enctype="multipart/form-data">
                <!-- ... (Campos do formulário) ... -->
                <input type="hidden" name="idquestao" value="<?php echo $row['idquest']; ?>">
                
                <label for="num">Número da Questão:</label>
                <input type="number" name="num" value="<?php echo $row['numero']; ?>" required><br>

                <label for="disciplina">Disciplina:</label>
                <select id="disciplina" name="disciplina">
                    <option value="Matemática"<?php echo ($row['disciplina'] === 'Matemática') ? 'selected' : ''; ?>>Matemática</option>
                    <option value="Ciências da Natureza"<?php echo ($row['disciplina'] === 'Ciências da Natureza') ? 'selected' : ''; ?>>Ciências da Natureza</option>
                    <option value="Ciências Humanas"<?php echo ($row['disciplina'] === 'Ciências Humanas') ? 'selected' : ''; ?>>Ciências Humanas</option>
                    <option value="Linguagens"<?php echo ($row['disciplina'] === 'Linguagens') ? 'selected' : ''; ?>>Linguagens</option>
                    <option value="Inglês"<?php echo ($row['disciplina'] === 'Inglês') ? 'selected' : ''; ?>>Inglês</option>
                    <option value="Espanhol"<?php echo ($row['disciplina'] === 'Espanhol') ? 'selected' : ''; ?>>Espanhol</option>
                </select><br>

                <label for="texto">Texto da Questão:</label>
                <textarea name="texto" rows="4" cols="50" required><?php echo $row['texto'];?></textarea><br>

                <label for="img">URL da Imagem (opcional):</label>
                <input type="file" name="img" id="img" accept="image/*"><br>

                <label for="alt_a">Alternativa A:</label>
                <input type="text" name="alt_a" value="<?php echo $row['alternativaA']; ?>"required><br>

                <label for="alt_b">Alternativa B:</label>
                <input type="text" name="alt_b" value="<?php echo $row['alternativaB']; ?>" required><br>

                <label for="alt_c">Alternativa C:</label>
                <input type="text" name="alt_c" value="<?php echo $row['alternativaC']; ?>" required><br>

                <label for="alt_d">Alternativa D:</label>
                <input type="text" name="alt_d" value="<?php echo $row['alternativaD']; ?>" required><br>

                <label for="alt_e">Alternativa E:</label>
                <input type="text" name="alt_e" value="<?php echo $row['alternativaE']; ?>" required><br>

                <label>Resposta Correta:</label><br>
                <input type="radio" name="respCorreta" value="a" required<?php echo ($row['respCorreta'] === 'a') ? 'checked' : ''; ?>> A
                <input type="radio" name="respCorreta" value="b" required<?php echo ($row['respCorreta'] === 'b') ? 'checked' : ''; ?>> B
                <input type="radio" name="respCorreta" value="c" required<?php echo ($row['respCorreta'] === 'c') ? 'checked' : ''; ?>> C
                <input type="radio" name="respCorreta" value="d" required<?php echo ($row['respCorreta'] === 'd') ? 'checked' : ''; ?>> D
                <input type="radio" name="respCorreta" value="e" required<?php echo ($row['respCorreta'] === 'e') ? 'checked' : ''; ?>> E<br>

                <label for="dificuldade">Dificuldade:</label>
                <select name="dificuldade" required>
                    <option value="Fácil"<?php echo ($row['dificuldade'] === 'Fácil') ? 'selected' : ''; ?>>Fácil</option>
                    <option value="Intermediária"<?php echo ($row['dificuldade'] === 'Intermediária') ? 'selected' : ''; ?>>Intermediária</option>
                    <option value="Difícil"<?php echo ($row['dificuldade'] === 'Difícil') ? 'selected' : ''; ?>>Difícil</option>
                </select><br>

                <label for="textoCorrecao">Texto de Correção:</label>
                <textarea name="textoCorrecao" rows="4" cols="50" required><?php echo $row['textoResposta'];?></textarea><br>

                <label for="idEnem">Ano:</label>
                <select id="idEnem" name="idEnem" required>
                    <option value="1"<?php echo ($row['enem'] === '1') ? 'selected' : ''; ?>>2022</option>
                    <option value="2"<?php echo ($row['enem'] === '2') ? 'selected' : ''; ?>>2021</option>
                    <option value="3"<?php echo ($row['enem'] === '3') ? 'selected' : ''; ?>>2020</option>
                    <option value="4"<?php echo ($row['enem'] === '4') ? 'selected' : ''; ?>>2019</option>
                    <option value="5"<?php echo ($row['enem'] === '5') ? 'selected' : ''; ?>>2018</option>
                    <option value="6"<?php echo ($row['enem'] === '6') ? 'selected' : ''; ?>>2017</option>
                    <option value="7"<?php echo ($row['enem'] === '7') ? 'selected' : ''; ?>>2016</option>
                    <option value="8"<?php echo ($row['enem'] === '8') ? 'selected' : ''; ?>>2015</option>
                    <option value="9"<?php echo ($row['enem'] === '9') ? 'selected' : ''; ?>>2014</option>
                    <option value="10"<?php echo ($row['enem'] === '10') ? 'selected' : ''; ?>>2013</option>
                    </select><br><br>




                <input type="submit" value="Atualizar Questão">
            </form>
        </body>
        </html>
<?php
    }
}
?>