<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
		
		$this->load->view('LoginViews/LoginView');		
	}

	public function logar(){
		$this->load->database();
		$this->load->model('ModelLogin/Model_Login');	
		$this->load->helper('url');
		$matricula = $this->input->post("matricula");
		$password = md5($this->input->post("senha"));
		$usuario = $this->Model_Login->logar($matricula, $password);

    if($usuario){
			$this->session->set_userdata("usuario_logado", $usuario);
			$this->session->set_flashdata("success", "Logado com sucesso!");

		}else{
			$this->session->set_flashdata("danger", "Usuário ou senha inválidos!");
		}

		echo json_encode($usuario);

	}

}
