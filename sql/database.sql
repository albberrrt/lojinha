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
    produtoTags VARCHAR(500) NOT NULL,
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
INSERT INTO `produtos` (`produtoId`, `produtoPrc`, `produtoPrcFinal`, `produtoName`, `produtoImg`, `produtoImgFile`, `categoriaId`, `produtoGen`, `produtoVendas`, `produtoAmount`, `discProduto`, `produtoTags`, `produtoState`) VALUES
(1, 179.9, 179.9, 'Camiseta Penta Campeão Gaúcho 2022 Masculina', '../../img/produtoImg/Camiseta/masculino/CamisetaPentaCampeãoGaúcho2022produtoImg.jpg', 'CamisetaPentaCampeãoGaúcho2022produtoImg.jpg', 1, 2, 0, 60, 0, 'Camiseta Camisetas Preta Pretas Grêmio', 1),
(2, 119.9, 89.925, 'Camiseta Champion Masculina', '../../img/produtoImg/Camiseta/masculino/CamisetaChampionMasculinaprodutoImg.jpg', 'CamisetaChampionMasculinaprodutoImg.jpg', 1, 2, 0, 45, 25, 'Camisetas Preta', 1),
(3, 199.9, 179.91, 'Camiseta Retrô Preta Masculina', '../../img/produtoImg/Camiseta/masculino/CamisetaRetrôPretaMasculinaprodutoImg.jpg', 'CamisetaRetrôPretaMasculinaprodutoImg.jpg', 1, 2, 0, 50, 10, 'Camisetas ', 1),
(4, 119.9, 77.935, 'Camiseta Preta Grêmio Masculina', '../../img/produtoImg/Camiseta/masculino/CamisetaPretaGrêmioMasculinaprodutoImg.jpg', 'CamisetaPretaGrêmioMasculinaprodutoImg.jpg', 1, 2, 0, 30, 35, 'Camisetas Pretas ', 1),
(5, 199.9, 169.915, 'Camiseta Retrô Tricolor Masculina', '../../img/produtoImg/Camiseta/masculino/CamisetaRetrôTricolorMasculinaprodutoImg.jpg', 'CamisetaRetrôTricolorMasculinaprodutoImg.jpg', 1, 2, 0, 65, 15, 'Camisetas', 1),
(6, 229.9, 206.91, 'Camiseta Retrô Mundial 1983 Masculina', '../../img/produtoImg/Camiseta/masculino/CamisetaRetrôMundial1983MasculinaprodutoImg.jpg', 'CamisetaRetrôMundial1983MasculinaprodutoImg.jpg', 1, 2, 0, 45, 10, 'Camisetas', 1),
(7, 299.9, 275.908, 'Camiseta Retrô 1917 Masculina', '../../img/produtoImg/Camiseta/masculino/CamisetaRetrô1917MasculinaprodutoImg.jpg', 'CamisetaRetrô1917MasculinaprodutoImg.jpg', 1, 2, 0, 35, 8, 'Camisetas Branca Brancas Grêmio', 1);