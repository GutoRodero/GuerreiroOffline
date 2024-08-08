<?php include("./conexao.php"); ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Produto</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h2>Cadastrar Produto</h2>
        <form action="./Produto/ProdutoI001.php" method="post">
            <div class="form-group">
                <label for="nomeProduto">Nome:</label>
                <input type="text" class="form-control" id="nomeProduto" name="nomeProduto" required>
            </div>
            <div class="form-group">
                <label for="valorProduto">Valor:</label>
                <input type="text" class="form-control" id="valorProduto" name="valorProduto" required>
            </div>
            <div class="form-group">
                <label for="statusProduto">Status:</label>
                <select class="form-control" id="statusProduto" name="statusProduto">
                    <option value="1">Ativo</option>
                    <option value="2">Inativo</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>
</body>
</html>
