<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {

	public function index()
	{
		
		$this->load->view('LoginViews/Logout');		
	}

	public function logoutUser(){
     
		$this->session->unset_userdata("usuario_logado");
		
		echo 'ok';
	}

}
