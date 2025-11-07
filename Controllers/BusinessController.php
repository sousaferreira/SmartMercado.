<?php

use Dompdf\Dompdf;
use Dompdf\Options;

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

    // =================== ESTOQUE ===================
    public function estoque()
    {

        $this->data['nivel-1'] = 'Estoque';
        $this->data['nivel-2'] = 'Disponivel';
        $produto = new Produto();
        $categoria = new Categoria();

        $products = $produto->getAll();
        $this->data['categorias'] = $categoria->getAll();
        $this->data['products'] = $products;

        $this->loadTemplateAdmin('Business/estoque', $this->data);
    }

    // =================== CAIXA ===================
    public function caixa()
    {
        $produto = new Produto();
        $products = $produto->getEstoque();
        $this->data['products'] = $products;

        $categoria = new Categoria();
        $this->data['categorias'] = $categoria->getAll();

        $this->data['soma'] = '0';

        $this->data['nivel-1'] = "Caixa";

        $this->loadViewInTemplate('PDV/LoginOperador', $this->data);
    }


    public function AddItemVenda()
    {
        $venda = new Venda();

        if (isset($_GET['nome']) && isset($_GET['valor'])) {
            $nome = addslashes($_GET['nome']);
            $valor = addslashes($_GET['valor']);
            $venda->AddVendaItem($nome, 1);
            $venda->AddSoma($valor);

            // Evita reenvio de formulário
            header("Location: " . BASE_URL . "Business/AddItemVenda");
            exit;
        }

        $produto = new Produto();
        $this->data['products'] = $produto->getEstoque();
        $this->data['soma'] = $venda->SelectSoma();

        $this->loadViewInTemplate('Atm/caixa', $this->data);
    }

    public function Recomeçar()
    {
        $venda = new Venda();
        $venda->DeleteVenda();
        header("Location: caixa");
        exit;
    }

    public function Finish($nome)
    {
        $quantidade = new Venda();
        $quantidade->ProdutoQuantidade($nome, $quantidade);
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

        $juros_lista = [
            'x1' => [0, '1x', 'sem juros'],
            'x2' => [5, '2x', 'com 5% de juros'],
            'x3' => [10, '3x', 'com 10% de juros'],
            'x4' => [15, '4x', 'com 15% de juros'],
            'x5' => [20, '5x', 'com 20% de juros'],
            'x6' => [25, '6x', 'com 25% de juros'],
            'x7' => [30, 'x7', 'com 30% de juros'],
            'x8' => [35, 'x8', 'com 35% de juros'],
            'x9' => [40, 'x9', 'com 40% de juros'],
            'x10' => [45, 'x10', 'com 45% de juros'],
            'x11' => [50, 'x11', 'com 50% de juros'],
            'x12' => [55, 'x12', 'com 55% de juros'],
        ];

        if (isset($juros_lista[$juros])) {
            $j = $juros_lista[$juros];
            $this->data['parcela'] = $j[1];
            $this->data['porcetagem'] = $j[2];
            $this->data['juros'] = $valor + (($valor * $j[0]) / 100);
        }

        $this->loadTemplateAdmin('Business/Cartao', $this->data);
    }

    public function Comprar($forma_de_pagamento, $juros)
    {
        $venda = new Venda();
        $itens = $venda->SelectItem();

        foreach ($itens as $item) {
            $venda->ProdutoQuantidade($item['nome']);
        }

        $venda = new Venda();
        $venda->DeleteVenda();
        $venda->AddCompra($juros, $forma_de_pagamento);
        $venda->Delete();

        header('Location: ' . BASE_URL . 'Atm/caixa');
        exit;
    }

    public function Calc($soma)
    {
        if ($soma == '') {
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
        $this->data['nivel-1'] = 'Estoque';
        $this->data['nivel-2'] = 'Indisponiveis';
        $missing = $venda->RupturaEstoque();
        $this->data['missing'] = $missing;

        $this->loadTemplateAdmin('Business/ComprarEstoque', $this->data);
    }

    public function ExportarPDF()
    {
        require 'vendor/autoload.php';

        $venda = new Venda();
        $missing = $venda->RupturaEstoque();


        require_once 'vendor/autoload.php';


        $venda = new Venda();
        $missing = $venda->RupturaEstoque();

        $html_completo = '<html><body>';
        $html_completo .= '<table class="table" border="1" cellpadding="5" cellspacing="0">';
        $html_completo .= '<thead>';
        $html_completo .= '<tr><th scope="col">Id</th><th scope="col">Imagem URL</th><th scope="col">Nome</th><th scope="col">Valor</th><th scope="col">Verificar</th><th scope="col">Novo valor?</th> </tr>';
        $html_completo .= '</thead>';
        $html_completo .= '<tbody>';

        foreach ($missing as $produto) {
            $id = $produto['id'];
            $nome = $produto['nome'];
            $valor = $produto['valor'];
            $imagemUrl = $produto['imagem'];

            $imageData = base64_encode(file_get_contents($imagemUrl));
            $imageSrc = 'data:image/png;base64,' . $imageData;


            $html_completo .= '<tr>';
            $html_completo .= '<th scope="row">' . $id . '</th>';
            $html_completo .= '<th scope="row"><img src="' . $imageSrc . '" height="200px"></th>';
            $html_completo .= '<td>' . $nome . '</td>';
            $html_completo .= '<td>' . $valor . '</td>';
            $html_completo .= '<td><ul style="list-style-type: square;">
            <li>Comprado</li>
            <li>Não Comprado</li>
            </ul></td>';
            $html_completo .= '<td></td>';
            $html_completo .= '</tr>';
        }

        $html_completo .= '</tbody>';
        $html_completo .= '</table>';
        $html_completo .= '</body></html>';

        $options = new Options();
        $options->set('enable_remote', true);
        $dompdf = new Dompdf($options);

        $dompdf->loadHtml($html_completo);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        if (ob_get_length()) {
            ob_end_clean();
        }

        $dompdf->stream('compras.pdf');
        exit;
    }

    public function Return($id)
    {
        $produto = new Produto();
        $products = $produto->SelectForm($id);
        $categoria = new Categoria();

        $this->data['categorias'] = $categoria->getAll();
        $this->data['products'] = $products;
        $this->data['nivel-1'] = 'Dashboard';

        $this->loadTemplateAdmin("Business/ComprarEstoque", $this->data);
    }

    public function editAmount($hash)
    {
        $produto = new Produto();
        if (isset($_GET['quantidade']) && !empty($_GET['quantidade'])) {
            $quantidade = addslashes($_GET['quantidade']);
            $valor = addslashes($_GET['valor']);
            $produto->editAmount($quantidade, $hash, $valor);
            header('Location: ' . BASE_URL . 'Home');
            exit;
        }
    }

    public function Voltar()
    {
        header('Location: ' . BASE_URL . 'Home');
        exit;
    }

    public function ComprasFinalizadas()
    {
        $produto = new Produto();
        // $this->data['compras'] = $produto->SelectNaoFinalizadas();

        $this->data['nivel-1'] = 'Compras';
        $this->data['nivel-2'] = 'Finalizadas';
        $this->data['finalizadas'] = $produto->SelectComprasOkays();
        $this->loadTemplateAdmin("Business/client/CompraFeitas", $this->data);
    }
    public function ComprasPendentes()
    {
        $produto = new Produto();
        $this->data['pendentes'] = $produto->SelectNaoFinalizadas();
        $this->data['nivel-1'] = 'Compras';
        $this->data['nivel-2'] = 'Pendentes';
        // $this->data['finalizadas'] = $produto->SelectComprasOkays();

        $this->loadTemplateAdmin("Business/client/ComprasPendentes", $this->data);
    }

    public function Delivery()
    {
        $produto = new Produto();
        $this->data['compras'] = $produto->SelectNaoFinalizadas();
        $this->loadTemplateAdmin("Business/client/Delivery", $this->data);
    }

    public function Delivered($id)
    {
        $produto = new Produto();
        $produto->Delivered($id);

        header('Location: ' . BASE_URL . 'Business/ComprasPendentes');
        exit;
    }

    public function CompraPerson($id)
    {
        $produto = new Produto();
        $this->data['client'] = $produto->SelectComprasId($id);

        $venda = new Venda();
        $compra_user = $venda->SelectCompraUser($id);
        $this->data['compra_user'] = $compra_user;

        $this->loadTemplateAdmin("Business/CompraPerson", $this->data);
    }

    public function CompraRealizadas($id)
    {
        $produto = new Produto();
        $this->data['client'] = $produto->SelectComprasFinishID($id);

        $venda = new Venda();
        $compra_user = $venda->SelectCompraUser($id);
        $this->data['compra_user'] = $compra_user;

        $this->loadTemplateAdmin("Business/client/CompraPersonFinish", $this->data);
    }

    public function Analistic()
    {
        $produto = new Produto();


        $products = $produto->getAll();
        $this->data['products'] = $products;
        $this->data['nivel-1'] = 'Dashboard';
        $this->data['nivel-2'] = 'Análises';

        $categoria = new Categoria();
        $this->data['categorias'] = $categoria->getAll();

        $grafico = new Produto();
        $venda_item = $grafico->VendasMensais();

        $nomes = [];
        $quantidades = [];

        foreach ($venda_item as $p) {
            $mesNumero = (int)$p['mes'];
            $mesNome = date("F", mktime(0, 0, 0, $mesNumero, 10));
            $nomes[] = $mesNome;
            $quantidades[] = (float)$p['quantidade'];
        }

        $this->data['nomes'] = json_encode($nomes);
        $this->data['totais'] = json_encode($quantidades);

        $this->loadTemplateAdmin('Business/analytics', $this->data);
    }

    public function VoltarProducts()
    {
        header("Location: " . BASE_URL . "Business/AddItemVenda");
        exit;
    }

    public function ComprasRealizadas()
    {
        $produto = new Produto();
        $this->data['compras'] = $produto->SelectComprasOkays();
        $this->loadTemplateAdmin("Business/client/ComprasFinalizadas", $this->data);
    }
    public function gerenciarCaixa()
    {
        $caixa = new Caixa();
        $this->data['caixa'] = $caixa->SelectCaixaAll();
        $this->data['nivel-1'] = 'Caixa';
        $this->data['nivel-2'] = 'GerenciarCaixa';

        $this->data['valor_caixa']  = $_SESSION['valor_compras']['valorCompra'] ?? [];

        $this->loadTemplateAdmin("Business/Caixa", $this->data);
    }
    public function AddValorInicial($id)
    {

        $caixa = new Caixa();
        $valor_inicial = addslashes($_POST['valor_inicial']);
        $caixa->addValorInicial($id, $valor_inicial);
        header('Location: ' . BASE_URL . 'Business/gerenciarCaixa');
    }
    public function MaisVendidos()
    {
        $produto = new Produto();
        $this->data['nivel-1'] = 'Dashboard';
        $this->data['nivel-2'] = 'MaisVendidos';
        $this->data['MaisVendidos'] = $produto->MaisVendidos();

        $this->loadTemplateAdmin("Business/ProductsMore", $this->data);
    }
}
