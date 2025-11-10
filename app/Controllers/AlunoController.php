<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Services\OrdenacaoService;
use App\Services\ValidacoesService;;

class AlunoController extends Controller {

    /**
    * Lista todos os alunos com ordenação e paginação.
    *
    */

   public function index() {

        $alunoModel = $this->model('Aluno');

        $filtroNome = $_GET['nome'] ?? null;

        if ($filtroNome) {
            $alunos = $alunoModel->listarPorNome($filtroNome);
        } else {
            $alunos = $alunoModel->listar();
        }

        //Ordena em ordem alfabética
        $ordenacao = new OrdenacaoService();
        $alunosOrdenados = $ordenacao->ordenar($alunos, 'nome_aluno', 'asc');

        $paginaAtual = $_GET['pagina'] ?? 1;
        $resultadoPaginado = $ordenacao->paginar($alunosOrdenados, $paginaAtual, 10);

        $this->view('alunos/listar', ['alunos' => $resultadoPaginado]);
    }

    /**
    * Cadastra um novo aluno.
    *
    */

    public function cadastrar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = [
                'nome_aluno' => $_POST['nome_aluno'] ?? '',
                'data_nascimento' => $_POST['data_nascimento'] ?? '',
                'cpf_aluno' => $_POST['cpf_aluno'] ?? '',
                'email_aluno' => $_POST['email_aluno'] ?? '',
                'senha_aluno' => $_POST['senha_aluno'] ?? '',
            ];

            $validator = new ValidacoesService();

            if (!$validator->validar($dados)) {
                $this->view('alunos/cadastrar', ['erros' => $validator->getErros(), 'dados' => $dados]);
                return;
            }

            $alunoModel = $this->model('Aluno');
            $ok = $alunoModel->criar(...array_values($dados));
        if($ok){
                $mensagem = ['tipo' => 'sucesso', 'texto' => 'Aluno cadastrado com sucesso!'];
                header('Location: ' . url('Aluno') . '?msg=' . urlencode(json_encode($mensagem)));
                exit;
            } else { 
                $mensagem = ['tipo' => 'erro', 'texto' => 'Falha ao cadastrar aluno. Tente novamente.'];
                header('Location: ' .  url('Aluno/cadastrar')) . '?msg=' . urlencode(json_encode($mensagem));
                exit;
            }
        } else {
            $this->view('alunos/cadastrar');
        }
    }

    /**
    * Atualiza os dados de um aluno.
    * @param int $id
    */

    public function atualizar($id)
    {
        $alunoModel = $this->model('Aluno');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = [
                'id_aluno' => $id,
                'nome_aluno' => $_POST['nome_aluno'] ?? '',
                'data_nascimento' => $_POST['data_nascimento'] ?? '',
                'cpf_aluno' => $_POST['cpf_aluno'] ?? '',
                'email_aluno' => $_POST['email_aluno'] ?? '',
                'senha_aluno' => $_POST['senha_aluno'] ?? null,
            ];

            // Remove senha vazia para não validar
            if (empty($dados['senha_aluno'])) {
                unset($dados['senha_aluno']);
            }

            $validator = new ValidacoesService();

            if (!$validator->validar($dados, $id)) {
                $this->view('alunos/cadastrar', ['aluno' => $dados, 'erros' => $validator->getErros()]);
                return;
            }

            $senha = $dados['senha_aluno'] ?? null;
            $ok = $alunoModel->atualizar(
                $id,
                $dados['nome_aluno'],
                $dados['data_nascimento'],
                $dados['cpf_aluno'],
                $dados['email_aluno'],
                $senha
            );

            if ($ok) {
                $mensagem = ['tipo' => 'sucesso', 'texto' => 'Aluno atualizado com sucesso!'];
                header('Location: ' . url('Aluno') . '?msg=' . urlencode(json_encode($mensagem)));
                exit;
            } else {
                $mensagem = ['tipo' => 'erro', 'texto' => 'Falha ao atualizar aluno. Tente novamente.'];
                header('Location: ' . url('Aluno/atualizar/'.$id . '?msg=' . urlencode(json_encode($mensagem))));
            }

        } else {

            $aluno = $alunoModel->buscarPorId($id);
            if (!$aluno) {
                echo "Aluno não encontrado.";
                return;
            }

            $this->view('alunos/cadastrar', ['aluno' => $aluno]);
        }
    }

    /**
    * Atualiza apenas a senha de um aluno.
    * @param int $id
    */

    public function atualizarSenha($id)
    {
        $alunoModel = $this->model('Aluno');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $senha = $_POST['senha_aluno'] ?? '';

            $validator = new ValidacoesService();
            $dados = ['senha_aluno' => $senha];

            if ($validator->validar($dados)) {
                $ok = $alunoModel->atualizar($id, null, null, null, null, $senha);
                if ($ok) {
                    $mensagem = ['tipo' => 'sucesso', 'texto' => 'Senha atualizada com sucesso!'];
                    header('Location: ' . url('Aluno/atualizar/'.$id . '?msg=' . urlencode(json_encode($mensagem))));
                } else {
                    $mensagem = ['tipo' => 'erro', 'texto' => 'Erro ao atualizar senha.'];
                    header('Location: ' . url('Aluno/atualizar/'.$id . '?msg=' . urlencode(json_encode($mensagem))));
                }
            } else {
                $erros = $validator->getErros();
                $this->view('alunos/cadastrar', [
                    'aluno' => $alunoModel->buscarPorId($id),
                    'erros_senha' => $erros
                ]);
            }
        }
        exit;
    }

    /**
    * Deleta um aluno.
    * @param int $id
    */

    public function deletar($id) {
        $alunoModel = $this->model('Aluno');
        $ok = $alunoModel->deletar($id);

       if ($ok) {
            $mensagem = ['tipo' => 'sucesso', 'texto' => 'Aluno deletado com sucesso!'];
        } else {
            $mensagem = ['tipo' => 'erro', 'texto' => 'Erro ao deletar aluno.'];
        }

        header('Location: ' . url('Aluno') . '?msg=' . urlencode(json_encode($mensagem)));
        exit;
    }
}
