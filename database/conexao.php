<?php

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createUnsafeImmutable(__DIR__ . '/..');
$dotenv->load();

$hostname = getenv('HOSTNAME');
$data_base = getenv('DATA_BASE');
$user = getenv('USER_DB');
$password = getenv('PASSWORD_DB');

try {
  $pdo = new PDO("pgsql:host=$hostname;dbname=$data_base", $user, $password);
} catch (PDOException $e) {
  echo "Erro: " . $e->getMessage();
}
