<?php $chave = filter_input(INPUT_GET, 'chave', FILTER_DEFAULT); ?>

<!doctype html>
<html lang="pt-BR">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="assets/images/icon_painel.png" type="image/x-icon">
	<title>ADM | Atualizar Senha</title>

	<!-- Bootstrap 5 -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

	<!-- Ícones -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

	<!-- CSS -->
	<link rel="stylesheet" href="assets/css/reset.css">
	<link rel="stylesheet" href="assets/css/control.css">
</head>

<body>
	<div class="login-wrapper">
		<!-- Formulário -->
		<div class="login-form">
			<h1>Atualizar senha</h1>
			<p class="text-muted mb-4">Crie uma nova senha para continuar o acesso ao sistema.</p>

			<form action="actions/verifica_atualizar.php" method="POST" novalidate>
				<!-- Nova senha -->
				<div class="mb-3">
					<label for="password">Nova senha</label>
					<div class="password-inner">
						<input type="password" class="form-control" id="senha" name="password" placeholder="Digite sua senha" required>
						<button type="button" id="toggleSenha">
							<i class="bi bi-eye-slash"></i>
						</button>
					</div>
					<small class="text-muted">Use letras maiúsculas, minúsculas, números e símbolos.</small>
				</div>

				<input type="hidden" name="chave" value="<?= htmlspecialchars($chave) ?>">

				<!-- Botão Atualizar -->
				<button type="submit" name="btn-altera" class="btn btn-primary mb-3 w-100">Atualizar senha</button>

				<!-- Botões auxiliares -->
				<div class="d-flex justify-content-between">
					<a href="index.php" class="btn btn-outline-secondary">Voltar para o login</a>
					<a href="registro.php" class="btn btn-outline-primary">Cadastrar-se</a>
				</div>

				<div class="mt-3">
					<a href="../login_atn/" class="link-colaborador">Portal do colaborador</a>
				</div>
			</form>
		</div>

		<!-- Logo (lado direito) -->
		<div class="logo-side">
			<img src="assets/images/Painel.png" class="img-fluid" alt="Logo do Sistema">
		</div>
	</div>

	<!-- Scripts -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
	<script src="assets/js/script.js"></script>
    
</body>

</html>
