c)

SELECT ean from Produto where ean not in 
(SELECT ean from Reposicao);

d)

SELECT ean from Produto where ean in
(SELECT ean from Fornecedor_secundario group by ean having count(ean)>10);

e)

SELECT ean from Reposicao group by ean having count(distinct operador) = 1;