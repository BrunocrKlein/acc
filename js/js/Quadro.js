$(document).ready(function () {
  // $("#tabela").DataTable();
  $("#filtros").submit(function () {
    inserir();
    return false;
  });
});

$(document).on("click", ".deletar", function (event) {
  event.stopPropagation();
  const codigo = $(this).attr("data-id");

  bootbox.confirm("Deseja Realmente Excluir Esse Quadro?", function (result) {
    if (result) {
      deletar(codigo);
    }
  });
});

$(document).on("click", ".editar", function (event) {
  const codigo = $(this).attr('data-id');
  carregar_edt(codigo);
});

function deletar(codigo) {
  $.post("./Quadro/delete", {'codigo': codigo}, function (result) {
    bootbox.alert(result, function () {
      location.reload();
    });
  });
}

function carregar_edt(codigo) {
  $.get("./Quadro/update", {'codigo': codigo}, function (json) {
    json = $.parseJSON(json);
    $(json.dado).each(function (i, val) {
      $("#gravar").val(val.codigo);
      $("#nome").val(val.nome).trigger("change");
      $("#descricao").val(val.descricao).trigger("change");
      $("#total_horas").val(val.total_horas).trigger("change");
    });
  });
}

function inserir() {
  var formData = new FormData();
  formData.append('nome', $("#nome").val());
  formData.append('descricao', $("#descricao").val());
  formData.append('total_horas', $("#total_horas").val());
  formData.append('gravar', $("#gravar").val());
  $.ajax({
    url: './Quadro/create',
    dataType: 'text',
    cache: false,
    contentType: false,
    processData: false,
    data: formData,
    type: 'POST',
    sucess: function (result) {}
  }).done(function (msg) {
    if (msg != "ok") {
      alert("Ocorreu um erro: " + msg);

    } else {
      bootbox.alert("Gravado com sucesso!!!", function () {
        location.reload();
      });
    }

  });
}
 