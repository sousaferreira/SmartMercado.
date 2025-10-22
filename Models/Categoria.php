<?php

class Categoria extends Model
{
 public function getAll(){
    $sql = $this->db->prepare("SELECT * FROM categorias");
        $sql->execute();
        return $sql->fetchAll(); 

        
 }
 public function getCategoria(int $categoria){
        $situacao =1;
        $sql = $this->db->prepare("SELECT * FROM produto WHERE categoria_id = :categoria AND situacao= :situacao");
        $sql->bindValue(":categoria", $categoria);
        $sql->bindValue(":situacao", $situacao);
        $sql->execute();
        return $sql->fetchAll();
    

 }

}
