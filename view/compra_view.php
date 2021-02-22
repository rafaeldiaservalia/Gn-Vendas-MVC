<!DOCTYPE html>
<html>
    <head>
        <title>Gn-Vendas</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet"href="css/estilo.css">
        <script src="js/formatacao.js"></script>     
    </head>
    <body>
        <div class="topnav">
        <div class="topnav">
            <a href="index.php?acao=cadastrar">Cadastrar</a>
            <a href="index.php?acao=listar"">Listar Produtos</a>
            <a href="index.php?acao=compras">Ver Pedidos</a>
        </div>
        </div>
        <div class="content">
            <h2>Gn-Vendas</h2>
            <h3>Informações da Compra</h3>        
            <table> 
                <tr>
                    <th>Nome do Produto</th>
                    <th>Valor do Produto</th>
                </tr>
                <?php
                foreach ($produto_individual as $produto  => $valor){       
                    echo "<td>".$valor['nome']."</td>";
                    echo "<td>R$ ".number_format($valor['valor'], 2, ',', '.')."</td>";  
                }
                ?>
                </tr>
            </table>
            <h3>Preencha os dados abaixo</h3>
            <form action="index.php?acao=efetuarCompra" method ="post">
                Nome:
                <input type="text" name="nome" required="required"></br></br>
                Sobrenome:
                <input type="text" name="sobrenome" required="required"></br></br>
                CPF:
                <input type="text" name="cpf" id="cpf" onkeyup="mascaraCpf();" maxlength="11" required="required"></br></br>
                Telefone:
                <input type="text" id="telefone" name="telefone" onkeypress="mask(this, mphone);" onblur="mask(this, mphone);" /> 
                <input type="hidden" name="idProduto" value="<?php echo $_GET['cod']; ?>">
                <input type="hidden" name="produto" value="<?php echo $valor['nome']; ?>">
                <input type="hidden" name="valor" value="<?php echo $valor['valor']; ?>">
                <input class="botao" type="submit" name="submit" value="Comprar">
            </form>
        </div>
        <div class="footer">
            <p>Gn-Vendas <?php echo date("Y") ?> - Todos os direitos reservados</p>
        </div>
    </body>
</html>