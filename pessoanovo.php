<?php include("./index.php"); ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Pessoa</title>
</head>

<body>
    <div class="conteudo">
        <h4>Pessoa/<span style="color: #34679d; cursor: pointer;" onclick="window.location.href='./pessoa.php'">Cliente</span>/Cadastrar Cliente</h4>
        <div class="container">
            <form id="formPessoa" method="post">
                <div class="form-row">
                    <div class="form-group col-md-5">
                        <label for="nomePessoa">Nome *</label>
                        <input type="text" class="form-control" id="nomePessoa" placeholder="Nome da Pessoa" name="nomePessoa" required="required">
                    </div>
                    <div class="form-group col-md-5">
                        <label for="apelidoPessoa">Apelido</label>
                        <input type="text" class="form-control" placeholder="Apelido da Pessoa" id="apelidoPessoa" name="apelidoPessoa">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="sexoPessoa">Sexo *</label>
                        <select class="form-control" name="sexoPessoa" id="sexoPessoa" required="required">
                            <option value="" selected>Selecione</option>
                            <option value="1">Masculino</option>
                            <option value="2">Feminino</option>
                            <option value="3">Outros</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <button type="button" style="position: right;" class="btn btn-primary" onclick="cadastrarPessoa()">Salvar</button>
                </div>
            </form>

            <div class="message-card" id="messageCard"></div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>