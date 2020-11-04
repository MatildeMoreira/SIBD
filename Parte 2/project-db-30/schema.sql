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

CREATE TABLE Element(
    id INTEGER,
    PRIMARY KEY(eid)
    -- The id of an element cannot exist in line, bus bar and transformer at the same time
    -- Every if of element must exist either in line, bus bar or transformer
);

CREATE TABLE Line(
    id INTEGER,
    impedance INTEGER,
    PRIMARY KEY(id),
    FOREIGN KEY(id) REFERENCES Element(id)
);

CREATE TABLE line_connection(
    id_line INTEGER,
    id_primary INTEGER,
    id_secondary INTEGER,
    PRIMARY KEY(id_line, id_primary, id_secondary),
    FOREIGN KEY(id_line) REFERENCES Line(id),
    FOREIGN KEY(id_primary) REFERENCES BusBar(id),
    FOREIGN KEY(id_secondary) REFERENCES BusBar(id)
);

CREATE TABLE BusBar(
    id INTEGER,
    voltage INTEGER,
    PRIMARY KEY(id),
    FOREIGN KEY(id) REFERENCES Element(id)
);

CREATE TABLE Transformer(
    primary_voltage INTEGER,
    secondary_voltage INTEGER,
    PRIMARY KEY(id),
    FOREIGN KEY(id) REFERENCES Element(id)
);

CREATE TABLE transformer_connection(
    id_transformer INTEGER,
    id_primary INTEGER,
    id_secondary INTEGER,
    PRIMARY KEY(id_transformer, id_primary, id_secondary),
    FOREIGN KEY(id_transformer) REFERENCES Transformer(id),
    FOREIGN KEY(id_primary) REFERENCES BusBar(id),
    FOREIGN KEY(id_secondary) REFERENCES BusBar(id)
);





