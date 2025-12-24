<?php

require __DIR__ . '/../vendor/autoload.php';

// Só carrega o .env se o arquivo existir (desenvolvimento local)
if (file_exists(__DIR__ . '/../.env')) {
  $dotenv = Dotenv\Dotenv::createUnsafeImmutable(__DIR__ . '/..');
  $dotenv->load();
}

// Pega as variáveis (do .env local ou da Railway)
$hostname = getenv('HOSTNAME');
$data_base = getenv('DATA_BASE');
$user = getenv('USER_DB');
$password = getenv('PASSWORD_DB');

try {
  $pdo = new PDO("pgsql:host=$hostname;dbname=$data_base", $user, $password);
} catch (PDOException $e) {
  echo "Erro: " . $e->getMessage();
}
