<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Services\OrdenacaoService;

class MatriculaController extends Controller
{

    
    /**
    * Busca alunos disponíveis e já matriculados em uma turma
    * @param int $id_turma
    */

    public function obterMatriculas($id_turma)
    {
        $matriculaModel = $this->model('Matricula');
        $alunoModel = $this->model('Aluno');
        $turmaModel = $this->model('Turma');

        $turma = $turmaModel->buscarPorId($id_turma);
        if (!$turma) {
            echo "Turma não encontrada.";
            return;
        }

        $alunosMatriculados = $matriculaModel->buscarAlunosMatriculados($id_turma);

        $todosAlunos = $alunoModel->listar();
        
        //Evita duplicidade não listando alunos já matriculados
        $alunosDisponiveis = array_filter($todosAlunos, function($aluno) use ($alunosMatriculados) {
            foreach ($alunosMatriculados as $mat) {
                if ($aluno['id_aluno'] == $mat['id_aluno']) return false;
            }
            return true;
        });

        $ordenacao = new OrdenacaoService();
        $alunosDisponiveis = $ordenacao->ordenar($alunosDisponiveis, 'nome_aluno', 'asc');
        $alunosMatriculados = $ordenacao->ordenar($alunosMatriculados, 'nome_aluno', 'asc');

        $this->view('matriculas/cadastrar', [
            'turma' => $turma,
            'alunosDisponiveis' => $alunosDisponiveis,
            'alunosMatriculados' => $alunosMatriculados
        ]);
    }

       
    /**
    * Salva a matricula de um ou mais alunos em uma turma
    * @param int $id_turma
    */

    public function cadastrar($id_turma)
    {
        $matriculaModel = $this->model('Matricula');

        $alunosSelecionados = $_POST['alunos'] ?? [];

        foreach ($alunosSelecionados as $id_aluno) {
            // evita duplicidade
            if (!$matriculaModel->buscarDuplicidade($id_aluno, $id_turma)) {
                $matriculaModel->criar($id_turma, $id_aluno);
            }
        }

        $mensagem = ['tipo' => 'sucesso', 'texto' => 'Alunos matriculados com sucesso!'];

        header('Location: ' . url('Matricula/obterMatriculas/'.$id_turma) . '?msg=' . urlencode(json_encode($mensagem)));
        exit;
    }

       
    /**
    * Remove a matricula de um ou mais alunos de uma turma
    * @param int $id_turma
    */

    public function deletar($id_turma)
    {
        $matriculaModel = $this->model('Matricula');

        $alunosSelecionados = $_POST['alunos_remover'] ?? [];

        if (!empty($alunosSelecionados)) {
            $matriculaModel->remover($id_turma, $alunosSelecionados);


            $mensagem = ['tipo' => 'sucesso', 'texto' => 'Alunos removidos com sucesso!'];
        } else {
            $mensagem = ['tipo' => 'erro', 'texto' => 'Nenhum aluno selecionado para remover.'];
        }

        header('Location: ' . url('Matricula/obterMatriculas/'.$id_turma) . '?msg=' . urlencode(json_encode($mensagem)));
        exit;
    }
}
