<?php
include("../conexao.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $obsVenda = $_POST['obsVenda'];
    $produtos = $_POST['produtos'];
    $cliente = $_POST['cliente']; 
    $valores = $_POST['valores'];
    $quantidades = $_POST['quantidades'];

    // Iniciar transação
    $mysqli->begin_transaction();

    try {
        // Inserir a venda na tabela Venda
        $queryVenda = "INSERT INTO Venda (obsVenda, idPessoa, dataVenda) VALUES (?, ?, NOW())";
        $stmtVenda = $mysqli->prepare($queryVenda);
        $stmtVenda->bind_param("si", $obsVenda, $cliente);
        $stmtVenda->execute();

        if ($stmtVenda->affected_rows > 0) {
            $idVenda = $stmtVenda->insert_id;

            // Inserir os itens da venda na tabela ItemVenda
            $queryItemVenda = "INSERT INTO ItemVenda (idVenda, idProduto, valorUnitario, quantidade) 
                               VALUES (?, ?, ?, ?)";
            $stmtItemVenda = $mysqli->prepare($queryItemVenda);

            for ($i = 0; $i < count($produtos); $i++) {
                $idProduto = $produtos[$i];
                $valorProduto = $valores[$i];
                $quantidade = $quantidades[$i];

                $stmtItemVenda->bind_param("iidi", $idVenda, $idProduto, $valorProduto, $quantidade);
                $stmtItemVenda->execute();
            }

            // Commit da transação
            $mysqli->commit();
            echo "Venda e itens cadastrados com sucesso!";
        } else {
            throw new Exception("Erro ao cadastrar venda.");
        }
    } catch (Exception $e) {
        // Rollback da transação em caso de erro
        $mysqli->rollback();
        echo "Erro ao cadastrar venda: " . $e->getMessage();
    } finally {
        // Fechar statements
        $stmtVenda->close();
        $stmtItemVenda->close();
        // Fechar conexão com o banco de dados
        $mysqli->close();
    }
}
?>
