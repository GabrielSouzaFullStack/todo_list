<?php

require_once(__DIR__ . '/database/conexao.php');
$descricao = filter_input(INPUT_POST, 'description');
$id = filter_input(INPUT_POST, 'id');

if ($descricao && $id) {
  $sql = $pdo->prepare("UPDATE task SET descricao = :descricao WHERE id = :id");
  $sql->bindValue(':descricao', $descricao);
  $sql->bindValue(':id', $id, PDO::PARAM_INT);
  $sql->execute();

  header('Location: ../api/index.php');
  exit;
}
