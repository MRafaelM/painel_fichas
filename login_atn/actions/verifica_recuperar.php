<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once '../../config/pdo_database.php';
require '../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['btn-trocar'])) {
    $email = strip_tags($_POST['email']);
    $ip = strip_tags($_POST['ip']);

    $verifica_email = $pdo->prepare("SELECT email, nome FROM login WHERE email = :email");
    $verifica_email->bindParam(":email", $email);
    $verifica_email->execute();
    $rowsEmail = $verifica_email->fetch(PDO::FETCH_ASSOC);

    if ($rowsEmail) {
        $nome = $rowsEmail['nome'];
        $contra_chave = "@t1c3ntr41#Melancia@13?";
        $chave = password_hash($contra_chave, PASSWORD_DEFAULT);

        $trocar_senha = $pdo->prepare("UPDATE login SET token_recuperacao = :chave WHERE email = :email");
        $trocar_senha->bindValue(":chave", $chave);
        $trocar_senha->bindValue(":email", $email);

        if ($trocar_senha->execute()) {
            $mail = new PHPMailer();
            $mail->CharSet = 'UTF-8';
            $mail->Encoding = 'base64';
            $mail->isSMTP();
            $mail->Timeout = 15;
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'tls';
            $mail->Username = 'paineldefichas@gmail.com';
            $mail->Password = 'dqsj djua vtnn xnzg';
            $mail->Port = 587;

            $mail->setFrom('paineldefichas@gmail.com', 'Painel do atendente');
            $mail->addReplyTo('paineldefichas@gmail.com', 'Painel do atendente');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Alteração de Senha';
            $mail->Body = "
                
                <p>Olá, <b>$nome</b>!</p>               
                <p><a href='http://100.110.166.68/painel/login_atn/atualizar.php?chave=$chave'>Clique aqui</a> para alterar sua senha.</p>
                <br>
                <span><i>Caso você não tenha solicitado a alteração de senha, ignore este e-mail.</i></span>
                <br><br>
                <span>---------</span>
                <br>
                <span><b>Painel de atendimento - Soledade/RS</b></span>
                <br>
                <span>E-mail: <a href='mailto:paineldefichas@gmail.com'><i>paineldefichas@gmail.com</i></a></span>
                <br><br>
                <span><i>E-mail gerado automaticamente, não responda.</i></span>
            ";

            if (!$mail->send()) {
                echo "<script>alert('Erro na solicitação: " . $mail->ErrorInfo . ". Entre em contato com o suporte através do telefone (54) 99670-3627.'); document.location='../index.php';</script>";
            } else {

                $sql = $pdo->prepare("SELECT * FROM login WHERE email = :email");
                $sql->bindParam(":email", $email);
                $sql->execute();
                $resultado = $sql->fetch(PDO::FETCH_ASSOC);

                $data = date('Y-m-d H:i:s');
                $acao = "Usuário Alterou a senha do sistema";
                $inserir_logs_user = $pdo->prepare("INSERT INTO logs (data_acao, acao, fk_login_id, ip_usuario) VALUES (:data, :acao, :user, :ip)");
                $inserir_logs_user->bindParam(':data', $data);
                $inserir_logs_user->bindParam(':acao', $acao);
                $inserir_logs_user->bindParam(':user', $resultado['id']);
                $inserir_logs_user->bindParam(':ip', $ip);
                $inserir_logs_user->execute();

                echo "<script>alert('Um e-mail foi enviado com o link de alteração de senha, verifique sua caixa de entrada e/ou spam.'); document.location='../index.php';</script>";
            }
        } else {
            echo "<script>alert('Oops... Ocorreu algum erro com a solicitação. Tente novamente.'); document.location='../index.php';</script>";
        }
    } else {
        echo "<script>alert('Oops... Parece que esse e-mail não foi encontrado. Tente novamente ou crie uma conta.'); document.location='../recuperar.php';</script>";
    }
}
