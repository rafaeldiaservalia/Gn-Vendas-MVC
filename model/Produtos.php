<?php

class Produtos {
    private $id;
    private $nome;
    private $valor; 
    // Métodos de acesso Getters e Setters
    function getId() {
        return $this->id;
    }
    function getNome() {
        return $this->nome;
    }
    function getValor() {
        return $this->valor;
    }
    function setId($i) {
        $this->id = $i;
    }
    function setNome($n) {
        $this->nome = $n;
    }
    function setValor($v) {
        $this->valor = $v;
    }
    // Método para cadastrar produto
    public function cadastrarProduto($nome,$valor) { 
        require_once ('config/Conexao.php');
        $db = Conexao::conectar();   
        $this->setNome($nome);
        $this->setValor($valor);
        $nomeProduto = $this->getNome();
        $valorProduto = $this->getValor();    
        $sql = $db->prepare("INSERT INTO produtos (nome, valor) VALUES (:nome, :valor)");
        $sql->bindParam(':nome', $nomeProduto);
        $sql->bindParam(':valor', $valorProduto);
        $sql->execute();
    }
    // Método para listar todos os produtos
    public function listarTodosProdutos() {
        require_once ('config/Conexao.php');
        $db = Conexao::conectar(); 
        $sql = $db->prepare("SELECT produto_id as id, nome, valor FROM produtos ORDER BY nome ASC");
        $sql->execute();
        return $sql;
    }
    // Método para listar produto
    public function listarProduto($id) {
        require_once ('config/Conexao.php');
        $db = Conexao::conectar(); 
        $this->setId($id);
        $codigo = $this->getId();
        $sql = $db->prepare("SELECT produto_id as id, nome, valor FROM produtos WHERE produto_id = :id");
        $sql->bindParam(':id', $codigo);
        $sql->execute();
        return $sql;
    }
}