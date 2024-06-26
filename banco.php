<?php 
include("conecta.php");
session_start();

// Verifique se o usuário está autenticado
if (!isset($_SESSION['username'])){
    // Se não estiver autenticado, redirecione para a página de login
    header("Location: login.php");
    exit();
}

                /* Configurações de paginação
                $resultados_por_pagina = 15;
                $pagina_atual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
                $offset = ($pagina_atual - 1) * $resultados_por_pagina;
                $sql = "SELECT COUNT(*) as total FROM `questao` JOIN `enem` ON (questao.enem = enem.idenem) WHERE 1";
               $result_total = $conn->query($sql);
                $total_resultados = $result_total->fetch_assoc()['total'];
                */
                $sql = "SELECT * FROM `questao` JOIN `enem` ON (questao.enem = enem.idenem) WHERE 1 ";

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $ano = $_POST['ano']; // Obtém o valor do campo de seleção de ano do formulário
                    $dificuldade = $_POST['dificuldade']; // Obtém o valor do campo de seleção de dificuldade do formulário
                    $disciplina = $_POST['disciplina']; // Obtém o valor do campo de seleção de disciplina do formulário

                    // Modifica o SQL para incluir os critérios do formulário de pesquisa

                    if ($ano != 'any') {
                        $sql .= " AND enem.ano = '$ano'";
                    }

                    if ($dificuldade != 'any') {
                        $sql .= " AND questao.dificuldade = '$dificuldade'";
                    }

                    if ($disciplina != 'any') {
                        $sql .= " AND questao.disciplina = '$disciplina'";
                    }

                    $sql .= "ORDER BY ano DESC, numero ASC";
                    $result = $conn->query($sql);
                }
                
                // Adicionando a cláusula LIMIT para implementar a paginação
               // $sql .= " LIMIT $offset, $resultados_por_pagina";
                $result = $conn->query($sql);
                
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Banco de Questões - QuestENEM</title>
    <style>
    /* estilos para a página banco.php*/

        /* Estilos para a seção "bank" */
        .bank {
            margin-top: 20px;
            
        }

        .bank h2 {
            font-size: 24px;
            color: #333;
        }

        .bank ul {
            list-style: none;
            padding: 0;
        }

        .bank li {
            margin-bottom: 10px;
            border-bottom: 1px solid #ddd;
        }

        .bank button {
            background-color: #524e8a;
            text-align: left;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            box-sizing: border-box;
        }

        .bank button:hover {
            background-color: #8595b6;
        }
    </style>
    
    
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
        <h2>Banco de Questões</h2>
        <form method='POST'>
            Ano:
            <select id="ano" name="ano">
                <option value ="any">Qualquer</option>
                <option value="2022">2022</option>
                <option value="2021">2021</option>
                <option value="2020">2020</option>
                <option value="2019">2019</option>
                <option value="2018">2018</option>
                <option value="2017">2017</option>
                <option value="2016">2016</option>
                <option value="2015">2015</option>
                <option value="2014">2014</option>
                <option value="2013">2013</option>
                <option value="2012">2012</option>
                <option value="2011">2011</option>
                <option value="2010">2010</option>
                <option value="2009">2009</option>
                <option value="2008">2008</option>
                <option value="2007">2007</option>
                <option value="2006">2006</option>
                <option value="2005">2005</option>
                <option value="2004">2004</option>
                <option value="2003">2003</option>
                <option value="2002">2002</option>
                <option value="2001">2001</option>
                <option value="2000">2000</option>
                <option value="1999">1999</option>
                <option value="1998">1998</option>
                
            </select>
            
            Dificuldade:
            <select id="dificuldade" name="dificuldade">
                <option value="any">Qualquer</option>
                <option value="fácil">Fácil</option>
                <option value="intermediária">Intermediária</option>
                <option value="avançada">Avançada</option>
            </select>

            Disciplina:
            <select id="disciplina" name="disciplina">
                <option value="any">Qualquer</option>
                <option value="matemática">Matemática</option>
                <option value="ciências-da-natureza">Ciências da Natureza</option>
                <option value="ciências humanas">Ciências Humanas</option>
                <option value="linguagens">Linguagens</option>
                <option value="ingles">Inglês</option>
                <option value="espanhol">Espanhol</option>
            </select>
            
            <input type="submit" value="Pesquisar">
        </form>
    </section>
    <?php if ($_SESSION['isAdmin']) {
            echo "<a href = \"form.html\"> <button>Adicionar Questão</button> </a>";
            echo "<button id ='editarQuestaoBtn'>Editar Questão</button>";
            echo "<button id='removerQuestaoBtn'>Remover Questão</button>";
        } ?>
    <section class="bank">
        
        <h2>Questoes</h2>
        <ul>
        <?php
                
                if(!empty($sql)){
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<li><button data-id='" . $row["idquest"] . "' onclick='openPopup(" . $row["idquest"] . ")'>ENEM " . $row["ano"] . " Q" . $row["numero"] .  " - Disciplina: " . $row["disciplina"] . " - Dificuldade: " . $row["dificuldade"] . "</button>";
                    }
                    
                } else {
                    echo "0 resultados encontrados";
                }
                // Adicionar links de navegação entre páginas
  /*              $total_resultados = // Consulte o banco de dados para obter o número total de resultados;
                $total_paginas = ceil($total_resultados / $resultados_por_pagina);

                for ($i = 1; $i <= $total_paginas; $i++) {
                    echo "<a href='banco.php?pagina=$i'>$i</a> ";
                }
                */
            }
                $conn->close();
        ?>

        </ul>    
    
        
    </section>
    <footer>
        <p>&copy; 2023 QuestENEM. Todos os direitos reservados.</p>
    </footer>


    <script>
    // Scripts para Modo Remoção e Edição
    let modoAtivado = null; // Pode ser 'remover' ou 'editar'
    let questaoSelecionada = null;

    function ativarModo(modo) {
        modoAtivado = modo;
        alert(`Modo ${modo.charAt(0).toUpperCase() + modo.slice(1)} Questão ativado. Selecione uma questão.`);
    }

    function desativarModo() {
        modoAtivado = null;
    }

    function confirmarAcao() {
        if (modoAtivado && questaoSelecionada) {
            const acao = modoAtivado === 'remover' ? 'remover_questao.php' : 'editar_questao.php';
            const confirmation = confirm(`Tem certeza de que deseja ${modoAtivado} esta questão?`);
            if (confirmation) {
                window.location.href = `${acao}?id=${questaoSelecionada}`;
            } else {
                desativarModo();
            }
        }
    }

    function openPopup(idquestao) {
        if (modoAtivado) {
            questaoSelecionada = idquestao;
            confirmarAcao();
        } else {
            // Se o modo não estiver ativado, abra a janela pop-up normalmente
            const popupURL = `questao.php?id=${idquestao}`;
            const popupConfig = 'width=1000, height=500, top=100, left=100, resizable=no, scrollbars=no, menubar=no, toolbar=no';
            window.open(popupURL, 'Popup', popupConfig);
        }
    }
</script>

<script>
    // Scripts para Modo Remoção
    document.getElementById('removerQuestaoBtn').addEventListener('click', () => ativarModo('remover'));

    // Scripts para Modo Edição
    document.getElementById('editarQuestaoBtn').addEventListener('click', () => ativarModo('editar'));
</script>



</body>
</html>
