CREATE DATABASE eleicoes;
USE eleicoes;

CREATE TABLE candidatos(
    candidatoId INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    candidatoNome VARCHAR(255) NOT NULL
    );

CREATE TABLE eleitor(
    eleitorId INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    eleitorCpf VARCHAR(500) NOT NULL,
    eleitorNome VARCHAR(255) NOT NULL,
    eleitorEmail VARCHAR(255) NOT NULL,
    eleitorBairro VARCHAR(255) NOT NULL,
    eleitorVoto01 INT NOT NULL,
    eleitorVoto02 INT NOT NULL,
    eleitorVoto03 INT NOT NULL,
    FOREIGN KEY (`eleitorVoto01`) REFERENCES candidatos(`candidatoId`),
    FOREIGN KEY (`eleitorVoto02`) REFERENCES candidatos(`candidatoId`),
    FOREIGN KEY (`eleitorVoto03`) REFERENCES candidatos(`candidatoId`)
    );
INSERT INTO `candidatos` (`candidatoId`, `candidatoNome`) VALUES 
(1, 'Jair Bolsonaro(PL)'),
(2, 'Lula(PT)'),
(3, 'Ciro Gomes(PDT)'),
(4, 'Simone Tebet(MDB)'),
(5, 'Leonardo Péricles(UP)'),
(6, 'Luiz Felipe d Avila(NOVO)'),
(7, 'Vera Lúcia(PSTU)'),
(8, 'Sofia Manzano(PCB)'),
(9, 'Eymael(DC)'),
(10, 'Soraya Thronicke(União Brasil)'),
(11, 'Pablo Marça~(Pros)'),
(12, 'Roberto Jefferson(PTB)');

INSERT INTO `eleitor` (`eleitorId`, `eleitorCpf`, `eleitorNome`, `eleitorEmail`, `eleitorBairro`, `eleitorVoto01`, `eleitorVoto02`, `eleitorVoto03`) VALUES 
(1, '88888888888', 'Guilherme Bigode', 'bigode@gmail.com', 'Vila Maria', '2', '3', '1'),
(2, '77777777777', 'Gianlucca', 'gianlucca@gmail.com', 'Mooca', '1', '6', '8'),
(3, '55555555555', 'Beymar Ulisses', 'beymar@gmail.com', 'Mooca', '1', '2', '3'),
(4, '34356578711', 'Déborah Yeko', 'debs123@gmail.com', 'Mooca', '1', '6', '4'),
(5, '75788748787', 'Felipe Porto', 'felipewhey@gmail.com', 'Mooca', '1', '3', '10'),
(6, '55954644866', 'João Edilson', 'joaoedilson@gmail.com', 'Jardim Dourado', '5', '8', '9');

