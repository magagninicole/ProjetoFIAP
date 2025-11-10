<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title><?php echo isset($administrador) ? 'Editar administrador' : 'Cadastrar administrador' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo asset('css/alunos.css') ?>" rel="stylesheet">
</head>
<body style="background-color: #15191A;">
<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-sm p-4" style="width: 400px;">
        <div class="card-body d-flex flex-column gap-3">
            <h3 class="text-center mb-4"><?php echo isset($administrador) ? 'Editar administrador' : 'Cadastro de administrador' ?></h3>

            <?php if (!empty($erros)){ ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php foreach($erros as $erro){ ?>
                            <li><?php echo htmlspecialchars($erro) ?></li>
                        <?php } ?>
                    </ul>
                </div>
            <?php } ?>

            <form method="POST" action="<?php echo isset($administrador) ? url('Administrador/atualizar/'.$administrador['id_admin']) : url('Administrador/cadastrar'); ?>" class="d-flex flex-column gap-3">

                <input class="input-sign" type="text" name="nome" placeholder="Nome completo" required
                    value="<?php echo ($administrador['nome'] ?? $dados['nome'] ?? ''); ?>">

                <input class="input-sign" type="text" name="cpf" placeholder="CPF" required
                    value="<?php echo htmlspecialchars($administrador['cpf'] ?? $dados['cpf'] ?? ''); ?>">

                <input class="input-sign" type="email" name="email" placeholder="E-mail" required
                    value="<?php echo htmlspecialchars($administrador['email'] ?? $dados['email'] ?? ''); ?>">

                <?php if(!isset($administrador)){ ?>
                    <input class="input-sign" type="password" name="senha" placeholder="Senha" required>
                <?php } ?>

                <button type="submit" class="btn-pink"><?php echo isset($administrador) ? 'Atualizar' : 'Cadastrar'; ?></button>

            </form>

            <div class="text-center mt-3">
                <a href="<?php echo url('Administrador') ?>" class="btn btn-gray">← Voltar à lista</a>
            </div>
        </div>
    </div>
</div>

<?php if(isset($administrador)){ ?>
<div id="modalSenha" class="modal fade">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-4">
            <h5 class="mb-3">Atualizar Senha</h5>
            <form method="POST" action="<?php echo url('Administrador/atualizarSenha/'.$administrador['id']) ?>" class="d-flex flex-column gap-2">
                <input type="password" name="senha" class="form-control" placeholder="Nova senha" required>
                <?php if(!empty($erros_senha['senha'])){ ?>
                    <div class="text-danger"><?php echo htmlspecialchars($erros_senha['senha']) ?></div>
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
