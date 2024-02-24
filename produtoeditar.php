<?php include("./index.php"); ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Produto</title>
</head>

<body>

    <div class="conteudo">
        <h4>Cadastrar/<span style="color: #34679d; cursor: pointer;" onclick="window.location.href='./produto.php'">Produto/Cadastrar Produto</span></h4>
        <div class="container">
            <form id="formProduto" method="post">
                <div class="form-row">
                    <?php
                    $consulta = "SELECT idProduto, nomeProduto, valorProduto, statusProduto FROM Produto";

                    // Executar a consulta
                    $resultado = $mysqli->query($consulta);

                    // Verificar se a consulta foi bem-sucedida
                    if ($resultado) {
                        $dados = $resultado->fetch_assoc();
                    ?>
                        <div class="form-group col-md-4">
                            <label for="nomeProduto">Nome *</label>
                            <input type="text" class="form-control" id="nomeProduto" value="<?= $dados['nomeProduto'] ?>" placeholder="Nome do Produto" name="nomeProduto" required="required">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="valorProduto">Valor *</label>
                            <input type="text" class="form-control" id="valorProduto" value="<?= $dados['valorProduto'] ?>" placeholder="R$ 0,00" name="valorProduto" required="required" oninput="formatarValor(this)">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="statusProduto">Status *</label>
                            <select class="form-control" name="statusProduto" id="statusProduto" required>
                                <?php
                                $statusAtivo = '';
                                $statusInativo = '';

                                if ($dados['statusProduto'] == 1) {
                                    $statusAtivo = 'selected';
                                } elseif ($dados['statusProduto'] == 2) {
                                    $statusInativo = 'selected';
                                }

                                ?>
                                <option value="1" <?= $statusAtivo ?>>Ativo</option>
                                <option value="2" <?= $statusInativo ?>>Inativo</option>
                            </select>

                        </div>
                    <?php } ?>
                </div>
                <div class="form-group">
                    <button type="button" class="btn btn-primary" onclick="editarProduto()">Salvar</button>
                </div>
            </form>

            <div class="message-card" id="messageCard"></div>
        </div>
    </div>

</body>

</html>

<script>

</script>