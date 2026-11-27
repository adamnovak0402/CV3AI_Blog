<?php
$host = getenv('DB_HOST');
$dbname = getenv('DB_NAME');
$user = getenv('DB_USER');
$password = getenv('DB_PASSWORD');

$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

try {
    $connection = new PDO($dsn, $user, $password);

    $connection->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );

    $connection->setAttribute(
        PDO::ATTR_DEFAULT_FETCH_MODE,
        PDO::FETCH_ASSOC
    );

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    error_log($e->getMessage());
    http_response_code(500);
    exit('Chyba připojení k databázi.');
}
