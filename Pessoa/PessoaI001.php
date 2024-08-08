<?php
include("../conexao.php");
include("../script.js");

// Verifique se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupere os valores enviados pelo formulário
    $nomePessoa = $_POST["nomePessoa"];
    $apelidoPessoa = $_POST["apelidoPessoa"];
    $sexoPessoa = $_POST["sexoPessoa"];

    // Prepare a consulta SQL para inserir os dados na tabela Pessoa
    $sql = "INSERT INTO Pessoa (nomePessoa, apelidoPessoa, sexoPessoa) VALUES (?, ?, ?)";

    // Preparar a declaração
    $stmt = $mysqli->prepare($sql);

    // Verifique se a preparação foi bem-sucedida
    if ($stmt) {
        // Vincular parâmetros
        $stmt->bind_param("sss", $nomePessoa, $apelidoPessoa, $sexoPessoa);

        // Execute a consulta
        $stmt->execute();

        // Verifique se a inserção foi bem-sucedida
        if ($stmt->affected_rows > 0) {
            // Chame a função showMessage do script.js
            echo '<script>showMessage("Dados inseridos com sucesso na tabela Pessoa.", "success");</script>';
        } else {
            echo '<script>showMessage("Erro ao inserir dados na tabela Pessoa.", "danger");</script>';
        }

        // Feche a declaração
        $stmt->close();
    } /* else {
        echo '<script>showMessage("Erro ao preparar a consulta.", "danger");</script>';
    } */

    // Feche a conexão com o banco de dados
    $mysqli->close();
}
?>
