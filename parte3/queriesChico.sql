--a
WITH Produtor_primario AS (
	SELECT forn_primario as nif, ean
	FROM Produto
), Produtores_por_produto as (

	SELECT * FROM Produtor_primario 
	UNION 
	SELECT * FROM Fornecedor_secundario

), Categoria_por_produto as (
	SELECT ean, categoria
	FROM Produto

),Categoria_por_fornecedor as (
	SELECT * 
	FROM Categoria_por_produto, Produtores_por_produto 
	WHERE Categoria_por_produto.ean = Produtores_por_produto.ean

), n_Categorias_por_fornecedor as (
	SELECT nif, COUNT(categoria) as n_categorias
	FROM Categoria_por_fornecedor
	GROUP BY nif

), max_Categorias as (
	SELECT MAX(n_categorias) as max_cat
	FROM n_Categorias_por_fornecedor

), nif_fornecedor_com_max_cat as (
	SELECT nif
	FROM max_Categorias, n_Categorias_por_fornecedor
	WHERE max_Categorias.max_cat = n_Categorias_por_fornecedor.n_categorias
)
SELECT nome
FROM nif_fornecedor_com_max_cat,Fornecedor
WHERE nif_fornecedor_com_max_cat.nif = Fornecedor.nif;