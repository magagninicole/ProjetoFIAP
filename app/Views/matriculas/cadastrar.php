<?php require __DIR__ . '/../outros/mensagem.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta charset="UTF-8">
<title>obterMatriculasAlunos - <?php echo htmlspecialchars($turma['nome_turma']) ?></title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo asset('css/alunos.css') ?>" rel="stylesheet">
</head>
<body style="background-color: #15191A;">

<div class="d-flex justify-content-center align-items-start mt-5 vh-100" >
    <div class="card shadow-sm p-4" style="width: 700px; margin-top:150px;">
        <div class="card-body shadow-sm d-flex flex-column gap-3 align-items-center">
        <h3 class="text-center mb-4">Gerenciar matriculas - <?php echo htmlspecialchars($turma['nome_turma']) ?></h3>

        <?php if (!empty($mensagem)){ ?>
            <div class="alert alert-success text-center">
                <?php echo htmlspecialchars($mensagem['texto']) ?>
            </div>
        <?php } ?>

        <div class="d-flex gap-3 flex-column flex-md-row">
            <div class="flex-fill">
                <h5>Alunos Disponíveis</h5>
                <form method="POST" action="<?php echo url('Matricula/cadastrar/'.$turma['id_turma']) ?>">
                    <div class="form-control" style="height: 200px; overflow-y: auto;">
                        <?php foreach ($alunosDisponiveis as $aluno){ ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="alunos[]" value="<?php echo $aluno['id_aluno'] ?>" id="disponivel_<?php echo $aluno['id_aluno'] ?>">
                            <label class="form-check-label" for="disponivel_<?php echo $aluno['id_aluno'] ?>">
                                <?php echo htmlspecialchars($aluno['nome_aluno']) ?>
                            </label>
                        </div>
                        <?php } ?>
                    </div>
                    <button type="submit" class="btn btn-lg-pink mt-2 w-100">Matricular alunos</button>
                </form>
            </div>

            <div class="flex-fill">
                <h5>Alunos Matriculados</h5>
                <form method="POST" action="<?php echo url('Matricula/deletar/'.$turma['id_turma']) ?>">
                    <div class="form-control" style="height: 200px; overflow-y: auto; ">
                        <?php foreach ($alunosMatriculados as $aluno){ ?>
                        <div class="form-check d-flex justify-content-between align-items-center">
                            <div>
                                <input class="form-check-input" type="checkbox" name="alunos_remover[]" value="<?php echo $aluno['id_aluno'] ?>" id="matriculado_<?php echo $aluno['id_aluno'] ?>">
                                <label class="form-check-label" for="matriculado_<?php echo $aluno['id_aluno'] ?>">
                                    <?php echo htmlspecialchars($aluno['nome_aluno']) ?>
                                </label>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <button type="submit" class="btn btn-danger mt-2 w-100">Remover Selecionados</button>
                </form>
            </div>
        </div>

        <a href="<?php echo url('Turma') ?>" class="btn btn-gray w-100 mt-3">← Voltar à lista</a>
    </div>
    </div>
</div>

</body>
</html>
