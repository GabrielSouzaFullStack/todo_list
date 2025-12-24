<?php
require_once(__DIR__ . '/../database/conexao.php');
$tasks = [];
$sql = $pdo->query("select * from task order by id asc");

if ($sql->rowCount() > 0) {
  $tasks = $sql->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>To-Do-List</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="/src/style/style.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
  <div id="todo">
    <h1>Todo List</h1>

    <form action="/actions/create.php" method="POST" class="to-do-form">
      <input type="text" name="description" placeholder="Digite sua tarefa aqui" required>
      <button type="submit" class="form-button">
        <i class="fa-solid fa-plus"></i>
      </button>
    </form>

    <div id="tasks">
      <?php foreach ($tasks as $task): ?>

        <div class="task">
          <input type="checkbox" name="progress" class="progress <?= $task['tarefa_finalizada'] ? 'done' : '' ?>"
          data-task-id="<?= $task['id'] ?>"
          <?= $task['tarefa_finalizada'] ? 'checked' : '' ?>>

          <p class="task-description"><?= $task['descricao'] ?></p>

          <div class="task-actions">
            <a class="action-button edit-button">
              <i class="fa-regular fa-pen-to-square"></i>
            </a>
            <a href="/actions/delete.php?id=<?= $task['id'] ?>" class="action-button delete-button">
              <i class="fa-solid fa-trash"></i>
            </a>
            <form action="actions/update.php" method="POST" class="to-do-form edit-task hidden">
              <input type="hidden" name="id" value="<?= $task['id'] ?>">
              <input type="text" name="description" placeholder="Edite sua tarefa aqui" value="<?= $task['descricao'] ?>">
              <button type="submit" class="form-button confirm-button">
                <i class="fa-solid fa-check"></i>
              </button>
            </form>
          </div>
        </div>
      <?php endforeach ?>

    </div>
  </div>

  <script src="/src/javascript/script.js"></script>
</body>

</html>