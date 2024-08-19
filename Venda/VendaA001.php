<?php
include("../conexao.php");

// Verifique se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idVenda = $_POST['idVenda'];
    $obsVenda = $_POST['obsVenda'];

    // Verifique se os dados dos produtos existem
    $produtos = isset($_POST['produtos']) ? $_POST['produtos'] : [];
    $valores = isset($_POST['valores']) ? $_POST['valores'] : [];
    $quantidades = isset($_POST['quantidades']) ? $_POST['quantidades'] : [];

    // Iniciar a resposta
    $response = ['status' => 'error', 'message' => 'Erro desconhecido'];

    // Verifique se o ID da venda existe
    $sqlVerifica = "SELECT idVenda FROM Venda WHERE idVenda = ?";
    $stmtVerifica = $mysqli->prepare($sqlVerifica);
    $stmtVerifica->bind_param("i", $idVenda);
    $stmtVerifica->execute();
    $stmtVerifica->store_result();

    if ($stmtVerifica->num_rows === 0) {
        $response = ['status' => 'error', 'message' => 'ID da venda não encontrado.'];
        $stmtVerifica->close();
        $mysqli->close();
        echo json_encode($response);
        exit();
    }
    $stmtVerifica->close();

    // Atualizar venda (sempre tentar, mesmo que o campo obsVenda não tenha sido alterado)
    $sql = "UPDATE Venda SET obsVenda = ? WHERE idVenda = ?";
    $stmt = $mysqli->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("si", $obsVenda, $idVenda);
        $stmt->execute();
        $stmt->close();

        // Remover itens antigos
        $sqlRemover = "DELETE FROM ItemVenda WHERE idVenda = ?";
        $stmtRemover = $mysqli->prepare($sqlRemover);

        if ($stmtRemover) {
            $stmtRemover->bind_param("i", $idVenda);
            $stmtRemover->execute();
            $stmtRemover->close();

            // Inserir itens atualizados
            if (count($produtos) > 0) {
                $sqlItem = "INSERT INTO ItemVenda (idVenda, idProduto, quantidade, valorUnitario) VALUES (?, ?, ?, ?)";
                $stmtItem = $mysqli->prepare($sqlItem);

                if ($stmtItem) {
                    foreach ($produtos as $index => $idProduto) {
                        $valor = $valores[$index];
                        $quantidade = $quantidades[$index];
                        $stmtItem->bind_param("iiid", $idVenda, $idProduto, $quantidade, $valor);
                        $stmtItem->execute();
                    }
                    $stmtItem->close();
                    $response = ['status' => 'success', 'message' => 'Venda atualizada com sucesso!'];
                } else {
                    $response['message'] = 'Erro ao preparar a consulta de itens: ' . $mysqli->error;
                }
            } else {
                $response['message'] = 'Nenhum produto foi adicionado.';
            }
        } else {
            $response['message'] = 'Erro ao remover itens antigos: ' . $mysqli->error;
        }
    } else {
        $response['message'] = 'Erro ao preparar a consulta: ' . $mysqli->error;
    }

    // Feche a conexão com o banco de dados
    $mysqli->close();

    // Retorne a resposta como JSON
    echo json_encode($response);
}
?>
