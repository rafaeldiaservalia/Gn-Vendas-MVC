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
            <a href="index.php?acao=cadastrar">Cadastrar</a>
            <a href="index.php?acao=listar"">Listar Produtos</a>
            <a href="index.php?acao=compras">Ver Pedidos</a>
        </div>
        <div class="content">
            <h2>Gn-Vendas</h2>
            <h3>Cadastro de Produto</h3>
            <form action="index.php?acao=efetuarCadastro" method ="post" class="form-cadastro">
                Nome:
                <input type="text" name="nome" required="required"></br></br>
                Valor:
                <input type="text" name="valor" id="valor" onkeyup="formatarMoeda();" required="required" maxlength="10"></br></br>
                <input class="botao" type="submit" name="submit" value="Cadastrar">
            </form>
        </div>
        <div class="footer">
            <p>Gn-Vendas <?php echo date("Y") ?> - Todos os direitos reservados</p>
        </div>
    </body>
</html>
