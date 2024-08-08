<?php
include("../conexao.php");
include("../script.js");

// Verifique se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomeProduto = $_POST["nomeProduto"];    
    // Remover caracteres não numéricos e vírgulas do valorProduto
    $valorProduto = preg_replace('/[^0-9,]/', '', $_POST["valorProduto"]);
    // Substituir vírgulas por pontos para usar como separador decimal
    $valorProduto = str_replace(',', '.', $valorProduto);
    // Converter para float
    $valorProduto = floatval($valorProduto);
    $statusProduto = $_POST["statusProduto"];

    // Prepare a consulta SQL para inserir os dados na tabela Produto
    $sql = "INSERT INTO Produto (nomeProduto, valorProduto, statusProduto) VALUES (?, ?, ?)";

    // Preparar a declaração
    $stmt = $mysqli->prepare($sql);

    // Verifique se a preparação foi bem-sucedida
    if ($stmt) {
        // Vincular parâmetros
        $stmt->bind_param("sds", $nomeProduto, $valorProduto, $statusProduto);

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
    $mysqli->close();
}
?>
