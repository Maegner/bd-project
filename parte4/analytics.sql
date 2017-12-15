SELECT categoria,ano,mes,SUM(numero_reposicoes)
FROM info_reposicao NATURAL JOIN d_produto
WHERE nif_fornecedor_principal = '123455678'
GROUP BY ROLLUP(categoria, ano, mes);