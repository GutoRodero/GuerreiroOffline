<?php include("./conexao.php"); ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="./Css/menu.css">
    <link rel="stylesheet" type="text/css" href="./Css/style.css">
</head>

<body>
    <ul class="accordion-menu">
        <li>
            <div class="dropdownlink"><i href="./index.php" class="fa fa-home" aria-hidden="true"></i> Início
            </div>
        </li>
        <li>
            <div class="dropdownlink"><i class="fa fa-database" aria-hidden="true"></i> Cadastrar
                <i class="fa fa-chevron-down" aria-hidden="true"></i>
            </div>
            <ul class="submenuItems">
                <li><a href="./produto.php">Produto</a></li>
                <li><a href="./venda.php">Venda</a></li>
            </ul>
        </li>
         <li>
            <div class="dropdownlink"><i class="fa fa-users" aria-hidden="true"></i> Pessoa
                <i class="fa fa-chevron-down" aria-hidden="true"></i>
            </div>
            <ul class="submenuItems">
                <li><a href="./pessoa.php">Cliente</a></li>
            </ul>
        </li> 
        <li>
            <div class="dropdownlink"><i class="fa fa-table" aria-hidden="true"></i> Relatórios
                <i class="fa fa-chevron-down" aria-hidden="true"></i>
            </div>
            <ul class="submenuItems">
                <li><a href="./relatorioproduto.php">Produtos</a></li>
                <li><a href="./relatoriocliente.php">Clientes</a></li>
            </ul>
            
        </li> 
    </ul>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="./Script/script.js"></script>
    <script src="./Script/menu.js"></script>