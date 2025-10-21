<!doctype html>
<html lang="pt-br">

<head>
    <link rel="shortcut icon" href="assets/images/icon_painel.png" type="image/x-icon">
    <title>Painel Admin - Registro</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/control.css">
</head>

<body>
    <div class="d-flex align-items-center justify-content-center vh-100" style="background-color: #f8f9fa;">
        <div class="login-wrapper">
            <!-- Lado da logo -->
            <div class="logo-side">
                <img src="assets/images/Painel.png" alt="Logo">
            </div>

            <!-- Formulário de registro -->
            <div class="login-form">
                <h1 class="mb-4">Criar Conta</h1>
                <form action="actions/verifica_registro.php" method="POST">
                    <input type="hidden" name="ip" id="ip">

                    <!-- Nome completo -->
                    <div class="mb-3">
                        <label for="nome">Nome completo</label>
                        <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite seu nome completo" required autocomplete="name">
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email">E-mail</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu e-mail" required>
                    </div>

                    <!-- Senha -->
                    <div class="password-wrapper">
                        <label for="senha">Senha</label>
                        <div class="password-inner">
                            <input type="password" class="form-control" id="senha" name="password" placeholder="Crie uma senha" required>
                            <button type="button" id="toggleSenha">
                                <i class="bi bi-eye-slash"></i>
                            </button>
                        </div>
                        <small class="form-text text-end" style="font-size: 0.75rem;">
                            Use letras maiúsculas, minúsculas e números
                        </small>
                    </div>

                    <!-- Botão criar conta -->
                    <button type="submit" name="btn-login" class="btn btn-primary mb-3">Criar Conta</button>

                    <!-- Link voltar para login -->
                    <p class="text-center mb-0">
                        <a href="index.php">Voltar para o login</a>
                    </p>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>
