<?php
require_once 'controller/ProdutoController.php';
require_once 'controller/CompraController.php';

if (isset($_GET['acao']) && $_GET['acao'] == 'cadastrar') {
    $obj_produto = new ProdutoController();
    $obj_produto->cadastrar();
} elseif (isset($_GET['acao']) && $_GET['acao'] == 'efetuarCadastro') {
    $obj_produto = new ProdutoController();
    $obj_produto->efetuar_cadastro();
} elseif (isset($_GET['acao']) && $_GET['acao'] == 'compras') {
    $obj_compra = new CompraController();
    $obj_compra->listar();
} elseif (isset($_GET['acao']) && $_GET['acao'] == 'comprar') {  
    $obj_produto = new ProdutoController();
    $obj_produto->listarProduto($_GET['cod']);
} elseif (isset($_GET['acao']) && $_GET['acao'] == 'efetuarCompra') {
    $obj_compra = new CompraController();
    $obj_compra->comprar();
} elseif (isset($_GET['acao']) && $_GET['acao'] == 'listar'){
    $obj_produto = new ProdutoController();
    $obj_produto->listar();
} else {
    $obj_produto = new ProdutoController();
    $obj_produto->listar();
} 
?>  