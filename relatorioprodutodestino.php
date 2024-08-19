<?php require_once ("index.php"); ?>
<?php
include ("conexao.php");


// Verifique se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dataInicio = $_POST["dataInicio"];
    $dataFim = $_POST["dataFim"];

    $dateInicio = new DateTime($dataInicio);
    $dateFim = new DateTime($dataFim);
    $dataInicioFormatada = $dateInicio->format('d/m/Y');
    $dataFimFormatada = $dateFim->format('d/m/Y');
    ?>

    <head>
        <title>Relatório de vendas de produtos</title>
    </head>

    <body>
        <div class="conteudo">
            <h4>Relatório de vendas de <span style="color: #34679d; cursor: pointer;"
                    onclick="window.location.href='./produto.php'"> produtos</span></h4>
            <h4><?php echo "$dataInicioFormatada - $dataFimFormatada" ?></php>
            </h4>


            <?php
            // Prepare a consulta SQL para inserir os dados na tabela Produto
            $consulta = "SELECT p.nomeProduto, SUM(iv.quantidade) as quantidade
        FROM produto p 
        INNER JOIN itemvenda iv ON p.idProduto = iv.idProduto 
        INNER JOIN venda v ON iv.idVenda = v.idVenda 
        WHERE v.dataVenda BETWEEN '$dataInicio' AND '$dataFim 23:59:59' 
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
                    echo '<script>showMessage("Erro ao preparar a consulta.", "danger");</script>';
                }

            } else {
                echo "<p>Nenhum dado a ser mostrado.</p>";
            }
            $resultado->free();
} else {
    echo "<p>Erro na consulta: " . $mysqli->error . "</p>";
}


// Feche a conexão com o banco de dados
$mysqli->close();

?>






    </div>
</body>