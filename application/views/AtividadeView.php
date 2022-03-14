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

?>

<?php if ($logado && $isTeacher) : ?>

  <!DOCTYPE html>
  <html lang="pt-br">

  <head>
    <meta charset="UTF-8">
    <title>Atividades</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrap.min.css'); ?>">
    <link type="text/css" href="<?php echo base_url('css/css/menu.css?v=<?= time()?>'); ?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">

    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js" integrity="sha512-RdSPYh1WA6BF0RhpisYJVYkOyTzK4HwofJ3Q7ivt/jkpW6Vc8AurL1R+4AUcvn9IwEKAPm/fk7qFZW3OuiUDeg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

    <script src="<?php echo base_url("js/js/Atividade.js?v=$versao"); ?>"></script>
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

    <div class="container-fluid text-center">
      <div class="row">
        <?php
        include "menu.php";
        ?>

        <form id="crud-atividade" class="col-lg-10 col-md-10 col-sm-10">
          <br>
          <h3>Manutenção de Atividade</h3>
          <br>

          <div class="form-group row mt-3">
            <label for="selQuadro" class="col-lg-2 col-md-2 col-sm-12 col-form-label required"><b>Quadro:</b></label>
            <div class="col-lg-8 col-md-8 col-sm-8">
              <select class="form-control" name="selQuadro" id="selQuadro" required>
                <option value="" selected disabled> - Selecione o Quadro - </option>
                <?php foreach ($quadros as $quadro) : ?>
                  <option value="<?= $quadro->codigo; ?>"><?= $quadro->descricao; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>

          <div class="form-group row mt-3">
            <label for="nmAtividade" class="col-lg-2 col-md-2 col-sm-12 col-form-label required"><b>Atividade:</b></label>
            <div class="col-lg-8 col-md-8 col-sm-8">
              <input type="text" class="form-control" id="nmAtividade" name="nmAtividade" placeholder="Informe o nome da atividade" required></input>
            </div>
          </div>

          <div class="form-group row mt-3">
            <label for="selUnidade" class="col-lg-2 col-md-2 col-sm-12 col-form-label required"><b>Unidade:</b></label>
            <div class="col-lg-8 col-md-8 col-sm-8">
              <select class="form-control" name="selUnidade" id="selUnidade" required>
                <option value="" selected disabled> - Selecione a Unidade - </option>
                <option value="horas"> Horas </option>
                <option value="unidades"> Unidades </option>
              </select>
            </div>
          </div>

          <div class="form-group row mt-3">
            <label for="totalHoras" class="col-lg-2 col-md-2 col-sm-12 col-form-label required"><b>Total de Horas:</b></label>
            <div class="col-lg-8 col-md-8 col-sm-8">
              <input type="number" class="form-control" id="totalHoras" name="totalHoras" placeholder="Informe o total de horas" required></input>
            </div>
          </div>

          <div class="form-group row mt-3">
            <label for="formContHoras" class="col-lg-2 col-md-2 col-sm-12 col-form-label">Fórmula p/ Contabilizar Horas:</label>
            <div class="col-lg-8 col-md-8 col-sm-8">
              <input type="text" class="form-control" id="formContHoras" name="formContHoras" placeholder="Fórmula p/ Contabilizar Horas" disabled></input>
            </div>
          </div>

          <div class="form-group row mt-3">
            <label for="formTotHoras" class="col-lg-2 col-md-2 col-sm-12 col-form-label required">Fórmula p/ Total de Horas:</label>
            <div class="col-lg-8 col-md-8 col-sm-8">
              <input type="text" class="form-control" id="formTotHoras" name="formTotHoras" placeholder="Fórmula p/ Total Horas Permitidas" disabled></input>
            </div>
          </div>

          <div class="form-group mt-3">
            <button type="submit" id="gravar" value="-1" class="btn btn-success">Gravar</button>
          </div>

          <br>
          <table id="tabela" class="table table-striped mt-5">
            <thead>
              <tr>
                <th>Nr Quadro</th>
                <th>Quadro</th>
                <th>Atividade</th>
                <th>Unidade</th>
                <th>Total de Horas</th>
                <th>Ação</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($data as $row) : ?>
                <tr>
                  <td><?= $row->nr_quadro; ?></td>
                  <td><?= $row->quadro; ?></td>
                  <td><?= $row->descricao; ?></td>
                  <td><?= $row->unidade; ?></td>
                  <td><?= $row->total_horas; ?></td>
                  <td>
                    <div class="btn-group">
                      <button class="btn btn-secondary editar mx-3" type="button" data-id="<?= $row->codigo ?>"> <i class="fa fa-edit"></i> </button>
                      <button class="btn btn-danger deletar" type="button" data-id="<?= $row->codigo ?>"><i class="fa fa-trash"></i> </button>
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </form>
      </div>
    </div>

  <?php elseif ($logado && !$isTeacher) : ?>

    <?php
    header("Location: ./certificado");
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