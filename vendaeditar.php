<?php include ("./index.php"); ?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Venda</title>
    <style>
        .form-row .form-group {
            flex: 1;
        }

        .form-group button {
            width: 100%;
        }

        .table thead th,
        .table tbody td {
            text-align: center;
        }

        .conteudo {
            padding: 20px;
        }

        .btn-block {
            display: inline-block;
            width: auto;
        }
    </style>
</head>

<body>
    <div class="conteudo">
        <h4>Cadastrar/<span style="color: #34679d; cursor: pointer;"
                onclick="window.location.href='./venda.php'">Venda</span>/Venda Editar</h4>
        <div class="container">
            <?php
            include ("conexao.php");
            $idVenda = $_GET['idVenda'];
            $consultaVenda = "SELECT obsVenda, idPessoa FROM Venda WHERE idVenda = $idVenda";
            $resultadoVenda = $mysqli->query($consultaVenda);
            $obsVenda = "";
            $idPessoa = 0;
            if ($resultadoVenda->num_rows > 0) {
                $row = $resultadoVenda->fetch_assoc();
                $obsVenda = $row['obsVenda'];
                $idPessoa = $row['idPessoa'];
            }
            $apelidoPessoa = "";
            if ($idPessoa) {
                $consultaPessoa = "SELECT apelidoPessoa FROM pessoa WHERE idPessoa = $idPessoa";
                $resultadoPessoa = $mysqli->query($consultaPessoa);
                if ($resultadoPessoa->num_rows > 0) {
                    $row = $resultadoPessoa->fetch_assoc();
                    $apelidoPessoa = $row['apelidoPessoa'];
                }
            }
            ?>
            <form id="formVenda" method="post" action="Venda/VendaA001.php">
                <input type="hidden" name="idVenda" value="<?php echo $idVenda; ?>">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="obsVenda">Observações</label>
                        <input type="text" class="form-control" id="obsVenda" name="obsVenda"
                            placeholder="Observações da Venda" value="<?php echo $obsVenda; ?>">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="cliente">Cliente</label>
                        <select class="form-control" id="cliente" name="cliente" >
                            <option value="<?php echo $apelidoPessoa; ?>"><?php echo $apelidoPessoa; ?></option>
                            <?php
                            
                            $consultaCliente = "SELECT idPessoa, apelidoPessoa  FROM pessoa";
                            $resultadoCliente = $mysqli->query($consultaCliente);
                            if ($resultadoCliente->num_rows > 0) {
                                while ($row = $resultadoCliente->fetch_assoc()) {
                                    echo "<option value='" . $row['idPessoa'] . "'>" . $row['apelidoPessoa'] . "</option>";
                                }
                            }
                            $resultadoCliente->free();
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="produto">Produto</label>
                        <select class="form-control" id="produto" name="produto" onchange="atualizarValorProduto()">
                            <option value="">Selecione um Produto</option>
                            <?php
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
                    <div class="form-group col-md-2">
                        <label for="quantidade">Quantidade</label>
                        <input type="number" class="form-control" id="quantidade" name="quantidade" min="1" value="1">
                    </div>
                    <div class="form-group col-md-2 align-self-end">
                        <button type="button" class="btn btn-primary btn-block"
                            onclick="adicionarProduto()">Adicionar</button>
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
                                <?php
                                $consultaItensVenda = "SELECT ItemVenda.idItemVenda, Produto.idProduto, Produto.nomeProduto, ItemVenda.quantidade, ItemVenda.valorUnitario 
                                                       FROM ItemVenda 
                                                       INNER JOIN Produto ON ItemVenda.idProduto = Produto.idProduto 
                                                       WHERE ItemVenda.idVenda = $idVenda";
                                $resultadoItensVenda = $mysqli->query($consultaItensVenda);
                                if ($resultadoItensVenda->num_rows > 0) {
                                    while ($row = $resultadoItensVenda->fetch_assoc()) {
                                        $subtotal = $row['quantidade'] * $row['valorUnitario'];
                                        echo "<tr>
                                                <td>{$row['nomeProduto']}<input type='hidden' name='produtos[]' value='{$row['idProduto']}'></td>
                                                <td>R$ " . number_format($row['valorUnitario'], 2, ',', '.') . "<input type='hidden' name='valores[]' value='{$row['valorUnitario']}'></td>
                                                <td>{$row['quantidade']}<input type='hidden' name='quantidades[]' value='{$row['quantidade']}'></td>
                                                <td>R$ " . number_format($subtotal, 2, ',', '.') . "</td>
                                                <td><button type='button' class='btn btn-danger btn-sm' onclick='removerProduto(this, \"{$row['idItemVenda']}\")'>Remover</button></td>
                                              </tr>";
                                    }
                                }
                                $resultadoItensVenda->free();
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="form-group">
                    <button type="button" class="btn btn-primary btn-block" onclick="editarVenda()">Salvar
                        Venda</button>
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

            if (idProduto && valorProduto && quantidade > 0) {
                const tabela = document.getElementById('tabelaProdutos').getElementsByTagName('tbody')[0];
                const novaLinha = tabela.insertRow();

                novaLinha.innerHTML = `<tr>
                    <td>${nomeProduto}<input type="hidden" name="produtos[]" value="${idProduto}"></td>
                    <td>R$ ${parseFloat(valorProduto).toFixed(2)}<input type="hidden" name="valores[]" value="${valorProduto}"></td>
                    <td>${quantidade}<input type="hidden" name="quantidades[]" value="${quantidade}"></td>
                    <td>R$ ${subtotal}</td>
                    <td><button type="button" class="btn btn-danger btn-sm" onclick="removerProduto(this)">Remover</button></td>
                </tr>`;

                produtoSelect.value = '';
                document.getElementById('valorProduto').value = '';
                document.getElementById('quantidade').value = 1;
            } else {
                alert("Preencha todos os campos do produto antes de adicionar.");
            }
        }

        function removerProduto(button, idItemVenda) {
            if (confirm("Deseja realmente remover este item?")) {
                removerItemVenda(idItemVenda);
                const linha = button.parentNode.parentNode;
                linha.parentNode.removeChild(linha);
            }
        }
    </script>
</body>

</html>