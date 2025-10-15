<?php
function acertaValor($id_ver) {
    // Define as constantes para conexão com o banco de dados
    define('DB_HOST_V', 'localhost');
    define('DB_USERNAME_V', 'zeca');
    define('DB_PASSWORD_V', '@t1c3ntr41#Melancia@13?');
    define('DB_NAME_V', 'estoque');

    // Realiza a conexão com o banco de dados
    try {
        $pdo = new PDO("mysql:host=" . DB_HOST_V . ";dbname=" . DB_NAME_V . ";charset=utf8mb4", DB_USERNAME_V, DB_PASSWORD_V);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Falha na conexão: " . $e->getMessage();
        exit();
    }

    // Executa a consulta ao banco de dados
    try {
        $sql = $pdo->prepare("SELECT * FROM versao WHERE id_ver = :id_ver");
        $sql->bindParam(":id_ver", $id_ver, PDO::PARAM_INT);
        $sql->execute();
        $publisher = $sql->fetch(PDO::FETCH_ASSOC);

        if ($publisher) {
            $versao = $publisher['producao'] . "." . $publisher['alteracao'] . "." . $publisher['correcao'];
            return $versao;
        } else {
            return null; // Ou uma mensagem de erro/log se preferir
        }
    } catch (PDOException $e) {
        echo "Erro ao buscar os dados: " . $e->getMessage();
        return false;
    }
}
?>
