<?php

class Produto extends Model
{


    public function addProduct($nome, $valor,  $categoria_id, $imagem, $descricao, $situacao, $quantidade, $codigo_barras)
    {

        $sql = $this->db->prepare("INSERT INTO produto (nome, valor, categoria_id, imagem, descricao, situacao, quantidade, codigo_barras) VALUES (:nome, :valor, :categoria_id, :imagem, :descricao, :situacao, :quantidade, :codigo_barras)");

        $sql->bindValue(':nome', $nome);
        $sql->bindValue(':valor', $valor);
        $sql->bindValue(':categoria_id', $categoria_id);
        $sql->bindValue(':descricao', $descricao);
        $sql->bindValue(':imagem', $imagem);
        $sql->bindValue(':situacao', $situacao);
        $sql->bindValue(':quantidade', $quantidade);
        $sql->bindValue(':codigo_barras', $codigo_barras);
        $sql->execute();

        return $this->db->lastInsertId();
    }

    public function addVendaItem($nome, $valor, $categoria_id, $descricao, $situacao)
    {
        $quantidade = 1;
        $sql = $this->db->prepare("INSERT INTO venda_item (nome, valor, categoria_id, descricao, situacao, quantidade) VALUES (:nome, :valor, :categoria_id, :descricao, :situacao, :quantidade)");

        $sql->bindValue(':nome', $nome);
        $sql->bindValue(':valor', $valor);
        $sql->bindValue(':categoria_id', $categoria_id);
        $sql->bindValue(':descricao', $descricao);
        $sql->bindValue(':situacao', $situacao);
        $sql->bindValue(':quantidade', $quantidade);
        $sql->execute();
    }

    public function getId()
    {
        $sql = $this->db->prepare("SELECT id FROM produto WHERE situacao=1 ORDER BY id DESC ");
        $sql->execute();
        return $sql->fetch();
    }
    public function getAll()
    {
        $sql = $this->db->prepare("SELECT * FROM produto WHERE quantidade>0 AND situacao = 1");
        $sql->execute();
        return $sql->fetchAll();
    }
    public function getEstoque()
    {
        $sql = $this->db->prepare("SELECT * FROM produto WHERE situacao = 1");
        $sql->execute();
        return $sql->fetchAll();
    }

     public function getEstoqueLimit()
    {
        $sql = $this->db->prepare("SELECT * FROM produto WHERE situacao = 1 LIMIT 3");
        $sql->execute();
        return $sql->fetchAll();
    }
  

    public function getEstoqueSite()
    {
        $sql = $this->db->prepare("SELECT * FROM produto WHERE situacao = 1 AND quantidade >0");
        $sql->execute();
        return $sql->fetchAll();
    }

    public function SelectCart($hash)
    {
        $sql = $this->db->prepare("SELECT id, nome, valor, descricao, imagem, categoria_id, quantidade FROM produto WHERE hash = :hash");
        $sql->bindValue(":hash", $hash);
        $sql->execute();
        return $sql->fetch();
    }

    public function SelectForm($hash)
    {
        $sql = $this->db->prepare("SELECT * FROM produto WHERE hash = :hash");
        $sql->bindValue(":hash", $hash);
        $sql->execute();
        return $sql->fetch();
    }

    public function delete(string $hash)
    {
        $situacao = 0;
        $sql = $this->db->prepare("UPDATE produto SET situacao = :situacao WHERE hash =:hash");
        $sql->bindValue(":hash", $hash);
        $sql->bindValue(":situacao", $situacao);
        $sql->execute();
    }

    public function editProduct($id, $nome, $valor, $descricao, $imagem,  $categoria_id)
    {
        $sql = $this->db->prepare("UPDATE produto SET nome = :nome, valor = :valor, descricao = :descricao, imagem = :imagem, categoria_id = :categoria_id WHERE hash =:id");
        $sql->bindValue(":id", $id);
        $sql->bindValue(":nome", $nome);
        $sql->bindValue(":valor", $valor);
        $sql->bindValue(":categoria_id", $categoria_id);
        $sql->bindValue(":descricao", $descricao);
        $sql->bindValue(":imagem", $imagem);
        $sql->execute();
    }

    public function editAmount($quantidade, $hash, $valor)
    {
        $sql = $this->db->prepare("UPDATE produto SET quantidade = :quantidade, valor = :valor WHERE hash =:hash");
        $sql->bindValue(":hash", $hash);
        $sql->bindValue(":quantidade", $quantidade);
         $sql->bindValue(":valor", $valor);
        $sql->execute();
    }
    // Update hash product
    public function editHashProduct($id, $hash)
    {
        $sql = $this->db->prepare("UPDATE produto SET hash = :hash WHERE id =:id");
        $sql->bindValue(":id", $id);
        $sql->bindValue(":hash", $hash);
        $sql->execute();
    }

    public function getCategoria()
    {
        $sql = $this->db->prepare("SELECT * FROM categorias");
        $sql->execute();
        return $sql->fetchAll();
    }

    public function Site()
    {
        $sql = $this->db->prepare("SELECT * FROM produto WHERE situacao = 1 AND quantidade >0");
        $sql->execute();
        return $sql->fetchAll();
    }
    public function SiteLimpeza()
    {
        $sql = $this->db->prepare("SELECT * FROM produto WHERE situacao = 1 AND quantidade >0 AND categoria_id=1");
        $sql->execute();
        return $sql->fetchAll();
    }
    public function SiteBrinquedos()
    {
        $sql = $this->db->prepare("SELECT * FROM produto WHERE situacao = 1 AND quantidade >0 AND categoria_id=2");
        $sql->execute();
        return $sql->fetchAll();
    }
    public function SiteCarnes()
    {
        $sql = $this->db->prepare("SELECT * FROM produto WHERE situacao = 1 AND quantidade >0 AND categoria_id=5");
        $sql->execute();
        return $sql->fetchAll();
    }

    public function SiteBebidas()
    {
        $sql = $this->db->prepare("SELECT * FROM produto WHERE situacao = 1 AND quantidade >0 AND categoria_id=3");
        $sql->execute();
        return $sql->fetchAll();
    }

    public function SiteAlimentacao()
    {
        $sql = $this->db->prepare("SELECT * FROM produto WHERE situacao = 1 AND quantidade >0 AND categoria_id=4");
        $sql->execute();
        return $sql->fetchAll();
    }
    public function SelectNaoFinalizadas()
    {
        $sql = $this->db->prepare("SELECT * FROM compra_finalizada WHERE entrega = 1");
        $sql->execute();
        return $sql->fetchAll();
    }

     
     public function SelectComprasOkays()
    {
        $sql = $this->db->prepare("SELECT * FROM compra_finalizada WHERE entrega = 0");
        $sql->execute();
        return $sql->fetchAll();
    }
    public function SelectComprasID($id)
    {
        $sql = $this->db->prepare("SELECT * FROM compra_finalizada WHERE entrega = 1 AND id_compra = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
        return $sql->fetchAll();
    }
    public function SelectComprasFinishID($id)
    {
        $sql = $this->db->prepare("SELECT * FROM compra_finalizada WHERE entrega = 0 AND id_compra = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
        return $sql->fetchAll();
    }
    public function Delivered($id)
    {
        $sql = $this->db->prepare("UPDATE compra_finalizada SET entrega = 0 WHERE id_compra = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
    }
     public function VendasMensais(){
        $sql = $this->db->prepare("SELECT MONTH(`data`) AS mes, SUM(`quantidade`) AS quantidade FROM `produtos compra` GROUP BY MONTH(`data`) ORDER BY mes");
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function MaisVendidos(){
         $sql = $this->db->prepare("SELECT nome, imagem,  SUM(quantidade) AS total_vendido FROM `produtos compra` GROUP BY nome ORDER BY total_vendido DESC LIMIT 10");
        $sql->execute();
    return $sql->fetchAll(PDO::FETCH_ASSOC);
}
}
