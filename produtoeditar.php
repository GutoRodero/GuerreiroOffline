<?php include("./index.php"); ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .form-group button {
            width: 100%;
        }

        .conteudo {
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="conteudo">
        <h4>Produto/<span style="color: #34679d; cursor: pointer;" onclick="window.location.href='./produto.php'">Produto</span>/Produto Editar</h4>
        <div class="container">
            <?php
            $idProduto = $_GET['idProduto'];
            $consultaProduto = "SELECT nomeProduto, valorProduto, statusProduto FROM Produto WHERE idProduto = $idProduto";
            $resultadoProduto = $mysqli->query($consultaProduto);
            $nomeProduto = $valorProduto = $statusProduto = "";
            if ($resultadoProduto->num_rows > 0) {
                $row = $resultadoProduto->fetch_assoc();
                $nomeProduto = $row['nomeProduto'];
                $valorProduto = $row['valorProduto'];
                $statusProduto = $row['statusProduto'];
            }
            ?>
            <form id="formProduto" method="post" action="ProdutoA001.php">
                <input type="hidden" name="idProduto" value="<?php echo $idProduto; ?>">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="nomeProduto">Nome *</label>
                        <input type="text" class="form-control" id="nomeProduto" name="nomeProduto" value="<?php echo $nomeProduto; ?>" required="required">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="valorProduto">Valor *</label>
                        <input type="text" class="form-control" id="valorProduto" name="valorProduto" value="<?php echo $valorProduto; ?>" required="required" oninput="formatarValor(this)">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="statusProduto">Status *</label>
                        <select class="form-control" name="statusProduto" id="statusProduto" required>
                            <option value="1" <?php echo $statusProduto == 1 ? 'selected' : ''; ?>>Ativo</option>
                            <option value="2" <?php echo $statusProduto == 2 ? 'selected' : ''; ?>>Inativo</option>
                        </select>
                    </div>
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
    function formatarValor(element) {
        let value = element.value;
        value = value.replace(/\D/g, '');
        value = (value / 100).toFixed(2) + '';
        value = value.replace(".", ",");
        value = value.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
        element.value = 'R$ ' + value;
    }
</script>
<script>
    document.getElementById('formProduto').addEventListener('submit', function (e) {
        e.preventDefault();
        const form = e.target;
        const formData = new FormData(form);

        fetch('ProdutoA001.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            const messageCard = document.getElementById('messageCard');
            if (data.status === 'success') {
                messageCard.className = 'message-card success';
                form.reset();
            } else {
                messageCard.className = 'message-card error';
            }
            messageCard.innerHTML = `<p>${data.message}</p>`;
            messageCard.style.display = 'block';
            setTimeout(() => {
                messageCard.style.display = 'none';
            }, 3000);
        })
        .catch(error => console.error('Erro:', error));
    });

    function formatarValor(element) {
        let value = element.value.replace(/\D/g, '');
        value = (value / 100).toFixed(2).replace('.', ',');
        value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        element.value = 'R$ ' + value;
    }
</script>
