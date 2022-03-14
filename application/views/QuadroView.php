<?php
$versao = time();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Quadro</title>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrap.min.css'); ?>">
  <link type="text/css" href="<?php echo base_url('css/css/menu.css?v=<?= time()?>'); ?>" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js" integrity="sha512-RdSPYh1WA6BF0RhpisYJVYkOyTzK4HwofJ3Q7ivt/jkpW6Vc8AurL1R+4AUcvn9IwEKAPm/fk7qFZW3OuiUDeg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="<?php echo base_url("js/js/Quadro.js?v=$versao"); ?>"></script>
</head>

<body>
  
  <?php
      $logado = false;
      $isTeacher = false;
      if(isset($this->session->usuario_logado['isteacher'])){
          $logado = true;
        if($this->session->usuario_logado['isteacher'] == 'p'){
          $isTeacher = true;
        }
      }
  ?>

  <?php if ($logado && $isTeacher) : ?>

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

        <form id="filtros" class="col-lg-10 col-md-10 col-sm-10">
          <br>
          <h3>Manutenção de Quadro</h3>
          <br>
          <div class="form-group row">
            <label for="nome" class="col-lg-2 col-md-2 col-sm-12 col-form-label required"><b>Nome:</b></label>
            <div class="col-lg-8 col-md-8 col-sm-8">
              <input id="nome" placeholder="Informe o nome do quadro" class="form-control" required></input>
            </div>
          </div>

          <br>

          <div class="form-group row mt-10px">
            <label for="descricao" class="col-lg-2 col-md-2 col-sm-12 col-form-label required"><b>Descrição:</b></label>
            <div class="col-lg-8 col-md-8 col-sm-8">
              <input id="descricao" placeholder="Informe a descrição" class="form-control" required></input>
            </div>
          </div>

          <br>

          <div class="form-group row">
            <label for="total_horas" class="col-lg-2 col-md-2 col-sm-12 col-form-label required"><b>Total de horas:</b></label>
            <div class="col-lg-8 col-md-8 col-sm-8">
              <input id="total_horas" placeholder="Informe o total de horas" class="form-control" required></input>
            </div>
          </div>

          <br>

          <div class="form-group">
            <button type="submit" id="gravar" value="-1" class="btn btn-success">Gravar</button>
          </div>

          <br>

          <table id="tabela" class="table table-striped">
            <thead>
              <th>Nome</th>
              <th>Descricao</th>
              <th>Tota de horas</th>
              <th>Ação</th>
            </thead>
            <tbody>
              <?php foreach ($data as $row) : ?>
                <tr>
                  <td><?= $row->nome ?></td>
                  <td><?= $row->descricao ?></td>
                  <td><?= $row->total_horas ?></td>
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