<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Secretaria - FIAP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo asset('css/home.css') ?>" rel="stylesheet">
</head>
<body>
    <div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="box p-4 shadow-sm" style="max-width: 350px; width: 100%;">
        <h1 class="mb-4 fw-bold text-center">Secretaria  FIAP</h1>

        <?php if (!empty($dados['erro'])){ ?>
            <p class="text-danger text-center"><?php echo $dados['erro']; ?></p>
        <?php } ?>

        <form action="<?php echo url('Login/autenticar') ?>" method="POST">
            <input class="input-login mb-3 w-100" type="email" name="email" placeholder="E-mail" required>
            <input class="input-login mb-3 w-100" type="password" name="senha" placeholder="Senha" required>
            <button class="btn w-100" type="submit">Entrar</button>
        </form>
    </div>
</div>
</body>
</html>
