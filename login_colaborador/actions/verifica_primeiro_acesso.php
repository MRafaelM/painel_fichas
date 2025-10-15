<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once '../config/conecta_db.php';

if (isset($_GET['chave']) || isset($_GET['cpf'])) {
    $chave = trim($_GET['chave']);
    $cpf = trim($_GET['cpf']);
    $ip = trim($_GET['ip']);

    $consulta_chave = $pdo->prepare("SELECT COUNT(*) as count FROM login WHERE primeiro_acesso = :chave");
    $consulta_chave->bindParam(":chave", $chave);
    $consulta_chave->execute();
    $chave_existe = $consulta_chave->fetch(PDO::FETCH_ASSOC);

    if ($chave_existe['count'] > 0) {

        $sql_altera_sitiacao = $pdo->prepare("UPDATE login SET email_verificado = 'Sim', primeiro_acesso = NULL");
        $sql_altera_sitiacao->execute();

        $consulta_user = $pdo->prepare("SELECT * FROM login WHERE cpf = :cpf");
        $consulta_user->bindParam(":cpf", $cpf);
        $consulta_user->execute();
        $resultado_user = $consulta_user->fetch(PDO::FETCH_ASSOC);

        $data = date('Y-m-d H:i:s');
        $acao = "Usuário confirmou o email";
        $inserir_logs_user = $pdo->prepare("INSERT INTO logs (data, acao, user, cpf, nivel, ip) VALUES (:data, :acao, :user, :cpf, :nivel, :ip)");
        $inserir_logs_user->bindParam(':data', $data);
        $inserir_logs_user->bindParam(':acao', $acao);
        $inserir_logs_user->bindParam(':user', $resultado_user['nome']);
        $inserir_logs_user->bindParam(':cpf', $resultado_user['cpf']);
        $inserir_logs_user->bindParam(':nivel', $resultado_user['nivel']);
        $inserir_logs_user->bindParam(':ip', $ip);
        $inserir_logs_user->execute();

        echo "<script>alert('Obrigado por confirmar seu Email! Aguarde o administrador do sistema liberar seu acesso.'); document.location='https://pmsoledaders.inf.br/painel/login/';</script>";

    } else {
        echo "<script>alert('Oops... Link inválido!'); document.location='../index.php';</script>";
    }
} else {
    echo "<script>alert('Oops... Link inválido!'); document.location='../index.php';</script>";
}
