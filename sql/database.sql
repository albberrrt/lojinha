CREATE DATABASE BigodeShop;

CREATE TABLE users (
    userId INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    userName VARCHAR(255) NOT NULL,
    userEmail VARCHAR(255) NOT NULL,
    userPassword VARCHAR(255) NOT NULL,
    userCart INT NOT NULL,
    userImg VARCHAR(255) NOT NULL
    );

CREATE TABLE produtos (
    produtoId INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    produtoPrc INT NOT NULL,
    produtoName VARCHAR(255) NOT NULL,
    categoriaId VARCHAR(255) NOT NULL,
    produtoVendas INT NOT NULL,
    discProduto INT,
    FOREIGN KEY (`categoriaId`) REFERENCES `categorias` (`catId`)
   )

CREATE TABLE categorias (
    catId INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    categoria VARCHAR(255) NOT NULL
    )