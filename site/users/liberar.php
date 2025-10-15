<?php
require_once "../assets/secure/acesso.php";

require_once "../../config/pdo_database.php";

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
                        <p class="text-muted">Orientações claras e eficazes para a regulação de exames, garantindo
                            acesso justo e ágil aos serviços de saúde.</p>
                    </div>
                    <div class="col-sm-4 offset-md-1 py-4">
                        <h4 class="text-white">Contato</h4>
                        <ul class="list-unstyled">
                            <li><a href="https://soledade.rs.gov.br/" class="text-white" target="_blank">Prefeitura
                                    Municipal de Soledade</a></li>
                            <li><a href="https://www.soledade.rs.gov.br/pagina/13/secretaria-da-saude"
                                    class="text-white" target="_blank">Secretaria da Saúde</a></li>
                            <li><a href="https://pmsoledaders.inf.br/" class="text-white" target="_blank">DTI
                                    Soledade</a></li>
                            <li><br></li>
                            <li><a href="sair.php" class="text-white">Sair</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="navbar navbar-dark bg-dark shadow-sm">
            <div class="container d-flex justify-content-between">
                <a href="https://pmsoledaders.inf.br/painel/site/chamados/"
                    class="navbar-brand d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="mr-2">
                        <rect x="1" y="3" width="22" height="18" rx="2" ry="2"></rect>
                        <line x1="12" y1="9" x2="12" y2="15"></line>
                        <line x1="9" y1="12" x2="15" y2="12"></line>
                    </svg>
                    <strong>Painel de Chamados</strong>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader"
                    aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </div>
    </header>

    <main role="main" style="margin-top: 20px;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-12">
                    <div class="card-voltar bg-transparent border-secondary mb-3" onclick="window.location.href='../sus/welcome.php';"
                    style="margin-top: 20px;">
                        <div class="card-content">
                            <h4><</h4>
                            <small>Voltar</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-8 col-sm-12">
                    <?php
                    $consulta = $pdo->prepare("SELECT COUNT(id) AS total FROM login");
                    $consulta->execute();
                    $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
                    $total = $resultado['total'];
                    ?>
                    <div class="container">
                        <h4><b>Usuários</b></h4>
                        <hr><br>
                        <span>Usuários Cadastrados: <b><?php echo $total; ?></b>
                            <br>
                            <hr>
                    </div>

                    <div class="container">
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
                                                <td><?php echo "***.***.**" . strip_tags(substr($result['cpf'], 10, 14)); ?>
                                                </td>
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
            </div>
        </div>
    </main>
    <footer class="main-footer bg-dark text-white">
        <div class="text-center mx-auto">
            <span>
                &copy;
                <script>
                    document.write(new Date().getFullYear());
                </script> Desenvolvidor por <a href="https://pmsoledaders.inf.br/" target="_blank"
                    style="color: white;"><b>DTI
                        Prefeitura Municipal de Soledade</b></a>. Todos os direitos reservados.
            </span>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
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