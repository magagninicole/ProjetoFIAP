<?php

namespace App\Controllers;

use App\Core\Controller;

use App\Models\Administrador;

class LoginController extends Controller
{

    /**
    * Valida se o usuário está logado e redireciona para o login
    */

    public function index()
    {
        // Se já estiver logado, vai direto pra home
        session_start();
        if (!empty($_SESSION['logado'])) {
            header('Location: ' . \url('Home'));
            exit;
        }

        $this->view('login');
    }

    /**
    * Valida login e senha do administrador
    */
    public function autenticar()
    {
        session_start();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $senha = $_POST['senha'] ?? '';

            $adminModel = $this->model('Administrador');
            $admin = $adminModel->buscarPorEmail($email);

            if ($admin && password_verify($senha, $admin['senha'])) {
                $_SESSION['logado'] = true;
                $_SESSION['admin'] = [
                    'id' => $admin['id'],
                    'nome' => $admin['nome'],
                    'email' => $admin['email']
                ];

                header('Location: ' . \url('Home'));
                exit;
            } else {
                $erro = "E-mail ou senha incorretos.";
                $this->view('login', ['erro' => $erro]);
            }
        } else {
            header('Location: ' . \url('Login'));
            exit;
        }
    }

    
    /**
    * Faz logout do administrador
    */
    public function sair()
    {
        session_start();
        session_destroy();
        header('Location: ' . \url('Login'));
        exit;
    }
}
