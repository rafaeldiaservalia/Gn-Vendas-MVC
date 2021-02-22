<?php
ini_set("display_errors", 0);
require_once 'model/Compras.php';
require_once 'model/Produtos.php';
use Gerencianet\Exception\GerencianetException;
use Gerencianet\Gerencianet;
require 'vendor/autoload.php'; // caminho relacionado a SDK

class CompraController {
    public function listar() {
        $compra = new Compras();
        $compras = $compra->listarTodasCompras();   
        require_once 'view/pedido_view.php'; 
    }
    public function comprar(){
        $nome = $_POST['nome'].' '.$_POST['sobrenome'];
        // tratamento cpf
        $cpf = $_POST['cpf'];
        $cpf_sem_ponto = str_replace('.', '', $cpf); // remove o ponto
        $cpf_sem_traco = str_replace('-', '', $cpf_sem_ponto); // remove o traco
        $cpf_n = $cpf_sem_traco;
        // tratamento telefone  
        $telefone = $_POST['telefone'];
        $telefone_sem_parenteses_a = str_replace('(', '', $telefone); // remove o (
        $telefone_sem_parenteses_f = str_replace(')', '', $telefone_sem_parenteses_a); // remove o )
        $telefone_sem_traco = str_replace('-', '', $telefone_sem_parenteses_f); // remove o traco
        $telefone_sem_espaco = str_replace(' ', '', $telefone_sem_traco); // remove o traco
        $telefone_n = $telefone_sem_espaco;
        //
        $id_produto = $_POST['idProduto'];
        $produto = $_POST['produto'];
        $valor = $_POST['valor'];
        $valor_sem_ponto = str_replace('.', '', $valor); // remove o ponto
        if ($valor >= 5) {
            $clientId = 'Client_Id_4e4327e045ceb277ed5f62db8c46c399c309e0bf';// insira seu Client_Id, conforme o ambiente (Des ou Prod)
            $clientSecret = 'Client_Secret_bb1ad596c70e1c17089cd27ec860816670412681'; // insira seu Client_Secret, conforme o ambiente (Des ou Prod)  
            $options = [
                 'client_id' => $clientId,
                 'client_secret' => $clientSecret,
                 'sandbox' => true // altere conforme o ambiente (true = desenvolvimento e false = producao)
            ];
            $item_1 = [
                'name' => $produto, // nome do item, produto ou serviço
                'amount' => 1, // quantidade
                'value' => intval($valor_sem_ponto), // valor (1000 = R$ 10,00) (Obs: É possível a criação de itens com valores negativos. Porém, o valor total da fatura deve ser superior ao valor mínimo para geração de transações.)
            ];
            $items = [
                $item_1
            ];
            $metadata = array('notification_url'=>'https://www.rafaelarlindo.com.br'); //Url de notificações
            $customer = [
                'name' => $nome, // nome do cliente
                'cpf' => $cpf_n, // cpf válido do cliente
                'phone_number' => $telefone_n, // telefone do cliente
            ];
            $discount = [ // configuração de descontos
                'type' => 'currency', // tipo de desconto a ser aplicado
                'value' => 599 // valor de desconto 
            ];
            $configurations = [ // configurações de juros e mora
                'fine' => 200, // porcentagem de multa
                'interest' => 33 // porcentagem de juros
            ];
            $conditional_discount = [ // configurações de desconto condicional
                'type' => 'percentage', // seleção do tipo de desconto 
                'value' => 1, // porcentagem de desconto
                'until_date' => date('Y-m-d', strtotime('+2 days')) // data máxima para aplicação do desconto
            ];
            $bankingBillet = [
                'expire_at' => date('Y-m-d', strtotime('+2 days')), // data de vencimento do titulo
                'message' => 'teste\nteste\nteste\nteste', // mensagem a ser exibida no boleto
                'customer' => $customer,
                'discount' =>$discount,
                'conditional_discount' => $conditional_discount
            ];
            $payment = [
                'banking_billet' => $bankingBillet // forma de pagamento (banking_billet = boleto)
            ];
            $body = [
                'items' => $items,
                'metadata' =>$metadata,
                'payment' => $payment
            ];
            try {
                $api = new Gerencianet($options);
                $pay_charge = $api->oneStep([],$body);
                foreach ($pay_charge as $key => $value) {
                    $charge_id = $value[charge_id];
                    $expire_at = $value[expire_at];
                    $pdf_charge = $value[pdf][charge];
                }
                $compra = new Compras();
                $compra->comprarProduto($nome,$cpf_n,$telefone,$pdf_charge,$charge_id,$expire_at,$id_produto);  
                echo '
                <script type="text/javascript">
                    alert("Compra realizada com sucesso!");
                    window.location.href="index.php";
                </script>';
            } catch (GerencianetException $e) {
                print_r($e->code);
                print_r($e->error);
                print_r($e->errorDescription);
            } catch (Exception $e) {
                print_r($e->getMessage());
            }
        } else {
            echo '
            <script type="text/javascript">
                alert("O valor do produto deve ser maior ou igual a R$ 5,00");
                window.location.href="index.php";
            </script>';
        }        
    }         
}
?>