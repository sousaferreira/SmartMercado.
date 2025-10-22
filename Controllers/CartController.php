<?php

class CartController extends Controller
{
    private $data = array();

    public function SaveCart($hash)
    {
        $cartModel = new CartSave;
        $cart = $cartModel->SelectCart($hash);
        $this->data['cart'] = $cart;

        $id = $cart['hash'];
        $nome = $cart['nome'];
        $descricao = $cart['descricao'];
        $valor = $cart['valor'];
        $imagem = $cart['imagem'];
        $categoria_id = $cart['categoria_id'];

        $contar = $cartModel->SelectRows($hash);

        // var_dump($hash, $contar['qtd'], $contar['qtd']>2);
        // exit;
        if ($contar['qtd'] > 1) {
            $cart = $cartModel->UpdateCart($hash);
             echo 'oiii';
            var_dump($contar);
            exit;

        } else {

           



            $cartModel->AddCart($id, $nome, $descricao, $valor, $imagem, $categoria_id);
        }



        header('Location: ' . BASE_URL . '');
        exit;
    }
}
