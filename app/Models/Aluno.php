<?php

namespace App\Models;

use App\Core\Model;
use PDO;

class Aluno extends Model
{

    /**
    * Listar alunos
    */
    public function listar()
    {
        $stmt = $this->conn->query("
            SELECT id_aluno, nome_aluno, data_nascimento, cpf_aluno, email_aluno, criado_em
            FROM alunos
            ORDER BY id_aluno DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
    * Cadastrar aluno
    * @param string $nome
    * @param string $data_nascimento
    * @param string $cpf 
    * @param string $email
    * @param string|null $senha
    */
    public function criar($nome, $data_nascimento, $cpf, $email, $senha)
    {
        $sql = "INSERT INTO alunos (nome_aluno, data_nascimento, cpf_aluno, email_aluno, senha_aluno)
                VALUES (:nome, :data_nascimento, :cpf, :email, :senha)";
        $stmt = $this->conn->prepare($sql);
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        return $stmt->execute([
            ':nome' => $nome,
            ':data_nascimento' => $data_nascimento,
            ':cpf' => $cpf,
            ':email' => $email,
            ':senha' => $senhaHash
        ]);
    }
    
    /**
    * Listar alunos por nome para o filtro
    * @param string $nome
    */
    public function listarPorNome($nome)
    {
        $sql = "SELECT id_aluno, nome_aluno, data_nascimento, cpf_aluno, email_aluno, criado_em
                FROM alunos
                WHERE nome_aluno LIKE :nome
                ORDER BY nome_aluno ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':nome' => "%$nome%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

       
    /**
    * Evita duplicidade de CPF ou Email ao cadastrar ou atualizar
    * @param string $cpf
    * @param string $email
    * @param int|null $idAtual
    */
    public function existeCpfOuEmail($cpf, $email, $idAtual = null)
    {
        $sql = "SELECT COUNT(*) FROM alunos WHERE (cpf_aluno = :cpf OR email_aluno = :email)";
        
        // Se estiver atualizando, ignoramos o próprio registro
        if ($idAtual) {
            $sql .= " AND id_aluno != :id";
        }

        $stmt = $this->conn->prepare($sql);
        $params = [':cpf' => $cpf, ':email' => $email];
        if ($idAtual) {
            $params[':id'] = $idAtual;
        }
        $stmt->execute($params);
        return $stmt->fetchColumn() > 0;
    }


    /**
    * Deletar aluno
    * @param int $id
    */
    public function deletar($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM alunos WHERE id_aluno = :id");
        return $stmt->execute([':id' => $id]);
    }

    public function buscarPorId($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM alunos WHERE id_aluno = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    
    /**
    * Atualizar aluno
    * @param int $id
    * @param string $nome
    * @param string $data_nascimento   
    * @param string $cpf 
    * @param string $email
    * @param string|null $senha
    */
    public function atualizar($id, $nome, $data_nascimento, $cpf, $email, $senha = null)
    {
        if ($senha) {
            $sql = "UPDATE alunos
                    SET nome_aluno = :nome, data_nascimento = :data_nascimento,
                        cpf_aluno = :cpf, email_aluno = :email, senha_aluno = :senha
                    WHERE id_aluno = :id";
            $stmt = $this->conn->prepare($sql);
            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
            return $stmt->execute([
                ':nome' => $nome,
                ':data_nascimento' => $data_nascimento,
                ':cpf' => $cpf,
                ':email' => $email,
                ':senha' => $senhaHash,
                ':id' => $id
            ]);
        } else {
            $sql = "UPDATE alunos
                    SET nome_aluno = :nome, data_nascimento = :data_nascimento,
                        cpf_aluno = :cpf, email_aluno = :email
                    WHERE id_aluno = :id";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([
                ':nome' => $nome,
                ':data_nascimento' => $data_nascimento,
                ':cpf' => $cpf,
                ':email' => $email,
                ':id' => $id
            ]);
        }
    }
}
