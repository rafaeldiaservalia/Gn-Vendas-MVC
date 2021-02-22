<?php

class Compras {
    private $nome;
    private $cpf;
    private $telefone;
    // Métodos de acesso Getters e Setters
    function getNome() {
        return $this->nome;
    }
    function getCpf() {
        return $this->cpf;
    }
    function getTelefone() {
        return $this->telefone;
    }
    function setNome($nome) {
        $this->nome = $nome;
    }
    function setCpf($cpf) {
        $this->cpf = $cpf;
    }
    function setTelefone($telefone) {
        $this->telefone = $telefone;
    }
    // Método para cadastrar compra
    public function comprarProduto($nome,$cpf,$telefone,$pdf_charge,$charge_id,$data_venc,$id_produto) { 
        require_once ('config/Conexao.php');
        require_once ('Produtos.php');
        $db = Conexao::conectar();   
        $produto = new Produtos();
        $produto->setId($id_produto);
        $id_produto = $produto->getId();
        $this->setCpf($cpf);
        $this->setNome($nome);
        $this->setTelefone($telefone);
        $cpf = $this->getCpf();
        $nome = $this->getNome();
        $telefone = $this->getTelefone();  
        $sql = $db->prepare("INSERT INTO compras (nome_cliente,cpf_cliente,telefone_cliente,link_boleto,id_boleto,vencimento_boleto,produto_id) VALUES (:nome, :cpf, :telefone, :link, :boleto, :vencimento, :idProduto)");
        $sql->bindParam(':nome', $nome);
        $sql->bindParam(':cpf', $cpf);
        $sql->bindParam(':telefone', $telefone);
        $sql->bindParam(':link', $pdf_charge);
        $sql->bindParam(':boleto', $charge_id);
        $sql->bindParam(':vencimento', $data_venc);
        $sql->bindParam(':idProduto', $id_produto);
        $sql->execute();
    }
    // Método para listar compra
    public function listarTodasCompras() {
        require_once ('config/Conexao.php');
        $db = Conexao::conectar(); 
        $sql = $db->prepare("SELECT * FROM compras JOIN produtos ON compras.produto_id = produtos.produto_id ORDER BY compras.compra_id DESC");
        $sql->execute();
        return $sql;
    }
    
}
