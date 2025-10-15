<?php
require_once "../../config/pdo_database.php";

$consulta_produto = $pdo->prepare("SELECT numero, prioridade, novamente FROM chamados WHERE status = 'Aberto' ORDER BY id_chamado DESC LIMIT 1");
$consulta_produto->execute();
$chamado = $consulta_produto->fetch(PDO::FETCH_ASSOC);
$ultimo_numero = $chamado["numero"];
$prioridade = $chamado["prioridade"];
$repetir = $chamado["novamente"];

ob_start();
?>
<style>
    .senha-container,
    .sala-container {
        background-color:
            <?php echo $prioridade == "Vermelho" ? "red" : ($prioridade == "Azul" ? "#007bff" : "transparent"); ?>
        ;
        /* Adicione outros estilos conforme necessário */
    }

    .data-hora {
        color:
            <?php echo $prioridade == "Vermelho" ? "red" : ($prioridade == "Azul" ? "#007bff" : "white"); ?>
        ;
        /* Adicione outros estilos conforme necessário */
    }

    .frase-container {
        background-color:
            <?php echo $prioridade == "Vermelho" ? "red" : ($prioridade == "Azul" ? "#007bff" : "transparent"); ?>
        ;
        /* Adicione outros estilos conforme necessário */
    }
</style>

<div class="senha-container">
    <?php if ($prioridade === "Vermelho"): ?>
        <h2 id="prioridade"><?php echo "PRIORITÁRIO Nº"; ?></h2>
    <?php else: ?>
        <h2 id="prioridade" style="display: none;"><?php echo $prioridade; ?></h2>
        <h2 id="texto">Senha número:</h2>
    <?php endif; ?>
    <h1 id="senha"><?php echo $ultimo_numero; ?></h1>
    <p id="repetir" type="hidden"><?php echo $repetir; ?></p>
</div>
<div class="sala-container">
    <h2>Prosseguir para:</h2>
    <h1 id="sala">Sala 1</h1>
</div>
<?php
$html = ob_get_clean();

echo json_encode(array("numero" => $ultimo_numero, "prioridade" => $prioridade, "repetir" => $repetir, "html" => $html));
?>