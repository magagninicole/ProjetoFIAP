<?php

namespace App\Models;

use App\Core\Model;
use PDO;

class Administrador extends Model
{

    /**
    * Listar administradores
    */
    public function listar() {
        $stmt = $this->conn->query("
            SELECT id_admin, nome, cpf, email
            FROM administradores
            ORDER BY id_admin DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
    * Cadastrar administrador
    * @param string $nome
    * @param string $cpf
    * @param string $email
    * @param string $senha
    */
    public function criar($nome, $cpf, $email, $senha) {
        $sql = "INSERT INTO administradores (nome, cpf, email, senha)
                VALUES (:nome, :cpf, :email, :senha)";
        $stmt = $this->conn->prepare($sql);
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        return $stmt->execute([
            ':nome' => $nome,
            ':cpf' => $cpf,
            ':email' => $email,
            ':senha' => $senhaHash
        ]);
    }

    /**
    * Buscar administrador por e-mail
    * @param string $email
    */
    public function buscarPorEmail($email) {
        $sql = "SELECT * FROM administradores WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
    * Buscar administrador por id
    * @param int $id
    */
    public function buscarPorId($id) {
        $stmt = $this->conn->prepare("SELECT * FROM administradores WHERE id_admin = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
    * Deletar administrador
    * @param int $id
    */
    public function deletar($id) {
        $stmt = $this->conn->prepare("DELETE FROM administradores WHERE id_admin = :id");
        return $stmt->execute([':id' => $id]);
    }


    /**
    * Atualizar administrador
    * @param int $id
    * @param string $nome
    * @param string $cpf 
    * @param string $email
    * @param string|null $senha
    */
    public function atualizar($id, $nome, $cpf, $email, $senha = null) {
        if ($senha) {
            $sql = "UPDATE administradores
                    SET nome=:nome, cpf=:cpf, email=:email, senha=:senha
                    WHERE id_admin=:id";
            $stmt = $this->conn->prepare($sql);
            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
            return $stmt->execute([
                ':nome' => $nome,
                ':cpf' => $cpf,
                ':email' => $email,
                ':senha' => $senhaHash,
                ':id' => $id
            ]);
        } else {
            $sql = "UPDATE administradores
                    SET nome=:nome, cpf=:cpf, email=:email
                    WHERE id_admin=:id";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([
                ':nome' => $nome,
                ':cpf' => $cpf,
                ':email' => $email,
                ':id' => $id
            ]);
        }
    }

    /**
    * Buscar a listagem por nome para o filtro 
    * @param string $nome
    */
     public function listarPorNome($nome)
    {
        $sql = "SELECT id_admin, nome,  cpf, email, criado_em
                FROM administradores
                WHERE nome LIKE :nome
                ORDER BY nome ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':nome' => "%$nome%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
