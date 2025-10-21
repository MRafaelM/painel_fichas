<!doctype html>
<html lang="pt-BR">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="assets/images/icon_painel.png" type="image/x-icon">
	<title>ADM | Recuperar Senha</title>

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
			<h1>Recuperar acesso</h1>
			<p class="text-muted mb-4">Insira o e-mail cadastrado e siga as instruções enviadas.</p>

			<form action="actions/verifica_recuperar.php" method="POST" novalidate>
				<input type="hidden" name="ip" id="ip">

				<!-- Email -->
				<div class="mb-3">
					<label for="email">E-mail</label>
					<input
						type="email"
						class="form-control"
						id="email"
						name="email"
						placeholder="Digite seu e-mail cadastrado"
						required
						autocomplete="email"
						autocapitalize="off"
						autocorrect="off"
					>
				</div>

				<!-- Botão Recuperar -->
				<button type="submit" name="btn-trocar" class="btn btn-primary mb-3 w-100">Recuperar</button>

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
	<script src="assets/js/script.js"></script> <!-- seu script geral (toggle senha etc.) -->
</body>

</html>
