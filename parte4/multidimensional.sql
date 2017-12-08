DROP TABLE d_produto CASCADE
DROP TABLE d_tempo CASCADE
DROP TABLE d_info_produto CASCADE

CREATE TABLE d_produto(
    cean VARCHAR(25) NOT NULL,
    categoria VARCHAR(50) NOT NULL,
    nif_fornecedor_principal VARCHAR(9) NOT NULL,
    PRIMARY KEY (cean)
);

CREATE TABLE d_tempo(
    dia DATE NOT NULL,
    mes DATE NOT NULL,
    ano DATE NOT NULL
);

CREATE TABLE info_reposicao(
    cean VARCHAR(25) NOT NULL,
    """
    nro INT NOT NULL,
    lado VARCHAR(8) NOT NULL,
    altura INT NOT NULL,
    operador VARCHAR(25) NOT NULL,
    instante TIMESTAMP NOT NULL,
    FOREIGN KEY(ean, nro, lado, altura, operador, instante) REFERENCES Reposicao,
    """
    dia DATE NOT NULL,
    mes DATE NOT NULL,
    ano DATE NOT NULL,
    FOREIGN KEY(dia, mes, ano) REFERENCES d_tempo,
    
);