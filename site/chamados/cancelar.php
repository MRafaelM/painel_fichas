<?php
require_once "../assets/secure/acesso.php";

require_once "../../config/pdo_database.php";
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["prioridade"])) {
        if ($_POST["prioridade"] === "Azul") {
            $prioridade_azul = 'Azul';
            $consulta_azul = $pdo->prepare("SELECT numero FROM chamados WHERE  prioridade = :prioridade ORDER BY id_chamado DESC LIMIT 1");
            $consulta_azul->bindParam(':prioridade', $prioridade_azul);
            $consulta_azul->execute();
            $resultado = $consulta_azul->fetch(PDO::FETCH_ASSOC);

            $numero = $resultado['numero'];
            $nome_funcionario = $_POST["nome_funcionario"];
            $data_abertura = date("Y-m-d H:i:s");
            $data_fechamento = date("Y-m-d H:i:s");

            $concluir_azul = $pdo->prepare("UPDATE chamados SET status = 'Cancelado', data_fechamento = :data_fechamento WHERE numero = :numero AND status = 'Aberto' AND prioridade = 'Azul'");
            $concluir_azul->bindParam(':numero', $numero);
            $concluir_azul->bindParam(':data_fechamento', $data_fechamento);
            $concluir_azul->execute();

            $numero_novo = $resultado['numero'] + 1;
            $status_novo = 'Aberto';
            $iniciar_azul = $pdo->prepare("INSERT INTO chamados (numero, nome_funcionario, data_abertura, data_fechamento, prioridade, status) VALUES (?, ?, ?, NULL, 'Azul', ?)");
            $iniciar_azul->execute([$numero_novo, $nome_funcionario, $data_abertura, $status_novo]);

            header("Location: chamar.php");
            exit();
        } elseif ($_POST["prioridade"] === "Vermelho") {
            $prioridade_vermelho = 'Vermelho';
            $consulta_vermelho = $pdo->prepare("SELECT numero FROM chamados WHERE prioridade = :prioridade ORDER BY id_chamado DESC LIMIT 1");
            $consulta_vermelho->bindParam(':prioridade', $prioridade_vermelho);
            $consulta_vermelho->execute();
            $resultado = $consulta_vermelho->fetch(PDO::FETCH_ASSOC);

            $numero = $resultado['numero'];
            $nome_funcionario = $_POST["nome_funcionario"];
            $data_abertura = date("Y-m-d H:i:s");
            $data_fechamento = date("Y-m-d H:i:s");

            $concluir_vermelho = $pdo->prepare("UPDATE chamados SET status = 'Cancelado', data_fechamento = :data_fechamento WHERE numero = :numero AND status = 'Aberto'");
            $concluir_vermelho->bindParam(':numero', $numero);
            $concluir_vermelho->bindParam(':data_fechamento', $data_fechamento);
            $concluir_vermelho->execute();

            $numero_novo = $resultado['numero'] + 1;
            $status_novo = 'Aberto';
            $iniciar_vermelho = $pdo->prepare("INSERT INTO chamados (numero, nome_funcionario, data_abertura, data_fechamento, prioridade, status) VALUES (?, ?, ?, NULL, 'Vermelho', ?)");
            $iniciar_vermelho->execute([$numero_novo, $nome_funcionario, $data_abertura, $status_novo]);

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