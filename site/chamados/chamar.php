<?php
//Verifica o user
require_once "../assets/secure/acesso.php";
//Verica a conexão com o banco
require_once "../../config/pdo_database.php";
?>
<!DOCTYPE html>
<html>

<head>
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
                        <a class="nav-link" href="chamar.php">
                            <i class="nc-icon nc-bell-55"></i>
                            <p>Painel de Chamados</p>
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="telefone.php">
                            <i class="nc-icon nc-mobile"></i>
                            <p>Atendimentos</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <nav class="navbar navbar-expand-lg " color-on-scroll="500">
                <div class="container-fluid">
                    <a class="navbar-brand" href="chamar.php"> Controle do Painel </a>
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
                <div class="container" style="margin-top: 50px;">
                    <div class="row row-cols-2">
                        <div class="col">
                            <div class="card text-dark border-primary">
                                <div class="card-header bg-primary text-white text-center">
                                    <h4>Chamados Normal - Azul</h4>
                                </div>
                                <?php
                                $prioridade_azul = 'Azul';
                                $consulta_azul = $pdo->prepare("SELECT numero FROM chamados WHERE  prioridade = :prioridade ORDER BY id_chamado DESC LIMIT 1");
                                $consulta_azul->bindParam(':prioridade', $prioridade_azul);
                                $consulta_azul->execute();
                                $resultado = $consulta_azul->fetch(PDO::FETCH_ASSOC);
                                $ultimo_azul = $resultado['numero'];
                                ?>
                                <div class="card-body" id="chamados_normais" style="display: flex; justify-content: space-between;">
                                    <h5 style="display: inline; text-align: start;">Último número: <span class="destaque-numero" style="display: inline; font-weight: bold;"><?php echo $ultimo_azul; ?></span>
                                    </h5>
                                    <h5 style="display: inline; text-align: end;">Atendido por:
                                        <?php echo $_SESSION['nome']; ?>
                                    </h5>
                                </div>
                                <div class="card-body" id="chamados_normais" style="display: flex; align-items: center;">
                                    <h5 style="margin-right: 10px; padding-top: 15px;">Informe o número:</h5>
                                    <input type="number" class="form-control col-3" id="numero_inicio_azul" max="99999" oninput="this.value = this.value.replace(/e/g, ''); this.value = this.value.slice(0, 5);">
                                    <div style="margin-left: 10px;">
                                        <button class="btn btn-custom-light btn-light" onclick="iniciar('Azul', 'numero_inicio_azul')">Enviar</button>
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-between">
                                    <div class="d-flex">
                                        <button class="btn btn-custom-warning btn-warning mr-2" onclick="chamarProximo('Azul')">Chamar Próximo</button>
                                        <button class="btn btn-custom btn-info" onclick="chamarNovamente('Azul')">Chamar
                                            Novamente</button>
                                    </div>
                                    <div class="d-flex">
                                        <button class="btn btn-custom-success btn-success mr-2" disabled style="visibility: hidden;">
                                            Concluir Atendimento
                                        </button>
                                        <button class="btn btn-custom-danger btn-danger" onclick="cancelarChamado('Azul')">Cancelar Atendimento</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col" style="margin-top: 20px;">
                            <div class="card text-dark border-danger">
                                <div class="card-header bg-danger text-white text-center">
                                    <h4>Chamados Prioritário - Vermelho</h4>
                                </div>
                                <?php
                                $prioridade_vermelho = 'Vermelho';
                                $consulta_vermelho = $pdo->prepare("SELECT numero FROM chamados WHERE prioridade = :prioridade ORDER BY id_chamado DESC LIMIT 1");
                                $consulta_vermelho->bindParam(':prioridade', $prioridade_vermelho);
                                $consulta_vermelho->execute();
                                $resultado = $consulta_vermelho->fetch(PDO::FETCH_ASSOC);
                                $ultimo_vermelho = $resultado['numero'];
                                ?>
                                <div class="card-body" id="chamados_normais" style="display: flex; justify-content: space-between;">
                                    <h5 style="display: inline; text-align: start;">Último número: <span class="destaque-numero-danger" style="display: inline; font-weight: bold; "><?php echo $ultimo_vermelho; ?></span>
                                    </h5>
                                    <h5 style="display: inline; text-align: end;">Atendido por:
                                        <?php echo $_SESSION['nome']; ?>
                                    </h5>
                                </div>
                                <!-- Chamado Vermelho -->
                                <div class="card-body" id="chamados_prioritarios" style="display: flex; align-items: center;">
                                    <h5 style="margin-right: 10px; padding-top: 15px;">Informe o número:</h5>
                                    <input type="number" class="form-control col-3" id="numero_inicio_vermelho" max="99999" oninput="this.value = this.value.replace(/e/g, ''); this.value = this.value.slice(0, 5);">
                                    <div style="margin-left: 10px;">
                                        <button class="btn btn-custom-light btn-light" onclick="iniciar('Vermelho', 'numero_inicio_vermelho')">Enviar</button>
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-between">
                                    <div class="d-flex">
                                        <button class="btn btn-custom-warning btn-warning mr-2" onclick="chamarProximo('Vermelho')" style="text-align: start;">Chamar
                                            Próximo</button>
                                        <button class="btn btn-custom btn-info mr-2" onclick="chamarNovamente('Vermelho')">Chamar Novamente</button>
                                    </div>
                                    <div class="d-flex">
                                        <button class="btn btn-custom-success btn-success" onclick="concluirChamado('Vermelho')" disabled style="visibility: hidden;">
                                            Concluir Atendimento
                                        </button>
                                        <button class="btn btn-custom-danger btn-danger" onclick="cancelarChamado('Vermelho')">Cancelar Atendimento</button>
                                    </div>
                                </div>
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
    <!-- Azul -->
    <form id="form_chamar_proximo_Azul" action="chamado.php" method="post">
        <input type="hidden" name="ultimo_numero" value="<?php echo $ultimo_azul; ?>">
        <input type="hidden" name="nome_funcionario" value="<?php echo $_SESSION['nome']; ?>">
        <input type="hidden" name="prioridade" value="Azul">
    </form>
    <form id="form_chamar_novamente_Azul" action="novamente.php" method="post">
        <input type="hidden" name="ultimo_numero" value="<?php echo $ultimo_azul; ?>">
        <input type="hidden" name="nome_funcionario" value="<?php echo $_SESSION['nome']; ?>">
        <input type="hidden" name="prioridade" value="Azul">
    </form>
    <form id="form_concluir_chamado_Azul" action="concluir.php" method="post">
        <input type="hidden" name="tipo" value="3">
    </form>
    <form id="form_cancelar_chamado_Azul" action="cancelar.php" method="post">
        <input type="hidden" name="ultimo_numero" value="<?php echo $ultimo_azul; ?>">
        <input type="hidden" name="nome_funcionario" value="<?php echo $_SESSION['nome']; ?>">
        <input type="hidden" name="prioridade" value="Azul">
    </form>
    <form id="form_iniciar_Azul" action="iniciar.php" method="post">
        <input type="hidden" name="numero_inicio_Azul" id="numero_inicio_input_Azul">
        <input type="hidden" name="ultimo_azul" value="<?php echo $ultimo_azul; ?>">
        <input type="hidden" name="nome_funcionario" value="<?php echo $_SESSION['nome']; ?>">
        <input type="hidden" name="prioridade" value="Azul">
    </form>
    <!-- Vermelho -->
    <form id="form_chamar_proximo_Vermelho" action="chamado.php" method="post">
        <input type="hidden" name="ultimo_numero" value="<?php echo $ultimo_vermelho; ?>">
        <input type="hidden" name="nome_funcionario" value="<?php echo $_SESSION['nome']; ?>">
        <input type="hidden" name="prioridade" value="Vermelho">
    </form>
    <form id="form_chamar_novamente_Vermelho" action="novamente.php" method="post">
        <input type="hidden" name="ultimo_numero" value="<?php echo $ultimo_vermelho; ?>">
        <input type="hidden" name="nome_funcionario" value="<?php echo $_SESSION['nome']; ?>">
        <input type="hidden" name="prioridade" value="Azul">
    </form>
    <form id="form_concluir_chamado_Vermelho" action="concluir.php" method="post">
        <input type="hidden" name="tipo" value="8">
    </form>
    <form id="form_cancelar_chamado_Vermelho" action="cancelar.php" method="post">
        <input type="hidden" name="ultimo_numero" value="<?php echo $ultimo_vermelho; ?>">
        <input type="hidden" name="nome_funcionario" value="<?php echo $_SESSION['nome']; ?>">
        <input type="hidden" name="prioridade" value="Vermelho">
    </form>
    <form id="form_iniciar_Vermelho" action="iniciar.php" method="post">
        <input type="hidden" name="numero_inicio_vermelho" id="numero_inicio_input_Vermelho">
        <input type="hidden" name="ultimo_vermelho" value="<?php echo $ultimo_vermelho; ?>">
        <input type="hidden" name="nome_funcionario" value="<?php echo $_SESSION['nome']; ?>">
        <input type="hidden" name="prioridade" value="Vermelho">
    </form>
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

</html>