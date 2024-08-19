<?php include("./index.php"); ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova Venda</title>
</head>

<body>
    <div class="conteudo">
        <h4>Cadastrar/<span style="color: #34679d; cursor: pointer;" onclick="window.location.href='./venda.php'">Venda</span>/Venda Novo</h4>
        <div class="container">
            <form id="formVenda" method="post" action="Venda/VendaI001.php">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="obsVenda">Observações</label>
                        <input type="text" class="form-control" id="obsVenda" name="obsVenda" placeholder="Observações da Venda">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="produto">Produto</label>
                        <select class="form-control" id="produto" name="produto" onchange="atualizarValorProduto()">
                            <option value="">Selecione um Produto</option>
                            <?php
                            include("../conexao.php");
                            $consultaProduto = "SELECT idProduto, nomeProduto, valorProduto FROM Produto";
                            $resultadoProduto = $mysqli->query($consultaProduto);
                            if ($resultadoProduto->num_rows > 0) {
                                while ($row = $resultadoProduto->fetch_assoc()) {
                                    echo "<option value='" . $row['idProduto'] . "' data-valor='" . $row['valorProduto'] . "'>" . $row['nomeProduto'] . "</option>";
                                }
                            }
                            $resultadoProduto->free();
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="valorProduto">Valor</label>
                        <input type="text" class="form-control" id="valorProduto" name="valorProduto" readonly>
                    </div>
                    <div class="form-group col-md2">
                        <label for="quantidade">Quantidade</label>
                        <input type="number" class="form-control" id="quantidade" name="quantidade" min="1" value="1">
                    </div>
                    <div class="form-group col-md-2 align-self-end">
                        <button type="button" class="btn btn-primary" onclick="adicionarProduto()">Adicionar Produto</button>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <table id="tabelaProdutos" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Produto</th>
                                    <th>Valor</th>
                                    <th>Quantidade</th>
                                    <th>Subtotal</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Linhas de produtos serão adicionadas aqui -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="form-group">
                    <button type="button" class="btn btn-primary" onclick="cadastrarVenda()">Salvar Venda</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function atualizarValorProduto() {
            const produtoSelect = document.getElementById('produto');
            const valor = produtoSelect.options[produtoSelect.selectedIndex].getAttribute('data-valor');
            document.getElementById('valorProduto').value = valor;
        }

        function adicionarProduto() {
            const produtoSelect = document.getElementById('produto');
            const idProduto = produtoSelect.value;
            const nomeProduto = produtoSelect.options[produtoSelect.selectedIndex].text;
            const valorProduto = document.getElementById('valorProduto').value;
            const quantidade = document.getElementById('quantidade').value;
            const subtotal = (parseFloat(valorProduto) * parseInt(quantidade)).toFixed(2);

            const tabela = document.getElementById('tabelaProdutos').getElementsByTagName('tbody')[0];
            const novaLinha = tabela.insertRow();

            novaLinha.innerHTML = `<tr>
                <td>${nomeProduto}<input type="hidden" name="produtos[]" value="${idProduto}"></td>
                <td>R$ ${parseFloat(valorProduto).toFixed(2)}<input type="hidden" name="valores[]" value="${valorProduto}"></td>
                <td>${quantidade}<input type="hidden" name="quantidades[]" value="${quantidade}"></td>
                <td>R$ ${subtotal}</td>
                <td><button type="button" class="btn btn-danger" onclick="removerProduto(this)">Remover</button></td>
            </tr>`;
        }

        function removerProduto(button) {
            const linha = button.parentNode.parentNode;
            linha.parentNode.removeChild(linha);
        }
    </script>
</body>

</html>