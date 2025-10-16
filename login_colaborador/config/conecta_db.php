<?php
// Lê o arquivo .env
$dotenv = parse_ini_file('.env');

// Verifica se o .env foi carregado corretamente
if (!$dotenv) {
    die("Erro: arquivo .env não encontrado ou inválido.");
}

// Define as constantes usando as variáveis do .env
define('DB_HOST', $dotenv['DB_HOST']);
define('DB_USERNAME', $dotenv['DB_USERNAME']);
define('DB_PASSWORD', $dotenv['DB_PASSWORD']);
define('DB_NAME', $dotenv['DB_NAME']);

// Realiza a conexão com o banco de dados
try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
        DB_USERNAME,
        DB_PASSWORD
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Falha na conexão: " . $e->getMessage());
}
?>
