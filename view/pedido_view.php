<!DOCTYPE html>
<html>
    <head>
    <title>Gn-Vendas</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"href="css/estilo.css">
</head>
<body>
    <div class="topnav">
        <a href="index.php?acao=cadastrar">Cadastrar</a>
        <a href="index.php?acao=listar"">Listar Produtos</a>
        <a href="index.php?acao=compras">Ver Pedidos</a>
    </div>
    <div class="content">
        <h2>Pedidos</h2>
        <table border="1"> 
            <tr>
                <th>Nome</th>
                <th>Telefone</th> 
                <th>Produto</th>
                <th>Preço (R$)</th> 
                <th>Pagar</th>
            </tr>
            <?php
            $msg = false;   
            foreach ($compras as $compra => $valor){
                echo '<tr>';
                echo '<td>'.$valor['nome_cliente'].'</td>';
                echo '<td>'.$valor['telefone_cliente'].'</td>';
                echo '<td>'.$valor['nome'].'</td>';
                echo '<td> R$ '. number_format($valor['valor'], 2, ',', '.') .'</td>';
                echo '<td><a href="'.$valor['link_boleto'].'" target="_blank" class="button">Boleto</a></td>';
                echo '</tr>';
                $msg = true;    
            }
            if ($msg == false) {
                echo 'Nenhum produto cadastrado';
            }
            ?> 
        </table>
    </div>
    <div class="footer">
        <p>Gn-Vendas <?php echo date("Y") ?> - Todos os direitos reservados</p>
    </div>
</body>
</html>