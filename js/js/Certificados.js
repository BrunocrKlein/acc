$(document).ready(function () {
  $("#tabela").DataTable({
    ordering: false,
    fixedHeader: true,
    rowReorder: {
      selector: 'td:nth-child(2)'
    },
    responsive: true
  });

  $("#tblMeusCertificados").DataTable({
    ordering: false,
    fixedHeader: true,
    rowReorder: {
      selector: 'td:nth-child(2)'
    },
    responsive: true
  });


  $.get("./Certificado/dash", {}, function (result) {
    $("#dashResumo").empty();
    $("#totalProgress").attr("style", "--value:75");

    const json = $.parseJSON(result);
    let htmlDash = "";

    htmlDash += "<div class='row justify-content-center'>";
    $.each(json, function (k, item) {
      htmlDash += "<div class='col d-flex align-items-center justify-content-center'>";
      htmlDash += "<div role='progressbar' aria-valuenow='65' aria-valuemin='0' aria-valuemax='100' style='--value:65'></div>";
      htmlDash += "</div>";
    });
    htmlDash += "</div>";

    htmlDash += "<div class='row justify-content-center mt-3'>";
    $.each(json, function (k, item) {
      htmlDash += "<div class='col d-flex align-items-center justify-content-center'>";
      htmlDash += item["quadro"];
      htmlDash += "</div>";
    });
    htmlDash += "</div>";

    htmlDash += "<div class='row justify-content-center mt-3'>";
    $.each(json, function (k, item) {
      htmlDash += "<div class='col d-flex align-items-center justify-content-center'>";
      htmlDash += "Total Certificados: 75. Total de Horas: 25:00";
      htmlDash += "</div>";
    });
    htmlDash += "</div>";

    $("#dashResumo").html(htmlDash);
  });

  $("#form-add-atv").submit(function (e) {
    e.stopPropagation();

    var formData = new FormData();

    formData.append('codAtividade', $("#btnAddCert").val());
    formData.append('nmCertificado', $("#nmCertificado").val());
    formData.append('hrCertificado', $("#hrCertificado").val());
    formData.append('arquivo', $('#arquivo').prop('files')[0]);

    $.ajax({
      url: './Certificado/gravar',
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
        location.reload();
      } else {
        alert("Gravado com sucesso!!!");
        location.reload();
      }
    });
  });
});

$(document).on("click", ".add-atv", function (e) {
  e.stopPropagation();

  let atividade = $(this).attr("data-atv");
  let unidade = $(this).attr("data-unidade");

  if (unidade === "unidades") {
    $("#hrCertificado").val("01:00");
    $("#hrCertificado").prop("disabled", true);
  }

  $("#btnAddCert").val(atividade);

  var tabela = $("#tblMeusCertificados").DataTable();
  tabela.clear();

  $.get("./Certificado/meusCertificados", {atividade}, function (result) {
    let json = $.parseJSON(result);
    $.each(json, function (index, item) {
      let id = item.codigo;
      let btnDel = "<button class='rm-crt btn btn-danger' data-crt='" + id + "'><i class='fa fa-trash' aria-hidden='true'></i></button>";
      let btnView = "<button class='vw-crt btn btn-primary' data-crt='" + id + "'><i class='fa fa-eye' aria-hidden='true'></i></button>";
      let btns = `${btnDel} &nbsp; ${btnView}`;

      tabela.row.add([
        item.nome, item.quantidade_horas, item.status, item.observacoes, btns
      ]);
    });

    tabela.draw();
  });
});

$(document).on("click", ".vw-crt", function (e) {
  e.stopPropagation();

  const codigo = $(this).attr("data-crt");

  window.open('./Certificado/viewCertificado?codigo=' + codigo, 'Meu Certificado').focus();
});

$(document).on("click", ".rm-crt", function (e) {
  e.stopPropagation();

  if (confirm("Deseja Realmente Excluir Esse Certificado?")) {
    const codigo = $(this).attr("data-crt");

    $.post("./Certificado/delete", {codigo}, function (result) {
      alert(result);
      window.location.reload();
    });
  }
});