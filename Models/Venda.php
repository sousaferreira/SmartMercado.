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
        $sql = $this->db->prepare("SELECT hash, nome, valor, descricao, imagem, categoria_id, quantidade FROM produto WHERE hash = :hash");
        $sql->bindValue(":hash", $hash);
        $sql->execute();
        return $sql->fetch();

        
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

    public function RupturaEstoque(){
        $sql = $this->db->prepare("SELECT * FROM produto WHERE quantidade<=0 AND situacao = 1");
        $sql->execute();
        return $sql->fetchAll();
    }
    }

