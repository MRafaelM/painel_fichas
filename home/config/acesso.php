<?php

session_start();

if (!isset($_SESSION['logado'])) {
    header('Location: http://100.110.166.68/painel/login_atn/');
}

?>