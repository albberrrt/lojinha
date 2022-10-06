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
INSERT INTO `categorias` (`categoriaId`, `categoria`) VALUES (NULL, 'Camisas polo'), (NULL, 'Camisetas'), (NULL, 'Regatas'), (NULL, 'Jaquetas'), (NULL, 'Moletons'), (NULL, 'Shorts'), (NULL, 'Camisas')

/* Produtos */
INSERT INTO `produtos` (`produtoId`, `produtoPrc`, `produtoPrcFinal`, `produtoName`, `produtoImg`, `produtoImgFile`, `categoriaId`, `produtoGen`, `produtoVendas`, `produtoAmount`, `discProduto`, `produtoTags`, `produtoState`) VALUES
(38, 279.9, 209.925, 'Jaqueta Trilobal Marinha Masculina', '../../img/produtoImg/Jaquetas/masculino/JaquetaTrilobalMarinhaMasculinaprodutoImg.jpg', 'JaquetaTrilobalMarinhaMasculinaprodutoImg.jpg', 4, 2, 0, 45, 25, 'Jaquetas Marinhas Grêmio', 1),
(37, 315.9, 315.9, 'Jaqueta Estampada c/ Forro Preta Masculina', '../../img/produtoImg/Jaquetas/masculino/JaquetaEstampadacForroPretaMasculinaprodutoImg.jpg', 'JaquetaEstampadacForroPretaMasculinaprodutoImg.jpg', 4, 2, 0, 45, 0, 'Jaquetas Estampadas Pretas Grêmio', 1),
(36, 299.9, 299.9, 'Jaqueta Moletom Details Masculina', '../../img/produtoImg/Jaquetas/masculino/JaquetaMoletomDetailsMasculinaprodutoImg.jpg', 'JaquetaMoletomDetailsMasculinaprodutoImg.jpg', 4, 2, 0, 45, 0, 'Jaquetas Preta Pretas Grêmio', 1),
(35, 289.9, 289.9, 'Jaqueta Bomber Preta Grêmio Masculina', '../../img/produtoImg/Jaquetas/masculino/JaquetaBomberPretaGrêmioMasculinaprodutoImg.jpg', 'JaquetaBomberPretaGrêmioMasculinaprodutoImg.jpg', 4, 2, 0, 42, 0, 'Jaquetas Pretas ', 1),
(34, 299.9, 254.915, 'Jaqueta Bomber Vintage Grêmio Masculina', '../../img/produtoImg/Jaquetas/masculino/JaquetaBomberVintageGrêmioMasculinaprodutoImg.jpg', 'JaquetaBomberVintageGrêmioMasculinaprodutoImg.jpg', 4, 2, 0, 55, 15, 'Jaquetas Grêmio Preta Pretas', 1),
(7, 299.9, 269.91, 'Camiseta Retrô 1917 Masculina', '../../img/produtoImg/Camisetas/masculino/CamisetaRetrô1917MasculinaprodutoImg.jpg', 'CamisetaRetrô1917MasculinaprodutoImg.jpg', 1, 2, 0, 35, 10, 'Camisetas Branca Brancas Grêmio', 1),
(6, 229.9, 206.91, 'Camiseta Retrô Mundial 1983 Masculina', '../../img/produtoImg/Camisetas/masculino/CamisetaRetrôMundial1983MasculinaprodutoImg.jpg', 'CamisetaRetrôMundial1983MasculinaprodutoImg.jpg', 1, 2, 0, 45, 10, 'Camisetas', 1),
(5, 199.9, 169.915, 'Camiseta Retrô Tricolor Masculina', '../../img/produtoImg/Camisetas/masculino/CamisetaRetrôTricolorMasculinaprodutoImg.jpg', 'CamisetaRetrôTricolorMasculinaprodutoImg.jpg', 1, 2, 0, 65, 15, 'Camisetas', 1),
(4, 119.9, 77.935, 'Camiseta Preta Grêmio Masculina', '../../img/produtoImg/Camisetas/masculino/CamisetaPretaGrêmioMasculinaprodutoImg.jpg', 'CamisetaPretaGrêmioMasculinaprodutoImg.jpg', 1, 2, 0, 30, 35, 'Camisetas Pretas ', 1),
(3, 199.9, 179.91, 'Camiseta Retrô Preta Masculina', '../../img/produtoImg/Camisetas/masculino/CamisetaRetrôPretaMasculinaprodutoImg.jpg', 'CamisetaRetrôPretaMasculinaprodutoImg.jpg', 1, 2, 0, 50, 10, 'Camisetas ', 1),
(2, 119.9, 89.925, 'Camiseta Champion Masculina', '../../img/produtoImg/Camisetas/masculino/CamisetaChampionMasculinaprodutoImg.jpg', 'CamisetaChampionMasculinaprodutoImg.jpg', 1, 2, 0, 45, 25, 'Camisetas Preta', 1),
(1, 179.9, 179.9, 'Camiseta Penta Campeão Gaúcho 2022 Masculina', '../../img/produtoImg/Camisetas/masculino/CamisetaPentaCampeãoGaúcho2022MasculinaprodutoImg..jpg', 'CamisetaPentaCampeãoGaúcho2022MasculinaprodutoImg..jpg', 1, 2, 0, 60, 0, 'Camiseta Camisetas Preta Pretas Grêmio', 1);

-- http://www.codingcage.com/2015/04/php-login-and-registration-script-with.html