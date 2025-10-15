<?php
require_once "../assets/secure/acesso.php";

require_once "../../config/pdo_database.php";
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["prioridade"])) {
        if ($_POST["prioridade"] === "Azul") {
            $numero = $_POST["numero_inicio_Azul"];
            $ultimo_azul = $_POST["ultimo_azul"];
            $nome_funcionario = $_POST["nome_funcionario"];
            $data_abertura = date("Y-m-d H:i:s");
            $data_fechamento = date("Y-m-d H:i:s");
            $status = "Aberto";

            $concluir_azul = $pdo->prepare("UPDATE chamados SET status = 'Concluido', data_fechamento = :data_fechamento WHERE numero = :numero AND status = 'Aberto'");
            $concluir_azul->bindParam(':numero', $_POST["ultimo_azul"]);
            $concluir_azul->bindParam(':data_fechamento', $data_fechamento);
            $concluir_azul->execute();


            $iniciar_azul = $pdo->prepare("INSERT INTO chamados (numero, nome_funcionario, data_abertura, data_fechamento, prioridade, status) VALUES (?, ?, ?, NULL, 'Azul', ?)");
            $iniciar_azul->execute([$numero, $nome_funcionario, $data_abertura, $status]);

            header("Location: chamar.php");
            exit();
        } elseif ($_POST["prioridade"] === "Vermelho") {
            $numero = $_POST["numero_inicio_vermelho"];
            $ultimo_vermelho = $_POST["ultimo_vermelho"];
            $nome_funcionario = $_POST["nome_funcionario"];
            $data_abertura = date("Y-m-d H:i:s");
            $data_fechamento = date("Y-m-d H:i:s");
            $status = "Aberto";

            $concluir_vermelho = $pdo->prepare("UPDATE chamados SET status = 'Concluido', data_fechamento = :data_fechamento WHERE numero = :numero AND status = 'Aberto'");
            $concluir_vermelho->bindParam(':numero', $_POST["ultimo_vermelho"]);
            $concluir_vermelho->bindParam(':data_fechamento', $data_fechamento);
            $concluir_vermelho->execute();


            $iniciar_vermelho = $pdo->prepare("INSERT INTO chamados (numero, nome_funcionario, data_abertura, data_fechamento, prioridade, status) VALUES (?, ?, ?, NULL, 'Vermelho', ?)");
            $iniciar_vermelho->execute([$numero, $nome_funcionario, $data_abertura, $status]);


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