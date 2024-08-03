<?php
include("../conexao.php");

$idProduto = $_POST['idProduto'];
$nomeProduto = $_POST['nomeProduto'];
$valorProduto = preg_replace('/[^0-9,]/', '', $_POST["valorProduto"]);
// Substituir vírgulas por pontos para usar como separador decimal
$valorProduto = str_replace(',', '.', $valorProduto);
// Converter para float
$valorProduto = floatval($valorProduto);
$statusProduto = $_POST['statusProduto'];

$updateProduto = "UPDATE Produto SET nomeProduto = '$nomeProduto', valorProduto = '$valorProduto', statusProduto = '$statusProduto' WHERE idProduto = '$idProduto'";

if ($mysqli->query($updateProduto) === TRUE) {
    echo json_encode(["status" => "success", "message" => "Produto atualizado com sucesso!"]);
} else {
    echo json_encode(["status" => "error", "message" => "Erro ao atualizar o produto: " . $mysqli->error]);
}
$mysqli->close();
