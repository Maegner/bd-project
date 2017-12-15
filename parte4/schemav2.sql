drop table Categoria cascade;
drop table Categoria_Simples cascade;
drop table Super_Categoria cascade;
drop table Constituida cascade;
drop table Fornecedor cascade;
drop table Produto cascade;
drop table Fornecedor_secundario cascade;
drop table Corredor cascade;
drop table Prateleira cascade;
drop table Planograma cascade;
drop table EventoReposicao cascade;
drop table Reposicao cascade;


CREATE TABLE Categoria(
    nome VARCHAR(50) NOT NULL,
    PRIMARY KEY(nome)
);

CREATE TABLE Categoria_Simples(
    nome VARCHAR(50) NOT NULL,
    PRIMARY KEY(nome),
    FOREIGN KEY (nome) REFERENCES Categoria ON DELETE CASCADE
);

CREATE TABLE Super_Categoria(
    nome VARCHAR(50) NOT NULL,
    PRIMARY KEY(nome),
    FOREIGN KEY (nome) REFERENCES Categoria ON DELETE CASCADE
);

CREATE TABLE Constituida(
    super_categoria VARCHAR(50) NOT NULL,
    categoria VARCHAR(50) NOT NULL,
    PRIMARY KEY(super_categoria,categoria),
    FOREIGN KEY (super_categoria) REFERENCES Super_Categoria(nome) ON DELETE CASCADE,
    FOREIGN KEY (categoria) REFERENCES Categoria(nome) ON DELETE CASCADE
);

CREATE TABLE Fornecedor(
    nif VARCHAR(9) NOT NULL,
    nome VARCHAR(25) NOT NULL,
    PRIMARY KEY (nif)
);

CREATE TABLE Produto(
    ean VARCHAR(25) NOT NULL,
    categoria VARCHAR(50) NOT NULL,
    forn_primario VARCHAR(9) NOT NULL,    
    design VARCHAR(50) NOT NULL,
    data DATE NOT NULL,
    PRIMARY KEY (ean),
    FOREIGN KEY(categoria) REFERENCES Categoria ON DELETE CASCADE,
    FOREIGN KEY(forn_primario) REFERENCES Fornecedor
);

CREATE TABLE Fornecedor_secundario(
    nif VARCHAR(9) NOT NULL,
    ean VARCHAR(25) NOT NULL,
    FOREIGN KEY(nif) REFERENCES Fornecedor(nif),
    FOREIGN KEY(ean) REFERENCES Produto(ean) ON DELETE CASCADE
);

CREATE TABLE Corredor(
    nro INT NOT NULL,
    largura INT NOT NULL,
    PRIMARY KEY(nro),
    check(largura > 0),
    check(nro > 0)
);

CREATE TABLE Prateleira(
    lado VARCHAR(8) NOT NULL,
    altura INT NOT NULL,
    nro INT NOT NULL,
    PRIMARY KEY(lado,altura,nro),
    FOREIGN KEY(nro) REFERENCES Corredor,
    CHECK(altura > 0)
);

CREATE TABLE Planograma(
    face INT NOT NULL,
    unidades INT NOT NULL,
    localizacao VARCHAR(10) NOT NULL,
    ean VARCHAR(25) NOT NULL ,
    lado VARCHAR(8) NOT NULL,
    altura INT NOT NULL,
    nro INT NOT NULL,
    FOREIGN KEY(ean) REFERENCES Produto ON DELETE CASCADE,
    FOREIGN KEY(lado,altura,nro) REFERENCES Prateleira
);

CREATE TABLE EventoReposicao(
    operador VARCHAR(25) NOT NULL,
    instante TIMESTAMP NOT NULL,
    PRIMARY KEY(operador,instante)   
);

CREATE TABLE Reposicao(
    unidades INT NOT NULL,
    ean VARCHAR(25) NOT NULL,
    nro INT NOT NULL,
    altura INT NOT NULL,
    lado VARCHAR(8) NOT NULL,
    operador VARCHAR(25) NOT NULL,
    instante TIMESTAMP NOT NULL,
    PRIMARY KEY(ean, altura, lado, nro,operador,instante),
    FOREIGN KEY(ean) REFERENCES Produto ON DELETE CASCADE,
    FOREIGN KEY(lado,altura,nro) REFERENCES Prateleira,
    FOREIGN KEY(operador,instante) REFERENCES EventoReposicao,
    CHECK(unidades > 0)
);

ALTER TABLE EventoReposicao
   ADD CONSTRAINT RI_EA3 CHECK(instante <= CURRENT_TIMESTAMP);

ALTER TABLE Prateleira 
    ADD CONSTRAINT TIPOLADO CHECK (lado = 'esquerdo' OR lado = 'direito');