<?php

class LoginController extends Controller
{
    public function index()
    {
        // Inicia sessão se não tiver
        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }

        $user = new Users();
        $data = [];

        // Redireciona se já estiver logado
        if ($user->isLogged()) {
            header("Location: " . BASE_URL . "Home/");
            exit;
        }

        // Recebe POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

        if ($post) {
            $email = trim($post['email']);
            $passwd = $post['passwd'];

            var_dump("Email recebido:", $email);
            var_dump("Senha recebida:", $passwd);

            // Valida e-mail
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $data["alert"] = message()->warning("Por favor, informe um email válido.");
            } else {
                // Verifica se e-mail existe e está ativo
                $userData = $user->getInfoByEmail($email);

                if (!$userData || $userData['situation'] != 1) {
                    $data["alert"] = message()->warning("Email não encontrado ou usuário inativo.");
                } else {
                    // Verifica a senha
                    if ($user->doLoginWithAutoHash($email, $passwd)) {
                        header("Location: " . BASE_URL . "Home/");
                        exit;
                    } else {
                        $data["alert"] = message()->error("Senha inválida.");
                    }
                }
            }
        }

        $this->loadView("Login/index", $data);
    }

    public function logout()
    {
        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }

        $user = new Users();
        $user->logout();
        header("Location: " . BASE_URL . "Login");
        exit;
    }
}
