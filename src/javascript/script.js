$(document).ready(function () {
  $(".edit-button").on("click", function () {
    var task = $(this).closest(".task");
    task.find(".progress").addClass("hidden");
    task.find(".task-description").addClass("hidden");
    task.find(".action-button").addClass("hidden");
    task.find(".edit-task").removeClass("hidden");
  });

  $(".progress").on("click", function () {
    if ($(this).is(":checked")) {
      $(this).addClass("done");
    } else {
      $(this).removeClass("done");
    }
  });

  $('.progress').on('change', function () {
    const id = $(this).data('task-id');
    const verificado = $(this).is(':checked') ? 'true' : 'false';
    $.ajax({
      url: 'controllers/TaskController.php?action=atualizar-progresso',
      method: 'POST',
      data: {
        id: id,
        tarefa_finalizada: verificado
      },
      dataType: 'json',
      success: function (res) {
        if (res.success) {
        } else {
          alert("Erro ao editar a tarefa");
        }
      },
      error: function () {
        alert("Ocorreu um erro!");
      }
    });
  });
});
