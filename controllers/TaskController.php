<?php

require_once(__DIR__ . '/../config/conexao.php');

class TaskController
{
  private $pdo;

  public function __construct($pdo)
  {
    $this->pdo = $pdo;
  }

  // Controlador dos métodos do to-do-list conforme a escolha do usuário
  public function controleMetodo()
  {
    $action = filter_input(INPUT_GET, 'action') ?? filter_input(INPUT_POST, 'action');

    switch ($action) {
      case 'criar-tarefa':
        $this->criarTarefa();
        break;
      case 'atualizar-tarefa':
        $this->atualizarTarefa();
        break;
      case 'atualizar-progresso':
        $this->atualizarProgresso();
        break;
      case 'deletar-tarefa':
        $this->deletarTarefa();
        break;
      default:
        header('Location: ../index.php');
        exit;
    }
  }
  // Cria a tarefa utilizando o PDO e envia as informações para o banco de dados.
  public function criarTarefa()
  {

    $descricao = filter_input(INPUT_POST, 'description');

    if ($descricao) {
      $sql = $this->pdo->prepare("INSERT INTO task (descricao, tarefa_finalizada) VALUES (:descricao, false)");
      $sql->bindValue(':descricao', $descricao);
      $sql->execute();

      header('Location: ../index.php');
      exit;
    }
  }

  // Atualiza a tarefa utilizando o PDO e envia as informações para o banco de dados.
  public function atualizarTarefa()
  {
    $descricao = filter_input(INPUT_POST, 'description');
    $id = filter_input(INPUT_POST, 'id');

    if ($descricao && $id) {
      $sql = $this->pdo->prepare("UPDATE task SET descricao = :descricao WHERE id = :id");
      $sql->bindValue(':descricao', $descricao);
      $sql->bindValue(':id', $id, PDO::PARAM_INT);
      $sql->execute();

      header('Location: ../index.php');
      exit;
    }
  }

  // Deleta a tarefa utilizando o PDO e envia as informações para o banco de dados.
  public function deletarTarefa()
  {
    $id = filter_input(INPUT_GET, 'id');

    if ($id) {
      $sql = $this->pdo->prepare("DELETE FROM task WHERE id = :id");
      $sql->bindValue(':id', $id, PDO::PARAM_INT);
      $sql->execute();

      header('Location: ../index.php');
      exit;
    }
  }

  // Atualiza o progresso ta tarefa seja pendente ou concluída
  public function atualizarProgresso()
  {
    $id = filter_input(INPUT_POST, 'id');
    $verificado = filter_input(INPUT_POST, 'tarefa_finalizada');

    if ($id && $verificado) {
      $sql = $this->pdo->prepare("UPDATE task SET tarefa_finalizada = :verificado WHERE id = :id");
      $sql->bindValue(':verificado', $verificado);
      $sql->bindValue(':id', $id, PDO::PARAM_INT);
      $sql->execute();

      echo json_encode(['success' => true]);
      exit;
    } else {
      echo json_encode(['success' => false]);
      exit;
    }
  }

  // Consulta e retorna todas as tarefas exisitentes na tabela no DataBase
  public function obterTarefas () {
    $sql = $this->pdo->query("select * from task order by id asc");

    // Verifica se a quantide de linhas é maior que zero
    if ($sql->rowCount() > 0) {
      return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    return [];
  }
}

// Se for uma requisição de ação, processa.
if (isset($_GET['action']) || isset($_POST['action'])) {
  $taskController = new TaskController($pdo);
  $taskController->controleMetodo();
}