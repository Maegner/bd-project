SELECT categoria, SUM(numero_reposicoes)
FROM info_reposicao,d_produto
WHERE nif_fornecedor_principal = '000000001'
GROUP BY ROLLUP(categoria, ano, mes);