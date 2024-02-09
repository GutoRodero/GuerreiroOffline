<?php
include("../conexao.php");
include("../script.js");

// Verifique se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupere os valores enviados pelo formulário
    $nomeProduto = $_POST["nomeProduto"];
    $valorProduto = $_POST["valorProduto"];
    $statusProduto = $_POST["statusProduto"];

    // Prepare a consulta SQL para inserir os dados na tabela Produto
    $sql = "INSERT INTO Produto (nomeProduto, valorProduto, statusProduto) VALUES (?, ?, ?)";

    // Preparar a declaração
    $stmt = $conexao->prepare($sql);

    // Verifique se a preparação foi bem-sucedida
    if ($stmt) {
        // Vincular parâmetros
        $stmt->bind_param("sss", $nomeProduto, $valorProduto, $statusProduto);

        // Execute a consulta
        $stmt->execute();

        // Verifique se a inserção foi bem-sucedida
        if ($stmt->affected_rows > 0) {
            // Chame a função showMessage do script.js
            echo '<script>showMessage("Dados inseridos com sucesso na tabela Produto.", "success");</script>';
        } else {
            echo '<script>showMessage("Erro ao inserir dados na tabela Produto.", "danger");</script>';
        }

        // Feche a declaração
        $stmt->close();
    } else {
        echo '<script>showMessage("Erro ao preparar a consulta.", "danger");</script>';
    }

    // Feche a conexão com o banco de dados
    $conexao->close();
}
