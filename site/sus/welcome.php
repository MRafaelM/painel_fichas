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

      <a href="welcome.php" class="logo me-auto"><img src="assets/img/brasao.png" alt=""><span style="font-size: 20px; padding-left: 10px;">Secretaria da Saúde - Painel Eletrônico</span></a>
      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link scrollto " href="#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="#services">Serviços</a></li>
          <li><a class="nav-link scrollto" href="#about">Sobre</a></li>
          <li><a class="nav-link scrollto" href="#location">Localização</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

      <a href="../chamados/sair.php" class="appointment-btn scrollto"><span class="d-none d-md-inline">Sair do
          Sistema</span></a>

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero">
    <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

      <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

      <div class="carousel-inner" role="listbox">

        <!-- Slide 1 -->
        <div class="carousel-item active" style="background-image: url(assets/img/slide/slide-36.jpeg)">
          <div class="container">
            <h2>Bem-vindo <span style="color: #3fbbc0;"><?php echo $_SESSION['nome'] ?></span></h2>
            <p>A saúde é o maior bem que possuímos, e a regulação do SUS desempenha um papel fundamental
              em assegurar que esse direito básico seja acessível a todos, independentemente de sua condição social ou
              econômica.</p>
            <a href="#services" class="btn-get-started scrollto">Serviços</a>
          </div>
        </div>

        <!-- Slide 2 -->
        <div class="carousel-item" style="background-image: url(assets/img/slide/slide-35.jpeg)">
          <div class="container">
            <h2>Seu papel como Servidor(a)</h2>
            <p>Como servidor(a), seu papel é fundamental na regulação do SUS. Trabalhe para garantir acesso e qualidade
              nos serviços de saúde, aplicando políticas de forma justa e transparente.
              Sua dedicação é essencial para fortalecer o sistema e promover o direito à saúde para todos.</p>
            <a href="#services" class="btn-get-started scrollto">Serviços</a>
          </div>
        </div>

        <!-- Slide 3 -->
        <div class="carousel-item" style="background-image: url(assets/img/slide/slide-34.jpeg)">
          <div class="container">
            <h2>Seus Objetivos</h2>
            <p>Como servidor(a) do SUS, tenha como objetivo primordial garantir acesso igualitário e qualidade nos
              serviços de saúde.
              Trabalhe para aplicar políticas de forma justa e transparente, promovendo a eficiência do sistema e o
              bem-estar da população.</p>
            <a href="#services" class="btn-get-started scrollto">Serviços</a>
          </div>
        </div>

      </div>

      <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
      </a>

      <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
      </a>

    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= Featured Services Section ======= -->
    <section id="services" class="featured-services">
      <div class="container" data-aos="fade-up">
        <div class="section-title">
          <h2>serviços</h2>
        </div>

        <div class="row justify-content-center">
        <?php if ($_SESSION["nivel"] === "Usuário Balcão") : ?>
            <div class="col-md-6 col-lg-4 d-flex align-items-stretch mb-5 mb-lg-0">
              <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
                <div class="icon"><i class="fas fa-headset"></i></div>
                <h4 class="title"><a href="../chamados/balcao.php">Atendimento Balcão</h4>
                <p class="description">Entre em contato conosco para receber suporte sobre os atendimentos do balcão.</p></a>
              </div>
            </div>
          <?php endif; ?>
          <?php if ($_SESSION["nivel"] === "Usuário Padrão" || $_SESSION["nivel"] === "Mestre" || $_SESSION["nivel"] === "Gestor") : ?>
            <div class="col-md-6 col-lg-4 d-flex align-items-stretch mb-5 mb-lg-0">
              <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
                <div class="icon"><i class="fas fa-headset"></i></div>
                <h4 class="title"><a href="../chamados/chamar.php">Atendimentos</h4>
                <p class="description">Entre em contato conosco para receber suporte sobre os atendimentos.</p></a>
              </div>
            </div>
          <?php endif; ?>
          <?php if ($_SESSION["nivel"] === "Gestor" || $_SESSION["nivel"] === "Mestre") : ?>
            <div class="col-md-6 col-lg-4 d-flex align-items-stretch mb-5 mb-lg-0">
              <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
                <div class="icon"><i class="far fa-file-alt"></i></div>
                <h4 class="title"><a href="../relatorios/relatorios.php">Relatórios</h4>
                <p class="description">Acesse e baixe nossos relatórios para obter informações detalhadas.</p></a>
              </div>
            </div>
          <?php endif; ?>
          <?php if ($_SESSION["nivel"] === "Gestor" || $_SESSION["nivel"] === "Mestre") : ?>
            <div class="col-md-6 col-lg-4 d-flex align-items-stretch mb-5 mb-lg-0">
              <div class="icon-box" data-aos="fade-up" data-aos-delay="300">
                <div class="icon"><i class="fas fa-users"></i></div>
                <h4 class="title"><a href="../users/users.php">Usuários</h4>
                <p class="description">Conheça nossos usuários e de as permissões necessárias.</p></a>
              </div>
            </div>
          <?php endif; ?>
        </div>


      </div>
    </section><!-- End Featured Services Section -->
    <!-- ======= Counts Section ======= -->
    <section id="about" class="counts">
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
        <br><br>
        <div class="content-header" style="text-align: center;">
          <h4>Internos / Externos</h4>
        </div>
        <div class="row no-gutters">

          <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch">
            <div class="count-box">
              <i class="fas fa-check-circle"></i>
              <span data-purecounter-start="0" data-purecounter-end="<?php echo $concluido['total_concluidos']; ?>" data-purecounter-duration="5" class="purecounter"></span>
              <p><strong>Concluídos</strong> atendimentos realizados com sucesso.</p>
              <a href="#services">Saiba mais nos relatórios &raquo;</a>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch">
            <div class="count-box">
              <i class="fas fa-times-circle"></i>
              <span data-purecounter-start="0" data-purecounter-end="<?php echo $cancelado['total_cancelados']; ?>" data-purecounter-duration="5" class="purecounter"></span>
              <p><strong>Cancelados</strong> atendimentos que foram cancelados por algum motivo.</p>
              <a href="#services">Saiba mais nos relatórios &raquo;</a>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch">
            <div class="count-box">
              <i class="fas fa-hospital-user"></i>
              <span data-purecounter-start="0" data-purecounter-end="<?php echo $todos['total_chamados']; ?>" data-purecounter-duration="5" class="purecounter"></span>
              <p><strong>Total de Atendimentos</strong> Atendimentos realizados pela regulação.</p>
              <a href="#services">Saiba mais nos relatórios &raquo;</a>
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
    <!-- End Counts Section -->

    <!-- ======= Contact Section ======= -->
    <section id="location" class="location">
      <div class="container">

        <div class="section-title">
          <h2>Localização</h2>
          <p>R. Benjamin Constant, 67 - Centro, Soledade - RS, 99300-000</p>
        </div>

        <div>
          <iframe style="border:0; width: 100%; height: 350px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3463.828110234146!2d-52.51244688551951!3d-28.818970182286425!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9519960b54578d1f%3A0x308d54b3d9ddc81b!2sR.%20Benjamin%20Constant%2C%2067%20-%20Centro%2C%20Soledade%20-%20RS%2C%2099300-000!5e0!3m2!1sen!2sbr!4v1622643788833!5m2!1sen!2sbr" frameborder="0" allowfullscreen></iframe>
        </div>
      </div>
    </section>
    </div>

    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span><a href="https://pmsoledaders.inf.br" target="_blank">DTI</a></span></strong>. Todos os direitos
        reservados
        <i class="bi bi-info-circle" style="padding-left: 10px;"> <?php 
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