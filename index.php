<?php include("conexao.php");?>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" type="text/css" href="./Css/menu.css">
<link rel="stylesheet" type="text/css" href="./Css/style.css">

<!-- 
<div class="menu">
    <ul>
        <li><a style="cursor: pointer;" href="./index.php">Início</a></li>
        <li><a style="cursor: pointer;" onclick="toggleSubmenu('submenuCadastrar')">Cadastrar</a></li>
        <div id="submenuCadastrar" class="submenu">
            <ul>
                <li><a href="./produto.php">Produto</a></li>
            </ul>
        </div>
        <li><a style="cursor: pointer;" onclick="toggleSubmenu('submenuPessoa')">Pessoa</a></li>
        <div id="submenuPessoa" class="submenu">
            <ul>
                <li><a href="./pessoa.php">Cliente</a></li>
            </ul>
        </div>
    </ul>
</div> -->
<ul class="accordion-menu">
    <li>
        <div class="dropdownlink"><i class="fa fa-home" aria-hidden="true"></i> Inicio
            <i class="fa fa-chevron-down" aria-hidden="true"></i>
        </div>
    </li>
    <li>
        <div class="dropdownlink"><i class="fa fa-database" aria-hidden="true"></i> Cadastrar
            <i class="fa fa-chevron-down" aria-hidden="true"></i>
        </div>
        <ul class="submenuItems">
            <li><a href="./produto.php">Produto</a></li>
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
</ul>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="./Script/script.js"></script>
<script src="./Script/menu.js"></script>