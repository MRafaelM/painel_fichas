<?php
require_once "../../assets/secure/acesso.php";
require_once "../../../config/pdo_database.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $desativar = $pdo->prepare("UPDATE login SET situacao = 'Inativo' WHERE id = :id");
    $desativar->bindParam(':id', $id);
    $desativar->execute();
    
    header("Location: ../users.php?desativado=ok");
    exit();
} else {
    header("Location: ../users.php?desativado=erro");
    exit();
}
?>
