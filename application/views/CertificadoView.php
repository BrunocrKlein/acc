<?php
$versao = time();

$tbody = "";
foreach ($data as $tr) {
  $btnAdd = "<button class='add-atv btn btn-success' data-atv='" . $tr->cod_atividade . "' data-unidade='" . $tr->unidade . "' data-toggle='modal' data-target='#modalAddCertificado'><i class='fa fa-file' aria-hidden='true'></i></button>";

  $tbody .= "<tr>"
    . "<td>" . $tr->quadro . "</td>"
    . "<td>" . $tr->atividade . "</td>"
    . "<td>" . $tr->unidade . "</td>"
    . "<td>" . $tr->limite . "</td>"
    . "<td>" . $tr->total_qtde . "</td>"
    . "<td>" . $tr->total_horas . "</td>"
    . "<td>$btnAdd</td>"
    . "</tr>";
}

$logado = false;
$isStudent = false;
if (isset($this->session->usuario_logado['isteacher'])) {
  $logado = true;
  if ($this->session->usuario_logado['isteacher'] == 'a') {
    $isStudent = true;
  }
}
?>

<?php if ($logado && $isStudent) : ?>
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

    <script src="<?php echo base_url("js/js/Certificados.js?v=$versao"); ?>"></script>
  </head>

  <body>
    <?php
    include "menu_sup.php";
    ?>
    <div id="confirm" class="modal">
      <div class="modal-body">
        Deseja Realmente Excluir?
      </div>
      <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn btn-primary" id="delete">Excluir</button>
        <button type="button" data-dismiss="modal" class="btn">Cancelar</button>
      </div>
    </div>

    <div class="modal fade" id="modalAddCertificado" tabindex="-1" role="dialog" aria-labelledby="exampleModalAddCertificado" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 75vw; left:-100%;">
          <div class="modal-header">
            <h5 class="modal-title">Adicionar Certificado</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="#" id="form-add-atv">
              <div class="form-group">
                <label for="nmCertificado" class="col-form-label required font-weight-bold text-left">Nome:</label>
                <input type="text" class="form-control" id="nmCertificado" required>
              </div>

              <div class="form-group">
                <label for="recipient-name" class="col-form-label required font-weight-bold text-left">Total de Horas:</label>
                <input type="time" class="form-control" id="hrCertificado" required>
              </div>

              <div class="form-group">
                <label for="arquivo" class="col-form-label required font-weight-bold text-left">Arquivo</label>
                <input class="form-control" name="arquivo" id="arquivo" type="file" accept="application/pdf" required>
              </div>

              <div class="form-group mt-5">
                <button type="submit" class="btn btn-success" id="btnAddCert" value="-1">Salvar</button>
              </div>
            </form>

            <br>

            <div class="row">
              <table id="tblMeusCertificados">
                <thead>
                  <tr>
                    <th>Nome</th>
                    <th>Horas</th>
                    <th>Status</th>
                    <th>Obs</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody></tbody>
              </table>
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          </div>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row col-12 text-center mt-3 mb-5">
        <h3>Meus Certificados</h3>
      </div>

      <div class="totalGeral">
        <div class="row justify-content-center">
          <div role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100" style="--value:20" id="totalProgress"></div>
        </div>
        <div class="row mt-3">
          <div class='col d-flex align-items-center justify-content-center'>
            <span>Total Certificados: 75. Total de Horas: 25:00</span>
          </div>
        </div>
      </div>

      <div id="dashResumo"></div>

      <hr class="hrStyle mt-5 mb-5">

      <div class="row justify-content-center">
        <table id="tabela" class="table table-striped mt-5">
          <thead>
            <tr>
              <th>Quadro</th>
              <th>Atividade</th>
              <th>Unidade</th>
              <th>Limite</th>
              <th>Qtdes</th>
              <th>Horas</th>
              <th>Certificados</th>
            </tr>
          </thead>
          <tbody><?= $tbody; ?></tbody>
        </table>
      </div>
    </div>

  <?php elseif ($logado && !$isStudent) : ?>

    <?php
    header("Location: ./Home");
    die();
    ?>

  <?php else : ?>
    <?php
    header("Location: ./ControllerLogin/ControllerRedireciona");
    die();
    ?>
  <?php endif; ?>

  <script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>

  </html>