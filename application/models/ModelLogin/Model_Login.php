<?php

class Model_Login extends CI_Model 
{

	function logar($matricula, $password)
	{
		$this->db->where("matricula", $matricula);
    $this->db->where("senha", $password);
    $usuario = $this->db->get("usuarios")->row_array();
		return $usuario;
	}

}