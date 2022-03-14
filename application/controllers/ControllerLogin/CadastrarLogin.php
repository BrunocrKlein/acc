<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CadastrarLogin extends CI_Controller {

	public function index()
	{
 
		$this->load->view('LoginViews/CadastroLoginView');
    
	}

	public function cadastrarUsuario(){
		$this->load->database();
		$this->load->model('ModelLogin/Model_CadastrarLogin');	
		$this->load->helper('url');
		$login_matricula = $this->input->post("login_matricula");

		if(substr($login_matricula, 0, 4) == "PROF"){
			$isteacher = "p";
		}else{
			$isteacher = "a";
		}

		$usuarioexiste = $this->Model_CadastrarLogin->consultar($login_matricula);
		if(!$usuarioexiste){
			$usuario = array(
				"matricula" => $login_matricula,
				"nome" => $this->input->post("login_nome"),
				"email" => $this->input->post("login_email"),
				"senha" => md5($this->input->post("login_password")),
				"isteacher" => $isteacher
			);

			$usuario = $this->Model_CadastrarLogin->inserir($usuario);
			$response['matricula'] = 'inexistente';
	  }else{
			$response['matricula'] = 'existente';
		}
		echo json_encode($response);

	}
}
