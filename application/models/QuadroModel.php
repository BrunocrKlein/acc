<?php

class QuadroModel extends CI_Model 
{
	function insert($nome, $descricao, $total_horas)
	{
		$query="insert into quadro values('','$descricao', '$total_horas', '$nome')";
		$this->db->query($query);
	}

	function execquery()
	{
		$query = $this->db->query("select * from quadro");
		return $query->result();
	}

	function execdelete($id)
	{
		$this->db->query("delete  from quadro where codigo = $id");
	}	

	function pegaid($id)
	{
		$query = $this->db->query("select * from quadro where codigo = $id");
		return $query->result();
	}

	function execupdate($nome, $descricao, $total_horas, $codigo)
	{
		$query = $this->db->query("update quadro SET nome='$nome', descricao='$descricao',total_horas='$total_horas' where codigo = $codigo ");
	}	

}