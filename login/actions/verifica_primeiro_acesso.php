<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once '../../config/pdo_database.php';

if (isset($_GET['id']) && isset($_GET['chave'])) {

    $id_usuario = trim($_GET['id']);
    $chave = trim($_GET['chave']);
    $ip = trim($_GET['ip'] ?? '');

    // --- Consulta para verificar se a chave corresponde ao usuário ---
    $consulta_chave = $pdo->prepare("SELECT * FROM login WHERE id = :id AND primeiro_acesso = :chave LIMIT 1");
    $consulta_chave->execute([
        ':id' => $id_usuario,
        ':chave' => $chave
    ]);

    $usuario = $consulta_chave->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {
        // --- Ativa usuário e limpa primeiro_acesso ---
        $sql_ativar = $pdo->prepare("UPDATE login SET situacao = 'pendente', primeiro_acesso = NULL WHERE id = :id");
        $sql_ativar->execute([':id' => $id_usuario]);

        // --- Inserir log ---
        $data = date('Y-m-d H:i:s');
        $acao = "Usuário confirmou o email";
        $inserir_log = $pdo->prepare("
            INSERT INTO logs (data, acao, user, nivel, ip)
            VALUES (:data, :acao, :user, :nivel, :ip)
        ");
        $inserir_log->execute([
            ':data' => $data,
            ':acao' => $acao,
            ':user' => $usuario['nome'],
            ':nivel' => $usuario['nivel'],
            ':ip' => $ip
        ]);

        echo "<script>
            alert('Obrigado por confirmar seu Email! Aguarde o administrador do sistema liberar seu acesso.');
            document.location='http://100.110.166.68/painel/login/';
        </script>";
        exit;

    } else {
        echo "<script>
            alert('Oops... Link inválido!');
            document.location='../index.php';
        </script>";
        exit;
    }

} else {
    echo "<script>
        alert('Oops... Link inválido!');
        document.location='../index.php';
    </script>";
    exit;
}
