$(document).ready(function () {
  $("#tabela").DataTable({
    ordering: false,
    fixedHeader: true,
    rowReorder: {
      selector: 'td:nth-child(2)'
    },
    responsive: true
  });
});

$(document).on("click", ".btn-ver", function (event) {
  event.stopPropagation();

  const codigo = $(this).attr("data-id");

  window.open('./verCertificadoAluno?codigo=' + codigo, 'Extrato do Aluno').focus();
});