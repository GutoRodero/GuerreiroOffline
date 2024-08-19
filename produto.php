<?php require_once("./index.php"); ?>

<head>
    <title>Tabela de Produtos</title>
</head>

<body>
    <div class="conteudo">
        <h4>Cadastrar/<span style="color: #34679d; cursor: pointer;" onclick="window.location.href='./produto.php'">Produto</span></h4>
        <button onclick="window.location.href='./produtonovo.php'" class="button-cadastrar" style="margin-bottom: 20px;">Cadastrar Produto</button>
        <?php

        // Consulta SQL para obter os dados da tabela Produto
        $consulta = "SELECT idProduto, nomeProduto, valorProduto, statusProduto FROM Produto";

        // Executar a consulta
        $resultado = $mysqli->query($consulta);

        // Verificar se a consulta foi bem-sucedida
        if ($resultado) {
            // Verificar se há pelo menos um produto na tabela
            if ($resultado->num_rows > 0) {
                // Criar a tabela HTML
                echo "<table>
                    <tr>
                        <th style=\"width: 50%;\">Nome</th>
                        <th style=\"width: 20%; text-align: center;\">Valor</th>
                        <th style=\"width: 20%; text-align: center;\">Status</th>
                        <th style=\"width: 10%; text-align: center;\">Opções</th>
                    </tr>";

                // Loop através dos resultados e exibir os dados na tabela
                while ($row = $resultado->fetch_assoc()) {
                    $idProduto = $row['idProduto'];
                    echo "<tr>
                        <td>" . $row['nomeProduto'] . "</td>
                        <td style=\"text-align: center;\">R$" . number_format($row['valorProduto'], 2, ',', '.') . "</td>
                        <td style=\"text-align: center;\">";

                    // Converter o valor numérico do campo status para a string correspondente
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

                    echo "</td>
                        <td style=\"text-align: center;\">
                            <a title=\"Editar Produto\" href=\"./produtoeditar.php?idProduto=$idProduto\"><i class=\"fas fa-pencil-alt\" style=\"color: blue; cursor: pointer;\"></i></a>
                            <a title=\"Excluir Produto\" href=\"#\"><i class=\"fas fa-trash-alt\" style=\"color: red; cursor: pointer;\" onclick=\"excluirProduto('$idProduto')\"></i></a>
                        </td>
                    </tr>";
                }

                echo "</table>";
            } else {
                echo "<p>Nenhum produto encontrado na tabela Produto.</p>";
            }

            // Liberar o resultado da consulta
            $resultado->free();
        } else {
            echo "<p>Erro na consulta: " . $mysqli->error . "</p>";
        }

        // Fechar a conexão com o banco de dados
        $mysqli->close();

        ?>
    </div>
</body>