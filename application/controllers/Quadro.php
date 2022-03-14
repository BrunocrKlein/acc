<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quadro extends CI_Controller {

	public function index()
	{
			//load database libray manually
			$this->load->database();

			$this->load->helper('url');
			
			//load Model
			$this->load->model('QuadroModel');

			//load registration view form
			$result['data'] = $this->QuadroModel->execquery();
			$this->load->view('QuadroView', $result);
	}

	public function delete()
	{
		$id = $this->input->post('codigo');
		$this->QuadroModel->execdelete($id);
		echo "Registro excluído com sucesso!!!";
	}

	public function update()
	{	
			$id = $this->input->get('codigo');
			$dado = ['dado' => $this->QuadroModel->pegaid($id)];
			echo json_encode($dado);

	}

	public function create()
	{	
		//Check submit button 
		if($this->input->post('gravar'))
		{
			//get form's data and store in local varable
			$vlrbuttongravar = $this->input->post('gravar');
			$nome = $this->input->post('nome');
			$descricao = $this->input->post('descricao');
			$total_horas = $this->input->post('total_horas');
		
			//call saverecords method of Quadro Model and pass variables as parameter

			if($vlrbuttongravar != -1){
				$this->QuadroModel->execupdate($nome, $descricao, $total_horas, $vlrbuttongravar);
				echo "ok";
			}else{
				$this->QuadroModel->insert($nome, $descricao, $total_horas);		
				echo "ok";
			}
		
		}else {
			echo "erro no create";
		}
	}

}
