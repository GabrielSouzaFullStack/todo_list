<?php

require_once(__DIR__ . '/../api/database/conexao.php');
$descricao = filter_input(INPUT_POST, 'description');

if ($descricao) {
  $sql = $pdo->prepare("INSERT INTO task (descricao, tarefa_finalizada) VALUES (:descricao, false)");
  $sql->bindValue(':descricao', $descricao);
  $sql->execute();

  header('Location: ../api/index.php');
  exit;
}
