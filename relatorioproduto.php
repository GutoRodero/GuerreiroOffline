<?php require_once ("./index.php"); ?>

<head>
    <title>Relatório de Produtos</title>
</head>

<body>
    <div class="conteudo">
        <h4>Relatório de venda de <span style="color: #34679d; cursor: pointer;"
                onclick="window.location.href='./produto.php'">produtos</span></h4>

        <form class="form-group" id="formProduto" method="POST" action="./relatorioprodutodestino.php">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="dataInicio">Início</label>
                    <input type="date" class="form-control" id="dataInicio"
                        value="<?php echo date('Y-m-d', strtotime('-1 month')); ?>" name="dataInicio" required="required">
                </div>
                <div class="form-group col-md-6">
                    <label for="dataFim">Fim</label>
                    <input type="date" class="form-control" id="dataFim" name="dataFim" value="<?php echo date('Y-m-d'); ?>"
                        name="valorProduto" required="required">
                </div>

            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </form>



    </div>
</body>