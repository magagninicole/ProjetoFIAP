<?php

namespace App\Core;

use PDO;
use PDOException;
use App\Config\Config;

class Model
{
    protected PDO $conn;

    public function __construct()
    {
        $dsn = "mysql:host=" . Config::$DB['host'] . ";dbname=" . Config::$DB['name'] . ";charset=utf8mb4";

        try {
            $this->conn = new PDO(
                $dsn,
                Config::$DB['user'],
                Config::$DB['pass'],
                [
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
                ]
            );

            // Configurações do PDO
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erro de conexão com o banco de dados: " . $e->getMessage());
        }
    }

    protected function query(string $sql, array $params = []): PDOStatement
    {
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
}
