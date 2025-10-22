<?php

class SiteController extends Controller
{


    private $data = array();

    public function __construct()
    {
        // construct of class
    }

    public function index()
    {
        $this->data['level-1'] = 'WebSite';
        $_COOKIE['valor']['nome'] = 'um token';



        $produto = new Produto();

        $produtos = $produto->Site();
        $this->data['produtos'] = $produtos;


        $brinquedos = $produto->SiteBrinquedos();
        $this->data['brinquedos'] = $brinquedos;

        $carnes = $produto->SiteCarnes();
        $this->data['carnes'] = $carnes;


        $bebidas = $produto->SiteBebidas();
        $this->data['bebidas'] = $bebidas;

        $alimentacao = $produto->SiteAlimentacao();
        $this->data['alimentacao'] = $alimentacao;

         $limpeza = $produto->SiteLimpeza();
        $this->data['limpeza'] = $limpeza;

        $this->data['carrinho'] = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
        $this->data['quantidade'] = isset($_SESSION['cart']) ? sizeof($_SESSION['cart']) : 0;


        $this->loadTemplateSite('Home/index', $this->data);
    }

    public function CartView()
    {

        $this->data['carrinho'] = $_SESSION['cart'];
         
       
        $this->loadTemplateSite('Home/Carrinho', $this->data);
    }


    public function Limpeza()
    {
        $produto = new Produto();
       

        $this->data['carrinho'] = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];


        $this->loadTemplateSite('Home/Limpeza', $this->data);
    }
    public function CartAdd($id)
    {
       

        $cartModel = new Venda;
        $cart = $cartModel->SelectCart($id);
        
        if(!$cart){
            echo 'Produto inexistente';
            return;
        }

        $ProdutoId = $cart['hash'];
        $nome = $cart['nome'];
        $descricao = $cart['descricao'];
        $valor = $cart['valor'];
        $imagem = $cart['imagem'];

       
         if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        if (isset($_SESSION['cart'][$ProdutoId])) {
            $_SESSION['cart'][$ProdutoId]['quantity']++;
           
        }else{
             $_SESSION['cart'][$ProdutoId] = [
                'name' => $nome,
                'image' => $imagem,
                'descricao' => $descricao,
                'price' => $valor,
               'quantity' => 1
            ];
        }
         header('Location: ' .BASE_URL);
    }

    public function CartRemove($id)
    {
       

        $cartModel = new Venda;
        $cart = $cartModel->SelectCart($id);
        
        if(!$cart){
            echo 'Produto inexistente';
            return;
        }

        $ProdutoId = $cart['hash'];
        

         if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        if (isset($_SESSION['cart'][$ProdutoId])) {
            $_SESSION['cart'][$ProdutoId]['quantity']--;
           
        }if(  $_SESSION['cart'][$ProdutoId]['quantity']<1){
            $_SESSION['cart'][$ProdutoId]['quantity'] = 0;
            unset($_SESSION['cart'][$ProdutoId]);
        }
         header('Location: ' .BASE_URL);
    }
    public function Voltar(){
         header('Location: ' .BASE_URL);
         exit;
    }
}
