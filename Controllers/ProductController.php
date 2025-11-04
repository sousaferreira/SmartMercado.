<?php

class ProductController extends Controller
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



    public function index()
    {
        $categoria = new Categoria();
        $this->data['categorias'] = $categoria->getAll();
        $this->data['nivel-1'] = 'Configurações';
        $this->data['nivel-2'] = "Permissões";

        $this->loadTemplateAdmin("Product/index", $this->data);
    }

    public function Filter()
    {
        $grafico = new Venda();
        $venda_item = $grafico->SelectItem();

        $item_falta = $grafico->SelectFalta();

        $n_falta = [];
        $t_falta = [];

        foreach ($item_falta as $f) {
            $n_falta[] = $f['nome'];
            $t_falta[] = 1;
        }

        $nomes = [];
        $quantidades = [];



        foreach ($venda_item as $p) {
            $nomes[] = $p['nome'];
            $quantidades[] = (float)$p['quantidade'];
        }


        $this->data['n_falta'] = json_encode($n_falta);
        $this->data['t_falta'] = json_encode($t_falta);


        $this->data['nomes'] = json_encode($nomes);
        $this->data['totais'] = json_encode($quantidades);

        $filter =  $_POST['filter'];

        if ($filter == 'estoque') {
            $this->loadTemplateAdmin('Business/graphicOn', $this->data);
        }
        else if ($filter == 'Indisponivel'){
            $this->loadTemplateAdmin('Business/graphicOff', $this->data);
           
        }
    }
    public function addProduct()
    {
        
        $produto = new Produto();

        if (isset($_POST['nome']) && !empty($_POST['nome']) && isset($_POST['valor']) && !empty($_POST['valor']) && isset($_POST['categoria_id']) && !empty($_POST['categoria_id'])) {
            $nome = addslashes($_POST['nome']);
            $valor = addslashes($_POST['valor']);
            $categoria_id = (int)$_POST['categoria_id'];
            $descricao = addslashes($_POST['descricao']);
            $quantidade = addslashes($_POST['quantidade']);
            $codigo_barras = addslashes($_POST['codigo_barras']);
            $situacao = 1;
            $id = $produto->getId();
            


            if (isset($_FILES["imagem"]) && !empty($_FILES["imagem"])) {

                $id = ++$id['id'];
                $folder = 'Assets/uploads/Products/img' . $id . "/";
                $file = $_FILES['imagem'];

                $upload = uploaded_file($file, $folder);

                if ($upload !== false) {
                    $idProduct = $produto->addProduct($nome, $valor, $categoria_id, $upload, $descricao, $situacao, $quantidade, $codigo_barras);
                    
                    $venda = $produto->addVendaItem($nome, $valor, $categoria_id, $descricao, $situacao);
                    $hash = hash('sha256', $idProduct);
                    $produto->editHashProduct($idProduct, $hash);
                }
            } else {
                $upload = '';
            }


            header('Location: ' . BASE_URL . 'Business/estoque');
            exit;
        }
        header('Location: ' . BASE_URL . 'Product');
        exit;
    }

    public function CardSelect(string $hash)
    {

        $produto = new Produto();
        $products =  $produto->SelectForm($hash);
        $this->data['products'] = $products;
        $this->loadTemplateAdmin('Product/VisuCard', $this->data);
    }

    public function cartSave(string $hash)
    {
        $cartModel = new Venda;
        $cart = $cartModel->SelectCart($hash);
        $this->data['cart'] = $cart;

        $id = $cart['hash'];
        $nome = $cart['nome'];
        $descricao = $cart['descricao'];
        $valor = $cart['valor'];
        $imagem = $cart['imagem'];
        $categoria_id = $cart['categoria_id'];

        
        header('Location: ' . BASE_URL . 'Home');
        exit;
    }

   


    public function edit(string $hash)
    {
        $produto = new Produto();

        if (isset($_POST['nome']) && !empty($_POST['nome']) && isset($_POST['valor']) && !empty($_POST['valor'])) {
            $nome = addslashes($_POST['nome']);
            $valor = addslashes($_POST['valor']);
            $descricao = addslashes($_POST['descricao']);
            $categoria_id = $_POST['categoria_id'];
            $id1 = $produto->getId();

            $imagemAtual = $produto->SelectForm($hash);
            $imagemAntiga = $imagemAtual['imagem'];
            if (isset($_FILES["imagem"]) && !empty($_FILES["imagem"]["name"])) {


                $folder = 'Assets/uploads/Products/img' . $id1['id'] . "/";
                $file = $_FILES['imagem'];


                if (!empty($imagemAntiga) && file_exists($imagemAntiga)) {
                    unlink($imagemAntiga);
                }

                $upload = uploaded_file($file, $folder);


                if ($upload !== false) {
                    $produto->editProduct($hash, $nome, $valor, $descricao, $upload, $categoria_id);
                } else {
                    $upload = 'Deu ruimm';
                }
            } else {

                $produto->editProduct($hash, $nome, $valor, $descricao, $imagemAntiga,  $categoria_id);
            }

            header('Location: ' . BASE_URL . 'Business/estoque');
            exit;

            header('Location: ' . BASE_URL . 'Business/estoque');
            exit;
        }
    }



   

    public function delete(string $id)
    {
        $produto = new Produto();
        $produto->delete($id);
        header('Location: ' . BASE_URL . 'Business/estoque');
    }

    public function BuyProduct(string $hash)
    {
        $produto = new Produto();
        $products =  $produto->SelectForm($hash);
        
        $this->data['products'] = $products;


        $categoria = new Categoria();
        $this->data['categorias'] = $categoria->getAll();


        $this->data['products'] = $products;
        $this->data['nivel-1'] = 'Dashboard';

        $this->loadTemplateAdmin('Product/finishBuy', $this->data);
    }
}
