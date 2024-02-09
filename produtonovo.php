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
        <div class="container">
            <form id="formProduto" method="post">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="nomeProduto">Nome *</label>
                        <input type="text" class="form-control" id="nomeProduto" placeholder="Nome do Produto" name="nomeProduto" required="required">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="valorProduto">Valor *</label>
                        <input type="text" class="form-control" id="valorProduto" placeholder="R$ 0,00" name="valorProduto" required="required" oninput="formatarValor(this)">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="statusProduto">Status *</label>
                        <select class="form-control" name="statusProduto" id="statusProduto" required>
                            <option value="1" selected>Ativo</option>
                            <option value="2">Inativo</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <button type="button" class="btn btn-primary" onclick="cadastrarProduto()">Salvar</button>
                </div>
            </form>

            <div class="message-card" id="messageCard"></div>
        </div>
    </div>

</body>

</html>