SELECT quadro.codigo nr_quadro,
       quadro.descricao quadro,
       atividade.*
  FROM atividade
  JOIN quadro ON (quadro.codigo = atividade.cod_quadro)
 order by nr_quadro, atividade.codigo