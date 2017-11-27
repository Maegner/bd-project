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

--b
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

),Categorias_simples_por_fornecedor as (
	SELECT * 
	FROM Categoria_por_fornecedor,Categoria_Simples
	WHERE Categoria_por_fornecedor.categoria = Categoria_Simples.nome

),n_Categorias_simples_por_fornecedor as(
	SELECT nif, COUNT(distinct categoria) as n_categorias_simples
	FROM Categorias_simples_por_fornecedor
	GROUP BY nif

),n_total_Categorias_simples as(
	SELECT COUNT(distinct nome) as n_total
	FROM Categoria_Simples
),nif_de_todos_que_forn as(
	SELECT nif
	FROM n_total_Categorias_simples,n_Categorias_simples_por_fornecedor
	WHERE n_total_Categorias_simples.n_total = n_Categorias_simples_por_fornecedor.n_categorias_simples
)
SELECT Fornecedor.nif, nome
FROM nif_de_todos_que_forn, Fornecedor
WHERE nif_de_todos_que_forn.nif = Fornecedor.nif;