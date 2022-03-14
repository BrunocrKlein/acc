<!DOCTYPE html>
<html lang="pt-br">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IFRS-IBIRUBÁ-CC-ACCs</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrap.min.css'); ?>">
    <link type="text/css" href="<?php echo base_url('css/css/menu.css?v=<?= time()?>'); ?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("css/css/CertificadoProfessor.css?v=" . time()); ?>" />

    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url("js/js/CertificadoProfessor.js?v=" . time()); ?>"></script>
  </head>

  <body>
    <?php
    $logado = false;
    $isTeacher = false;
    if (isset($this->session->usuario_logado['isteacher'])) {
      $logado = true;
      if ($this->session->usuario_logado['isteacher'] == 'p') {
        $isTeacher = true;
      }
    }
    ?>

    <?php if ($logado && $isTeacher): ?>


      <?php
      include "menu_sup.php";
      ?>

      <div class="container-fluid">
        <div class="row">
          <?php
          include "menu.php";
          ?>

          <div class="col-sm-10 col-md-10 col-lg-10 col-10 justify-content-center">
            <div class="row">
              <div class="col-12 text-center">
                <h3 class="pt-4 mb-4">Relação de ACCs p/ Aluno</h3>
              </div>
            </div>

            <div class="row mt-5">
              <table id="tabela" class="table table-striped mt-5">
                <thead>
                  <tr>
                    <th>Matrícula</th>
                    <th>Aluno</th>
                    <th>Quadro 1</th>
                    <th>Quadro 2</th>
                    <th>Quadro 3</th>
                    <th>Quador 4</th>
                    <th>Total</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody></tbody>
              </table>
            </div>

          </div>

        </div>
      </div>

    <?php elseif ($logado && !$isTeacher): ?>

      <?php
      header("Location: ./certificado");
      die();
      ?>

    <?php else: ?>  
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