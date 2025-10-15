<?php
require_once "../assets/secure/acesso.php";
require_once "../../config/pdo_database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome_funcionario = $_POST['funcionario'];
    $nome_cidadao = $_POST["nome_cidadao"];
    $tipo_atendimento = $_POST["tipo_atendimento"];

    if (!empty($nome_cidadao) && $tipo_atendimento != "Selecione") {

        $data_atendimento = date("Y-m-d");

        $consulta_numero = $pdo->prepare("SELECT numero FROM atendimentos_externos ORDER BY id_atendimento DESC LIMIT 1");
        $consulta_numero->execute();
        $resultado = $consulta_numero->fetch(PDO::FETCH_ASSOC);
        $numero_velho = $resultado['numero'];
        $numero_novo = $numero_velho + 1;

        var_dump($nome_funcionario, $nome_cidadao, $tipo_atendimento, $data_atendimento, $numero_novo);

        $atendimento = $pdo->prepare("INSERT INTO atendimentos_externos (nome_cidadao, data_atendimento, tipo_atendimento, nome_funcionario, numero) VALUES (?, ?, ?, ?, ?)");
        $atendimento->execute([$nome_cidadao, $data_atendimento, $tipo_atendimento, $nome_funcionario, $numero_novo]);

        echo "<script>alert('Atendimento Externo salvo com sucesso!'); document.location='telefone.php';</script>";
    } else {
        echo "<script>alert('Os campos \"nome do cidadão\" e \"tipo de atendimento\" são obrigatórios, tente novamente!'); document.location='telefone.php';</script>";
    }
}
