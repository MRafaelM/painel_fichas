<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once '../../config/pdo_database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = strip_tags(trim($_POST['email']));
    $senha = strip_tags(trim($_POST['password']));
    $ip    = strip_tags(trim($_POST['ip']));

    if (empty($email) || empty($senha)) {
        echo "<script>alert('Por favor, preencha todos os campos!'); document.location='../index.php';</script>";
        exit;
    }

    $sql = $pdo->prepare("SELECT * FROM login WHERE email = :email LIMIT 1");
    $sql->bindParam(":email", $email);
    $sql->execute();
    $resultado = $sql->fetch(PDO::FETCH_ASSOC);

    if ($resultado) {

        if ($resultado['error'] >= 5) {
            echo "<script>alert('Sua conta está bloqueada por 5 tentativas de login incorretas.'); document.location='../index.php';</script>";
            exit;
        }

        if (password_verify($senha, $resultado['senha'])) {

            // Zera os erros
            $update_erro = $pdo->prepare("UPDATE login SET error = 0 WHERE email = :email");
            $update_erro->bindParam(":email", $email);
            $update_erro->execute();

            if ($resultado['situacao'] === 'inativo') {
                echo "<script>alert('Usuário inativo! Se for seu primeiro acesso, verifique seu e-mail.'); document.location='../index.php';</script>";
                exit;
            } else if ($resultado['situacao'] === 'pendente') {
                echo "<script>alert('Usuário pendente! Aguarde o administrador habilitar o seu acesso.'); document.location='../index.php';</script>";
                exit;
            }

            // Log de login
            $data = date('Y-m-d H:i:s');
            $acao = "Usuário entrou no sistema";
            $inserir_logs_user = $pdo->prepare("
                INSERT INTO logs (data, acao, user, nivel, ip)
                VALUES (:data, :acao, :user, :nivel, :ip)
            ");
            $inserir_logs_user->execute([
                ':data' => $data,
                ':acao' => $acao,
                ':user' => $resultado['nome'],
                ':nivel' => $resultado['nivel'],
                ':ip' => $ip
            ]);

            // Inicia sessão
            session_start();
            $_SESSION['logado'] = true;
            $_SESSION['id_usuario'] = $resultado['id'];
            $_SESSION['nome'] = $resultado['nome'];
            $_SESSION['email'] = $resultado['email'];
            $_SESSION['nivel'] = $resultado['nivel'];

            header('Location: ../../gestao/');
            exit;
        } else {
            // Incrementa tentativas
            $update_erro = $pdo->prepare("UPDATE login SET error = CASE WHEN error < 5 THEN error + 1 ELSE error END WHERE email = :email");
            $update_erro->bindParam(":email", $email);
            $update_erro->execute();

            // Consulta tentativas
            $consulta_erro = $pdo->prepare("SELECT error FROM login WHERE email = :email");
            $consulta_erro->bindParam(":email", $email);
            $consulta_erro->execute();
            $consulta = $consulta_erro->fetch(PDO::FETCH_ASSOC);
            $erros = (int)$consulta["error"];

            if ($erros <= 4) {
                echo "<script>alert('Senha incorreta! Tentativa $erros de 5.'); document.location='../index.php';</script>";
                exit;
            } else {
                $data_bloc = date('Y-m-d H:i:s');
                $update_bloc = $pdo->prepare("UPDATE login SET situacao = 'inativo', data_bloc = :data_bloc WHERE email = :email");
                $update_bloc->execute([
                    ':data_bloc' => $data_bloc,
                    ':email' => $email
                ]);

                echo "<script>alert('Sua conta foi bloqueada por 5 tentativas de login incorretas.'); document.location='../index.php';</script>";
                exit;
            }
        }
    } else {
        echo "<script>alert('Oops... E-mail não encontrado! Verifique ou crie uma conta.'); document.location='../index.php';</script>";
        exit;
    }
}
