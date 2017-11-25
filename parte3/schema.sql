CREATE TABLE Categoria(
    nome VARCHAR(50) NOT NULL,
    PRIMARY KEY(nome)
);

CREATE TABLE Categoria_Simples(
    nome VARCHAR(50) NOT NULL,
    FOREIGN KEY (nome) REFERENCES Categoria,
    PRIMARY KEY (nome)
);

CREATE TABLE Super_Categoria(
    nome VARCHAR(50) NOT NULL,
    FOREIGN KEY (nome) REFERENCES Categoria,
    PRIMARY KEY (nome)
);

CREATE TABLE Constituida(
    super_categoria VARCHAR(50) NOT NULL,
    categoria VARCHAR(50) NOT NULL,
    FOREIGN KEY (super_categoria) REFERENCES Super_Categoria,
    FOREIGN KEY (categoria) REFERENCES Categoria_Simples,
    PRIMARY KEY(super_categoria,categoria)
);

CREATE TABLE Fornecedor(
    nif VARCHAR(9) NOT NULL,
    nome VARCHAR(25),
    PRIMARY KEY (nif)
);

CREATE TABLE Fornecedor_secundario(
    FOREIGN KEY(nif) REFERENCES Fornecedor(nif),
    FOREIGN KEY(ean) REFERENCES Produto(ean),
    PRIMARY KEY(nif,ean),
);

CREATE TABLE Produto(
    categoria VARCHAR(50) NOT NULL,
    forn_primario VARCHAR(9) NOT NULL,    
    FOREIGN KEY(categoria) REFERENCES Categoria,
    FOREIGN KEY(forn_primario) REFERENCES Fornecedor,
    PRIMARY KEY (categoria,forn_primario)
);


CREATE TABLE Corredor(
    numero INT NOT NULL,
    largura INT,
    PRIMARY KEY(numero)
)

CREATE TABLE Prateleira(
    lado VARCHAR(5) NOT NULL,
    altura VARCHAR(5) NOT NULL,
    FOREIGN KEY(numero) REFERENCES Corredor(numero),
    PRIMARY KEY(numero,lado,altura)
);

CREATE TABLE Planograma(
    
    face VARCHAR(5),
    unidades INT,
    localizacao VARCHAR(10),
    
    FOREIGN KEY(numero) REFERENCES Corredor(numero),
    FOREIGN KEY(ean) REFERENCES Produto(ean),
    FOREIGN KEY(lado) REFERENCES Prateleira(lado),
    FOREIGN KEY(altura) REFERENCES Prateleira(altura),

    PRIMARY KEY(ean,numero,lado,altura)
);

CREATE TABLE EventoReposicao(
    operador VARCHAR(25),
    instante DATETIME,
    PRIMARY KEY(operador,instante)   
);

CREATE TABLE Reposicao(
    unidades INT,
    FOREIGN KEY(numero) REFERENCES Corredor(numero),
    FOREIGN KEY(ean) REFERENCES Produto(ean),
    FOREIGN KEY(lado) REFERENCES Prateleira(lado),
    FOREIGN KEY(altura) REFERENCES Prateleira(altura),
    FOREIGN KEY(operador) REFERENCES EventoReposicao(operador),
    FOREIGN KEY(instante) REFERENCES EventoReposicao(instante),
    PRIMARY KEY(ean,numero,lado,lado,altura,operador,instante)
);

ALTER TABLE EventoReposicao
   ADD CONSTRAINT RI_EA3 CHECK(instante <= NOW());
