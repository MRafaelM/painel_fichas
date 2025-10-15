<!doctype html>
<html lang="en">

<head>
    <title>Painel SUS - Recuperar</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="assets/images/brasao.ico">
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
                    <div class="wrap d-md-flex" style="background:  #8adce5;">
                        <div class="login-wrap p-4 p-md-5">
                            <div class="d-flex">
                                <img class="img-fluid img-responsive" src="assets/images/brasao.png" alt="Brasão">
                            </div>
                            <div class="d-flex">
                                <div id="card-nome" class="w-100" style="padding-top: 15px;">
                                    <h3 class="text-center">Prefeitura Municipal de Soledade<br></h3>
                                  
                                </div>
                            </div>
                        </div>
                        <div id="card-form" class="login-wrap p-4 p-md-5">
                            <div class="d-flex">
                                <div class="w-100">
                                    <h3 class="mb-4 text-center">Painel de chamados do SUS</h3>
                                </div>
                            </div>
                            <div class="w-100">
                                <h5 class="mb-2 text-center">Recuperar senha</h5>
                            </div>
                            <form action="actions/verifica_recuperar.php" class="signin-form" method="POST">
                                <input type="hidden" name="ip" id="ip">

                                <div class="form-group mb-3">
                                    <label class="label" for="email">Email do usuário</label>
                                    <input id="email" name="email" type="email" class="form-control" placeholder="Coloque seu email" required style="background-color: #E8F0FE;">
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="btn-trocar" class="form-control btn btn-primary btn-recover rounded submit px-3">Recuperar</button>
                                </div>
                            </form>
                            <p class="text-center"><a href="index.php">Voltar para o login</a></p>
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
				// Remove a classe se ela já estiver aplicada
				img.classList.remove('rotate');
				// Força o reflow para reiniciar a animação
				void img.offsetWidth; // Acesso forçado ao offsetWidth
				// Adiciona a classe para iniciar a animação
				img.classList.add('rotate');
			});
		});
	</script>
</body>

</html>