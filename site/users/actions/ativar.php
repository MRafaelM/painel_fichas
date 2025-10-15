<?php
require_once "../../assets/secure/acesso.php";
require_once "../../../config/pdo_database.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $ativar = $pdo->prepare("UPDATE login SET situacao = 'Ativo' WHERE id = :id");
    $ativar->bindParam(':id', $id);
    $ativar->execute();
    
    header("Location: ../users.php?ativado=ok");
    exit();
} else {
    header("Location: ../users.php?ativado=erro");
    exit();
}
?>
