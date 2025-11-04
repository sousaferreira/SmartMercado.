<?php

class LoginOperadorController extends Controller
{
    

    public function index()
    {
        
        $login = $_POST['operador'] ?? '';
        $senha = $_POST['passwd'] ?? '';

        $caixa = new Caixa;
        $operador = $caixa->LoginOperador($login, $senha);

        if ($operador == 'erro') {
            
            echo "<script language='javascript' type='text/javascript'>
            alert('Login e/ou senha incorretos');window.location.href='" . BASE_URL . "Business/caixa'</script>";
            die();
        } else {
            
            $operadorId = $operador['ID'];
            $nomeOperador = $operador['operador'];
            $caixaOperador = $operador['caixa'];
            $data_abertura = date('d/m/Y H:i:s');
            $status = 'aberto';

            $_SESSION['operador'] = [ 
                'id' => $operadorId,
                'nome' => $nomeOperador,
                'caixa' => $caixaOperador,
                'data_abertura' => $data_abertura,
                'status' => $status
            ];
           
           
            $caixa->Caixa($operadorId, $data_abertura, NULL, $status, $caixaOperador);

          
            header("Location: " . BASE_URL . "OperadorCaixa/"); 
            exit; 
        }
    }
}
