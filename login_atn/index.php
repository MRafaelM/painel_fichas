<!DOCTYPE html>
<html lang="pt-BR">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="assets/images/icon_painel.png" type="image/x-icon">
	<title>ADM | Login</title>

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
			<h1>Área do Atendente</h1>
			<form action="actions/verifica.php" method="POST">

				<input type="hidden" name="ip" id="ip">
				<!-- Email -->
				<div class="mb-3">
					<label for="email">E-mail</label>
					<input type="email" class="form-control" id="email" name="email" placeholder="Digite seu e-mail" required autofocus autocomplete="email">
				</div>

				<!-- Senha -->
				<div class="password-wrapper">
					<label for="senha">Senha</label>
					<div class="password-inner">
						<input type="password" class="form-control" id="senha" name="password" placeholder="Digite sua senha" required>
						<button type="button" id="toggleSenha">
							<i class="bi bi-eye-slash"></i>
						</button>
					</div>
				</div>

				<!-- Botão Entrar -->
				<button type="submit" class="btn btn-primary mb-3">Entrar</button>

				<!-- Botões auxiliares -->
				<div class="d-flex justify-content-between">
					<a href="recuperar.php" class="btn btn-outline-secondary">Esqueci minha senha</a>
				</div>
			</form>
		</div>


		<!-- Logo -->
		<div class="logo-side">
			<img src="assets/images/Painel.png" class="img-fluid" alt="Logo do Sistema">
		</div>
	</div>

	<!-- Scripts -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
	<script src="assets/js/script.js"></script>
</body>

</html>