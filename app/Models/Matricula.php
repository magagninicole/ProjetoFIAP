<?php
namespace App\Models;

use App\Core\Model;
use PDO;

class Matricula extends Model
{

    
    /**
    * Busca alunos matriculados em uma turma para exibição
    * @param int $id_turma
    */
   public function buscarAlunosMatriculados($id_turma)
    {
        $sql = "SELECT a.id_aluno, a.nome_aluno 
                FROM alunos a
                JOIN matriculas m ON a.id_aluno = m.id_aluno
                WHERE m.id_turma = :id_turma";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id_turma' => $id_turma]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


        
    /**
    * Busca alunos já matriculados para evitar duplicidade
    * @param int $id_turma
    * @param int $id_aluno
    */
    public function buscarDuplicidade($id_turma, $id_aluno)
    {
        $sql = "SELECT COUNT(*) FROM matriculas 
                WHERE id_turma = :id_turma AND id_aluno = :id_aluno";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id_turma' => $id_turma, ':id_aluno' => $id_aluno]);
        return $stmt->fetchColumn() > 0;
    }
    
    /**
    * Faz a matricula de um aluno em uma turma
    * @param int $id_turma
    * @param int $id_aluno
    */
    public function criar($id_turma, $id_aluno)
    {
        $sql = "INSERT INTO matriculas (id_turma, id_aluno)
                VALUES (:id_turma, :id_aluno)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id_turma' => $id_turma, ':id_aluno' => $id_aluno]);
    }

    /**
    * Remove a matricula de um aluno em uma turma
    * @param int $id_turma
    * @param  $ids_aluno
    */
   public function remover($id_turma, array $ids_aluno)
    {
        if (empty($ids_aluno)) return false;

        $placeholders = [];
        $params = [':id_turma' => $id_turma];
        foreach ($ids_aluno as $index => $id) {
            $key = ":id$index";
            $placeholders[] = $key;
            $params[$key] = $id;
        }

        $sql = "DELETE FROM matriculas 
                WHERE id_turma = :id_turma AND id_aluno IN (" . implode(',', $placeholders) . ")";
        
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($params);
    }
}