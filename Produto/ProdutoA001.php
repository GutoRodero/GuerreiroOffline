<?php
include("../conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idProduto = $_POST["idProduto"];
    $nomeProduto = $_POST["nomeProduto"];
    $valorProduto = str_replace(',', '.', $_POST["valorProduto"]);
    $valorProduto = floatval($valorProduto);
    $statusProduto = $_POST["statusProduto"];

    $sql = "UPDATE Produto SET nomeProduto = ?, valorProduto = ?, statusProduto = ? WHERE idProduto = ?";

    $stmt = $mysqli->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("sdsi", $nomeProduto, $valorProduto, $statusProduto, $idProduto);
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            echo "sucesso";
            header("Location: ../produto.php");
        } else {
            echo "Erro ao atualizar dados.";
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
