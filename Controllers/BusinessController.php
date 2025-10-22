<?php

class BusinessController extends Controller
{

    private $data = array();


    public function __construct()
    {
        $user = new Users();
        if (!$user->isLogged()) {
            header('Location: ' . BASE_URL . 'Login');
            exit;
        } else {
            $user->setLoggedUser();
            $this->data["name"] = $user->getName();
        }
    }

    public function estoque()
    {
        $produto = new Produto();
         $categoria = new Categoria();
        $products = $produto->getAll();
         $this->data['categorias'] = $categoria->getAll();
        $this->data['products'] = $products;

        $this->loadTemplateAdmin('Business/estoque', $this->data);
    }
    public function caixa()
    {
        $produto = new Produto();
        $products = $produto->getEstoque();
        $this->data['products'] = $products;

        $categoria = new Categoria();
        $this->data['categorias'] = $categoria->getAll();

        $this->data['soma'] = '0';

        $this->loadTemplateAdmin('Business/caixa', $this->data);
    }

    public function AddItemVenda()
    {
        $venda = new Venda();

        $nome = addslashes($_GET['nome']);
        $valor = addslashes($_GET['valor']);

        $venda->AddVendaItem($nome, 1); 
        $venda->AddSoma($valor);

        $produto = new Produto();
        $this->data['products'] = $produto->getEstoque();
        $this->data['soma'] = $venda->SelectSoma();

       
        $this->loadTemplateAdmin('Business/caixa', $this->data);
    }

    public function Recomeçar()
    {
        $venda = new Venda();
        $venda->DeleteVenda();

        header("Location: caixa");
        exit;
    }

    public function Finish($nome){
        $quantidade = new Venda();
        $quantidade->ProdutoQuantidade($nome , $quantidade);


    }

    public function FinishBuy()
    {
        
        $venda = new Venda();

        $this->data['soma'] = $venda->SelectSoma();

        $forma_de_pagamento = $_POST['forma_de_pagamento'];
        if ($forma_de_pagamento == 'Pix') {
            $this->loadTemplateAdmin('Business/Pix', $this->data);
        }
        if ($forma_de_pagamento == 'Cartão') {
            $venda = new Venda();
            $soma = $venda->SelectSoma();
            $valor = $soma[0];
            $this->data['parcela'] = '1x';
            $this->data['porcetagem'] = 'sem juros';
            $this->data['juros'] = $valor;
            $this->loadTemplateAdmin('Business/Cartao', $this->data);
        }
        if ($forma_de_pagamento == 'Especie') {
            $this->data['troco'] = '';
            $this->loadTemplateAdmin('Business/Especie', $this->data);
        }
    }

    public function tipo()
    {
        
        $venda = new Venda();

        $this->data['soma'] = $venda->SelectSoma();

        $venda = new Venda();
        $soma = $venda->SelectSoma();
        $valor = $soma[0];

        $juros = $_GET['juros'];
        if ($juros == 'x1') {
            $this->data['parcela'] = '1x';
            $this->data['porcetagem'] = 'sem juros';
            $this->data['juros'] = $valor + (($valor * 0) / 100);
        }
        if ($juros == 'x2') {
            $this->data['parcela'] = '2x';
            $this->data['porcetagem'] = 'com 5% de juros';
            $this->data['juros'] = $valor + (($valor * 5) / 100);
        }
        if ($juros == 'x3') {
            $this->data['parcela'] = '3x';
            $this->data['porcetagem'] = 'com 10% de juros';
            $this->data['juros'] = $valor + (($valor * 10) / 100);
        }
        if ($juros == 'x4') {
            $this->data['parcela'] = '4x';
            $this->data['porcetagem'] = 'com 15% de juros';
            $this->data['juros'] = $valor + (($valor * 15) / 100);
        }
        if ($juros == 'x5') {
            $this->data['parcela'] = '5x';
            $this->data['porcetagem'] = 'com 20% de juros';
            $this->data['juros'] = $valor + (($valor * 20) / 100);
        }
        if ($juros == 'x6') {
            $this->data['parcela'] = '6x';
            $this->data['porcetagem'] = 'com 25% de juros';
            $this->data['juros'] = $valor + (($valor * 25) / 100);
        }
        if ($juros == 'x7') {
            $this->data['parcela'] = 'x7';
            $this->data['porcetagem'] = 'com 30% de juros';
            $this->data['juros'] = $valor + (($valor * 30) / 100);
        }
        if ($juros == 'x8') {
            $this->data['parcela'] = 'x8';
            $this->data['porcetagem'] = 'com 35% de juros';
            $this->data['juros'] = $valor + (($valor * 35) / 100);
        }
        if ($juros == 'x9') {
            $this->data['parcela'] = 'x9';
            $this->data['porcetagem'] = 'com 40% de juros';
            $this->data['juros'] = $valor + (($valor * 40) / 100);
        }
        if ($juros == 'x10') {
            $this->data['parcela'] = 'x10';
            $this->data['porcetagem'] = 'com 45% de juros';
            $this->data['juros'] = $valor + (($valor * 45) / 100);
        }
        if ($juros == 'x11') {
            $this->data['parcela'] = 'x11';
            $this->data['porcetagem'] = 'com 50% de juros';
            $this->data['juros'] = $valor + (($valor * 50) / 100);
        }
        if ($juros == 'x12') {
            $this->data['parcela'] = 'x12';
            $this->data['porcetagem'] = 'com 55% de juros';
            $this->data['juros'] = $valor + (($valor * 55) / 100);
        }


        $this->loadTemplateAdmin('Business/Cartao', $this->data);
    }

    public function Comprar($forma_de_pagamento, $juros)
    {
        $venda = new Venda();

        $itens = $venda->SelectItem();

        foreach ($itens as $item){
             $venda->ProdutoQuantidade($item['nome']);
        }

        $venda = new Venda();
        $venda->DeleteVenda();

        $venda->AddCompra($juros, $forma_de_pagamento);
        $venda->Delete();


        header('Location: ' . BASE_URL . 'Business/caixa');
        exit;
    }

    public function Calc($soma)
    {
        if($soma == ''){
            $soma = 0;
        }
        $venda = new Venda();

        $this->data['soma'] = $venda->SelectSoma();


        $valor = doubleval($_POST['valor']);
        
        $this->data['troco'] = $valor - $soma;

        $this->loadTemplateAdmin('Business/Especie', $this->data);
    }

    public function RupturaEstoque()
    {
        $venda = new Venda();
        $missing = $venda->RupturaEstoque();

        
        $this->data['missing'] =  $missing;
        $this->loadTemplateAdmin('Business/ComprarEstoque', $this->data);
    }

    public function ExportarCSV(){
        $venda = new Venda();
        $missing = $venda->RupturaEstoque();

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=ruptura_estoque.csv');

        $output = fopen('php://output', 'w');

        fputcsv($output, ['ID', 'Nome', 'Quantidade']);

         foreach ($missing as $produto) {
            fputcsv($output, [
                $produto['id'],
                $produto['nome'],
                $produto['quantidade']
            ]);
        }

        fclose($output);
        exit;
    }

    public function Return($id){
        $produto = new Produto();
        $products =  $produto->SelectForm($id);
        $categoria = new Categoria();
        $this->data['categorias'] = $categoria->getAll();

        $this->data['products'] = $products;
        $this->data['nivel-1'] = 'Dashboard';

        $this->loadTemplateAdmin("Business/ComprarEstoque", $this->data);
    
    }
    public function editAmount($hash){
        $produto = new Produto();

      
        if (isset($_GET['quantidade']) && !empty($_GET['quantidade'])){
            $quantidade = addslashes($_GET['quantidade']);
          
            $produto->editAmount($quantidade, $hash);

            header('Location: ' . BASE_URL . 'Home');
            exit;

            
        }
    }
    public function Voltar(){
        header('Location: ' . BASE_URL . 'Home');
        exit;
    }

    
    
}


