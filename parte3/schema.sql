CREATE TABLE Categoria(
    nome VARCHAR(50) NOT NULL,
    PRIMARY KEY(nome)
);

CREATE TABLE Categoria_Simples(
    nome VARCHAR(50) NOT NULL,
    unique(nome),
    FOREIGN KEY (nome) REFERENCES Categoria
);

CREATE TABLE Super_Categoria(
    nome VARCHAR(50) NOT NULL,
    unique(nome),
    FOREIGN KEY (nome) REFERENCES Categoria
);

CREATE TABLE Constituida(
    super_categoria VARCHAR(50) NOT NULL,
    categoria VARCHAR(50) NOT NULL,
    PRIMARY KEY(super_categoria,categoria),
    FOREIGN KEY (super_categoria) REFERENCES Super_Categoria(nome),
    FOREIGN KEY (categoria) REFERENCES Categoria_Simples(nome)
);

CREATE TABLE Fornecedor(
    nif VARCHAR(9) NOT NULL,
    nome VARCHAR(25),
    PRIMARY KEY (nif)
);

CREATE TABLE Produto(
    ean VARCHAR(25) NOT NULL,
    categoria VARCHAR(50) NOT NULL,
    forn_primario VARCHAR(9) NOT NULL,    
    design VARCHAR(50),
    data DATE,
    PRIMARY KEY (ean),
    FOREIGN KEY(categoria) REFERENCES Categoria,
    FOREIGN KEY(forn_primario) REFERENCES Fornecedor
);

CREATE TABLE Fornecedor_secundario(
    nif VARCHAR(9) NOT NULL,
    ean VARCHAR(25) NOT NULL,
    FOREIGN KEY(nif) REFERENCES Fornecedor(nif),
    FOREIGN KEY(ean) REFERENCES Produto(ean)
);

CREATE TABLE Corredor(
    nro INT NOT NULL,
    largura INT,
    PRIMARY KEY(nro)
);

CREATE TABLE Prateleira(
    lado VARCHAR(5) NOT NULL,
    altura VARCHAR(5) NOT NULL,
    nro INT NOT NULL,
    PRIMARY KEY(lado,altura),
    FOREIGN KEY(nro) REFERENCES Corredor
);

CREATE TABLE Planograma(
    face VARCHAR(5) NOT NULL,
    unidades INT DEFAULT 0,
    localizacao VARCHAR(10) NOT NULL,
    nro INT NOT NULL,
    ean VARCHAR(25) NOT NULL,
    lado VARCHAR(5) NOT NULL,
    altura VARCHAR(5) NOT NULL,
    FOREIGN KEY(nro) REFERENCES Corredor,
    FOREIGN KEY(ean) REFERENCES Produto,
    FOREIGN KEY(lado,altura) REFERENCES Prateleira,
    CHECK(unidades >= 0)
);

CREATE TABLE EventoReposicao(
    operador VARCHAR(25) NOT NULL,
    instante TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(operador,instante)   
);

CREATE TABLE Reposicao(
    unidades INT,
    nro INT NOT NULL,
    ean VARCHAR(25) NOT NULL,
    lado VARCHAR(5) NOT NULL,
    altura VARCHAR(5) NOT NULL,
    operador VARCHAR(25) NOT NULL,
    instante TIMESTAMP NOT NULL,
    FOREIGN KEY(nro) REFERENCES Corredor,
    FOREIGN KEY(ean) REFERENCES Produto,
    FOREIGN KEY(lado,altura) REFERENCES Prateleira,
    FOREIGN KEY(operador,instante) REFERENCES EventoReposicao
);

ALTER TABLE EventoReposicao
   ADD CONSTRAINT RI_EA3 CHECK(instante <= NOW());
