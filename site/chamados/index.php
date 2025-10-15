<?php
require_once "../assets/secure/acesso.php";

require_once "../../config/pdo_database.php";

?>
<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="../assets/img/brasao.png">

  <title>Painel de Chamados</title>

  <!-- Bootstrap core CSS -->
  <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="../assets/dist/css/album.css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

</head>

<body>

  <header>
    <div class="collapse bg-dark" id="navbarHeader">
      <div class="container">
        <div class="row">
          <div class="col-sm-8 col-md-7 py-4">
            <h4 class="text-white">Sobre</h4>
            <p class="text-muted">Orientações claras e eficazes para a regulação de exames, garantindo acesso justo e ágil aos serviços de saúde.</p>
          </div>
          <div class="col-sm-4 offset-md-1 py-4">
            <h4 class="text-white">Contato</h4>
            <ul class="list-unstyled">
              <li><a href="https://soledade.rs.gov.br/" class="text-white" target="_blank">Prefeitura Municipal de Soledade</a></li>
              <li><a href="https://www.soledade.rs.gov.br/pagina/13/secretaria-da-saude" class="text-white" target="_blank">Secretaria da Saúde</a></li>
              <li><a href="https://pmsoledaders.inf.br/" class="text-white" target="_blank">DTI Soledade</a></li>
              <li><br></li>
              <li><a href="sair.php" class="text-white">Sair</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="navbar navbar-dark bg-dark shadow-sm">
      <div class="container d-flex justify-content-between">
        <a href="https://pmsoledaders.inf.br/painel/site/chamados/" class="navbar-brand d-flex align-items-center">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
            <rect x="1" y="3" width="22" height="18" rx="2" ry="2"></rect>
            <line x1="12" y1="9" x2="12" y2="15"></line>
            <line x1="9" y1="12" x2="15" y2="12"></line>
          </svg>
          <strong>Painel de Chamados</strong>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
    </div>
  </header>
  
  <div class="col-sm-4 w-100 h-100 mw-100 m-0 p-0">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="max-height: 100%;">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner" style="max-height: 500px;">
        <div class="carousel-item active">
          <img class="d-block w-100" src="../assets/img/slide/teste2.jpg" alt="First slide">
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="../assets/img/slide/teste4.jpg" alt="Second slide">
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="../assets/img/slide/teste3.jpg" alt="Third slide">
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>

  <main role="main" class="mt-5">
    <div class="container">
      <div class="row">
        <div class="col-sm-4 d-inline">
          <div class="card border-secondary" onclick="window.location.href='chamar.php';">
            <div class="card-content">
              <h4>CHAMADOS</h4>
              <p>Iniciar os chamados</p>
            </div>
          </div>
        </div>
        <?php if ($_SESSION["nivel"] === "Gestor" || $_SESSION["nivel"] === "Mestre") : ?>
          <div class="col-sm-4 d-inline">
            <div class="card border-secondary" onclick="window.location.href='../relatorios/tipos.php';">
              <div class="card-content">
                <h4>RELATÓRIOS</h4>
                <p>Gerar relatórios</p>
              </div>
            </div>
          </div>
        <?php endif; ?>
        <?php if ($_SESSION["nivel"] === "Gestor" || $_SESSION["nivel"] === "Mestre") : ?>
          <div class="col-sm-4 d-inline">
            <div class="card border-secondary" onclick="window.location.href='../users/liberar.php';">
              <div class="card-content">
                <h4>USUÁRIOS</h4>
                <p>Liberar acessos</p>
              </div>
            </div>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </main>



  <footer class="main-footer bg-dark text-white">
    <div class="text-center mx-auto">
      <span>
        &copy;
        <script>
          document.write(new Date().getFullYear());
        </script> Desenvolvidor por <a href="https://pmsoledaders.inf.br/" target="_blank" style="color: white;"><b>DTI
            Prefeitura Municipal de Soledade</b></a>. Todos os direitos reservados.
      </span>
    </div>
  </footer>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script>
    window.jQuery || document.write('<script src="../assets/js/vendor/jquery-slim.min.js"><\/script>')
  </script>
  <script src="../assets/js/vendor/popper.min.js"></script>
  <script src="../assets/dist/js/bootstrap.min.js"></script>
  <script src="../assets/js/vendor/holder.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>