<?php
require_once "../assets/secure/acesso.php";
require_once "../../config/pdo_database.php";

$data_hoje = date('Y-m-d'); // Data atual no formato do MySQL

$consulta = $pdo->prepare("SELECT * FROM chamados WHERE DATE(data_abertura) = ?");
$consulta->execute([$data_hoje]);
$chamados = $consulta->fetchAll(PDO::FETCH_ASSOC);

$consulta = $pdo->prepare("SELECT * FROM atendimentos_externos WHERE DATE(data_atendimento) = ?");
$consulta->execute([$data_hoje]);
$telefones = $consulta->fetchAll(PDO::FETCH_ASSOC);

$consulta = $pdo->prepare("SELECT * FROM tabela_social WHERE DATE(data_atendimento) = ?");
$consulta->execute([$data_hoje]);
$social = $consulta->fetchAll(PDO::FETCH_ASSOC);

$funcionarios = [];
$azuis = 0;
$vermelhos = 0;
$cancelados = 0;
$quant_telefones = 0;
$quant_sociais = 0;

foreach ($chamados as $chamado) {
    // Conta quantos chamados cada funcionário fez
    $funcionario = $chamado['nome_funcionario'];
    if (isset($funcionarios[$funcionario])) {
        $funcionarios[$funcionario]['chamados']++;
    } else {
        $funcionarios[$funcionario]['chamados'] = 1;
        $funcionarios[$funcionario]['telefones'] = 0;
        $funcionarios[$funcionario]['sociais'] = 0; // Inicializar o contador de atendimentos sociais
    }

    // Conta quantos chamados são azuis e quantos são vermelhos
    if ($chamado['prioridade'] == 'Azul') {
        $azuis++;
    } elseif ($chamado['prioridade'] == 'Vermelho') {
        $vermelhos++;
    }

    // Conta quantos chamados foram cancelados
    if ($chamado['status'] == 'Cancelado') {
        $cancelados++;
    }
}

foreach ($telefones as $telefone) {
    // Conta quantos atendimentos telefônicos cada funcionário realizou
    $funcionario = $telefone['nome_funcionario'];
    if (isset($funcionarios[$funcionario])) {
        $funcionarios[$funcionario]['telefones']++;
    } else {
        $funcionarios[$funcionario]['telefones'] = 1;
        $funcionarios[$funcionario]['chamados'] = 0;
        $funcionarios[$funcionario]['sociais'] = 0;
    }

    $quant_telefones++;
}

foreach ($social as $soc) {
    // Conta quantos atendimentos sociais cada funcionário realizou
    $funcionario = $soc['nome_funcionario'];
    if (isset($funcionarios[$funcionario])) {
        $funcionarios[$funcionario]['sociais']++;
    } else {
        $funcionarios[$funcionario]['sociais'] = 1;
        $funcionarios[$funcionario]['chamados'] = 0;
        $funcionarios[$funcionario]['telefones'] = 0;
    }

    $quant_sociais++;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <link rel="icon" href="../assets/img/brasao.png">

    <title>Relatório Diário</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            margin-top: 30px;
            padding: 0;
        }

        @page {
            size: A4;
            margin: 0;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            page-break-before: always;
        }

        h4 {
            margin-bottom: 0.5em;
            text-align: center;
        }

        img {
            max-width: 100%;
            height: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td,
        th {
            padding: 5px;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        p {
            margin: 0;
        }

        .footer {
            position: absolute;
            bottom: 20px;
            right: 0;
            left: 0;
            text-align: end;
        }

        .footer-line {
            width: 50%;
            margin: auto;
            border-top: 1px solid #333;
        }

        .footer-name {
            margin-top: 10px;
            text-align: center;
        }

        .row {
            text-align: center;
        }

        .no-border td,
        .no-border th {
            border: none;
        }
    </style>
</head>

<body>
    <?php
    session_start();
    ?>

    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center" style="margin-top: 20px;">
                <table class="mx-auto no-border">
                    <tr>
                        <td>
                            <img src="../assets/img/brasao.png" alt="" width="82" height="90">
                        </td>
                        <td>
                            <b>
                                <h4 style="width:80%;">PREFEITURA MUNICIPAL DE SOLEDADE<br>SECRETARIA DA SAÚDE
                                    <br> REGULAÇÃO DE CONSULTAS E EXAMES
                                </h4>
                            </b>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <br>
        <div style="text-align: end;">
            <table class="no-border">
                <tr>
                    <td><i>&nbsp;&nbsp;Código controle:&nbsp; <?php echo $_SESSION['id_usuario']; ?> </i></td>
                </tr>
            </table>
        </div>

        <h4>Relatório de Chamados - <?php echo date('d/m/Y'); ?></h4>

        <p>Total de Chamados: <?php echo count($chamados); ?></p>
        <p>Total de Chamados Azuis: <?php echo $azuis; ?></p>
        <p>Total de Chamados Vermelhos: <?php echo $vermelhos; ?></p>
        <p>Total de Chamados Cancelados: <?php echo $cancelados; ?></p>
        <p>Total de Chamados pelo Telefone: <?php echo $quant_telefones; ?></p>
        <p>Total de Chamados pelo Balcão: <?php echo $quant_sociais; ?></p>

        <h4>Chamados Internos por Funcionário:</h4>
        <table>
            <thead>
                <tr>
                    <th>Funcionário</th>
                    <th>Quantidade chamados</th>
                    <th>Quantidade telefone</th>
                    <th>Quantidade Balcão</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($funcionarios as $funcionario => $quantidades) : ?>
                    <tr>
                        <td><?php echo $funcionario; ?></td>
                        <td><?php echo $quantidades['chamados']; ?></td>
                        <td><?php echo $quantidades['telefones']; ?></td>
                        <td><?php echo $quantidades['sociais']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="footer">
        <div class="footer-line"></div>
        <div class="footer-name"><?php echo $_SESSION['nome']; ?></div>
    </div>
</body>

</html>
