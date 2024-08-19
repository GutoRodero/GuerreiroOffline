<?php require_once ("index.php"); ?>
<?php
include ("conexao.php");


// Verifique se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idCliente = $_POST["idCliente"];
    $dataInicio = $_POST["dataInicio"];
    $dataFim = $_POST["dataFim"];

    $dateInicio = new DateTime($dataInicio);
    $dateFim = new DateTime($dataFim);
    $dataInicioFormatada = $dateInicio->format('d/m/Y');
    $dataFimFormatada = $dateFim->format('d/m/Y');
    
    $consultaCliente = "SELECT apelidoPessoa  FROM pessoa WHERE idPessoa = $idCliente";
    $resultadoCliente = $mysqli->query($consultaCliente);
    if ($resultadoCliente->num_rows > 0) {
        while ($row = $resultadoCliente->fetch_assoc()) {
            $apelidoPessoa = $row['apelidoPessoa'];
        }
    }
}
$resultadoCliente->free();
?>




<head>
    <title>Relatório de vendas para clientes</title>
</head>

<body>
    <div class="conteudo">
        <h4>Relatório de vendas para <span style="color: #34679d; cursor: pointer;"
                onclick="window.location.href='./pessoa.php'"> clientes</span></h4>

        </h4>
        <h4><?php echo $apelidoPessoa; ?></h4>
        <h4><?php echo "$dataInicioFormatada - $dataFimFormatada" ?></php>

        <?php
        // Prepare a consulta SQL para inserir os dados na tabela Produto
        $consulta = "SELECT p.nomeProduto, SUM(iv.quantidade) as quantidade
        FROM produto p 
        INNER JOIN itemvenda iv ON p.idProduto = iv.idProduto 
        INNER JOIN venda v ON iv.idVenda = v.idVenda 
        INNER JOIN pessoa pes ON pes.idPessoa = v.idPessoa
        WHERE v.dataVenda BETWEEN '$dataInicio' AND '$dataFim 23:59:59' AND pes.idPessoa = $idCliente
        GROUP BY p.nomeProduto;";

        // Preparar a consulta
        $resultado = $mysqli->query($consulta);

        // Verifique se a consulta foi bem-sucedida
        if ($resultado) {
            if ($resultado->num_rows > 0) {
                // Criar a tabela HTML
                echo "<table>
                        <tr>
                            
                            <th style=\"width: 50%;\">Nome</th>
                            <th style=\"width: 50%; text-align: center;\">Quantidade</th>
                        </tr>";
                while ($row = $resultado->fetch_assoc()) {

                    echo "<tr>
                                <td>" . $row['nomeProduto'] . "</td>
                                <td style=\"text-align: center;\">" . $row['quantidade'] . "</td>";
                }
                ;
                echo "</table>";

            } else {
                echo "<p>Nenhum dado a ser mostrado.</p>";
            }
        } else {
            echo "<p>Erro na consulta: " . $mysqli->error . "</p>";
        }




        $resultado->free();



        // Feche a conexão com o banco de dados
        $mysqli->close();

        ?>






    </div>
</body>