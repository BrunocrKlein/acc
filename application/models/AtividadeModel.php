<?php

class AtividadeModel extends CI_Model {

  function obterQuadros() {
    $query = $this->db->query("select * from quadro");
    return $query->result();
  }

  function execquery() {
    $sql = "SELECT quadro.codigo nr_quadro,
                   quadro.descricao quadro,
                   atividade.*
              FROM atividade
              JOIN quadro ON (quadro.codigo = atividade.cod_quadro)
             ORDER BY nr_quadro, atividade.codigo";
    $query = $this->db->query($sql);
    return $query->result();
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
    $query = "delete from atividade where codigo = $codigo";
    $this->db->query($query);
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

}
