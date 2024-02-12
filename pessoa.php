<?php include("./index.php"); ?>

<head>
    <title>Tabela de Pessoas</title>
</head>

<body>
    <div class="conteudo">
        <h4>Pessoa/<span style="color: #34679d; cursor: pointer;" href="./pessoa.php">Cliente</span></h4>
        <button onclick="window.location.href='./pessoanovo.php'" class="button-cadastrar">Cadastrar Pessoa</button>
        <?php

        // Consulta SQL para obter os dados da tabela Pessoa
        $consulta = "SELECT idPessoa, nomePessoa, apelidoPessoa, sexoPessoa FROM Pessoa";

        // Executar a consulta
        $resultado = $mysqli->query($consulta);

        // Verificar se a consulta foi bem-sucedida
        if ($resultado) {
            // Verificar se há pelo menos uma pessoa na tabela
            if ($resultado->num_rows > 0) {
                // Criar a tabela HTML
                echo "<table>
                    <tr>
                        <th style=\"width: 35%;\">Nome</th>
                        <th style=\"width: 35%;\">Apelido</th>
                        <th style=\"text-align: center; width: 20%;\">Sexo</th>
                        <th style=\"text-align: center; width: 10%;\">Opções</th>
                    </tr>";

                // Loop através dos resultados e exibir os dados na tabela
                while ($row = $resultado->fetch_assoc()) {
                    $idPessoa = $row['idPessoa'];
                    echo "<tr>
                            <td>" . $row['nomePessoa'] . "</td>
                            <td>" . $row['apelidoPessoa'] . "</td>
                            <td style=\"text-align: center;\">";

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

                    echo "</td>
                        <td style=\"text-align: center;\"
                            <a title=\"Editar Pessoa\" href=\"#\"><i class=\"fas fa-pencil-alt\" style=\"color: blue;\" href=\"./editarpessoa.php?idPessoa=$idPessoa\"></i></a>
                            <a title=\"Excluir Pessoa\"href=\"#\"><i class=\"fas fa-trash-alt\" style=\"color: red;\" onclick=\"excluirPessoa('$idPessoa')\"></i></a>
                        </td>
                        </tr>";
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
    </div>
</body>