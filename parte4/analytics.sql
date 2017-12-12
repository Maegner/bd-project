SELECT categoria, SUM()
FROM d_info_produto
WHERE cean = "123455678"
GROUP BY ROLLUP(categoria, ano, mes)