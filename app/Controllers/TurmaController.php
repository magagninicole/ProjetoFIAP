<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Services\OrdenacaoService;
use App\Services\ValidacoesService;

class TurmaController extends Controller {

       
    /**
    * Lista todas as turmas com ordenação e paginação.
    */

    public function index() {
        $turmaModel = $this->model('Turma');
        $turmas = $turmaModel->listar();

        $ordenacao = new OrdenacaoService();
        $ordenadas = $ordenacao->ordenar($turmas, 'nome_turma', 'asc');

        $paginaAtual = $_GET['pagina'] ?? 1;
        $resultadoPaginado = $ordenacao->paginar($ordenadas, $paginaAtual, 10);

        $this->view('turmas/listar', ['turmas' => $resultadoPaginado]);
    }


   
    /**
    * Cadastra ou atualiza uma turma.
    * @param int $id_turma
    */

    public function cadastrar($id_turma = null)
    {
        $turmaModel = $this->model('Turma');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = [
                'nome_turma' => $_POST['nome_turma'] ?? '',
                'descricao' => $_POST['descricao'] ?? '',
            ];

               $erros = [];


            if (strlen($dados['nome_turma']) < 3) {
                $erros[] = 'O nome da turma deve ter pelo menos 3 caracteres.';
            }

            if (strlen($dados['descricao']) < 1) {
                $erros[] = 'A descrição da turma não pode ficar em branco.';
            }

            if (!empty($erros)) {
                $this->view('turmas/cadastrar', [
                    'erros' => $erros,
                    'dados' => $dados
                ]);
                return;
            }

            
            if ($id_turma) {
                $ok = $turmaModel->atualizar($id_turma, $dados['nome_turma'], $dados['descricao']);
                if ($ok) {
                    $mensagem = ['tipo' => 'sucesso', 'texto' => 'Turma atualizada com sucesso!'];
                } else {
                    $mensagem = ['tipo' => 'erro', 'texto' => 'Falha ao atualizar turma.'];
                }
            } else {
                $ok = $turmaModel->criar($dados['nome_turma'], $dados['descricao']);
                if ($ok) {
                    $mensagem = ['tipo' => 'sucesso', 'texto' => 'Turma cadastrada com sucesso!'];
                } else {
                    $mensagem = ['tipo' => 'erro', 'texto' => 'Falha ao cadastrar turma.'];
                }
            }

            header('Location: ' . url('Turma') . '?msg=' . urlencode(json_encode($mensagem)));
            exit;
        } else {
            $turma = $id_turma ? $turmaModel->buscarPorId($id_turma) : null;
            $this->view('turmas/cadastrar', ['turma' => $turma]);
        }
    }


    /**
    * Deleta uma turma.
    * @param int $id_turma
    */
    public function deletar($id_turma) {
        $turmaModel = $this->model('Turma');
        $ok = $turmaModel->deletar($id_turma);

        if ($ok) {
            $mensagem = ['tipo' => 'sucesso', 'texto' => 'Turma deletada com sucesso!'];
        } else {
            $mensagem = ['tipo' => 'erro', 'texto' => 'Falha ao deletar turma.'];
        }

        header('Location: ' . url('Turma') . '?msg=' . urlencode(json_encode($mensagem)));
        exit;
    }
}
