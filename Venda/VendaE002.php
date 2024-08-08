<?php
include("../conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["idItemVenda"])) {
        $idItemVenda = $_POST["idItemVenda"];

        // Excluir ItemVenda
        $sqlItemVenda = "DELETE FROM ItemVenda WHERE idItemVenda = ?";
        $stmtItemVenda = $mysqli->prepare($sqlItemVenda);
        if ($stmtItemVenda) {
            $stmtItemVenda->bind_param("i", $idItemVenda);
            $stmtItemVenda->execute();
            if ($stmtItemVenda->affected_rows > 0) {
                echo '<script>showMessage("Item da Venda excluído com sucesso!", "success");</script>';
            } else {
                echo '<script>showMessage("Erro ao excluir Item da Venda.", "danger");</script>';
            }
            $stmtItemVenda->close();
        } else {
            echo '<script>showMessage("Erro ao preparar a exclusão.", "danger");</script>';
        }
    }
    $mysqli->close();
}
?>
