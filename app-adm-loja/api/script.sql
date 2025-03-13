CREATE TABLE produto ( 
    id int AUTO_INCREMENT, 
    nome varchar(250) NOT NULL,
    preco FLOAT NOT NULL, 
    codigo int NOT NULL, 
    PRIMARY KEY(id);
)ENGINE = INNODB  AUTO_INCREMENT = 10000;