<?php

class Model_CadastrarLogin extends CI_Model 
{

	function inserir($usuario)
	{
		$this->db->insert("usuarios", $usuario);
	}

  function consultar($matricula){
    $this->db->where("matricula", $matricula);
    $usuario = $this->db->get("usuarios")->row_array();
		return $usuario;
  }

}