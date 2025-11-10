<?php require __DIR__ . '/../outros/mensagem.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Turmas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo asset('css/turmas.css') ?>" rel="stylesheet">
</head>
<body>
<div class="container my-5 d-flex flex-column align-items-center">
    <h2 class="mb-4">Lista de Turmas</h2>

    <div class="mb-3 w-100 text-end" style="max-width: 500px;">
        <a href="<?php echo url('Turma/cadastrar') ?>" class="btn-pink">+ Nova Turma</a>
    </div>

    <div class="table-responsive" style="max-width: 1000px;">
        <table class="table table-striped table-bordered text-center">
            <thead class="table-gray">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Total de Alunos</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($turmas['dados'] as $turma){ ?>
                <tr>
                    <td><?php echo $turma['id_turma'] ?></td>
                    <td><?php echo $turma['nome_turma'] ?></td>
                    <td><?php echo $turma['descricao'] ?></td>
                    <td><?php echo $turma['total_alunos'] ?></td>
                    <td class="d-flex justify-content-center gap-2">
                        <a href="<?php echo url('Turma/cadastrar/'.$turma['id_turma']) ?>" class="btn-gray btn-sm">Editar</a>
                        <form method="POST" action="<?php echo url('Turma/deletar/'.$turma['id_turma']) ?>" 
                              onsubmit="return confirm('Excluir esta turma?');">
                            <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                        </form>
                        <a href="<?php echo url('Matricula/obterMatriculas/'.$turma['id_turma']) ?>" class="btn-pink btn-sm">Gerenciar matrículas</a>
                    </td>
                </tr>
                <?php }?>
            </tbody>
        </table>
    </div>

    <!-- Paginação -->
    <nav class="mt-3">
        <ul class="pagination justify-content-center">
            <?php for ($i = 1; $i <= $turmas['total_paginas']; $i++){ ?>
                <li class="page-item <?php echo ($i == $turmas['pagina_atual']) ? 'active' : '' ?>">
                    <a class="page-pink" href="<?php echo url('Turma?pagina='.$i) ?>"><?php echo $i ?></a>
                </li>
            <?php }?>
        </ul>
    </nav>

    <div class="mt-4">
        <a href="<?php echo url('Home') ?>" class="btn-pink">Voltar</a>
    </div>
</div>
</body>
</html>
