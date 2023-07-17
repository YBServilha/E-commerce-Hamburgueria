--criadno banco de dados 'adm'
CREATE DATABASE burgerfriends;

USE burgerfriends;

--tabela de administradores
CREATE TABLE administradores(
    id INT(11) NOT NULL AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL COMMENT 'nome do adm',
    email VARCHAR(100) NOT NULL COMMENT 'email do adm',
    senha VARCHAR(100) NOT NULL COMMENT 'senha em sha256',
    datahora DATETIME NOT NULL COMMENT 'data e hora de registro',
    poder INT(1) NOT NULL COMMENT 'nível de responsabilidade de adm',
    status INT(1) NOT NULL COMMENT '(1) = ativo, (0) = inativo',
    constraint idadm PRIMARY KEY(id)
);

--inserindo um administrador na tabela
INSERT INTO administradores(nome, email, senha, datahora, poder, status) VALUES('Administrador','burgerfriends@gmail.com','5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5',now(),'9','1');


--Tabela de Menu
CREATE TABLE menu(
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    folder VARCHAR(100) NOT NULL COMMENT 'pasta onde se encontra a página x',
    nome VARCHAR(100) NOT NULL COMMENT 'nome do Menu|Link',
    url VARCHAR(100) NOT NULL COMMENT 'url do menu',
    datahora DATETIME NOT NULL COMMENT 'data e hora de registro',
    status INT(1) NOT NULL COMMENT '1 - Ativo | 0 - Inativo'
)ENGINE = InnoDB;

--Tabela de Submenu
CREATE TABLE submenu(
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    folder VARCHAR(100) NOT NULL COMMENT 'pasta onde se encontra a página x',
    idmenu INT(11) NOT NULL COMMENT 'id da tabela submenu',
    nomesub VARCHAR(100) NOT NULL COMMENT 'nome do submenu|Link',
    url VARCHAR(100) NOT NULL COMMENT 'url do submenu',
    datahora DATETIME NOT NULL COMMENT 'data e hora de registro',
    status INT(1) NOT NULL COMMENT '1 - Ativo | 0 - Inativo',
    FOREIGN KEY (idmenu) REFERENCES menu(id)
)ENGINE = InnoDB;



--SQL de INNER JOIN para o menu e submenu
SELECT menu.id AS menuId, menu.nome AS menuNome, menu.url AS menuURL, submenu.id AS subId, submenu.nomesub AS subNome, submenu.url AS subURL FROM menu INNER JOIN submenu ON menu.id = submenu.idmenu WHERE menu.folder = 'r' AND menu.status = 1;


--Tabela de Categorias
CREATE TABLE categorias(
    id INT(11) NOT NULL AUTO_INCREMENT,
    categoria VARCHAR(60) NOT NULL,
    nome VARCHAR(60) NOT NULL,
    preco VARCHAR(60) NOT NULL,
    imagem VARCHAR(60) NOT NULL,
    legenda VARCHAR(100) NOT NULL,
    PRIMARY KEY(ID)
);


--Alguns Insert para Categorias
INSERT INTO categorias(categoria, nome, preco, imagem, legenda) VALUES('Hamburguer',' Duplo Burger Bacon','32','DuploBurgerBacon.jpg','Pão com gergelim, Carne, duplo queijo, tomate');

INSERT INTO categorias(categoria, nome, preco, imagem, legenda) VALUES('Hamburguer','X-Burger','38','XBurger.jpg','Pão com gergelim, Carne, queijo, tomate, alface, cebola');

INSERT INTO categorias(categoria, nome, preco, imagem, legenda) VALUES('Hamburguer','X-Picanha Abacaxi','42','XPicanhaAbacaxi.jpg','Pão com gergelim, Picanha, queijo, tomate, Abacaxi');

INSERT INTO categorias(categoria, nome, preco, imagem, legenda) VALUES('Hamburguer','X-Picanha Salada','38','XPicanhaSalada.jpg','Pão com gergelim, Picanha, queijo, tomate, alface, cebola');

INSERT INTO categorias(categoria, nome, preco, imagem, legenda) VALUES('Acompanhamento','Batata Grande','15','BatataGrande.jpg','Batata Frita Tamanho Grande');

INSERT INTO categorias(categoria, nome, preco, imagem, legenda) VALUES('Acompanhamento','Batata Média','12','BatataMedia.jpg','Batata Frita Tamanho Médio');

INSERT INTO categorias(categoria, nome, preco, imagem, legenda) VALUES('Bebida','Coca-Cola','12','Refrigerante.jpg','Refrigerante Coca-cola');

INSERT INTO categorias(categoria, nome, preco, imagem, legenda) VALUES('Bebida','Suco de Laranja','10','SucoNatural.jpg','Suco Natural de laranja');

INSERT INTO categorias(categoria, nome, preco, imagem, legenda) VALUES('Sobremesa','Sorvete 1L','14','Sorvetes1litro.jpg','Sorvete de 1L morango, creme, chocolate');

INSERT INTO categorias(categoria, nome, preco, imagem, legenda) VALUES('Sobremesa','Sorvete 500ml','10','Sorvetes500ml.jpg','Sorvete de 500ml morango, creme, chocolate');

INSERT INTO categorias(categoria, nome, preco, imagem, legenda) VALUES('Sobremesa','Mousse de Chocolate','7','Mousses.jpg','Mousse de chocolate com frutas vermelhas');


--Tabela de Cadstro de Usuário
CREATE TABLE usuarios(
    id INT(11) NOT NULL AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    endereco VARCHAR(100) NOT NULL,
    complemento VARCHAR(100) NULL,
    numero VARCHAR(10) NOT NULL,
    telefone VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    senha VARCHAR(100) NOT NULL,
    PRIMARY KEY(id)
);

--Inner Join para menu e submenu
SELECT menu.id AS menuId, menu.nome AS menuNome, menu.url AS menuUrl, submenu.idmenu AS subId, submenu.nomesub AS subNome, submenu.url FROM menu INNER JOIN submenu ON menu.id = submenu.idmenu WHERE menu.folder = 'r' AND menu.status = 1;


--Tabela de Carrinho
CREATE TABLE carrinho(
    id INT(11) AUTO_INCREMENT,
    email VARCHAR(100) NOT NULL,
    nome VARCHAR(100) NOT NULL,
    imagem VARCHAR(100) NOT NULL,
    legenda VARCHAR(100) NOT NULL,
    preco INT(100) NOT NULL,
    PRIMARY KEY(id)
);


--Tabela de monte o seu
CREATE TABLE monteseu(
    id INT(11) AUTO_INCREMENT,
    email VARCHAR(100) NOT NULL,
    nome VARCHAR(100) NOT NULL,
    produto VARCHAR(100) NOT NULL,
    imagem VARCHAR(100) NOT NULL,
    pao VARCHAR(100) NOT NULL,
    burger VARCHAR(100) NOT NULL,
    ponto VARCHAR(100) NOT NULL,
    queijo VARCHAR(100) NOT NULL,
    alface VARCHAR(100) NOT NULL,
    bacon VARCHAR(100) NOT NULL,
    tomate VARCHAR(100) NOT NULL,
    cebola VARCHAR(100) NOT NULL,
    picles VARCHAR(100) NOT NULL,
    pimenta VARCHAR(100) NOT NULL,
    preco INT(100) NOT NULL,
    PRIMARY KEY(id)
);


