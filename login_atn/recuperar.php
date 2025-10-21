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
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

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
					<!-- Ícone de interrogação com tooltip -->
					<span
						class="ms-2 tooltip-green"
						data-bs-toggle="tooltip"
						data-bs-placement="top"
						title="Para obter o cadastro, entre em contato com o gestor de sua secretaria.">
						<i class="bi bi-question-circle"></i>
					</span>
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
	<script>
		const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
		const tooltipList = [...tooltipTriggerList].map(t => new bootstrap.Tooltip(t))
	</script>
</body>

</html>
