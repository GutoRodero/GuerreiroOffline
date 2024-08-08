<?php
include("../conexao.php");
include("../script.js");

// Verifique se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifique se o idPessoa foi enviado
    if (isset($_POST["idPessoa"])) {
        // Recupere o idPessoa enviado pelo formulário
        $idPessoa = $_POST["idPessoa"];

        // Prepare a consulta SQL para excluir o registro da tabela Pessoa com base no idPessoa
        $sql = "DELETE FROM Pessoa WHERE idPessoa = ?";

        // Preparar a declaração
        $stmt = $mysqli->prepare($sql);

        // Verifique se a preparação foi bem-sucedida
        if ($stmt) {
            // Vincular parâmetros
            $stmt->bind_param("i", $idPessoa);

            // Execute a consulta
            $stmt->execute();

            // Verifique se a exclusão foi bem-sucedida
            if ($stmt->affected_rows > 0) {
                // Chame a função showMessage do script.js
                echo '<script>showMessage("Registro excluído com sucesso da tabela Pessoa.", "success");</script>';
            } else {
                echo '<script>showMessage("Erro ao excluir registro da tabela Pessoa.", "danger");</script>';
            }

            // Feche a declaração
            $stmt->close();
        } else {
            echo '<script>showMessage("Erro ao preparar a consulta.", "danger");</script>';
        }
    } else {
        echo '<script>showMessage("ID da Pessoa não fornecido.", "danger");</script>';
    }

    // Feche a conexão com o banco de dados
    $mysqli->close();
}
?>
