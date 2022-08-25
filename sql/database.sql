CREATE DATABASE BigodeShop;
USE BigodeShop;

CREATE TABLE users (
    userId INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    userName VARCHAR(255) NOT NULL,
    userEmail VARCHAR(255) NOT NULL,
    userPassword VARCHAR(255) NOT NULL,
    userCart VARCHAR(255) NOT NULL,
    userImg VARCHAR(255) NOT NULL,
    dev BOOLEAN NOT NULL
    );

CREATE TABLE produtos (
    produtoId INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    produtoPrc INT NOT NULL,
    produtoName VARCHAR(255) NOT NULL,
    produtoImg VARCHAR(255) NOT NULL,
    categoriaId INT NOT NULL,
    produtoVendas INT NOT NULL,
    discProduto INT,
    FOREIGN KEY (`categoriaId`) REFERENCES categorias(`categoriaId`)
   );

CREATE TABLE categorias (
    categoriaId INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    categoria VARCHAR(255) NOT NULL
    );

CREATE TABLE profileImages (
	imageId INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    imagePath VARCHAR(255) NOT NULL
    )

INSERT INTO `categorias` (`categoriaId`, `categoria`) VALUES (NULL, 'Camisa polo'), (NULL, 'Camiseta'), (NULL, 'Regata'), (NULL, 'Casaco'), (NULL, 'Moletom'), (NULL, 'Short')