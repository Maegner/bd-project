DROP TABLE d_produto CASCADE;
DROP TABLE d_tempo CASCADE;
DROP TABLE info_reposicao CASCADE;

CREATE TABLE d_produto(
    cean VARCHAR(25) NOT NULL,
    categoria VARCHAR(50) NOT NULL,
    nif_fornecedor_principal VARCHAR(9) NOT NULL,
    PRIMARY KEY (cean)
);

CREATE TABLE d_tempo(
    dia int NOT NULL,
    mes int NOT NULL,
    ano int NOT NULL,
    PRIMARY KEY(dia,mes,ano)
);

CREATE TABLE info_reposicao(
    cean VARCHAR(25) NOT NULL,
    dia int NOT NULL,
    mes int NOT NULL,
    ano int NOT NULL,
    numero_reposicoes INT NOT NULL,
    FOREIGN KEY(dia, mes, ano) REFERENCES d_tempo,
    FOREIGN KEY(cean) REFERENCES d_produto, 
    PRIMARY KEY(dia,mes,ano,cean)
);

INSERT INTO d_produto
SELECT DISTINCT R.ean as cean, categoria, forn_primario as nif_fornecedor_principal
FROM Produto P , Reposicao R
WHERE P.ean = R.ean;

INSERT INTO d_tempo
SELECT DISTINCT EXTRACT(DAY FROM instante)as dia,EXTRACT(MONTH FROM instante)as mes,EXTRACT(YEAR FROM instante) as ano
FROM Reposicao;

INSERT INTO info_reposicao
SELECT  DISTINCT cean, dia, mes, ano, nro as numero_reposicoes
FROM Reposicao, d_produto, d_tempo
WHERE EXTRACT(DAY FROM instante) = dia AND 
    EXTRACT(MONTH FROM instante) = mes AND 
    EXTRACT(YEAR FROM instante) = ano AND
    cean = ean;