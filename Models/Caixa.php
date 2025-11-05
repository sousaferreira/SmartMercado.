<?php

class Caixa extends Model
{
    public function LoginOperador($operador, $senha)
    {
        $sql = $this->db->prepare("SELECT * FROM operador WHERE operador = :operador AND senha = :senha");

        $sql->bindValue(':operador', $operador);
        $sql->bindValue(':senha', $senha);

        $sql->execute();

        $count = $sql->rowCount();
        if ($count <=0) {
            return'erro';
           
        } else {
            return $sql->fetch(PDO::FETCH_ASSOC);
            return $count;
        }
    }

    public function Caixa($id_operador, $data_abertura, $data_fechamento, $status, $caixa)
    {
        $sql = $this->db->prepare("INSERT INTO caixa (`id_operador`,`data_abertura`,`data_fechamento`,`status`,`caixa`) VALUES (:id_operador, :data_abertura, :data_fechamento, :status, :caixa)");
        $sql->bindValue(':id_operador', $id_operador);
        $sql->bindValue(':data_abertura', $data_abertura);
        $sql->bindValue(':data_fechamento', $data_fechamento);
        $sql->bindValue(':status', $status);
        $sql->bindValue(':caixa', $caixa);
        $sql->execute();
    }
    public function SearchBarras($codigo_barras){
        $sql = $this->db->prepare("SELECT * FROM produto WHERE codigo_barras = :codigo_barras");
        $sql->bindValue(':codigo_barras', $codigo_barras);
        $sql->execute();
        return $sql->fetch();
    
    }
    public function SelectCaixaAll(){
         $sql = $this->db->prepare("SELECT * FROM caixa");
        $sql->execute();
        return $sql->fetchAll();
    }

    public function SelectCaixa(){
         $sql = $this->db->prepare("SELECT valor_inicial FROM caixa");
        $sql->execute();
        return $sql->fetch();
    }
    public function SelectCaixaOp($caixa){
         $sql = $this->db->prepare("SELECT * FROM caixa WHERE caixa = :caixa");
         $sql->bindValue(':caixa', $caixa);
        $sql->execute();
        return $sql->fetch();
    }
   public function addValorInicial($id,  $valor_inicial){
    $sql = $this->db->prepare("UPDATE caixa SET valor_inicial = :valor_inicial WHERE id = :id ");

    $sql->bindValue(':id', $id); 
    $sql->bindValue(':valor_inicial', $valor_inicial);
  
  
    $sql->execute();
}

  public function AddFechamentoCaixa($data_abertura, $valor_final, $data_fechamento, $status)
{
    $sql = $this->db->prepare("UPDATE caixa SET valor_final = :valor_final, data_fechamento = :data_fechamento, status = :status  WHERE data_abertura = :data_abertura");

    $sql->bindValue(':data_abertura', $data_abertura); 
    $sql->bindValue(':valor_final', $valor_final);
    $sql->bindValue(':data_fechamento', $data_fechamento);
    $sql->bindValue(':status', $status);

    $sql->execute();
}




}
