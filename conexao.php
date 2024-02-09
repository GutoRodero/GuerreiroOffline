<?php
$hostname = "localhost";
$bancodedados = "guerreirooffline";
$usuario = "root";
$senha = "";

$mysqli = new mysqli($hostname, $usuario, $senha, $bancodedados);

function selectDB($nomeTabela, $where)
{
    if(!$where){
        $where = "1";
    }
    // Incluir o arquivo de conexão com o banco de dados
    include("conexao.php");

    // Montar o comando SQL SELECT
    $sql = "SELECT * FROM $nomeTabela WHERE $where";

    // Executar a consulta
    $resultado = $mysqli->query($sql);

    // Verificar se a consulta foi bem-sucedida
    if ($resultado) {
        // Obter o número de registros retornados pela consulta
        $qtdRegistros = $resultado->num_rows;

        // Inicializar um array para armazenar os resultados da consulta
        $dados = array();

        // Converter o resultado da consulta em um array associativo
        while ($row = $resultado->fetch_assoc()) {
            $dados[] = $row;
        }

        // Retornar um array contendo os dados, a quantidade de registros e o comando SELECT
        return array($dados, $qtdRegistros, $sql);
    } else {
        // Se houver um erro na consulta, retornar false
        return false;
    }

    // Fechar a conexão com o banco de dados
    $mysqli->close();
}



function insertDB($tabela, $dados)
{
    // Incluir o arquivo de conexão com o banco de dados
    include("conexao.php");

    // Montar o comando SQL INSERT
    $colunas = implode(', ', array_keys($dados));
    $valores = "'" . implode("', '", array_values($dados)) . "'";
    $sql = "INSERT INTO $tabela ($colunas) VALUES ($valores)";

    // Executar a consulta INSERT
    if ($mysqli->query($sql) === TRUE) {
        // Se a consulta foi bem-sucedida, retornar true
        return true;
    } else {
        // Se houver um erro na consulta, retornar false
        return false;
    }

    // Fechar a conexão com o banco de dados
    $mysqli->close();
}
/* $array = array(
    "nomePessoa" => "teste",
    "sexoPessoa" => 1,
    "apelidoPessoa" => "testão"
);
$retono = insertDB("Pessoa", $array); */

function updateDB($dados, $tabela, $where)
{
    // Incluir o arquivo de conexão com o banco de dados
    include("conexao.php");

    // Montar o comando SQL UPDATE
    $set = '';
    foreach ($dados as $coluna => $valor) {
        $set .= "$coluna = '$valor', ";
    }
    $set = rtrim($set, ', ');
    $sql = "UPDATE $tabela SET $set $where";

    // Executar a consulta UPDATE
    if ($mysqli->query($sql) === TRUE) {
        // Se a consulta foi bem-sucedida, retornar true
        return true;
    } else {
        // Se houver um erro na consulta, retornar false
        return false;
    }

    // Fechar a conexão com o banco de dados
    $mysqli->close();
}

function deleteDB($tabela, $where = "")
{
    // Incluir o arquivo de conexão com o banco de dados
    include("conexao.php");

    // Montar o comando SQL DELETE
    $sql = "DELETE FROM $tabela $where";

    // Executar a consulta DELETE
    if ($mysqli->query($sql) === TRUE) {
        // Se a consulta foi bem-sucedida, retornar true
        return true;
    } else {
        // Se houver um erro na consulta, retornar false
        return false;
    }

    // Fechar a conexão com o banco de dados
    $mysqli->close();
}
