--a
WITH Produtores_por_produto as (

	SELECT forn_primario as nif,ean FROM Produto 
	UNION 
	SELECT * FROM Fornecedor_secundario

),Categoria_por_fornecedor as (
	SELECT nif,categoria 
	FROM Produto, Produtores_por_produto 
	WHERE Produto.ean = Produtores_por_produto.ean

), n_Categorias_por_fornecedor as (
	SELECT nif, COUNT(categoria) as n_categorias
	FROM Categoria_por_fornecedor
	GROUP BY nif

)
SELECT nome
FROM Fornecedor
WHERE Fornecedor.nif IN (
	SELECT nif
	FROM n_Categorias_por_fornecedor
	WHERE n_Categorias_por_fornecedor.n_categorias IN(
		SELECT MAX(n_categorias) as max_cat
		FROM n_Categorias_por_fornecedor
	)
);

--b
WITH Produtor_primario AS (
	SELECT forn_primario as nif, ean
	FROM Produto
), Produtores_por_produto as (

	SELECT nif,ean FROM Produtor_primario 
	UNION 
	SELECT * FROM Fornecedor_secundario

),Categorias_por_fornecedor as (
	SELECT * 
	FROM Produto, Produtores_por_produto 
	WHERE Produto.ean = Produtores_por_produto.ean AND
	Produto.categoria IN (SELECT nome FROM Categoria_Simples)

),n_Categorias_simples_por_fornecedor as(
	SELECT nif, COUNT(distinct categoria) as n_categorias_simples
	FROM Categorias_por_fornecedor
	GROUP BY nif
)
SELECT Fornecedor.nif, nome
FROM Fornecedor
WHERE Fornecedor.nif IN (
	SELECT nif
	FROM n_Categorias_simples_por_fornecedor
	WHERE n_Categorias_simples_por_fornecedor.n_categorias_simples IN (
		SELECT COUNT(distinct nome) as n_categorias_simples
		FROM Categoria_Simples)
);