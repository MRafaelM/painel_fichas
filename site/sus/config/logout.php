<?php

session_start();
session_unset();
session_destroy();

header('Location: http://100.110.166.68/painel/login_atn/');

?>