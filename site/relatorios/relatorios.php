<?php
require_once "../assets/secure/acesso.php";
require_once "../config/pdo_database.php";

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Secretaria da Saúde</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.ico" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>

  <!-- ======= Top Bar ======= -->
  <div id="topbar" class="d-flex align-items-center fixed-top">
    <div class="container d-flex align-items-center justify-content-center justify-content-md-between">
      <div class="align-items-center d-none d-md-flex">
        <i class="bi bi-clock"></i><span id="MyDateDisplay" style="padding-right: 5px;"></span>-<span id="MyClockDisplay" style="padding-left: 5px;"></span>
      </div>
      <div class="d-flex align-items-center">
        <i class="bi bi-phone"></i> Telefonista - (54) 3381-9052
      </div>
    </div>
  </div>
  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <a href="../sus/welcome.php" class="logo me-auto"><img src="assets/img/brasao.png" alt=""><span style="font-size: 20px; padding-left: 10px;">Secretaria da Saúde - Relatórios</span></a>
      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link scrollto" href="../sus/welcome.php#home">Home</a></li>
          <li><a class="nav-link scrollto" href="#report">Relatórios</a></li>
          <li><a class="nav-link scrollto" href="../sus/welcome.php#services">Serviços</a></li>
          <li><a class="nav-link scrollto" href="../sus/welcome.php#about">Sobre</a></li>
          <li><a class="nav-link scrollto" href="../sus/welcome.php#location">Localização</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

      <a href="../chamados/sair.php" class="appointment-btn scrollto"><span class="d-none d-md-inline">Sair do
          Sistema</span></a>

    </div>
  </header><!-- End Header -->

  <main id="main">
    <br><br><br>
    <!-- ======= Featured Services Section ======= -->
    <section id="report" class="featured-services">
      <div class="container" data-aos="fade-up">
        <div class="section-title">
          <h2>Relatórios</h2>
        </div>

        <div class="row justify-content-center">
          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
              <div class="icon"><i class="fas fa-calendar-day"></i></div>
              <h4 class="title"><a href="diario.php">Diário</a></h4>
              <p class="description">Relatório completo dos atendimentos <b>diários</b>.</p>
            </div>
          </div>
          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
              <div class="icon"><i class="fas fa-calendar-week"></i></div>
              <h4 class="title"><a href="semanal.php">Semanal</a></h4>
              <p class="description">Relatório completo dos atendimentos <b>semanais</b>.</p>
            </div>
          </div>
          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
              <div class="icon"><i class="fas fa-calendar-alt"></i></div>
              <h4 class="title"><a href="mensal.php">Mensal</a></h4>
              <p class="description">Relatório completo dos atendimentos <b>mensais</b>.</p>
            </div>
          </div>
          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="300">
              <div class="icon"><i class="fas fa-calendar"></i></div>
              <h4 class="title"><a href="anual.php">Anual</a></h4>
              <p class="description">Relatório completo dos atendimentos <b>anuais</b>.</p>
            </div>
          </div>
        </div>
      </div>
    </section><!-- End Featured Services Section -->
    <section class="counts" style="padding-top: 0px; padding-bottom: 20px;">
      <div class="container" data-aos="fade-up">
        <div class="section-title">
          <h2>sobre o trabalho </h2>
        </div>
        <?php
        $consulta = $pdo->prepare("SELECT COUNT(*) AS total_concluidos FROM chamados WHERE status = 'concluido'");
        $consulta->execute();
        $concluido = $consulta->fetch(PDO::FETCH_ASSOC);

        $consulta = $pdo->prepare("SELECT COUNT(*) AS total_cancelados FROM chamados WHERE status = 'cancelado'");
        $consulta->execute();
        $cancelado = $consulta->fetch(PDO::FETCH_ASSOC);

        $consulta = $pdo->prepare("SELECT COUNT(*) AS total_chamados FROM chamados WHERE status <> 'aberto'");
        $consulta->execute();
        $todos = $consulta->fetch(PDO::FETCH_ASSOC);

        $consulta = $pdo->prepare("SELECT COUNT(id_atendimento) AS total_telefone FROM atendimentos_externos");
        $consulta->execute();
        $todos_telefone = $consulta->fetch(PDO::FETCH_ASSOC);

        ?>
        <div class="content-header" style="text-align: center; padding-top: 5px; padding-bottom: 5px;">
          <h4>Internos / Externos</h4>
        </div>
        <div class="row no-gutters">
          <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch">
            <div class="count-box">
              <i class="fas fa-check-circle"></i>
              <span data-purecounter-start="0" data-purecounter-end="<?php echo $concluido['total_concluidos']; ?>" data-purecounter-duration="5" class="purecounter"></span>
              <p><strong>Concluídos</strong> atendimentos realizados com sucesso.</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch">
            <div class="count-box">
              <i class="fas fa-times-circle"></i>
              <span data-purecounter-start="0" data-purecounter-end="<?php echo $cancelado['total_cancelados']; ?>" data-purecounter-duration="5" class="purecounter"></span>
              <p><strong>Cancelados</strong> atendimentos que foram cancelados por algum motivo.</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch">
            <div class="count-box">
              <i class="fas fa-hospital-user"></i>
              <span data-purecounter-start="0" data-purecounter-end="<?php echo $todos['total_chamados']; ?>" data-purecounter-duration="5" class="purecounter"></span>
              <p><strong>Total de Atendimentos</strong> Atendimentos realizados pela regulação.</p>
              <br>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch">
            <div class="count-box">
              <i class="fas fa-hospital-user"></i>
              <span data-purecounter-start="0" data-purecounter-end="<?php echo $todos_telefone['total_telefone']; ?>" data-purecounter-duration="5" class="purecounter"></span>
              <p><strong>Externos</strong> Atendimentos realizados pelo telefone.</p>
              <a href="#services">Saiba mais nos relatórios &raquo;</a>
            </div>
          </div>

        </div>
      </div>
    </section>
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span><a href="https://pmsoledaders.inf.br">DTI</a></span></strong>. Todos os direitos
        reservados
        <i class="bi bi-info-circle" style="padding-left: 10px;"><?php 
        require_once '../assets/functions/versao.php';
        $id_ver = 5; 
        $versao = acertaValor($id_ver);
       echo 'Versão ',  $versao; 
        ?></i>
      </div>
    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <script src="assets/js/control.js"></script>


</body>

</html>