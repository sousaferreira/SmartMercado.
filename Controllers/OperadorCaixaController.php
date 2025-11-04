<?php

class OperadorCaixaController extends Controller
{
    private $data = array();

    public function index()
    {

        $this->requireLogin();

        $venda = new Venda();
        $produto = new Produto();
        $caixa = new Caixa();

        if (isset($_GET['nome']) && isset($_GET['valor'])) {
        }


        $this->data['products'] = $produto->getEstoque();
        $this->data['soma'] = $venda->SelectSoma();

        $this->data['operador'] = $_SESSION['operador'];
        $this->data['caixa'] = $_SESSION['caixa'] ?? [];


        $this->loadViewInTemplate('PDV/caixa', $this->data);
    }
    public function CaixaAddProduct($id)
    {
        $cartModel = new Venda;
        $cart = $cartModel->SelectCart($id);

        if (!$cart) {
            echo 'Produto inexistente';
            return;
        }

        $ProdutoId = $cart['hash'];
        $quantidade = $cart['quantidade'];
        $nome = $cart['nome'];
        $descricao = $cart['descricao'];
        $valor = $cart['valor'];
        $valorUni = $cart['valor'];
        $imagem = $cart['imagem'];
        $codigo_barras = $cart['codigo_barras'];

        if ($quantidade <= 0) {
            unset($_SESSION['caixa'][$ProdutoId]);
        }
        if (!isset($_SESSION['caixa'])) {
            $_SESSION['caixa'] = [];
        }

        if (isset($_SESSION['caixa'][$ProdutoId])) {
            $_SESSION['caixa'][$ProdutoId]['quantity'] += $quantidade;
            $_SESSION['caixa'][$ProdutoId]['price'] = $valor * $_SESSION['caixa'][$ProdutoId]['quantity'];
        } else {
            $_SESSION['caixa'][$ProdutoId] = [
                'id' => $ProdutoId,
                'name' => $nome,
                'image' => $imagem,
                'descricao' => $descricao,
                'valor' =>  $valorUni,
                'price' => $valor,
                'codigo_barras' => $codigo_barras,
                'quantity' => 1
            ];
        }



        if (isset($_SERVER['HTTP_REFERER'])) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }
    public function BuscarCod()
    {
        $codigo_barras = addslashes($_GET['codigo_barras']);
        $quantidade = $_GET['quantidade'] ? $_GET['quantidade'] : '1';



        $caixa = new Caixa();
        $produto = $caixa->SearchBarras($codigo_barras);

        if ($produto == false) {
            echo '<div class="alert alert-danger text-center  " role="alert">
            Não existe nenhum prodto com esse código
            </div>';
        } else {


            $ProdutoId = $produto['id'];
            $nome = $produto['nome'];
            $imagem = $produto['imagem'];
            $valorUni = $produto['valor'];
            $valor =  $produto['valor'];
            $descricao = $produto['descricao'];



            if (isset($_SESSION['caixa'][$ProdutoId])) {
                $_SESSION['caixa'][$ProdutoId]['quantity'] = $quantidade;
                $_SESSION['caixa'][$ProdutoId]['price'] = $valor * $_SESSION['caixa'][$ProdutoId]['quantity'];
            } else {
                $_SESSION['caixa'][$ProdutoId] = [
                    'id' => $ProdutoId,
                    'name' => $nome,
                    'image' => $imagem,
                    'descricao' => $descricao,
                    'valor' =>  $valorUni,
                    'price' => $valor,
                    'codigo_barras' => $codigo_barras,
                    'quantity' => $quantidade
                ];
            }
        }
        $this->data['operador'] = $_SESSION['operador'];
        $this->data['caixa'] = $_SESSION['caixa'];


        $venda = new Venda();
        $produto = new Produto();





        $this->data['products'] = $produto->getEstoque();
        $this->data['soma'] = $venda->SelectSoma();

        $this->data['operador'] = $_SESSION['operador'];
        $this->data['caixa'] = $_SESSION['caixa'];




        $this->loadViewInTemplate('PDV/caixa', $this->data);
    }
    public function troco()
    {

        $caixa = $_SESSION['caixa'];
        $valor_total = 0;
        foreach ($caixa as $c) {
            $valor_total += $c['price'];
        }



        $valor_recebido = floatval($_REQUEST["q"]);

        $troco = $valor_recebido - $valor_total;

        if($troco == 0){
            $resposta = "VALOR SUFICIENTE";
        }
        else{
            $resposta = 'Troco: R$'. number_format($troco, 2, ',', '.');
        }
        echo $resposta;
        }
        public function CompraCaixa($caixa ,$name ,$data_abertura){
          
            $radio= $_GET['forma_de_pagamento'];
            $entrega = 0;
            $tipo = 'fisica';
            $valor_total = $_GET['total_compra'];

            $venda = new Venda();
            $venda->AddCompraCaixa($radio, $entrega, $tipo);

        }
}
