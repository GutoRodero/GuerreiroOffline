<?php
include("./index.php");

// Verifique se o ID da pessoa foi passado na URL
if (isset($_GET['idPessoa'])) {
    // Recupere o ID da pessoa da URL
    $idPessoa = $_GET['idPessoa'];

    // Consulta SQL para obter os dados da pessoa com o ID fornecido
    $consulta = "SELECT nomePessoa, apelidoPessoa, sexoPessoa FROM Pessoa WHERE idPessoa = $idPessoa";

    // Executar a consulta
    $resultado = $mysqli->query($consulta);

    // Verificar se a consulta foi bem-sucedida
    if ($resultado && $resultado->num_rows > 0) {
        // Extrair os dados da pessoa
        $pessoa = $resultado->fetch_assoc();

        // Preencher os campos do formulário com os dados da pessoa
        $nomePessoa = $pessoa['nomePessoa'];
        $apelidoPessoa = $pessoa['apelidoPessoa'];
        $sexoPessoa = $pessoa['sexoPessoa'];
    } else {
        echo "Nenhuma pessoa encontrada com o ID fornecido.";
    }

    // Liberar o resultado da consulta
    $resultado->free();
} else {
    echo "ID da pessoa não fornecido na URL.";
}

// Fechar a conexão com o banco de dados
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Pessoa</title>
</head>

<body>
    <div class="conteudo">
        <h4>Editar Pessoa</h4>
        <form id="formEditarPessoa" method="post">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="nomePessoa">Nome *</label>
                    <input type="text" class="form-control" id="nomePessoa" placeholder="Nome da Pessoa" name="nomePessoa" required value="<?php echo $nomePessoa; ?>">
                </div>
                <div class="form-group col-md-4">
                    <label for="apelidoPessoa">Apelido</label>
                    <input type="text" class="form-control" placeholder="Apelido da Pessoa" id="apelidoPessoa" name="apelidoPessoa" value="<?php echo $apelidoPessoa; ?>">
                </div>
                <div class="form-group col-md-4">
                    <label for="sexoPessoa">Sexo *</label>
                    <select class="form-control" name="sexoPessoa" id="sexoPessoa" required>
                        <option value="1" <?php if ($sexoPessoa == 1) echo "selected"; ?>>Masculino</option>
                        <option value="2" <?php if ($sexoPessoa == 2) echo "selected"; ?>>Feminino</option>
                        <option value="3" <?php if ($sexoPessoa == 3) echo "selected"; ?>>Outros</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </form>
    </div>
</body>

</html>
