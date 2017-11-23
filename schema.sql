
CREATE TABLE Categoria(
    nome VARCHAR(50) NOT NULL
    PRIMARY KEY (nome)
)

CREATE TABLE Categoria_Simples(
    PRIMARY KEY(nome),
    FOREIGN KEY (nome) REFERENCES Categoria(nome),
)

CREATE TABLE Super_Categoria(
    PRIMARY KEY(nome),
    FOREIGN KEY (nome) REFERENCES Categoria(nome),
)

CREATE TABLE Constituida(

    PRIMARY KEY(super_categoria,categoria_simples),

    FOREIGN KEY (super_categoria) REFERENCES Super_Categoria(nome),
    FOREIGN KEY (categoria_simples) REFERENCES Categoria_Simples(nome)

)

CREATE TABLE Produto(
    
    ean VARCHAR(25) NOT NULL,
    design VARCHAR(50),
    dataFornecedorPrimario DATE,
    
    FOREIGN KEY(Categoria) REFERENCES Categoria(nome),
    FOREIGN KEY(forn_Primario) REFERENCES Fornecedor(nif),

    PRIMARY KEY (ean)
)

CREATE TABLE Fornecedor(
    nif VARCHAR(9) NOT NULL,
    nome VARCHAR(25),
    PRIMARY KEY (nif)
)

CREATE TABLE Fornecedor_secundario(
    PRIMARY KEY(nif,ean),
    FOREIGN KEY(nif) REFERENCES Fornecedor(nif),
    FOREIGN KEY(ean) REFERENCES Produto(ean)
)

CREATE TABLE Corredor(
    numero INT NOT NULL,
    largura INT,
    PRIMARY KEY(numero)
)

CREATE TABLE Prateleira(
    lado VARCHAR(5) NOT NULL,
    altura VARCHAR(5) NOT NULL,
    PRIMARY KEY(numero,lado,altura),
    FOREIGN KEY(numero) REFERENCES Corredor(numero)
)

CREATE TABLE Planograma(
    
    face VARCHAR(5),
    unidades INT,
    localizacao VARCHAR(10),

    PRIMARY KEY(ean,numero,lado,altura),
    FOREIGN KEY(numero) REFERENCES Corredor(numero),
    FOREIGN KEY(ean) REFERENCES Produto(ean),
    FOREIGN KEY(lado) REFERENCES Prateleira(lado),
    FOREIGN KEY(altura) REFERENCES Prateleira(altura)

)

CREATE TABLE EventoReposicao(
    operador VARCHAR(25),
    instante DATETIME,
    PRIMARY KEY(operador,instante)   
)

CREATE TABLE Reposicao(
    unidades INT,

    PRIMARY KEY(ean,numero,lado,lado,altura,operador,instante),
    FOREIGN KEY(numero) REFERENCES Corredor(numero),
    FOREIGN KEY(ean) REFERENCES Produto(ean),
    FOREIGN KEY(lado) REFERENCES Prateleira(lado),
    FOREIGN KEY(altura) REFERENCES Prateleira(altura),
    FOREIGN KEY(operador) REFERENCES EventoReposicao(operador),
    FOREIGN KEY(instante) REFERENCES EventoReposicao(instante),
)

ALTER TABLE EventoReposicao
   ADD CONSTRAINT RI_EA3 CHECK(instante <= NOW());