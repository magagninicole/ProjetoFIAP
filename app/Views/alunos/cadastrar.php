<?php if (!empty($mensagem)){ ?>
    <div style="
        padding: 10px 15px;
        margin-bottom: 15px;
        border-radius: 5px;
        color: white;
        background-color: <?php echo $mensagem['tipo'] === 'sucesso' ? '#28a745' : '#dc3545' ?>;
    ">
        <?php echo htmlspecialchars($mensagem['texto']) ?>
    </div>
<?php } ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title><?php echo isset($aluno) ? 'Editar Aluno' : 'Cadastrar Aluno' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo asset('css/alunos.css') ?>" rel="stylesheet">
</head>
<body style="background-color: #15191A;">
<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-sm p-4" style="width: 400px;">
        <div class="card-body d-flex flex-column gap-3">
            <h3 class="text-center mb-4"><?php echo isset($aluno) ? 'Editar Aluno' : 'Cadastro de Aluno' ?></h3>

            <?php if (!empty($erros)){ ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php foreach($erros as $erro){ ?>
                            <li><?php echo $erro ?></li>
                        <?php } ?>
                    </ul>
                </div>
            <?php } ?>

            <form method="POST" action="<?php echo isset($aluno) ? url('Aluno/atualizar/'.$aluno['id_aluno']) : url('Aluno/cadastrar') ?>" class="d-flex flex-column gap-3">
                <input class="input-sign" type="text" name="nome_aluno" placeholder="Nome completo" required
                       value="<?php echo htmlspecialchars($aluno['nome_aluno'] ?? $dados['nome_aluno'] ?? '') ?>">
                <input class="input-sign" type="date" name="data_nascimento" required
                       value="<?php echo htmlspecialchars($aluno['data_nascimento'] ?? $dados['data_nascimento'] ?? '') ?>">
                <input class="input-sign" type="text" name="cpf_aluno" placeholder="CPF" required
                       value="<?php echo htmlspecialchars($aluno['cpf_aluno'] ?? $dados['cpf_aluno'] ?? '') ?>">
                <input class="input-sign" type="email" name="email_aluno" placeholder="E-mail" required
                       value="<?php echo htmlspecialchars($aluno['email_aluno'] ?? $dados['email_aluno'] ?? '') ?>">

                <?php if(!isset($aluno)){ ?>
                    <input class="input-sign" type="password" name="senha_aluno" placeholder="Senha" required>
                <?php } ?>

                <button type="submit" class="btn-pink"> <?php echo isset($aluno) ? 'Atualizar' : 'Cadastrar' ?> </button>
            </form>

            <?php if(isset($aluno)){ ?>
                <div class="text-center mt-3">
                    <button class="btn btn-gray" onclick="abrirModalSenha()">Alterar Senha</button>
                </div>
            <?php } ?>

            <div class="text-center mt-3">
                <a href="<?php echo url('Aluno') ?>" class="btn btn-gray">← Voltar à lista</a>
            </div>
        </div>
    </div>
</div>

<?php if(isset($aluno)){ ?>
<div id="modalSenha" class="modal fade">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-4">
            <h5 class="mb-3">Atualizar Senha</h5>
            <form method="POST" action="<?php echo url('Aluno/atualizarSenha/'.$aluno['id_aluno']) ?>" class="d-flex flex-column gap-2">
                <input type="password" name="senha_aluno" class="form-control" placeholder="Nova senha" required>
                <?php if(!empty($erros_senha['senha_aluno'])){ ?>
                    <div class="text-danger"><?php echo htmlspecialchars($erros_senha['senha_aluno']) ?></div>
                <?php } ?>
                <div class="d-flex gap-2 mt-2">
                    <button type="submit" class="btn btn-pink flex-fill">Salvar</button>
                    <button type="button" class="btn btn-danger flex-fill" onclick="fecharModalSenha()">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php } ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
function abrirModalSenha() {
    var modalEl = document.getElementById('modalSenha');
    var modal = new bootstrap.Modal(modalEl);
    modal.show();
}
function fecharModalSenha() {
    var modalEl = document.getElementById('modalSenha');
    var modal = bootstrap.Modal.getInstance(modalEl);
    if(modal) modal.hide();
}
</script>
</body>
</html>
