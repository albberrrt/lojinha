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
    produtoPrc FLOAT NOT NULL,
    produtoPrcFinal FLOAT NOT NULL,
    produtoName VARCHAR(255) NOT NULL,
    produtoImg VARCHAR(255) NOT NULL,
    produtoImgFile VARCHAR(255) NOT NULL,
    categoriaId INT NOT NULL,
    produtoGen INT(4) NOT NULL,
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

/* Categorias */
INSERT INTO `categorias` (`categoriaId`, `categoria`) VALUES (NULL, 'Camisa polo'), (NULL, 'Camiseta'), (NULL, 'Regata'), (NULL, 'Casaco'), (NULL, 'Moletom'), (NULL, 'Short'), (NULL, 'Camisa')

/* Produtos */
INSERT INTO `produtos` (`produtoId`, `produtoPrc`, `produtoPrcFinal`, `produtoName`, `produtoImg`, `categoriaId`, `produtoGen`, `produtoVendas`, `discProduto`) VALUES (NULL, '279.90', '279.90', 'Camisa Grêmio Clássica', '../../img/produtoImg/camisa/masc/GremioClassica.webp', '7', '1', '0', '0');
INSERT INTO `produtos` (`produtoId`, `produtoPrc`, `produtoPrcFinal`, `produtoName`, `produtoImg`, `categoriaId`, `produtoGen`, `produtoVendas`, `discProduto`) VALUES (NULL, '299.90', '279.90', 'Camisa Grêmio Outubro Rosa 2021', '../../img/produtoImg/camisa/fem/GremioOutubroRosa.webp', '7', '2', '0', '0');