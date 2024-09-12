-- Criação do banco de dados

-- Uso do banco de dados
USE restaurante;

-- Criação das tabelas
CREATE TABLE Users (
    UserID INT PRIMARY KEY AUTO_INCREMENT,
    Username VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    senha VARCHAR(100) NOT NULL,
    CPF VARCHAR(14) UNIQUE NOT NULL,
    telefone VARCHAR(15) NOT NULL
);

CREATE TABLE Produtos (
    ProdutoID INT PRIMARY KEY AUTO_INCREMENT,
    NomeProduto VARCHAR(100) NOT NULL,
    Categoria VARCHAR(50) NOT NULL,
    Valor DECIMAL(10, 2) NOT NULL
);

-- Tabela para armazenar informações da comanda
CREATE TABLE Comandas (
    ComandaID INT PRIMARY KEY AUTO_INCREMENT,
    NomeCliente VARCHAR(100) NOT NULL,
    DataHora TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela para armazenar os itens da comanda
CREATE TABLE ItensComanda (
    ItemID INT PRIMARY KEY AUTO_INCREMENT,
    ComandaID INT,
    ProdutoID INT,
    Quantidade INT NOT NULL,
    ValorUnitario DECIMAL(10, 2) NOT NULL,
    ValorTotal DECIMAL(10, 2) AS (Quantidade * ValorUnitario) STORED,
    FOREIGN KEY (ComandaID) REFERENCES Comandas(ComandaID),
    FOREIGN KEY (ProdutoID) REFERENCES Produtos(ProdutoID)
);

-- Tabela para armazenar o total da comanda
CREATE TABLE TotalComanda (
    ComandaID INT PRIMARY KEY,
    TotalItens INT NOT NULL,
    ValorTotal DECIMAL(10, 2) NOT NULL,
    DataHora TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Adiciona a data e hora do fechamento da comanda
    FOREIGN KEY (ComandaID) REFERENCES Comandas(ComandaID)
);
CREATE TABLE ResultadosVendas (
    VendaID INT PRIMARY KEY AUTO_INCREMENT,
    ComandaID INT,
    DataHora TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ValorTotal DECIMAL(10, 2) NOT NULL,
    FormaPagamento VARCHAR(50) NOT NULL,
    FOREIGN KEY (ComandaID) REFERENCES Comandas(ComandaID)
);
