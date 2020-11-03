/**********************************************************************
 *                               SCHEMA.SQL
 *
 * Subject: Information Systems and Databases
 * Laboratory Teacher: Ines Filipe
 *
 * Joao Pedro Cardoso, 84096
 * Matilde Moreira, 84137
 * Duarte Oliveira, 94192
 ***********************************************************************/


 CREATE TABLE Person(
    name VARCHAR(80) ,
    address VARCHAR(120),
    Phone INTEGER NOT NULL,
    Tax_ID INTEGER NOT NULL,
    UNIQUE(Phone),
    UNIQUE(Tax_ID),
    PRIMARY KEY(name,address)
 );

INSERT INTO Person VALUES ('Maria Francisca','Rua Estrada da Cruzinha','97959','2');
INSERT INTO Person VALUES ('Eduardo','Rua Estrada da Cruzinha','9794','1');

SELECT * FROM Person;




/*
 Matilde
 */








/*
 Duarte
 */







