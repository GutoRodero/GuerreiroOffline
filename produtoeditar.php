<?php
include("./conexao.php");
$idProduto = $_GET['idProduto'];
$consulta = "SELECT * FROM Produto WHERE idProduto = $idProduto";
$resultado = $mysqli->query($consulta);
$produto = $resultado->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h2>Editar Produto</h2>
        <form action="./Produto/ProdutoA001.php" method="post">
            <input type="hidden" name="idProduto" value="<?php echo $produto['idProduto']; ?>">
            <div class="form-group">
                <label for="nomeProduto">Nome:</label>
                <input type="text" class="form-control" id="nomeProduto" name="nomeProduto" value="<?php echo $produto['nomeProduto']; ?>" required>
            </div>
            <div class="form-group">
                <label for="valorProduto">Valor:</label>
                <input type="text" class="form-control" id="valorProduto" name="valorProduto" value="<?php echo number_format($produto['valorProduto'], 2, ',', '.'); ?>" required>
            </div>
            <div class="form-group">
                <label for="statusProduto">Status:</label>
                <select class="form-control" id="statusProduto" name="statusProduto">
                    <option value="1" <?php if ($produto['statusProduto'] == 1) echo 'selected'; ?>>Ativo</option>
                    <option value="2" <?php if ($produto['statusProduto'] == 2) echo 'selected'; ?>>Inativo</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>
</body>
</html>
