<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Secretaria - FIAP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo asset('css/home.css') ?>" rel="stylesheet">
</head>
<body>
    <div class="container d-flex flex-column justify-content-center align-items-center vh-100 text-center">
        <div class="box p-4 mb-4 shadow-sm d-flex flex-column gap-3 align-items-center">
            <h1 class="mb-4 mt-4 fw-bold">Secretaria - FIAP</h1>

            <div class="d-flex flex-column gap-3 w-100" style="max-width: 300px;">
                <a href="<?php echo url('Aluno') ?>" class="btn pink-btn btn-lg">Gerenciamento de alunos</a>
                <a href="<?php echo url('Turma') ?>" class="btn pink-btn btn-lg">Turmas e matrículas</a>
                <a href="<?php echo url('Administrador') ?>" class="btn pink-btn btn-lg">Cadastro de administradores</a>
                <a href="<?php echo url('Login/sair') ?>" class="btn pink-btn btn-lg">Sair</a>
            </div>
         </div>
    </div>
</body>
</html>
