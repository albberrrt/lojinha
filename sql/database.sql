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
    produtoAmount INT NOT NULL,
    discProduto INT NOT NULL,
    produtoState INT NOT NULL,
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
INSERT INTO `produtos` (`produtoId`, `produtoPrc`, `produtoPrcFinal`, `produtoName`, `produtoImg`, `produtoImgFile`, `categoriaId`, `produtoGen`, `produtoVendas`, `produtoAmount`, `discProduto`, `produtoState`) 
VALUES (NULL, '279.90', '0', 'Camisa Polo Marinho Grêmio Masculina', '../../img/produtoImg/Camisa polo/masculino/CamisaPoloGrêmioMasculinaprodutoImg.jpg', 'CamisaPoloGrêmioMasculinaprodutoImg.jpg', '5', '2', '0', '50', '10', '1');
UPDATE `produtos` SET `produtoPrcFinal` = (produtoPrc - (produtoPrc * (discProduto / 100))) WHERE produtoName = 'Camisa Polo Marinho Grêmio Masculina';

INSERT INTO `produtos` (`produtoId`, `produtoPrc`, `produtoPrcFinal`, `produtoName`, `produtoImg`, `produtoImgFile`, `categoriaId`, `produtoGen`, `produtoVendas`, `produtoAmount`, `discProduto`, `produtoState`) 
VALUES (NULL, '279.90', '0', 'Camiseta Grêmio Retrô Preta Masculina', '../../img/produtoImg/Camiseta/masculino/CamisetaGrêmioRetrôPretaMasculinaprodutoImg.jpg', 'CamisetaGrêmioRetrôPretaMasculinaprodutoImg.jpg', '1', '2', '0', '60', '0', '1');
UPDATE `produtos` SET `produtoPrcFinal` = (produtoPrc - (produtoPrc * (discProduto / 100))) WHERE produtoName = 'Camiseta Grêmio Retrô Preta Masculina';

INSERT INTO `produtos` (`produtoId`, `produtoPrc`, `produtoPrcFinal`, `produtoName`, `produtoImg`, `produtoImgFile`, `categoriaId`, `produtoGen`, `produtoVendas`, `produtoAmount`, `discProduto`, `produtoState`) 
VALUES (NULL, '279.90', '0', 'Camiseta Grêmio Retrô Preta Masculina', '../../img/produtoImg/Camiseta/masculino/CamisetaGrêmioRetrôPretaMasculinaprodutoImg.jpg', 'CamisetaGrêmioRetrôPretaMasculinaprodutoImg.jpg', '1', '2', '0', '60', '0', '1');
UPDATE `produtos` SET `produtoPrcFinal` = (produtoPrc - (produtoPrc * (discProduto / 100))) WHERE produtoName = 'Camiseta Grêmio Retrô Preta Masculina';