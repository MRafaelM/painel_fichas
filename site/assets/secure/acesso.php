<?php

session_start();

if (!isset($_SESSION['logado'])) {
    header('Location: https://pmsoledaders.inf.br/painel/login/');
}

?>