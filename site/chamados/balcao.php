<?php
//Verifica o user
require_once "../assets/secure/acesso.php";
//Verica a conexão com o banco
require_once "../../config/pdo_database.php";
?>
<!DOCTYPE html>
<html>

<meta charset="utf-8" />
<link rel="apple-touch-icon" sizes="76x76" href="../assets/light/assets/img/apple-icon.png">
<link rel="icon" href="../assets/img/brasao.png">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<title>Controle de Chamados</title>
<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
<link href="../assets/light/assets/css/bootstrap.min.css" rel="stylesheet" />
<link href="../assets/light/assets/css/light-bootstrap-dashboard.css?v=2.0.0 " rel="stylesheet" />
<link href="../assets/light/assets/css/demo.css" rel="stylesheet" />
<link href="assets/css/control.css" rel="stylesheet" />

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var nomeCidadaoInput = document.getElementById('nome_cidadao');

        nomeCidadaoInput.addEventListener('input', function() {
            this.value = this.value.replace(/\d+/g, '');
        });
    });
</script>
</head>

<body>
    <div class="wrapper">
        <div class="sidebar" data-image="../assets/light/assets/img/sidebar-5.jpg">
            <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="../sus/welcome.php" class="simple-text">
                        Regulação
                    </a>
                </div>
                <ul class="nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="balcao.php">
                            <i class="nc-icon nc-bell-55"></i>
                            <p>Atendimentos</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <nav class="navbar navbar-expand-lg " color-on-scroll="500">
                <div class="container-fluid">
                    <a class="navbar-brand" href="telefone.php"> Controle dos atendimentos pelo balcão </a>
                    <div class="collapse navbar-collapse justify-content-end" id="navigation">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="chamar.php">
                                    <span class="no-icon">Bem-vindo(a) <?php echo $_SESSION['nome']; ?></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="content">
                <div class="container" style="margin-top: 10%;">
                    <div class="row row-cols-2">
                        <div class="col">
                            <div class="card text-dark" style="border-color: #9370DB;">
                                <div class="card-header text-white text-center" style="background-color: #9370DB;">
                                    <h4>Atendimentos da tabela social</h4>
                                </div>
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5>Atendido por: <?php echo $_SESSION['nome']; ?></h5>
                                        </div>
                                        <div class="col-md-6" style="text-align: end;">
                                            <i class="bi bi-clock"></i><span id="MyDateDisplay" style="padding-right: 5px;"></span>-<span id="MyClockDisplay" style="padding-left: 5px;"></span>
                                        </div>
                                    </div>
                                </div>
                                <form id="adicionar" method="post" action="atendimento_social.php">
                                    <div class="card-body mb-2">
                                        <input type="hidden" name="funcionario" value="<?php echo $_SESSION['nome']; ?>">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h5 style="margin-right: 10px; padding-top: 15px;">Informe o nome do cidadão:</h5>
                                                <input name="nome_cidadao" id="nome_cidadao" type="text" class="form-control" max="100">
                                            </div>
                                            <div class="col-md-6">
                                                <h5 style="margin-right: 10px; padding-top: 15px;">Selecione o tipo de
                                                    atendimento:</h5>
                                                <input name="nome_atendimento" id="nome_atendimento" type="text" class="form-control" value="tabela-social/diversos" readonly>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="d-flex justify-content-center">
                                            <button type="button" id="btn-limpar" class="btn btn-custom-clean mr-2">Limpar
                                                formulário</button>
                                            <button type="submit" id="btn-adicionar" class="btn btn-custom-success">Adicionar atendimento</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer">
                <div class="text-center mx-auto" style="padding-top: 20px;">
                    <span>
                        &copy;
                        <script>
                            document.write(new Date().getFullYear());
                        </script> - Secretaria da Saúde - Todos os direitos reservados. Desenvolvido por <a href="https://pmsoledaders.inf.br/" target="_blank"><b>DTI
                                Prefeitura Municipal de Soledade</b></a>.
                    </span>
                </div>
            </footer>
        </div>
    </div>
</body>
<script src="../assets/light/assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="../assets/light/assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="../assets/light/assets/js/core/bootstrap.min.js" type="text/javascript"></script>
<script src="../assets/light/assets/js/plugins/bootstrap-switch.js"></script>
<script src="../assets/light/assets/js/plugins/chartist.min.js"></script>
<script src="../assets/light/assets/js/plugins/bootstrap-notify.js"></script>
<script src="../assets/light/assets/js/light-bootstrap-dashboard.js?v=2.0.0 " type="text/javascript"></script>
<script src="../assets/light/assets/js/demo.js"></script>
<script src="assets/js/botoes.js"></script>
<script src="../sus/assets/js/control.js"></script>

<script>
    document.getElementById("btn-limpar").addEventListener("click", function() {
        // Limpar o conteúdo dos campos do formulário
        document.getElementById("nome_cidadao").value = "";
        document.getElementById("tipo_atendimento").selectedIndex = 0; // Selecionar o primeiro item
    });
</script>

</html>