<?php
include("../conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["idVenda"])) {
        $idVenda = $_POST["idVenda"];

        // Iniciar a resposta
        $response = ['status' => 'error', 'message' => 'Erro desconhecido'];

        // Excluir itens da venda
        $sqlItem = "DELETE FROM ItemVenda WHERE idVenda = ?";
        $stmtItem = $mysqli->prepare($sqlItem);
        if ($stmtItem) {
            $stmtItem->bind_param("i", $idVenda);
            $stmtItem->execute();
            $stmtItem->close();
        } else {
            $response['message'] = 'Erro ao preparar a consulta de itens: ' . $mysqli->error;
            echo json_encode($response);
            $mysqli->close();
            exit();
        }

        // Excluir venda
        $sqlVenda = "DELETE FROM Venda WHERE idVenda = ?";
        $stmtVenda = $mysqli->prepare($sqlVenda);
        if ($stmtVenda) {
            $stmtVenda->bind_param("i", $idVenda);
            $stmtVenda->execute();
            if ($stmtVenda->affected_rows > 0) {
                $response = ['status' => 'success', 'message' => 'Venda excluída com sucesso!'];
            } else {
                $response['message'] = 'Erro ao excluir venda ou venda não encontrada.';
            }
            $stmtVenda->close();
        } else {
            $response['message'] = 'Erro ao preparar a consulta de venda: ' . $mysqli->error;
        }

        echo json_encode($response);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'ID da venda não fornecido.']);
    }

    $mysqli->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Método de requisição inválido.']);
}
?>
