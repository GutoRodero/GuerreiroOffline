<?php include("./conexao.php"); ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h2>Lista de Produtos</h2>
        <button onclick="window.location.href='./produtonovo.php'" class="btn btn-primary">Cadastrar Produto</button>
        <table class="table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Valor</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $consulta = "SELECT idProduto, nomeProduto, valorProduto, statusProduto FROM Produto";
                $resultado = $mysqli->query($consulta);

                if ($resultado->num_rows > 0) {
                    while ($row = $resultado->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['nomeProduto'] . "</td>";
                        echo "<td>R$" . number_format($row['valorProduto'], 2, ',', '.') . "</td>";
                        echo "<td>" . ($row['statusProduto'] == 1 ? 'Ativo' : 'Inativo') . "</td>";
                ?>
                        <td>
                            <a href='./produtoeditar.php?idProduto=<?php echo $row['idProduto']; ?>' class='btn btn-warning'>Editar</a>
                            <form action='./Produto/ProdutoE001.php' method='post' style='display:inline;'>
                                <input type='hidden' name='idProduto' value='<?php echo $row['idProduto']; ?>'>
                                <button type='submit' class='btn btn-danger'>Excluir</button>
                            </form>
                        </td>
                <?php
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Nenhum produto encontrado.</td></tr>";
                }

                $mysqli->close();
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>