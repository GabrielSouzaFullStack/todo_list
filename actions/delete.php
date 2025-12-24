<?php

require_once(__DIR__ . '/database/conexao.php');

$id = filter_input(INPUT_GET, 'id');

if ($id) {
  $sql = $pdo->prepare("DELETE FROM task WHERE id = :id");
  $sql->bindValue(':id', $id, PDO::PARAM_INT);
  $sql->execute();

  header('Location: ../api/index.php');
  exit;
}
