<?php require_once ("./index.php"); ?>

<head>
    <title>Relatório de Clientes</title>
</head>

<body>
    <div class="conteudo">
        <h4>Relatório de vendas para <span style="color: #34679d; cursor: pointer;"
                onclick="window.location.href='./pessoa.php'">clientes</span></h4>

        <form class="form-group" id="formProduto" method="POST" action="./relatorioclientedestino.php">
            <div class="form-group">
                <label for="cliente">Cliente</label>
                <select class="form-control" id="cliente" name="idCliente" placeholder="Selecione um cliente">
                    <option value="">Selecione um Cliente</option>
                    <?php
                    include ("../conexao.php");
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
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="dataInicio">Início</label>
                        <input type="date" class="form-control" id="dataInicio"
                            value="<?php echo date('Y-m-d', strtotime('-1 month')); ?>" name="dataInicio"
                            required="required">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="dataFim">Fim</label>
                        <input type="date" class="form-control" id="dataFim" name="dataFim"
                            value="<?php echo date('Y-m-d'); ?>" name="valorProduto" required="required">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Buscar</button>

        </form>



    </div>
</body>