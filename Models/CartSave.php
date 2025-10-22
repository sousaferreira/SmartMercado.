<?php

class CartSave extends Model
{

    public function __construct()
    {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
    }

    public function add($id, $nome, $descricao, $valor, $imagem, $categoria_id, $quantidade)
    {
        $productId = $id;

        if (isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId]['quantity'] += $quantidade;
        } else {
            $_SESSION['cart'][$productId] = [
                'name' => $nome,
                'image' => $imagem,
                'descricao' => $descricao,
                'price' => $valor,
                'quantity' => $quantidade,
            ];

            var_dump($_SESSION['cart']);
            exit;
        }
    }
}
