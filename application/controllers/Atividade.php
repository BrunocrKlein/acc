<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Atividade extends CI_Controller {

  public function index() {
    //load database libray manually
    $this->load->database();

    $this->load->helper('url');

    //load Model
    $this->load->model('AtividadeModel');

    //load registration view form
    $result['data'] = $this->AtividadeModel->execquery();
    $result['quadros'] = $this->AtividadeModel->obterQuadros();
    $this->load->view('AtividadeView', $result);
  }

  public function update() {
    $id = $this->input->get('codigo');
    $dado = ['dado' => $this->AtividadeModel->pegaid($id)[0]];
    echo json_encode($dado);
  }

  public function delete() {
    $id = $this->input->post('codigo');
    $this->AtividadeModel->execdelete($id);
    echo "Registro excluído com sucesso!!!";
  }

  public function persist() {
    if ($this->input->post('codigo')) {
      $codigo = $this->input->post("codigo");
      $selQuadro = $this->input->post("selQuadro");
      $nmAtividade = $this->input->post("nmAtividade");
      $selUnidade = $this->input->post("selUnidade");
      $totalHoras = $this->input->post("totalHoras");
      $formContHoras = $this->input->post("formContHoras");
      $formTotHoras = $this->input->post("formTotHoras");

      if ((int) $codigo > 0) {
        $this->AtividadeModel->execupdate($codigo, $selQuadro, $nmAtividade, $selUnidade, $totalHoras, $formContHoras, $formTotHoras);
      } else {
        $this->AtividadeModel->execinsert($selQuadro, $nmAtividade, $selUnidade, $totalHoras, $formContHoras, $formTotHoras);
      }

      echo "ok";
    } else {
      echo "erro no persist";
    }
  }

}
