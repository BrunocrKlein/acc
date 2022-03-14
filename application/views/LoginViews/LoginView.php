<?php
$versao = time();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrap.min.css'); ?>">
    <link type="text/css" href="<?php echo base_url('css/css/Login.css?v=<?= time()?>'); ?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js" integrity="sha512-RdSPYh1WA6BF0RhpisYJVYkOyTzK4HwofJ3Q7ivt/jkpW6Vc8AurL1R+4AUcvn9IwEKAPm/fk7qFZW3OuiUDeg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="<?php echo base_url("js/js/Login.js?v=$versao"); ?>"></script>
</head>

<body>

  <section class="form-section">
    <div class="form-wrapper">
      <form id="form-login">
        <br>
        <h2 style="text-align: center;margin-top:-7vh">ACCs</h2>
        <div style="height: 15px;"></div>
        <div class="input-block">
          <label for="login_matricula">Matricula</label>
          <input type="text" id="login_matricula" />
        </div>
        <br>

        <div class="input-block">
          <label for="login_password">Password</label>
          <input type="password" id="login_password" />
        </div>

        <br>
        <button type="submit" class="btn-login" value="-1" class="btn btn-success">Login</button>
        <br><br><br>
        <div style="margin-right: 25px;margin-top:-10px;">
          <a>Esqueci a senha</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <a>Cadastre-se</a>
        </div>

      </form>
    </div>
  </section>

  <ul class="squares"></ul>

  
  <script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>