<?php
include("../conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Receba o ID do produto a ser excluído
    $idProduto = $_POST["idProduto"];

    // Prepare a consulta SQL para excluir o produto
    $sql = "DELETE FROM Produto WHERE idProduto = ?";

    // Prepare e execute a consulta
    $stmt = $mysqli->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i", $idProduto); // 'i' para integer
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            // Redirecione para produto.php após exclusão bem-sucedida
            header("Location: ../produto.php");
            exit();
        } else {
            echo "Erro ao excluir o produto ou o produto não foi encontrado.";
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
