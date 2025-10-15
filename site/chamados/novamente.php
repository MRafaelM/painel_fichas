<?php
require_once "../assets/secure/acesso.php";

require_once "../../config/pdo_database.php";
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["prioridade"])) {
        if ($_POST["prioridade"] === "Azul") {
            $numero = $_POST["ultimo_numero"];
            $nome_funcionario = $_POST["nome_funcionario"];
            $data_abertura = date("Y-m-d H:i:s");

            $verifica_status = $pdo->prepare("SELECT * FROM chamados WHERE numero = :numero AND status = 'Aberto'");
            $verifica_status->bindParam(':numero', $_POST["ultimo_numero"]);
            $verifica_status->execute();

            if ($verifica_status->rowCount() > 0) {
                $atualizar_novamente = $pdo->prepare("UPDATE chamados SET novamente = novamente + 1 WHERE numero = :numero AND status = 'Aberto'");
                $atualizar_novamente->bindParam(':numero', $_POST["ultimo_numero"]);
                $atualizar_novamente->execute();
            }

            header("Location: chamar.php");
            exit();
        } elseif ($_POST["prioridade"] === "Vermelho") {
            $numero = $_POST["ultimo_numero"] + 1;
            $data_abertura = date("Y-m-d H:i:s");

            $verifica_status = $pdo->prepare("SELECT * FROM chamados WHERE numero = :numero AND status = 'Aberto'");
            $verifica_status->bindParam(':numero', $_POST["ultimo_numero"]);
            $verifica_status->execute();

            if ($verifica_status->rowCount() > 0) {
                $atualizar_novamente = $pdo->prepare("UPDATE chamados SET novamente = novamente + 1 WHERE numero = :numero AND status = 'Aberto'");
                $atualizar_novamente->bindParam(':numero', $_POST["ultimo_numero"]);
                $atualizar_novamente->execute();
            }
            header("Location: chamar.php");
            exit();
        } else {
            echo "prioridade desconhecido";
        }
    } else {
        echo "Campo 'prioridade' não enviado";
    }
} else {
    echo "Método de requisição incorreto";
}
?>