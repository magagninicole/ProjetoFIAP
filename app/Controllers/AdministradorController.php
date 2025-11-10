<?php

namespace App\Controllers;

use App\Services\OrdenacaoService;
use App\Core\Controller;

class AdministradorController extends Controller {
    
    /**
     * Lista todos os administradores cadastrados.
     *
     */

    public function index() {
        $adminModel = $this->model('Administrador');
        $administradores = $adminModel->listar();

         
        $filtroNome = $_GET['nome'] ?? null;

        if ($filtroNome) {
            $administradores = $adminModel->listarPorNome($filtroNome);
        } else {
            $administradores = $adminModel->listar();
        }

        $ordenacao = new OrdenacaoService();
        $adminsOrdenados = $ordenacao->ordenar($administradores, 'nome', 'asc');

        $paginaAtual = $_GET['pagina'] ?? 1;
        $resultadoPaginado = $ordenacao->paginar($adminsOrdenados, $paginaAtual, 10);
        
        $this->view('administradores/listar', ['administradores' => $resultadoPaginado]);
    }

     /**
     * Cadastra um novo administrador.
     *
     */

    public function cadastrar() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $senha = $_POST['senha'];

            $adminModel = $this->model('Administrador');
            $ok = $adminModel->criar($nome, $cpf, $email, $senha);

            if ($ok) {
                $mensagem = ['tipo' => 'sucesso', 'texto' => 'Administrador criado com sucesso!'];
                header('Location: ' . url('Administrador') . '?msg=' . urlencode(json_encode($mensagem)));
                exit;
            } else {
                $mensagem = ['tipo' => 'erro', 'texto' => 'Erro ao criar administrador. Tente novamente.'];
                header('Location: ' .  url('Administrador/atualizar/') . '?msg=' . urlencode(json_encode($mensagem)));
                exit;
            }

        } else {
            $this->view('administradores/cadastrar');
        }
    }

    /**
    * Atualiza os dados de um administrador existente.
    *
    * @param int $id_admin
    */

    public function atualizar($id_admin) {

        $adminModel = $this->model('Administrador');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $senha = $_POST['senha'] ?? null; 

            if (empty($nome) || empty($cpf) || empty($email)) {
                echo "Todos os campos obrigatórios devem ser preenchidos.";
                return;
            }

            $ok = $adminModel->atualizar($id_admin, $nome, $cpf, $email, $senha);

                
            if($ok) {
                $mensagem = ['tipo' => 'sucesso', 'texto' => 'Administrador atualizado com sucesso!'];
                header('Location: ' . url('Administrador') . '?msg=' . urlencode(json_encode($mensagem)));
                exit;
            } else{
                $mensagem = ['tipo' => 'erro', 'texto' => 'Falha ao atualizar administrador. Tente novamente.'];
                header('Location: ' . url('Administrador/atualizar/' . $id_admin) . '?msg=' . urlencode(json_encode($mensagem)));
                exit;
            }
        } else {
            $administrador = $adminModel->buscarPorid($id_admin);

            if (!$administrador) {
                echo "Administrador não encontrado.";
                return;
            }
            $this->view('administradores/cadastrar', ['administrador' => $administrador]);
        }
    }

    /**
    * Deleta um administrador.
    *
    * @param int $id_admin
    */

    public function deletar($id_admin) {
        
        $adminModel = $this->model('Administrador');
        $ok = $adminModel->deletar($id_admin);
 
        if($ok) {
            $mensagem = ['tipo' => 'sucesso', 'texto' => 'Administrador deletado com sucesso!'];
        } else{
            $mensagem = ['tipo' => 'erro', 'texto' => 'Falha ao deletar administrador. Tente novamente.'];
        }
        
        header('Location: ' . url('Administrador') . '?msg=' . urlencode(json_encode($mensagem)));
        exit;
    }

   
}
