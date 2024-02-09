<?php include("./index.php"); ?>
<head>
    <title>Tabela de Pessoas</title>
</head>

<body>
    <div class="conteudo">
        <h4>Pessoa/<span style="color: #34679d; cursor: pointer;" href="./pessoa.php">Cliente</span></h4>
        <?php

        // Consulta SQL para obter os dados da tabela Pessoa
        $consulta = "SELECT nomePessoa, apelidoPessoa, sexoPessoa FROM Pessoa";

        // Executar a consulta
        $resultado = $mysqli->query($consulta);

        // Verificar se a consulta foi bem-sucedida
        if ($resultado) {
            // Verificar se há pelo menos uma pessoa na tabela
            if ($resultado->num_rows > 0) {
                // Criar a tabela HTML
                echo "<table>
                    <tr>
                        <th>Nome</th>
                        <th>Apelido</th>
                        <th style=\"text-align: center;\">Sexo</th>
                    </tr>";

                // Loop através dos resultados e exibir os dados na tabela
                while ($row = $resultado->fetch_assoc()) {
                    echo "<tr>
                        <td style=\"width: 40%;\">" . $row['nomePessoa'] . "</td>
                        <td style=\"width: 40%;\">" . $row['apelidoPessoa'] . "</td>
                        <td style=\"width: 20%; text-align: center;\">";

                    // Converter o valor numérico do campo sexo para a string correspondente
                    switch ($row['sexoPessoa']) {
                        case 1:
                            echo "Masculino";
                            break;
                        case 2:
                            echo "Feminino";
                            break;
                        case 3:
                            echo "Outros";
                            break;
                        default:
                            echo "Desconhecido";
                    }

                    echo "</td></tr>";
                }

                echo "</table>";
            } else {
                echo "<p>Nenhuma pessoa encontrada na tabela Pessoa.</p>";
            }

            // Liberar o resultado da consulta
            $resultado->free();
        } else {
            echo "<p>Erro na consulta: " . $mysqli->error . "</p>";
        }

        // Fechar a conexão com o banco de dados
        $mysqli->close();

        ?>
        <button href="./pessoanovo.php" class="button-cadastrar">Cadastrar Pessoa</button>
    </div>
</body>