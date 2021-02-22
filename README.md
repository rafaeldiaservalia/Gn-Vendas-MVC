# Gn-Vendas-MVC
Projeto de compra de produtos com boleto Gerencianet em MVC

#__Gn-Vendas__

### Para instalar/configurar este sistema, siga os passos abaixo: ### 

1º - Baixar o projeto (todos os aquivos) para seu computador.

2º - Para testar no ambiente local (windows), você pode usar o __WampServer__.

3º - Se você estiver usando o WampServer, acesse o caminho __c:\wamp ou c:\wamp64__, em seguida abra a pasta __www__  e  crie uma pasta chamada: __Gn-Vendas__  (sugestão) 

4º - Copie todos os arquivos do projeto (passo 1) para a pasta __Gn-Vendas__  (passo 3)

Estrutura de pasta e arquivos depois de ralizados os passos anteriores:  
 
```
 -www         
    -Gn-Vendas
        +config
           -Conexao.php
        +controller
           -ComprarController.php
           -ProdutoController.php
        +css
           -estilo.css
        +js
           -formatacao.js
        +model
           -Compras.php
           -Produtos.php
        +vendo
        +view 
           -cadastra_view.php
           -compra_view.php
           -pedido_view.php
           -produto_view.php
        -composer.json
        -composer.lock
        -index.php 
        -README

```

5º - Abra o __http://localhost/phpmyadmin/__ e crie um banco de dados chamado __GN-VENDAS__  (sugestão) OU crie o banco de dados via prompt de comandos.
```
CREATE DATABASE GN_VENDAS
```

6º - Selecione o banco de dados criado e crie as tabelas abaixo:
 
```
CREATE TABLE compras (
  compra_id int(11) NOT NULL AUTO_INCREMENT,
  nome_cliente varchar(100) NOT NULL,
  cpf_cliente varchar(11) NOT NULL,
  telefone_cliente varchar(15) NOT NULL,
  link_boleto varchar(250) NOT NULL,
  id_boleto int(100) NOT NULL,
  vencimento_boleto varchar(20) NOT NULL,
  produto_id int(11) NOT NULL,
  PRIMARY KEY (compra_id)
)

CREATE TABLE produtos (
  produto_id int(11) NOT NULL AUTO_INCREMENT,
  nome varchar(100) NOT NULL,
  valor decimal(15,2) NOT NULL,
  PRIMARY KEY (produto_id)
)

ALTER TABLE produtos ADD FOREIGN KEY (produto_id) REFERENCES compras (produto_id)
```

7º - Abra o arquivo __Conexao.php__ que está na pasta config e modifique as informações de acordo com os dados de acesso ao seu banco de dados.

```
$db_host = "localhost";
$db_nome = "GN_VENDAS"; //nome do banco de dados
$db_usuario = "root"; //usuario do banco de dados
$db_senha = ""; //senha do usuario do banco de dados
$db_driver = "mysql";
```
obs.: salvar o arquivo Conexao.php

8º - Abra o navegador de internet e digite __http://localhost/Gn-Vendas/__  e teste o funcionamento do sistema
