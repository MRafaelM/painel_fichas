<?php
session_start();
session_destroy();
header("Location: https://pmsoledaders.inf.br/painel/");
exit;