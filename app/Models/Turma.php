<?php
namespace App\Models;

use App\Core\Model;
use PDO;

class Turma extends Model
{

    /**
    * Listar turmas com contagem de alunos matriculados
    */

   public function listar()
    {
        $stmt = $this->conn->query("
            SELECT t.*, 
                COUNT(m.id_aluno) AS total_alunos
            FROM turmas t
            LEFT JOIN matriculas m ON m.id_turma = t.id_turma
            GROUP BY t.id_turma
            ORDER BY t.nome_turma ASC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
    * Cadastrar turma
    * @param string $nome
    * @param string $descricao
    */
    public function criar($nome, $descricao)
    {
        $sql = "INSERT INTO turmas (nome_turma, descricao) VALUES (:nome, :descricao)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':nome' => $nome, ':descricao' => $descricao]);
    }

    /**
    * Atualizar turma
    * @param int $id
    * @param string $nome
    * @param string $descricao
    */
    public function atualizar($id, $nome, $descricao)
    {
        $sql = "UPDATE turmas SET nome_turma = :nome, descricao = :descricao WHERE id_turma = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':nome' => $nome, ':descricao' => $descricao, ':id' => $id]);
    }


    /**
    * Deletar turma
    * @param int $id
    */
    public function deletar($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM turmas WHERE id_turma = :id");
        return $stmt->execute([':id' => $id]);
    }

    /**
    * Buscar turma por id
    * @param int $id
    */
    public function buscarPorId($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM turmas WHERE id_turma = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
