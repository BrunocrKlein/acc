<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Certificado extends CI_Controller {

  public function index() {
    //load database libray manually
    $this->load->database();

    $this->load->helper('url');

    //load Model
    $this->load->model('CertificadoModel');

    //load registration view form
    $result['data'] = $this->CertificadoModel->dadosPrincipais();
    //$result['quadros'] = $this->AtividadeModel->obterQuadros();
    $this->load->view('CertificadoView', $result);
  }

  public function dash() {
    $dados = $this->CertificadoModel->obterQuadrosAtividadesPessoa();
    echo json_encode($dados);
  }

  public function meusCertificados() {
    $atividade = $this->input->get('atividade');
    $dados = $this->CertificadoModel->meusCertificados($atividade);

    echo json_encode($dados);
  }

  public function certificadosAluno() {
    $matricula = $this->input->get('matricula');
    $result['nmAluno'] = $this->CertificadoModel->obterNmAluno($matricula);
    $result['data'] = $this->CertificadoModel->certificadosAluno($matricula);

    $this->load->view('CertificadosAlunoView', $result);
  }

  public function listagemProfessor() {
    $dados = $this->CertificadoModel->listagemProfessor();

    echo json_encode($dados);
  }

  public function verCertificadoAluno() {
    $pdf = file_get_contents("tmp/certificado.pdf");
    header('Content-Type: application/pdf');
    header('Cache-Control: public, must-revalidate, max-age=0'); // HTTP/1.1
    header('Pragma: public');
    header('Expires: Sat, 26 Jul 1997 05:00:00 GMT'); // Date in the past
    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
    header('Content-Length: ' . strlen($pdf));
    header('Content-Disposition: inline; filename="' . basename($pdf) . '";');
    ob_clean();
    flush();
    echo $pdf;
  }
  
  public function extratoAluno() {
    $pdf = file_get_contents("tmp/extrato.pdf");
    header('Content-Type: application/pdf');
    header('Cache-Control: public, must-revalidate, max-age=0'); // HTTP/1.1
    header('Pragma: public');
    header('Expires: Sat, 26 Jul 1997 05:00:00 GMT'); // Date in the past
    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
    header('Content-Length: ' . strlen($pdf));
    header('Content-Disposition: inline; filename="' . basename($pdf) . '";');
    ob_clean();
    flush();
    echo $pdf;
  }

  public function viewCertificado() {
    $codigo = $this->input->get('codigo');
    $bdPDF = $this->CertificadoModel->verCertificado($codigo);
    $pdf = $pdf = 'data:application/pdf;base64,' . trim(base64_encode($bdPDF)); // file_get_contents($bdPDF);
    header('Content-Type: application/pdf');
    header('Cache-Control: public, must-revalidate, max-age=0'); // HTTP/1.1
    header('Pragma: public');
    header('Expires: Sat, 26 Jul 1997 05:00:00 GMT'); // Date in the past
    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
    header('Content-Length: ' . strlen($pdf));
    header('Content-Disposition: inline; filename="' . basename($pdf) . '";');
    ob_clean();
    flush();
    echo $pdf;
  }

  public function update() {
    $id = $this->input->get('codigo');
    $dado = ['dado' => $this->CertificadoModel->pegaid($id)[0]];
    echo json_encode($dado);
  }

  public function delete() {
    $id = $this->input->post('codigo');
    $this->CertificadoModel->execdelete($id);
    echo "Registro excluído com sucesso!!!";
  }

  public function gravar() {
    $file = __DIR__ . "/tmp/" . time() . ".pdf";
    move_uploaded_file($_FILES["arquivo"]["tmp_name"], $file);

    if (file_exists($file)) {
      $arr = array(
          "cod_aluno" => "1",
          "nome" => $this->input->post("nmCertificado"),
          "quantidade_horas" => 60,
          "cod_atividade" => $this->input->post("codAtividade"),
          "arquivo_certificado" => file_get_contents($file)
      );
      $this->CertificadoModel->insertCertificado($arr);
      echo "arquivo gravado, continuar: $file";
    } else {
      echo "Não foi possivel salvar o certificado";
    }
  }

}
