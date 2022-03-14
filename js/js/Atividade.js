$(document).ready(function () {
  $("#tabela").DataTable();

  $("#crud-atividade").submit(function (event) {
    event.stopPropagation();

    gravar();

    return false;
  });
});

$(document).on("click", ".editar", function (event) {
  event.stopPropagation();
  const codigo = $(this).attr('data-id');
  carregar_edt(codigo);
});

$(document).on("click", ".deletar", function (event) {
  event.stopPropagation();
  const codigo = $(this).attr("data-id");

  bootbox.confirm("Deseja Realmente Excluir Essa Atividade?", function (result) {
    if (result) {
      deletar(codigo);
    }
  });
});

function deletar(codigo) {
  $.post("./Atividade/delete", {codigo}, function (result) {
    bootbox.alert(result, function () {
      location.reload();
    });
  });
}

function carregar_edt(codigo) {
  $.get("./Atividade/update", {codigo}, function (json) {
    let dado = $.parseJSON(json).dado;

    $("#selQuadro").val(dado.cod_quadro).trigger("change");
    $("#nmAtividade").val(dado.descricao).trigger("change");
    $("#selUnidade").val(dado.unidade).trigger("change");
    $("#totalHoras").val(dado.total_horas).trigger("change");
    $("#formContHoras").val(dado.formula_hr_contabilizar).trigger("change");
    $("#formTotHoras").val(dado.formula_total).trigger("change");
    $("#gravar").val(codigo);
  });
}

function gravar() {

  var formData = new FormData();
  formData.append('codigo', $("#gravar").val());
  formData.append('selQuadro', $("#selQuadro").val());
  formData.append('nmAtividade', $("#nmAtividade").val());
  formData.append('selUnidade', $("#selUnidade").val());
  formData.append('totalHoras', $("#totalHoras").val());
  formData.append('formContHoras', $("#formContHoras").val());
  formData.append('formTotHoras', $("#formTotHoras").val());

  $.ajax({
    url: './Atividade/persist',
    dataType: 'text',
    cache: false,
    contentType: false,
    processData: false,
    data: formData,
    type: 'POST',
    sucess: function (result) {}
  }).done(function (msg) {
    if (msg !== "ok") {
      alert("Ocorreu um erro: " + msg);
    } else {
      bootbox.alert("Gravado com sucesso!!!", function () {
        location.reload();
      });
    }
  });
}