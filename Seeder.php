<?php
require_once __DIR__ . '/vendor/autoload.php';

$host = 'localhost';
$dbname = 'secretaria_fiap';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT COUNT(*) as total FROM administradores";
    $count = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC)['total'];

    if ($count > 0) {
        exit;
    }

    $nome = 'Administrador Padrão';
    $email = 'admin@fiap.com';
    $cpf = '000.000.000-00';
    $senha = password_hash('123456', PASSWORD_DEFAULT); 
    

    $insert = $pdo->prepare("INSERT INTO administradores (nome, cpf, email, senha) VALUES (:nome, :cpf, :email, :senha)");
    $insert->bindValue(':nome', $nome);
    $insert->bindValue(':cpf', $cpf);
    $insert->bindValue(':email', $email);
    $insert->bindValue(':senha', $senha);
    $insert->execute();

    echo "Administrador criado com sucesso!\n";
    echo "Usuário: $email\n";
    echo "Senha: 123456\n";

} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage() . "\n";
}
