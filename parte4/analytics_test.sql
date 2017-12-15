SELECT categoria, ano, mes, SUM(numero_reposicoes)
FROM info_reposicao,d_produto,d_tempo
WHERE nif_fornecedor_principal = '000000001'
GROUP BY categoria
UNION
(
    SELECT null, ano, mes, SUM(numero_reposicoes)
    FROM info_reposicao NATURAL JOIN d_tempo
    GROUP BY ano
    UNION
    (
        select null, null, mes, SUM(numero_reposicoes)
        FROM info_reposicao NATURAL JOIN d_tempo
    );
);