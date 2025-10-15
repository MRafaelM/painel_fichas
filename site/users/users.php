<?php
require_once "../assets/secure/acesso.php";
require_once "../config/pdo_database.php";

if (isset($_GET['ativado']) && $_GET['ativado'] === 'ok') {
    echo "<script>alert('Usuário ativado com sucesso!');</script>";
} elseif (isset($_GET['ativado']) && $_GET['ativado'] === 'erro') {
    echo "<script>alert('Erro ao ativar usuário!');</script>";
}
if (isset($_GET['desativado']) && $_GET['desativado'] === 'ok') {
    echo "<script>alert('Usuário desativado com sucesso!');</script>";
} elseif (isset($_GET['desativado']) && $_GET['desativado'] === 'erro') {
    echo "<script>alert('Erro ao desativar usuário!');</script>";
}
if (isset($_GET['apagado']) && $_GET['apagado'] === 'ok') {
    echo "<script>alert('Usuário excluído com sucesso!');</script>";
} elseif (isset($_GET['apagado']) && $_GET['apagado'] === 'erro') {
    echo "<script>alert('Erro ao excluir usuário!');</script>";
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Secretaria da Saúde</title>
    <!-- Favicons -->
    <link href="assets/img/favicon.ico" rel="icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

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
                <i class="bi bi-clock"></i><span id="MyDateDisplay" style="padding-right: 5px;"></span>-<span
                    id="MyClockDisplay" style="padding-left: 5px;"></span>
            </div>
            <div class="d-flex align-items-center">
                <i class="bi bi-phone"></i> Telefonista - (54) 3381-9052
            </div>
        </div>
    </div>
    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top">
        <div class="container d-flex align-items-center">

            <a href="../sus/welcome.php" class="logo me-auto"><img src="assets/img/brasao.png" alt=""><span
                    style="font-size: 20px; padding-left: 10px;">Secretaria da Saúde - Relatórios</span></a>
            <nav id="navbar" class="navbar order-last order-lg-0">
                <ul>
                    <li><a class="nav-link scrollto" href="../sus/welcome.php#home">Home</a></li>
                    <li><a class="nav-link scrollto" href="#users">Usuários</a></li>
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
        <br><br><br><br><br><br><br>
        <section id="users" class="featured-services" style="padding: 19px;">
            <?php
            $consulta = $pdo->prepare("SELECT COUNT(id) AS total FROM login WHERE nivel <> 'Mestre'");
            $consulta->execute();
            $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
            $total = $resultado['total'];
            ?>
            <div class="section-title">
                <h2>Usuários</h2>
                <span class="align-to-table">Usuários Cadastrados: <b><?php echo $total; ?></b></span>
                <br class="align-to-table">
            </div>
            <div class="col-lg-9 col-md-8 col-sm-12 mx-auto">
                <div class="container d-flex justify-content-center">
                    <div class="table-responsive tabs">
                        <table class="table table-secondary table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">CPF</th>
                                    <th scope="col">E-mail</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Situação</th>
                                    <th scope="col">Nível</th>
                                    <th scope="col">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = $pdo->prepare("SELECT * FROM login WHERE nivel != 'Mestre' ORDER BY nome ASC");
                                $sql->execute();
                                $results = $sql->fetchAll(PDO::FETCH_ASSOC);

                                if ($results) {
                                    foreach ($results as $result) {
                                        ?>
                                        <tr>
                                            <td><?php echo "***.***.**" . strip_tags(substr($result['cpf'], 10, 14)); ?></td>
                                            <td><?php echo strip_tags($result['email']); ?></td>
                                            <td><?php echo strip_tags($result['nome']); ?></td>
                                            <td><?php echo strip_tags($result['situacao']); ?></td>
                                            <td><?php echo strip_tags($result['nivel']); ?></td>
                                            <td align='center'>
                                                <?php if ($result['situacao'] == 'Ativo') { ?>
                                                    <a href='actions/desativar.php?id=<?php echo $result['id']; ?>'
                                                        class='btn btn-danger' title='Desativar'
                                                        onclick='return confirm("Tem certeza que deseja desativar este usuário?")'>Desativar
                                                        <i class='bi bi-pause'></i>
                                                    </a>
                                                <?php } else { ?>
                                                    <a href='actions/ativar.php?id=<?php echo $result['id']; ?>'
                                                        class='btn btn-success' title='Ativar'
                                                        onclick='return confirm("Tem certeza que deseja ativar este usuário?")'>Ativar
                                                        <i class='bi bi-play'></i>
                                                    </a>
                                                <?php } ?>
                                                <a href='actions/apagar.php?id=<?php echo $result['id']; ?>'
                                                    class='btn btn-dark' title='Apagar'
                                                    onclick='return confirm("Tem certeza que deseja apagar este usuário?")'>Apagar
                                                    <i class='bi bi-trash'></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- ======= Footer ======= -->
    <footer id="footer" style="position: fixed; width: 100%; height: 100px; bottom: 0; left: 0;">
        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong><span><a href="https://pmsoledaders.inf.br">DTI</a></span></strong>. Todos os
                direitos
                reservados
                <i class="bi bi-info-circle" style="padding-left: 10px;"><?php
                require_once '../assets/functions/versao.php';
                $id_ver = 5;
                $versao = acertaValor($id_ver);
                echo 'Versão ', $versao;
                ?></i>
            </div>
        </div>
    </footer><!-- End Footer -->
    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
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