$(document).ready(function () {
  var tabela = $("#tabela").DataTable({
    ordering: false,
    fixedHeader: true,
    rowReorder: {
      selector: 'td:nth-child(2)'
    },
    responsive: true
  });

  $.get("./Certificado/listagemProfessor", {}, function (result) {
    const json = $.parseJSON(result);

    $.each(json, function (i, item) {
      let btnExtrato = "<button type='button' class='btn-extrato btn-acao btn btn-success' data-id='" + item.matricula + "'>Extrato</button>";
      let btnCertificados = "<button type='button' class='btn-certificados btn-acao btn btn-primary' data-id='" + item.matricula + "'>Certificados</button>";
      let total = parseInt(item.quadro1) + parseInt(item.quadro2) + parseInt(item.quadro3) + parseInt(item.quadro4);

      tabela.row.add([
        item.matricula, item.nome, item.quadro1 + "%", item.quadro2 + "%", item.quadro3 + "%", item.quadro4 + "%",
        (total >= 85 ? "100%" : total + "%"),
        btnExtrato + " " + btnCertificados
      ]);
    });

    tabela.draw();

    return false;
  });
});

$(document).on("click", ".btn-extrato", function (event) {
  event.stopPropagation();

  const matricula = $(this).attr("data-id");

  window.open('./Certificado/extratoAluno?matricula=' + matricula, 'Extrato do Aluno').focus();
});

$(document).on("click", ".btn-certificados", function (event) {
  event.stopPropagation();

  const matricula = $(this).attr("data-id");

  window.location.href = "Certificado/certificadosAluno?matricula=" + matricula;
});