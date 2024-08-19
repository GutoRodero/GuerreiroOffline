<?php require_once("./index.php"); ?>

<head>
    <title>Vendas</title>
</head>

<body>
    <div class="conteudo">
        <h4>Cadastrar/Venda</h4>
        <button onclick="window.location.href='./vendanovo.php'" class="button-cadastrar" style="margin-bottom: 20px;">Cadastrar Venda</button>
        <?php
        // Incluindo a conexão com o banco de dados
        include("./conexao.php");

        // Consulta SQL para obter os dados da tabela Venda
        $consultaVendas = "SELECT idVenda, obsVenda, dataVenda FROM Venda";

        // Executar a consulta
        $resultadoVendas = $mysqli->query($consultaVendas);

        // Verificar se a consulta foi bem-sucedida
        if ($resultadoVendas) {
            // Verificar se há pelo menos uma venda na tabela
            if ($resultadoVendas->num_rows > 0) {
                // Criar a tabela HTML
                echo "<table>
                    <tr>
                        <th style=\"width: 10%;\">ID</th>
                        <th style=\"width: 20%;\">Data</th>
                        <th style=\"width: 50%;\">Observações</th>
                        <th style=\"width: 20%; text-align: center;\">Ações</th>
                    </tr>";

                // Loop através dos resultados e exibir os dados na tabela
                while ($row = $resultadoVendas->fetch_assoc()) {
                    $idVenda = $row['idVenda'];
                    $dataVenda = date("d/m/Y H:i:s", strtotime($row['dataVenda']));
                    echo "<tr>
                        <td>{$idVenda}</td>
                        <td>{$dataVenda}</td>
                        <td>{$row['obsVenda']}</td>
                        <td style=\"text-align: center;\">
                            <a title=\"Editar Venda\" href=\"./vendaeditar.php?idVenda=$idVenda\"><i class=\"fas fa-pencil-alt\" style=\"color: blue; cursor: pointer;\"></i></a>
                            <a title=\"Excluir Venda\" href=\"#\"><i class=\"fas fa-trash-alt\" style=\"color: red; cursor: pointer;\" onclick=\"excluirVenda('$idVenda')\"></i></a>
                        </td>
                    </tr>";
                }

                echo "</table>";
            } else {
                echo "<p>Nenhuma venda encontrada na tabela Venda.</p>";
            }

            // Liberar o resultado da consulta
            $resultadoVendas->free();
        } else {
            echo "<p>Erro na consulta: " . $mysqli->error . "</p>";
        }

        // Fechar a conexão com o banco de dados
        $mysqli->close();
        ?>
    </div>
</body>