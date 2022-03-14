<?php

class CertificadoModel extends CI_Model {

  function obterAtividades() {
    $query = $this->db->query("select * from atividade");
    return $query->result();
  }

  private function quadroAtividade($quadro) {
    $sql = "SELECT a.descricao, 
                   COALESCE((SELECT SUM(c.quantidade_horas)
                               FROM certificado c
                              WHERE c.cod_aluno = '1'
                                AND c.cod_atividade = a.codigo),
                            0) total_horas
              FROM atividade a
             WHERE cod_quadro = $quadro
             ORDER BY descricao";
    $query = $this->db->query($sql);
    $result = $query->result();
    $arrAtv = array();
    foreach ($result as $dado) {
      $arrAtv[] = array(
          "atividade" => $dado->descricao,
          "total" => $dado->total_horas
      );
    }

    return $arrAtv;
  }

  function obterQuadrosAtividadesPessoa() {
    $qQ = $this->db->query("SELECT * FROM quadro");
    $qR = $qQ->result();
    $arrQuadro = array();
    foreach ($qR as $quadro) {
      $arrQuadro[] = array(
          "quadro" => $quadro->descricao,
          "atividades" => $this->quadroAtividade($quadro->codigo)
      );
    }

    return $arrQuadro;
  }

  function dadosPrincipais() {
    $matricula = $this->session->usuario_logado["matricula"];

    $sql = "SELECT atividade.cod_quadro, atividade.codigo cod_atividade,
                   quadro.descricao quadro,
                   atividade.descricao atividade,
                   atividade.unidade, atividade.total_horas limite,
                   COALESCE((SELECT COUNT(1)
                               FROM certificado
                              WHERE certificado.cod_aluno = '$matricula'
                                AND certificado.cod_atividade = atividade.codigo),
                            0) total_qtde,
                   COALESCE((SELECT SUM(certificado.quantidade_horas)
                               FROM certificado
                              WHERE certificado.cod_aluno = '$matricula'
                                AND certificado.cod_atividade = atividade.codigo),
                            0) total_horas
              FROM atividade
              JOIN quadro ON (quadro.codigo = atividade.cod_quadro)
             ORDER BY atividade.cod_quadro, atividade.codigo";
    $query = $this->db->query($sql);
    return $query->result();
  }

  function meusCertificados($atv) {
    $matricula = $this->session->usuario_logado["matricula"];
    $sql = "SELECT nome, quantidade_horas, coalesce(status, 'AGUARDANDO') status, observacoes, codigo FROM certificado WHERE cod_atividade = '$atv' and cod_aluno = '$matricula'";
    $query = $this->db->query($sql);
    return $query->result();
  }

  function certificadosAluno($matricula) {
    $sql = "SELECT quadro.codigo cod_quadro, quadro.descricao quadro,
                   certificado.cod_atividade, atividade.descricao atividade,
                   certificado.nome, certificado.quantidade_horas,
                   coalesce(certificado.status, 'AGUARDANDO') status,
                   certificado.observacoes, certificado.codigo
              FROM certificado
              JOIN atividade on (atividade.codigo = certificado.cod_atividade)
              JOIN quadro on (quadro.codigo = atividade.cod_quadro)
             WHERE cod_aluno = '$matricula'
             ORDER BY cod_quadro, cod_atividade";

    $query = $this->db->query($sql);
    return $query->result();
  }

  function listagemProfessor() {
    $sql = "select certificado.cod_aluno matricula, usuarios.nome,
                   sum(case when atividade.cod_quadro = 1 then 1 else 0 end) quadro1,
                   sum(case when atividade.cod_quadro = 2 then 1 else 0 end) quadro2,
                   sum(case when atividade.cod_quadro = 3 then 1 else 0 end) quadro3,
                   sum(case when atividade.cod_quadro = 4 then 1 else 0 end) quadro4
              from certificado
              join atividade on (atividade.codigo = certificado.cod_atividade)
              join usuarios on (usuarios.matricula = certificado.cod_aluno)
             group by certificado.cod_aluno, usuarios.nome
             order by usuarios.nome";
    $query = $this->db->query($sql);
    return $query->result();
  }

  function obterNmAluno($matricula) {
    $sql = "SELECT nome FROM usuarios WHERE matricula = '$matricula'";
    $query = $this->db->query($sql);
    $result = $query->result();

    return $result[0]->nome;
  }

  function pegaid($id) {
    $query = $this->db->query("select * from atividade where codigo = $id");
    return $query->result();
  }

  function execinsert($selQuadro, $nmAtividade, $selUnidade, $totalHoras, $formContHoras, $formTotHoras) {
    $query = "insert into atividade
                     (cod_quadro, descricao, unidade, total_horas, formula_hr_contabilizar, formula_total) 
              values ($selQuadro, '$nmAtividade', '$selUnidade', $totalHoras, '$formContHoras', '$formTotHoras')";
    $this->db->query($query);
  }

  function execdelete($codigo) {
    $query = "delete from certificado where codigo = $codigo";
    $this->db->query($query);
  }

  function insertCertificado($arrCertificado) {
    $this->db->insert('certificado', $arrCertificado);
  }

  function execupdate($codigo, $selQuadro, $nmAtividade, $selUnidade, $totalHoras, $formContHoras, $formTotHoras) {
    $query = "update atividade
                 set cod_quadro = $selQuadro, 
                     descricao = '$nmAtividade',
                     unidade = '$selUnidade',
                     total_horas = $totalHoras,
                     formula_hr_contabilizar = '$formContHoras',
                     formula_total = '$formTotHoras'
               where codigo = $codigo";
    $this->db->query($query);
  }

  function verCertificado($codigo) {
    $sql = "SELECT arquivo_certificado FROM certificado where codigo = $codigo";
    $query = $this->db->query($sql);
    return $query->result();
  }

}
