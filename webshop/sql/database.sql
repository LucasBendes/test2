CREATE DATABASE webshop;

USE webshop;

CREATE TABLE CLIENTES (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    endereco VARCHAR(255),
    cep VARCHAR(10),
    telefone VARCHAR(15)
);

CREATE TABLE PRODUTOS (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT,
    preco DECIMAL(10, 2) NOT NULL,
    estoque INT NOT NULL
);

CREATE TABLE COMPRAS (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT,
    data_compra DATETIME DEFAULT CURRENT_TIMESTAMP,
    total DECIMAL(10, 2),
    FOREIGN KEY (cliente_id) REFERENCES CLIENTES(id)
);

CREATE TABLE ITENS_COMPRA (
    id INT AUTO_INCREMENT PRIMARY KEY,
    compra_id INT,
    produto_id INT,
    quantidade INT,
    preco DECIMAL(10, 2),
    FOREIGN KEY (compra_id) REFERENCES COMPRAS(id),
    FOREIGN KEY (produto_id) REFERENCES PRODUTOS(id)
);