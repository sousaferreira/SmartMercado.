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

        $caixa = new Caixa();
        $this->data['caixaOperador'] = $caixa->SelectCaixa();


        $this->loadViewInTemplate('PDV/pdvCaixa', $this->data);
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
    $venda = new Venda();
    $produtoModel = new Produto();
    $caixaModel = new Caixa();

    $this->data['operador'] = $_SESSION['operador'] ?? [];
    $this->data['caixa'] = $_SESSION['caixa'] ?? [];

    $this->data['caixaOperador'] = $caixaModel->SelectCaixa();

    $codigo_barras = isset($_GET['codigo_barras']) ? trim(addslashes($_GET['codigo_barras'])) : '';
    $quantidade = isset($_GET['quantidade']) && $_GET['quantidade'] !== '' ? (int)$_GET['quantidade'] : 1;


    
     if (empty($codigo_barras)) {
        $this->data['products'] = $produtoModel->getEstoque();
        $this->data['soma'] = $venda->SelectSoma();
        $this->loadViewInTemplate('PDV/pdvCaixa', $this->data);
        
    }

    $produto = $caixaModel->SearchBarras($codigo_barras);

    if ($produto == false) {
        echo '<div class="alert alert-danger text-center" role="alert">
            Nenhum produto encontrado com esse código de barras.
        </div>';
    } elseif ($produto['quantidade'] <= 0) {
        echo '<div class="alert alert-warning text-center" role="alert">
            O produto <strong>' . htmlspecialchars($produto['nome']) . '</strong> está sem estoque!
        </div>';
    } elseif ($produto['quantidade'] < $quantidade) {
        echo '<div class="alert alert-warning text-center" role="alert">
            O produto <strong>' . htmlspecialchars($produto['nome']) . '</strong> possui apenas 
            <strong>' . $produto['quantidade'] . '</strong> unidades em estoque!
        </div>';
    } else {

        $ProdutoId = $produto['id'];
        $nome = $produto['nome'];
        $imagem = $produto['imagem'];
        $valorUni = $produto['valor'];
        $descricao = $produto['descricao'];

        if (!isset($_SESSION['caixa'])) {
            $_SESSION['caixa'] = [];
        }

        if (isset($_SESSION['caixa'][$ProdutoId])) {
            $_SESSION['caixa'][$ProdutoId]['quantity'] += $quantidade;
            $_SESSION['caixa'][$ProdutoId]['price'] = $_SESSION['caixa'][$ProdutoId]['quantity'] * $valorUni;
        } else {
          $_SESSION['caixa'][$ProdutoId] = [
                'id' => $ProdutoId,
                'name' => $nome,
                'image' => $imagem,
                'descricao' => $descricao,
                'valor' => $valorUni,
                'price' => $valorUni * $quantidade,
                'codigo_barras' => $codigo_barras,
                'quantity' => $quantidade
            ];
            $venda->ProdutoQuantity($nome, $quantidade);
        }

       header('Location: ' . BASE_URL . 'OperadorCaixa');
        exit;
    }

  
    $this->data['products'] = $produtoModel->getEstoque();
    $this->data['soma'] = $venda->SelectSoma();

    
    $this->data['caixa'] = $_SESSION['caixa'] ?? [];

    $this->loadViewInTemplate('PDV/pdvCaixa', $this->data);
}

    public function troco()
    {

        $caixa = $_SESSION['caixa'] ?? [];
        $valor_total = 0;
        foreach ($caixa as $c) {
            $valor_total += $c['price'];
        }



        $valor_recebido = floatval($_REQUEST["q"]);

        $troco = $valor_recebido - $valor_total;

        if ($troco == 0) {
            $resposta = "VALOR SUFICIENTE";
        } else {
            $resposta = 'Troco: R$' . number_format($troco, 2, ',', '.');
        }
        echo $resposta;
    }
    public function CompraCaixa($caixa, $name)
    {

       

        $venda = new Venda();
        $produto = new Produto();
        $caixa = new Caixa();

     
      
        $soma = $venda->SelectSoma();

        $operador = $_SESSION['operador'];
        $caixa = $_SESSION['caixa'] ?? [];
        $id = $venda->getId();
        $id = $id[0];

        if (!empty($caixa)) {
            $name = [];

            foreach ($caixa as $item) {

                $nome = $item['name'];
                $quantidade = $item['quantity'];
                $imagem = $item['image'];
           
                $name[] = $quantidade . 'x ' . $nome;


                $venda->itensCompra($id, $quantidade, $nome, $imagem);
         
            }


            $produtos = implode(", ", $name);
        }



        $model = new Caixa();
        $caixaOperador = $model->SelectCaixa();


        $radio = $_GET['forma_de_pagamento'];
        $entrega = 0;
        $tipo = 'fisica';

        $valor_total = $_GET['total_compra'];



        $valor_total = $_GET['total_compra'] ?? 0;

       
        if (isset($_SESSION['valor_compras']['valorCompra'])) {
            $_SESSION['valor_compras']['valorCompra'] += $valor_total;
        } else {
        
            $_SESSION['valor_compras'] = [
                'valorCompra' => $valor_total
            ];
        }

        $valorTotal = $_SESSION['valor_compras']['valorCompra'];
       
         $nome = 'Compra Fisica';
        $whatsapp = 'Compra Fisica';
       
        $venda->AddCompraCaixa($nome, $whatsapp, $radio, $entrega, $tipo, $valor_total);


        unset($_SESSION['caixa']);
        header('Location:' . BASE_URL . 'OperadorCaixa/');
    }
    public function FecharCaixa($caixaNumber)
    {
        $caixa = new Caixa();
 $operador = $_SESSION['operador'];
    $data = $operador['data_abertura'];
  
    
        $valor_final = $_SESSION['valor_compras']['valorCompra'];
        
        $data_fechamento = date('d/m/Y H:i:s');
        $caixaOperador = $caixa->SelectCaixaOp($caixaNumber);
        $valor_inicial = $caixaOperador['valor_inicial'];
        $status = 'fechado';
        

        $caixa->AddFechamentoCaixa($data, $valor_final, $data_fechamento, $status);
    }
    public function CancelarVenda()
    {
        foreach($_SESSION['caixa'] as $caixa){
            $nome = $caixa['name'];
            $quantidade = $caixa['quantity'];
            
        }
        $venda = new Venda();
        $venda->ProdutoQuantityVoltar($nome, $quantidade);
        unset($_SESSION['caixa']);

        header('Location: ' . BASE_URL . 'OperadorCaixa');
        exit;
    }
}
