<?php

class HomeController extends Controller
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



		$this->loadTemplateAdmin('Admin/blank', $this->data);
	}
	public function voltar()
	{
		header('Location: ' . BASE_URL . 'Home');
		exit;
	}
	 
}
