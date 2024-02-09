<?php include("conexao.php"); ?>
<link rel="stylesheet" type="text/css" href="./style.css">

<div id="menu">
    <ul>
        <li><a style="cursor: pointer;" href="./index.php">Início</a></li>
        <li><a style="cursor: pointer;">Cadastrar</a></li>
        <li><a style="cursor: pointer;" onclick="toggleSubmenu('submenuCliente')">Pessoa</a></li>
        <div id="submenuCliente" class="submenu">
            <ul>
                <li><a href="./pessoa.php">Cliente</a></li>
            </ul>
        </div>
    </ul>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="./script.js"></script>