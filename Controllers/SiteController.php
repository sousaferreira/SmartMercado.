<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

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

        $cartModel = new Venda;

        $carrinho = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];


        foreach ($carrinho as $cart) {
            $id = $cart['id'];

            $ProdutoId = $cartModel->SelectCartAll($id);
            
          
        }

        $this->data['carrinho'] = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

        $this->loadTemplateSite('Home/Carrinho', $this->data);
    }

    public function CartAdd($id)
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
        $imagem = $cart['imagem'];

        if ($quantidade <= 0) {
            unset($_SESSION['cart'][$ProdutoId]);
        }
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        if (isset($_SESSION['cart'][$ProdutoId])) {
            $_SESSION['cart'][$ProdutoId]['quantity']++;
            $_SESSION['cart'][$ProdutoId]['price'] = $valor * $_SESSION['cart'][$ProdutoId]['quantity'];
        } else {
            $_SESSION['cart'][$ProdutoId] = [
                'id' => $ProdutoId,
                'name' => $nome,
                'image' => $imagem,
                'descricao' => $descricao,
                'price' => $valor,
                'quantity' => 1
            ];
        }

        if (isset($_SERVER['HTTP_REFERER'])) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }

    public function CartRemove($id)
    {
        $cartModel = new Venda;
        $cart = $cartModel->SelectCart($id);

        if (!$cart) {
            echo 'Produto inexistente';
            return;
        }

        $ProdutoId = $cart['hash'];

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        $valor = $cart['valor'];

        if (isset($_SESSION['cart'][$ProdutoId])) {
            $_SESSION['cart'][$ProdutoId]['quantity']--;
            $_SESSION['cart'][$ProdutoId]['price'] = $valor * $_SESSION['cart'][$ProdutoId]['quantity'];
        }

        if (isset($_SESSION['cart'][$ProdutoId]) && $_SESSION['cart'][$ProdutoId]['quantity'] < 1) {
            unset($_SESSION['cart'][$ProdutoId]);
        }

        if (isset($_SERVER['HTTP_REFERER'])) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }

    public function Voltar()
    {
        header('Location: ' . BASE_URL);
        exit;
    }

    public function VoltarCart()
    {
        header('Location: ' . BASE_URL . 'Site/CartView');
        exit;
    }

    public function Limpeza()
    {
        $produto = new Produto();
        $limpeza = $produto->SiteLimpeza();
        $this->data['limpeza'] = $limpeza;
        $this->data['quantidade'] = isset($_SESSION['cart']) ? sizeof($_SESSION['cart']) : 0;
        $this->data['carrinho'] = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

        $this->loadTemplateSite('Home/categorias/Limpeza', $this->data);
    }

    public function Bebidas()
    {
        $produto = new Produto();
        $bebidas = $produto->SiteBebidas();
        $this->data['bebidas'] = $bebidas;
        $this->data['quantidade'] = isset($_SESSION['cart']) ? sizeof($_SESSION['cart']) : 0;
        $this->data['carrinho'] = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

        $this->loadTemplateSite('Home/categorias/Bebidas', $this->data);
    }

    public function Alimentos()
    {
        $produto = new Produto();
        $alimentacao = $produto->SiteAlimentacao();
        $this->data['alimentos'] = $alimentacao;

        $this->data['quantidade'] = isset($_SESSION['cart']) ? sizeof($_SESSION['cart']) : 0;
        $this->data['carrinho'] = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

        $this->loadTemplateSite('Home/categorias/Alimentos', $this->data);
    }

    public function Brinquedos()
    {
        $produto = new Produto();
        $brinquedos = $produto->SiteBrinquedos();
        $this->data['brinquedos'] = $brinquedos;
        $this->data['quantidade'] = isset($_SESSION['cart']) ? sizeof($_SESSION['cart']) : 0;
        $this->data['carrinho'] = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

        $this->loadTemplateSite('Home/categorias/Brinquedos', $this->data);
    }

    public function Carnes()
    {
        $produto = new Produto();
        $carnes = $produto->SiteCarnes();
        $this->data['carnes'] = $carnes;

        $this->data['quantidade'] = isset($_SESSION['cart']) ? sizeof($_SESSION['cart']) : 0;
        $this->data['carrinho'] = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

        $this->loadTemplateSite('Home/categorias/Carnes', $this->data);
    }

    public function InfoPersonal()
    {
        $this->data['carrinho'] = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
        $this->data['cliente'] = isset($_SESSION['cliente']) ? $_SESSION['cliente'] : [];

        $this->loadTemplateSite('Home/InfoBuy/Personal', $this->data);
    }

    public function AddCompra()
    {
        $venda = new Venda();

        $this->data['nome_cliente'] = $venda->getNameClient();

        $nome = $_GET['nome_completo'] ?? '';
        $whatsapp = $_GET['whatsapp'] ?? '';
        $rua = $_GET['rua'] ?? '';
        $bairro = $_GET['bairro'] ?? '';
        $numero_casa = $_GET['numero'] ?? '';
        $ponto_de_referencia = $_GET['ponto_de_referencia'] ?? '';
        $Radio = $_GET['Radio'] ?? '';
        $entrega = $_GET['entrega'] ?? '';
        $SaveCheck = $_GET['SaveCheck'] ?? '0';
        $tipo = 'online';


        if ($SaveCheck == '') {
            if (!isset($_SESSION['cliente'])) {
                $_SESSION['cliente'] = [];
            }

            $_SESSION['cliente'] = [
                'name' => $nome,
                'whatsapp' => $whatsapp,
                'rua' => $rua,
                'bairro' => $bairro,
                'numero_casa' => $numero_casa,
                'ponto_de_referencia' => $ponto_de_referencia,
                'Radio' => $Radio,
                'SaveCheck' => 'Check',
            ];
        } else {
            $_SESSION['cliente'] = [
                'name' => '',
                'whatsapp' => '',
                'rua' => '',
                'bairro' => '',
                'numero_casa' => '',
                'ponto_de_referencia' => '',
                'Radio' => '',
                'SaveCheck' => '',

            ];
        }

        $this->data['carrinho'] = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

        $venda->AddCompraFinalizada($nome, $whatsapp, $rua, $bairro, $numero_casa, $ponto_de_referencia, $Radio, $entrega, $tipo);

        $id = $venda->getId();
        $id = $id[0];

        if (!empty($this->data['carrinho'])) {
            foreach ($this->data['carrinho'] as $cart) {
                $nome = $cart['name'];
                $quantidade = $cart['quantity'];
                $imagem = $cart['image'];
                $name[] = $cart['quantity'] . '- ' . $cart['name'];

                $produtos = implode(", ", $name);
                $venda->itensCompra($id, $quantidade, $nome, $imagem);
                $venda->ProdutoQuantity($nome, $quantidade);
            }
        }

        unset($_SESSION['cart']);
        $_SESSION['cart'] = [];

        header('Location: https://wa.me/85982318794?text=Olá, quero finalizar minha compra! Produtos selecionados: ' . ($produtos ?? ''));
        exit();
    }
}
