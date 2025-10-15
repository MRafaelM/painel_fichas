<?php
require_once "../../assets/secure/acesso.php";
require_once "../../../config/pdo_database.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $Apagar = $pdo->prepare("DELETE FROM login WHERE id = :id");
    $Apagar->bindParam(':id', $id);
    $Apagar->execute();
    
    header("Location: ../users.php?apagado=ok");
    exit();
} else {
    header("Location: ../users.php?apagado=erro");
    exit();
}
