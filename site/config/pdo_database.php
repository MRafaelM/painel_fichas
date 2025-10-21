<?php
// Caminho absoluto para o .env
$dotenv_path = __DIR__ . '/../../.env'; // assume que o .env está na raiz acima da pasta config

$dotenv = parse_ini_file($dotenv_path);

// Verifica se o .env foi carregado corretamente
if (!$dotenv) {
    die("Erro: arquivo .env não encontrado ou inválido. Procurado em: $dotenv_path");
}

// Define as constantes usando as variáveis do .env
define('DB_HOST', $dotenv['DB_HOST']);
define('DB_USERNAME', $dotenv['DB_USER']);
define('DB_PASSWORD', $dotenv['DB_PASS']);
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
