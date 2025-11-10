<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title><?php echo isset($turma) ? 'Editar Turma' : 'Cadastro de Turma' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo asset('css/turmas.css') ?>" rel="stylesheet">
</head>
<body style="background-color: #15191A;">
<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-sm p-4" style="width: 400px;">
        <div class="card-body d-flex flex-column gap-3">
            <h3 class="text-center mb-4"><?php echo isset($turma) ? 'Editar Turma' : 'Cadastro de Turma' ?></h3>

            <?php if (!empty($erros)){ ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php foreach($erros as $erro){ ?>
                            <li><?php echo $erro ?></li>
                        <?php } ?>
                    </ul>
                </div>
            <?php } ?>

            <form method="POST" action="<?php echo url('Turma/cadastrar' . (isset($turma) ? '/'.$turma['id_turma'] : '')) ?>" class="d-flex flex-column gap-3">
                <input type="text" name="nome_turma" class="input-sign" placeholder="Nome da Turma" required
                       value="<?php echo htmlspecialchars($turma['nome_turma'] ?? '') ?>">
                <textarea name="descricao" class="input-sign" placeholder="Descrição da Turma" rows="3"><?php echo htmlspecialchars($turma['descricao'] ?? '') ?></textarea>

                <button type="submit" class="btn-pink"><?php echo isset($turma) ? 'Atualizar' : 'Cadastrar' ?></button>
            </form>

            <div class="text-center mt-3">
                <a href="<?php echo url('Turma') ?>" class="btn btn-gray">← Voltar à lista</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>
