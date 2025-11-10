<?php require __DIR__ . '/../outros/mensagem.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Alunos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo asset('css/alunos.css') ?>" rel="stylesheet">
</head>
<body>
<div class="container my-5 d-flex flex-column align-items-center">
    <h2 class="mb-4">Lista de Alunos</h2>
    <form method="GET" action="<?php echo url('Aluno') ?>" class="d-flex gap-2 mb-3 w-100" style="max-width: 500px;">
        <input type="text" name="nome" class="form-control" placeholder="Filtrar por nome" 
               value="<?php echo htmlspecialchars($_GET['nome'] ?? '') ?>" />
        <button type="submit" class="btn-pink">Filtrar</button>
        <a href="<?php echo url('Aluno') ?>" class="btn-gray">Limpar</a>
    </form>

    <div class="mb-3 w-100 text-end" style="max-width: 500px;">
        <a href="<?php echo url('Aluno/cadastrar') ?>" class="btn-pink">+ Novo Aluno</a>
    </div>
    <div class="table-responsive" style="max-width: 1000px;">
        <table class="table table-striped table-bordered text-center">
            <thead class="table-gray">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Nascimento</th>
                    <th>CPF</th>
                    <th>Email</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($alunos['dados'] as $aluno){ ?>
                <tr>
                    <td><?php echo $aluno['id_aluno'] ?></td>
                    <td><?php echo $aluno['nome_aluno'] ?></td>
                    <td><?php echo (new DateTime($aluno['data_nascimento']))->format('d/m/Y'); ?></td>
                    <td><?php echo $aluno['cpf_aluno'] ?></td>
                    <td><?php echo $aluno['email_aluno'] ?></td>
                    <td class="d-flex justify-content-center gap-2">
                        <a href="<?php echo url('Aluno/atualizar/'.$aluno['id_aluno']) ?>" class="btn-gray btn-sm">Editar</a>
                        <form method="POST" action="<?php echo url('Aluno/deletar/'.$aluno['id_aluno']) ?>" 
                              onsubmit="return confirm('Excluir este aluno?');">
                            <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                        </form>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <nav class="mt-3">
        <ul class="pagination justify-content-center">
            <?php for ($i = 1; $i <= $alunos['total_paginas']; $i++){ ?>
                <li class="page-item <?php echo ($i == $alunos['pagina_atual']) ? 'active' : '' ?>">
                    <a class="page-pink" href="<?php echo url('Aluno?pagina='.$i) ?>"><?php echo $i ?></a>
                </li>
            <?php } ?>
        </ul>
    </nav>

    <div class="mt-4">
        <a href="<?php echo url('Home') ?>" class="btn-pink">Voltar</a>
    </div>
</div>
</body>
</html>
