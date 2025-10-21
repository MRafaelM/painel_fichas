<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once '../../config/pdo_database.php';
require '../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$destino = "../registro.php";

// ---------------------- FUNÇÕES DE VALIDAÇÃO ----------------------
function validarEmail($email)
{
  return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function redirecionarComMsg($msg, $destino)
{
  echo "<script>alert('$msg'); document.location='$destino';</script>";
  exit;
}

// ---------------------- PROCESSAMENTO DO FORM ----------------------
if (isset($_POST['btn-login'])) {

  try {
    $nome   = trim(strip_tags($_POST['nome']));
    $email  = trim(strip_tags($_POST['email']));
    $senha  = $_POST['password'] ?? '';
    $ip     = strip_tags($_POST['ip']);
    $data   = date('Y-m-d H:i:s');
    $nivel  = "adm";

    // --- Validações básicas ---
    if (empty($nome) || empty($email) || empty($senha)) {
      redirecionarComMsg("Preencha todos os campos obrigatórios.", "../registro.php");
    }

    if (!validarEmail($email)) {
      redirecionarComMsg("Email inválido. Insira um endereço de email válido.", "../registro.php");
    }

    // --- Verifica duplicidade ---
    $verifica = $pdo->prepare("SELECT id FROM login WHERE email = :email");
    $verifica->execute([':email' => $email]);
    $usuarioExistente = $verifica->fetch(PDO::FETCH_ASSOC);

    if ($usuarioExistente) {
      redirecionarComMsg("O email informado já está vinculado a uma conta.", "../index.php");
    }

    // --- Regras de senha ---
    if (
      strlen($senha) < 8 ||
      !preg_match('/[A-Z]/', $senha) ||
      !preg_match('/[a-z]/', $senha) ||
      !preg_match('/[0-9]/', $senha) ||
      !preg_match('/[\W]/', $senha)
    ) {
      redirecionarComMsg("A senha deve ter no mínimo 8 caracteres e incluir letras maiúsculas, minúsculas, números e caracteres especiais.", "../registro.php");
    }

    // --- Criação do usuário ---
    $hash = password_hash($senha, PASSWORD_DEFAULT);
    $situacao = "inativo";

    $stmt = $pdo->prepare("
            INSERT INTO login (nome, email, data_criacao, senha, nivel, primeiro_acesso, situacao)
            VALUES (:nome, :email, :data_criacao, :senha, :nivel, :primeiro_acesso, :situacao)
        ");
    $stmt->execute([
      ':nome' => $nome,
      ':email' => $email,
      ':data_criacao' => $data,
      ':senha' => $hash,
      ':nivel' => $nivel,
      ':primeiro_acesso' => $hash,
      ':situacao' => $situacao
    ]);

    // --- Busca o ID do usuário recém-criado ---
    $consulta_id = $pdo->prepare("SELECT id FROM login WHERE email = :email LIMIT 1");
    $consulta_id->execute([':email' => $email]);
    $usuario = $consulta_id->fetch(PDO::FETCH_ASSOC);

    if (!$usuario) {
      redirecionarComMsg("Erro ao buscar usuário cadastrado.", "../registro.php");
    }

    $id_usuario = $usuario['id'];

    // --- Atualiza chave de ativação ---
    $contra_chave = "@t1c3ntr41#Melancia@13?";
    $chave = password_hash($contra_chave, PASSWORD_DEFAULT);

    $update = $pdo->prepare("UPDATE login SET primeiro_acesso = :chave WHERE id = :id");
    $update->execute([':chave' => $chave, ':id' => $id_usuario]);

    // --- Log de atividade ---
    $acao = "Usuário criou um cadastro no sistema";
    $log = $pdo->prepare("INSERT INTO logs (data_acao, acao, fk_login_id, ip_usuario) VALUES (:data, :acao, :id_usuario, :ip)");
    $log->execute([
      ':data' => $data,
      ':acao' => $acao,
      ':id_usuario' => $id_usuario,
      ':ip' => $ip
    ]);

    // --- Envio de e-mail de verificação ---
    $mail = new PHPMailer(true);
    $mail->CharSet = 'UTF-8';
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    $mail->Username = 'paineldefichas@gmail.com';
    $mail->Password = 'dqsj djua vtnn xnzg';

    $mail->setFrom('paineldefichas@gmail.com', 'Painel de Gestão');
    $mail->addAddress($email);
    $mail->isHTML(true);
    $mail->Subject = 'Ative seu acesso ao Painel de Gestão - Soledade/RS';

    $link_ativacao = "http://100.110.166.68/painel/login/actions/verifica_primeiro_acesso.php?id=$id_usuario&chave=$chave&ip=$ip";

    $mail->Body = "
            <p>Olá, <b>$nome</b>! Bem-vindo ao Painel de Gestão de Secretarias.</p>
            <p>Para ativar seu acesso, clique no link abaixo:</p>
            <p><a href='$link_ativacao'>Ativar conta</a></p>
            <hr>
            <p><b>Painel de Gestão SUS - Soledade/RS</b></p>
            <p><i>E-mail gerado automaticamente. Não responda.</i></p>
        ";

    $mail->send();

    redirecionarComMsg("Conta criada com sucesso! Verifique seu e-mail para ativar o acesso.", "../index.php");
  } catch (Exception $e) {
    echo "<pre>";
    echo "Erro ao processar o cadastro:\n";
    echo $e->getMessage() . "\n";
    if (isset($mail)) {
      echo "Erro do PHPMailer: " . $mail->ErrorInfo;
    }
    echo "</pre>";
    exit;
  }
}
