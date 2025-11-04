<?php

class Venda extends Model
{


    public function SelectItem()
    {
        $sql = $this->db->prepare("SELECT nome, quantidade FROM produto WHERE situacao = 1 AND quantidade > 0");
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function SelectFalta()
    {
        $sql = $this->db->prepare("SELECT nome FROM produto WHERE quantidade<=0 AND situacao = 1");
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function SelectCart($hash)
    {
        $sql = $this->db->prepare("SELECT hash, nome, valor, descricao, imagem, categoria_id, quantidade, codigo_barras FROM produto WHERE hash = :hash");
        $sql->bindValue(":hash", $hash);
        $sql->execute();
        return $sql->fetch();
    }
     public function SelectCartAll($hash)
    {
        $sql = $this->db->prepare("SELECT hash FROM produto WHERE quantidade=0 AND hash = :hash");
        $sql->bindValue(":hash", $hash);
        $sql->execute();
        return $sql->fetchAll();
    }
    public function SelectSoma()
    {
        $sql = $this->db->prepare("SELECT SUM(valor) AS soma FROM somar WHERE situacao = 1");
        $sql->execute();
        return $sql->fetch();
    }
    public function AddVendaItem($nome, $situacao)
    {

        $sql = $this->db->prepare("UPDATE venda_item SET quantidade = quantidade + 1 WHERE nome = :nome AND situacao=:situacao");

        $sql->bindValue(':nome', $nome);
        $sql->bindValue(':situacao', $situacao);


        $sql->execute();
    }
    public function AddSoma($valor)
    {
        $situacao = 1;
        $sql = $this->db->prepare("INSERT INTO somar(valor, situacao) VALUES (:valor, :situacao)");
        $sql->bindValue(':valor', $valor);
        $sql->bindValue(':situacao', $situacao);
        $sql->execute();
    }




    public function DeleteVenda()
    {
        $situacao = 0;
        $sql = $this->db->prepare("UPDATE somar SET situacao = :situacao WHERE situacao = 1");
        $sql->bindValue(":situacao", $situacao);
        $sql->execute();
    }
    public function Delete()
    {
        $situacao = 2;
        $sql = $this->db->prepare("UPDATE venda_item SET situacao = :situacao WHERE situacao = 1");
        $sql->bindValue(":situacao", $situacao);
        $sql->execute();
    }
    public function apagarSoma()
    {
        $sql = $this->db->prepare("UPDATE venda_item SET situacao = :situacao WHERE situacao = 1");
        $sql->execute();
    }
    public function AddCompra($valor, $forma_de_pagamento)
    {
        $sql = $this->db->prepare("INSERT INTO venda (valor, forma_de_pagamento) VALUES (:valor, :forma_de_pagamento)");
        $sql->bindValue(':forma_de_pagamento', $forma_de_pagamento);
        $sql->bindValue(':valor', $valor);
        $sql->execute();
    }

    public function ProdutoQuantidade($nome)
    {
        $sql = $this->db->prepare("UPDATE produto SET quantidade = quantidade - 1 WHERE nome = :nome AND situacao=1");
        $sql->bindValue(':nome', $nome);
        $sql->execute();
    }

    
    public function ProdutoQuantity($nome, $quantidade)
    {
        $sql = $this->db->prepare("UPDATE produto SET quantidade = quantidade - :quantidade WHERE nome = :nome AND situacao=1");
        $sql->bindValue(':nome', $nome);
        $sql->bindValue(':quantidade', $quantidade);
        $sql->execute();
    }

    public function RupturaEstoque()
    {
        $sql = $this->db->prepare("SELECT * FROM produto WHERE quantidade<=0 AND situacao = 1");
        $sql->execute();
        return $sql->fetchAll();
    }
    public function AddCompraFinalizada($nome, $whatsapp, $rua, $bairro, $numero, $ponto_de_referencia, $Radio, $entrega, $tipo)
    {


        $sql = $this->db->prepare("INSERT INTO `compra_finalizada`(`nome_cliente`, `whatsapp`, `rua`, `bairro`, `numero_casa`, `ponto_de_referencia`, `Radio`, `entrega`, `tipo`) VALUES (:nome_cliente, :whatsapp, :rua, :bairro, :numero_casa, :ponto_de_referencia, :Radio, :entrega, :tipo)");


        $sql->bindValue(':nome_cliente', $nome);
        $sql->bindValue(':whatsapp', $whatsapp);
        $sql->bindValue(':rua', $rua);
        $sql->bindValue(':bairro', $bairro);
        $sql->bindValue(':numero_casa', $numero);
        $sql->bindValue(':ponto_de_referencia', $ponto_de_referencia);
        $sql->bindValue(':Radio', $Radio);
        $sql->bindValue(':entrega', $entrega);
        $sql->bindValue(':tipo', $tipo);
        $sql->execute();
    }

     public function AddCompraCaixa($Radio, $entrega, $tipo)
    {


        $sql = $this->db->prepare("INSERT INTO `compra_finalizada`(`Radio`, `entrega`, `tipo`) VALUES (:Radio, :entrega, :tipo)");
        $sql->bindValue(':Radio', $Radio);
        $sql->bindValue(':entrega', $entrega);
        $sql->bindValue(':tipo', $tipo);
        $sql->execute();
    }


     

    public function getId()
    {
        $sql = $this->db->prepare("SELECT id_compra FROM `compra_finalizada` ORDER BY  id_compra DESC ");
        $sql->execute();
        return $sql->fetch();
    }
    public function itensCompra($id, $quantidade, $name_product, $imagem)
    {

        $sql = $this->db->prepare("INSERT INTO `produtos compra`(`id_compra`, `nome`, `quantidade`, `imagem`) VALUES (:id, :nome, :quantidade, :imagem)");
        $sql->bindValue(':id', $id);
        $sql->bindValue(':nome', $name_product);
         $sql->bindValue(':imagem', $imagem);
        $sql->bindValue(':quantidade', $quantidade);
        $sql->execute();
    }
    public function getNameClient()
    {
        $sql = $this->db->prepare("SELECT nome_cliente FROM `compra_finalizada`");
        $sql->execute();
        return $sql->fetchAll();
    }

    public function SelectCompraUser($id){
        $sql = $this->db->prepare("SELECT * FROM `produtos compra` WHERE id_compra = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
        return $sql->fetchAll();
    }
    
   
}
