<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once '../config/conecta_db.php';

// Função para validar CPF
function validaCPF($cpf)
{
  // Remove caracteres especiais
  $cpf = preg_replace('/[^0-9]/', '', $cpf);

  // Verifica se o número de dígitos é igual a 11
  if (strlen($cpf) != 11) {
    return false;
  }

  // Verifica se todos os dígitos são iguais (ex: 111.111.111-11)
  if (preg_match('/(\d)\1{10}/', $cpf)) {
    return false;
  }

  // Calcula os dígitos verificadores
  for ($t = 9; $t < 11; $t++) {
    for ($d = 0, $c = 0; $c < $t; $c++) {
      $d += $cpf[$c] * (($t + 1) - $c);
    }
    $d = ((10 * $d) % 11) % 10;
    if ($cpf[$c] != $d) {
      return false;
    }
  }

  return true;
}

function validarEmail($email)
{
  // Primeiro verifica o formato básico do email
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    return false; // Retorna falso se o formato do email for inválido
  }

  // Verifica o formato do domínio usando uma expressão regular mais rigorosa
  $pattern = '/^(?=.{1,254}$)[a-zA-Z0-9!#$%&\'*+\/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&\'*+\/=?^_`{|}~-]+)*@(?!-)[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*(?<!-)$/';

  if (preg_match($pattern, $email)) {
    return true; // O email é válido
  } else {
    return false; // O email é inválido
  }
}

if (isset($_POST['btn-login'])) {

  $nome = strip_tags($_POST['nome']);
  $cpf = strip_tags($_POST['cpf']);
  $email = strip_tags($_POST['email']);
  $senha = strip_tags($_POST['password']);
  $ip = strip_tags($_POST['ip']);
  $data = date('Y-m-d H:i:s');
  $nivel = "Usuário Padrão";

  $verificar_cpf = $pdo->prepare("SELECT COUNT(*) as count FROM login WHERE cpf = :cpf");
  $verificar_cpf->bindParam(":cpf", $cpf);
  $verificar_cpf->execute();
  $cpf_existe = $verificar_cpf->fetch(PDO::FETCH_ASSOC);

  // Verifica a validade do CPF
  if (!validaCPF($cpf)) {
    echo "<script>alert('CPF inválido. Por favor, insira um CPF válido.'); document.location='../registro.php';</script>";
    exit;
  }

  if (!validarEmail($email)) {
    echo "<script>alert('Este email é inválido, insira um que seja válido'); document.location='../registro.php';</script>";
    exit;
  }


  if ($cpf_existe['count'] > 0) {
    echo "<script>alert('O CPF informado já possui uma conta! Faça o login ou solicite a troca da senha.'); document.location='../index.php';</script>";
  } else {

    $verificar_email = $pdo->prepare("SELECT COUNT(*) as count FROM login WHERE email = :email");
    $verificar_email->bindParam(":email", $email);
    $verificar_email->execute();
    $email_existe = $verificar_email->fetch(PDO::FETCH_ASSOC);

    if ($email_existe['count'] > 0) {
      echo "<script>alert('O EMAIL informado já está vinculado a uma conta! Use outro email.'); document.location='../index.php';</script>";
    } else {

      if (strlen($senha) < 8) {
        echo "<script>alert('A senha deve ter pelo menos 8 caracteres.'); document.location='../registro.php';</script>";
      } elseif (!preg_match('/[A-Z]/', $senha)) {
        echo "<script>alert('A senha deve conter pelo menos uma letra maiúscula.'); document.location='../registro.php';</script>";
      } elseif (!preg_match('/[a-z]/', $senha)) {
        echo "<script>alert('A senha deve conter pelo menos uma letra minúscula.'); document.location='../registro.php';</script>";
      } elseif (!preg_match('/[0-9]/', $senha)) {
        echo "<script>alert('A senha deve conter pelo menos um número.'); document.location='../registro.php';</script>";
      } elseif (!preg_match('/[\W]/', $senha)) {
        echo "<script>alert('A senha deve conter pelo menos um caractere especial.'); document.location='../registro.php';</script>";
      } else {
        
          $hash = password_hash($senha, PASSWORD_DEFAULT);
          $situacao = "Inavivo";

          $inserir_login_user = $pdo->prepare("INSERT INTO login (nome, cpf, email, data_cadastro, senha, nivel, primeiro_acesso, situacao) 
          VALUES (:nome, :cpf, :email, :data_cadastro, :senha, :nivel, :primeiro_acesso, :situacao)");

          $inserir_login_user->bindParam(':nome', $nome);
          $inserir_login_user->bindParam(':cpf', $cpf);
          $inserir_login_user->bindParam(':email', $email);
          $inserir_login_user->bindParam(':data_cadastro', $data);
          $inserir_login_user->bindParam(':senha', $hash);
          $inserir_login_user->bindParam(':primeiro_acesso', $hash);
          $inserir_login_user->bindParam(':nivel', $nivel);
          $inserir_login_user->bindParam(':situacao', $situacao);

          if ($inserir_login_user->execute()) {

            $verificar_id = $pdo->prepare("SELECT id FROM login WHERE cpf = :cpf");
            $verificar_id->bindParam(":cpf", $cpf);
            $verificar_id->execute();
            $id_verificado = $verificar_id->fetch(PDO::FETCH_ASSOC);
            $id_novo = intval($id_verificado['id']);

            if ($id_novo > 0) {
              $data_lanc = date('Y-m-d H:i:s');
              $acao = "Usuário criou um cadastro no sistema";
              $inserir_logs_user = $pdo->prepare("INSERT INTO logs (data, acao, user, cpf, nivel, ip) VALUES (:data, :acao, :user, :cpf, :nivel, :ip)");
              $inserir_logs_user->bindParam(':data', $data_lanc);
              $inserir_logs_user->bindParam(':acao', $acao);
              $inserir_logs_user->bindParam(':user', $nome);
              $inserir_logs_user->bindParam(':cpf', $cpf);
              $inserir_logs_user->bindParam(':nivel', $nivel);
              $inserir_logs_user->bindParam(':ip', $ip);
              $inserir_logs_user->execute();

              $contra_chave = "@t1c3ntr41#Melancia@13?";
              $chave = password_hash($contra_chave, PASSWORD_DEFAULT);

              $primeiro_acesso = $pdo->prepare("UPDATE login SET primeiro_acesso = :chave WHERE email = :email");
              $primeiro_acesso->bindValue(":chave", $chave);
              $primeiro_acesso->bindValue(":email", $email);

              if ($primeiro_acesso->execute()) {
                require '../../../PHPMailer/PHPMailerAutoload.php';

                $mail = new PHPMailer();
                $mail->CharSet = 'UTF-8';
                $mail->Encoding = 'base64';
                $mail->isSMTP();
                $mail->Timeout = 15;
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = 'tls';
                $mail->Username = 'soledadedti@gmail.com';
                $mail->Password = 'fritufewgnrzpyci';
                $mail->Port = 587;

                $mail->setFrom('soledadedti@gmail.com', 'Departamento de TI – Prefeitura Municipal de Soledade/RS');
                $mail->addReplyTo('soledadedti@gmail.com', 'Departamento de TI – Prefeitura Municipal de Soledade/RS');
                $mail->addAddress($email);
                $mail->addAddress('ti@soledade.rs.gov.br');
                $mail->addCC($email, 'Cópia');
                $mail->addBCC($email, 'Cópia Oculta');

                $mail->isHTML(true);
                $mail->Subject = 'Primeiro Acesso';
                $mail->Body = "
                      
                      <p>Olá, <b>$nome</b>! Bem-vindo ao Sistema de Painel de chamados da Secretaria de Saúde, Verifique seu Email ao link abaixo.</p>               
                      <p><a href='https://pmsoledaders.inf.br/painel/login/actions/verifica_primeiro_acesso.php?chave=$chave&cpf=$cpf&ip=$ip'>Clique aqui</a> para liberar seu acesso.</p>
                      <span>---------</span>
                      <br>
                      <span><b>Departamento de TI - Prefeitura Municipal de Soledade/RS</b></span>
                      <br>
                      <span>E-mail: <a href='mailto:ti@soledade.rs.gov.br'><i>ti@soledade.rs.gov.br</i></a></span>
                      <br>
                      <span>Telefone: <i>+55 (54) 3381-9040</i></span>
                      <br><br>
                      <span><i>E-mail gerado automaticamente, não responda.</i></span>
                  ";

                if (!$mail->send()) {
                  echo "<script>alert('Erro na solicitação: " . $mail->ErrorInfo . ". Entre em contato com o suporte através do telefone (54) 3381-9040.'); document.location='../index.php';</script>";
                } else {

                  echo "<script>alert('Um e-mail foi enviado com o link de verificação de primeiro acesso, verifique sua caixa de entrada e/ou spam.'); document.location='../index.php';</script>";
                }
              } else {
                echo "<script>alert('Oops... Ocorreu algum erro com a solicitação. Tente novamente.'); document.location='../index.php';</script>";
              }
            } else {
              echo "<script>alert('Não foi possível realizar o registro!'); document.location='../registro.php';</script>";
            }
          } else {
            echo "<script>alert('Não foi possível realizar o registro!'); document.location='../registro.php';</script>";
          }
       
      }
    }
  }
}
