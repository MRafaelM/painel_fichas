<!doctype html>
<html lang="pt-br">

<head>
	<title>Painel SUS - Entrar</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
	<link rel="icon" type="image/x-icon" href="assets/images/brasao.ico">
	<link rel="stylesheet" href="assets/css/reset.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/control.css">
	<script>
		// Função para obter o IP do navegador
		function getIP() {
			fetch('https://api.ipify.org?format=json')
				.then(response => response.json())
				.then(data => {
					var ip = data.ip;
					document.getElementById('ip').value = ip; // Preenche o campo oculto com o IP
				})
				.catch(error => {
					console.log(error);
				});
		}
		// Chama a função para obter o IP
		getIP();
	</script>
</head>

<body>
	<section class="ftco-section" style="margin-top: 50px;">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-12 col-lg-10">
					<div class="wrap d-md-flex" style="background: #8adce5; position: relative;">
						<div class="login-wrap p-4 p-md-5">
							<div class="d-flex">
								<img class="img-fluid img-responsive" src="assets/images/pedraclara.png" alt="Brasão">
							</div>
							<div class="d-flex">
								<div class="w-100" style="padding-top: 15px;">
									<h3 class="text-center">Prefeitura Municipal de Pedra Clara  </h3>
								</div>
							</div>
							<div class="w-100">
								<h5 class="mb-2 text-center">Painel de chamados</h5>
							</div>
						</div>
						<div id="card-form" class="login-wrap p-4 p-md-5">
							<div class="d-flex">
								<div id="card-nome" class="w-100">
									<h3 class="mb-4 text-center">Entrar no sistema</h3>
								</div>
							</div>
							<form action="actions/verifica.php" class="signin-form" method="POST">
								<input type="hidden" name="ip" id="ip">
								<div class="form-group mb-3">
									<label class="label" for="cpf">CPF do usuário</label>
									<input id="cpf" name="cpf" type="text" class="form-control"
										placeholder="Coloque seu cpf" maxlength="14" required>
								</div>
								<div class="form-group mb-3">
									<div class="row align-items-center">
										<div class="col-10" style="padding-right: 0px;">
											<label class="label" for="password">Senha</label>
											<input id="password" name="password" type="password" class="form-control"
												placeholder="Coloque sua senha" minlength="8" required>
										</div>
										<div class="col-2" style="padding-left: 5px; padding-top: 33px;">
											<a onclick="togglePass()"
												class="btn btn-outline-secondary d-flex align-items-center justify-content-center"
												style="width: 100%; height: 47px; border-color: black; cursor: pointer; background-color: #E8F0FE;">
												<i id="eyeIcon" class="far fa-eye-slash" style="color: black;"></i>
											</a>
										</div>
									</div>
									<div class="row align-items-center mb-3">
										<small id="passwordHelp" class="form-text"
											style="font-size: 0.75em; display: block; color: #000000;">
											Caracteres especiais, letras maiúsculas e minúsculas, e números.
										</small>
									</div>
								</div>
								<div class="form-group">
									<button type="submit"
										class="form-control btn btn-primary btn-login rounded submit px-3">Entrar</button>
								</div>
								<div class="form-group d-md-flex">
									<div class="w-50 text-left">
										<label class="checkbox-wrap checkbox-primary mb-0"><b>Lembrar senha</b>
											<input type="checkbox" checked>
											<span class="checkmark"></span>
										</label>
									</div>
									<div class="w-50 text-md-right">
										<a style="color: #007bff;" href="recuperar.php"><b>Esqueci a senha</b></a>
									</div>
								</div>
							</form>
							<p class="text-center text-dark">Não possui acesso? (<a
									style="color: #007bff; font-size: 18px;" href="registro.php">Crie uma conta</a>)</p>
							<p class="w-100 texte-md-text text-center">
								<a href="https://www.gov.br/secom/pt-br/assuntos/noticias/2024/08/agosto-lilas-ministerio-das-mulheres-lanca-campanha-pelo-feminicidio-zero"
									style="color: #FF69B4;" target="_blank" rel="noopener noreferrer">
									Agosto Lilás, saiba mais...
								</a>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/popper.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/main.js"></script>
	<script src="assets/js/control.js"></script>
	<script>
		document.querySelectorAll('.img-fluid').forEach(img => {
			img.addEventListener('click', () => {
				img.classList.remove('rotate');
				void img.offsetWidth;
				img.classList.add('rotate');
			});
		});
	</script>
</body>

</html>