<?php
$versao = time();

$logado = false;
$isTeacher = false;
if (isset($this->session->usuario_logado['isteacher'])) {
  $logado = true;
  if ($this->session->usuario_logado['isteacher'] == 'p') {
    $isTeacher = true;
  }
}

if (!$isTeacher) {
  header("Location: ./ControllerLogin/ControllerRedireciona");
  die();
}

$tbody = "";
foreach ($data as $tr) {
  $btns = " <button class='btn-ver btn btn-primary' data-id='" . $tr->codigo . "'>Visualizar</button>";
  $btns .= " <button class='btn-val btn btn-success' data-id='" . $tr->codigo . "'>Validar</button>";
  $btns .= " <button class='btn-rec btn btn-danger' data-id='" . $tr->codigo . "'>Recusar</button>";

  $tbody .= "<tr>"
          . "<td>" . $tr->quadro . "</td>"
          . "<td>" . $tr->atividade . "</td>"
          . "<td>" . $tr->nome . "</td>"
          . "<td>" . $tr->quantidade_horas . "</td>"
          . "<td>" . $tr->status . "</td>"
          . "<td>" . $tr->observacoes . "</td>"
          . "<td>" . $btns . "</td>"
          . "</tr>";
}
?>

<!DOCTYPE html>
<html lang="pt-br">

  <head>
    <meta charset="UTF-8">
    <title> Certificados </title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrap.min.css'); ?>">
    <link type="text/css" href="<?php echo base_url('css/css/menu.css?v=<?= time()?>'); ?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("css/css/Certificado.css?v=$versao"); ?>" />

    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js" integrity="sha512-RdSPYh1WA6BF0RhpisYJVYkOyTzK4HwofJ3Q7ivt/jkpW6Vc8AurL1R+4AUcvn9IwEKAPm/fk7qFZW3OuiUDeg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

    <script src="<?php echo base_url("js/js/CertificadosAlunoView.js?v=$versao"); ?>"></script>
  </head>

  <body>
    <?php
    include "menu_sup.php";
    ?>

    <div class="container-fluid">
      <div class="row col-12 text-center mt-3 mb-5">
        <h3>Certificados - Aluno <?= $nmAluno; ?></h3>
      </div>

      <div class="row justify-content-center">
        <table id="tabela" class="table mt-5">
          <thead>
            <tr>
              <th>Quadro</th>
              <th>Atividade</th>
              <th>Nome</th>
              <th>Qtde/Horas</th>
              <th>Status</th>
              <th>Obs</th>
              <th></th>
            </tr>
          </thead>
          <tbody><?= $tbody; ?></tbody>
        </table>
      </div>
    </div>

    <script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
