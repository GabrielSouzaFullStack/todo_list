<?php

require_once(__DIR__ . '/../database/conexao.php');
$id = filter_input(INPUT_POST, 'id');
$verificado = filter_input(INPUT_POST, 'tarefa_finalizada');

if ($id && $verificado) {
  $sql = $pdo->prepare("UPDATE task SET tarefa_finalizada = :verificado WHERE id = :id");
  $sql->bindValue(':verificado', $verificado);
  $sql->bindValue(':id', $id, PDO::PARAM_INT);
  $sql->execute();

  echo json_encode(['success' => true]);
  exit;
} else {
  echo json_encode(['success' => false]);
  exit;
}