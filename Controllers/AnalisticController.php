<?php

class   AnalisticController extends Controller
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
        $produto = new Produto();
        $products = $produto->getAll();
        $this->data['products'] = $products;
        $this->data['nivel-1'] = 'Dashboard';
        $categoria = new Categoria();
        $this->data['categorias'] = $categoria->getAll();

        $grafico = new Produto();
        $venda_item = $grafico->VendasMensais();


        $nomes = [];
        $quantidades = [];



        foreach ($venda_item as $p) {
            $mesNumero = (int)$p['mes'];
            $mesNome = date("F", mktime(0, 0, 0, $mesNumero, 10)); // Janeiro, Fevereiro ...
            $nomes[] = $mesNome;
            $quantidades[] = (float)$p['quantidade'];
        }




        $this->data['nomes'] = json_encode($nomes);
        $this->data['totais'] = json_encode($quantidades);



        $this->loadTemplateAdmin('Business/analytics', $this->data);
    }
}
