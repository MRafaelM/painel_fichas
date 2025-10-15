<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once '../config/conecta_db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $cpf = strip_tags(trim($_POST['cpf']));
    $senha = strip_tags(trim($_POST['password']));
    $ip = strip_tags(trim($_POST['ip']));

    if (empty($cpf) || empty($senha)) {
        echo "<script>alert('Por favor, preencha todos os campos!'); document.location='../index.php';</script>";
    } else {
        $sql = $pdo->prepare("SELECT * FROM login WHERE cpf = :cpf");
        $sql->bindParam(":cpf", $cpf);
        $sql->execute();
        $resultado = $sql->fetch(PDO::FETCH_ASSOC);

        if ($resultado > 0) {

            if ($resultado['situacao'] == 'Inativo') {
                echo "<script>alert('Usuário bloqueado! recupere sua senha ou entre em contato com o suporte pelo telefone (54) 3381-9040. Se for seu primeiro acesso, verifique seu Email.'); document.location='../index.php';</script>";
            } else {
                if (password_verify($senha, $resultado['senha'])) {

                    // zera os erros
                    $update_erro = $pdo->prepare("UPDATE login SET quant_erros = 0 WHERE cpf = :cpf");
                    $update_erro->bindParam(":cpf", $cpf);
                    $update_erro->execute();

                    //insere os logs

                    $consulta_user = $pdo->prepare("SELECT * FROM login WHERE cpf = :cpf");
                    $consulta_user->bindParam(":cpf", $cpf);
                    $consulta_user->execute();
                    $resultado_user = $consulta_user->fetch(PDO::FETCH_ASSOC);

                    $data = date('Y-m-d H:i:s');
                    $acao = "Usuário entrou no sistema";
                    $inserir_logs_user = $pdo->prepare("INSERT INTO logs (data, acao, user, cpf, nivel, ip) VALUES (:data, :acao, :user, :cpf, :nivel, :ip)");
                    $inserir_logs_user->bindParam(':data', $data);
                    $inserir_logs_user->bindParam(':acao', $acao);
                    $inserir_logs_user->bindParam(':user', $resultado_user['nome']);
                    $inserir_logs_user->bindParam(':cpf', $resultado_user['cpf']);
                    $inserir_logs_user->bindParam(':nivel', $resultado_user['nivel']);
                    $inserir_logs_user->bindParam(':ip', $ip);
                    $inserir_logs_user->execute();

                    session_start();

                    $_SESSION['logado'] = true;
                    $_SESSION['id_usuario'] = $resultado_user['id'];
                    $_SESSION['nome'] = $resultado_user['nome'];
                    $_SESSION['cpf'] = $resultado_user['cpf'];
                    $_SESSION['email'] = $resultado_user['email'];
                    $_SESSION['nivel'] = $resultado_user['nivel'];

                    header('Location: ../../site/sus/welcome.php');
                } else {

                    // Realiza a contagem de vezes que o usuário errou a senha.
                    $update_erro = $pdo->prepare("UPDATE login SET quant_erros = quant_erros + 1 WHERE cpf = :cpf");
                    $update_erro->bindParam(":cpf", $cpf);
                    $update_erro->execute();

                    // Busca a quantidade de vezes que o usuário errou a senha.
                    $consulta_erro = $pdo->prepare("SELECT quant_erros FROM login WHERE cpf = :cpf");
                    $consulta_erro->bindParam(":cpf", $cpf);
                    $consulta_erro->execute();
                    $consulta = $consulta_erro->fetch(PDO::FETCH_ASSOC);
                    $erros = $consulta["quant_erros"];

                    if ($erros <= 4) {
                        echo "<script>alert('A senha não confere! Tente novamente. (Tentativa $erros de 5)'); document.location='../index.php';</script>";
                    } else {
                        $data_bloc = date('Y-m-d H:i:s');

                        $update_bloc = $pdo->prepare("UPDATE login SET situacao= 'Inativo', data_bloc = :data_bloc WHERE cpf = :cpf");
                        $update_bloc->bindParam(":cpf", $cpf);
                        $update_bloc->bindParam(":data_bloc", $data_bloc);
                        $update_bloc->execute();

                        echo "<script>alert('Sua Conta foi Bloqueada por mais de 5 tentativas de Login'); document.location='../index.php';</script>";
                    }
                }
            }
        } else {
            // CPF não encontrado
            echo "<script>alert('Oops... O CPF não foi encontrado! Tente novamente ou faça o primeiro acesso.'); document.location='../index.php';</script>";
        }
    }
}
