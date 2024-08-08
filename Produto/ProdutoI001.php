<?php
include("../conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomeProduto = $_POST["nomeProduto"];
    $valorProduto = str_replace(',', '.', $_POST["valorProduto"]);
    $valorProduto = floatval($valorProduto);
    $statusProduto = $_POST["statusProduto"];

    $sql = "INSERT INTO Produto (nomeProduto, valorProduto, statusProduto) VALUES (?, ?, ?)";

    $stmt = $mysqli->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("sds", $nomeProduto, $valorProduto, $statusProduto);
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            // Redireciona para produto.php após a inserção bem-sucedida
            header("Location: ../produto.php");
            exit();
        } else {
            echo "Erro ao inserir dados.";
        }
        $stmt->close();
    } else {
        echo "Erro ao preparar a consulta.";
    }
    $mysqli->close();
} else {
    echo "Método de requisição inválido.";
}
?>
