<?php
define("__URL_MENUS__",
        array(
            "quadro" => "#",
            "atividade" => "#"
));
?>

<div class="d-flex flex-column vh-100 flex-shrink-0 p-3 text-white bg-dark col-sm-2 col-md-2 col-lg-2">
  <!--
  <ul class="nav nav-pills flex-column mb-auto">
    <li> <a href="#" class="nav-link text-white"> <i class="fa fa-address-card"></i><span class="ms-2">Cadastros</span></a></li>
    <li> <a href="#" class="nav-link text-white"> <i class="fa fa-bar-chart"></i><span class="ms-2">Relatórios</span></a></li>

  </ul>
  -->
  <div class="btn-group dropright row">

    <a href="#" id="DropdownCadastro" class="nav-link text-white dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-address-card"></i><span class="ms-2">Cadastros</span></a>

<!--    <a href="#" class="nav-link text-white dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bar-chart"></i><span class="ms-2">Relatórios</span></a>-->

    <div class="dropdown-menu MenuDropdown" aria-labelledby="DropdownCadastro">
      <ul>
        <li style="white-space: nowrap;margin-right: 10px!important;"><a href="<?= __URL_MENUS__["quadro"]; ?>" class="nav-link text-white botaocadastro">Cadastro de Quadro</a></li>
        <li style="white-space: nowrap;margin-right: 10px!important;"><a href="<?= __URL_MENUS__["atividade"]; ?>"class="nav-link text-white botaocadastro">Cadastro de Atividade</a></li>
      </ul>
    </div>


  </div>
</div>