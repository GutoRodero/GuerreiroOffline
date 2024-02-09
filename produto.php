<?php include("./index.php"); ?>
<head>
    <title>Tabela de Produtos</title>
</head>

<body>
    <div class="conteudo">
        <h4>Produto/<span style="color: #34679d; cursor: pointer;" href="./produto.php">Cliente</span></h4>
        <?php

        // Consulta SQL para obter os dados da tabela Produto
        $consulta = "SELECT nomeProduto, valorProduto, statusProduto FROM Produto";

        // Executar a consulta
        $resultado = $mysqli->query($consulta);

        // Verificar se a consulta foi bem-sucedida
        if ($resultado) {
            // Verificar se há pelo menos uma produto na tabela
            if ($resultado->num_rows > 0) {
                // Criar a tabela HTML
                echo "<table>
                    <tr>
                        <th>Nome</th>
                        <th style=\"text-align: center;\">Valor</th>
                        <th style=\"text-align: center;\">Status</th>
                    </tr>";

                // Loop através dos resultados e exibir os dados na tabela
                while ($row = $resultado->fetch_assoc()) {
                    echo "<tr>
                        <td style=\"width: 60%;\">" . $row['nomeProduto'] . "</td>
                        <td style=\"width: 20%;\">" . $row['valorProduto'] . "</td>
                        <td style=\"width: 20%; text-align: center;\">";

                    // Converter o valor numérico do campo sexo para a string correspondente
                    switch ($row['statusProduto']) {
                        case 1:
                            echo "Ativo";
                            break;
                        case 2:
                            echo "Inativo";
                            break;
                        default:
                            echo "Desconhecido";
                    }

                    echo "</td></tr>";
                }

                echo "</table>";
            } else {
                echo "<p>Nenhuma produto encontrada na tabela Produto.</p>";
            }

            // Liberar o resultado da consulta
            $resultado->free();
        } else {
            echo "<p>Erro na consulta: " . $mysqli->error . "</p>";
        }

        // Fechar a conexão com o banco de dados
        $mysqli->close();

        ?>
        <button href="./produtonovo.php" class="button-cadastrar">Cadastrar Produto</button>
    </div>
</body>