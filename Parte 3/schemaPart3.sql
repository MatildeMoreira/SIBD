-------------------------------------------------------------
-- Project Assignment - Part 3 - Schema
-------------------------------------------------------------
/**********************************************************************
 *                               SCHEMA.SQL
 *
 * Subject: Information Systems and Databases
 * Laboratory Teacher: Ines Filipe
 * Senior Lecturer: Paulo Carreira
 *
 * Joao Pedro, 84096
 * Matilde, 84137
 * Duarte, 94192
 ***********************************************************************/

-- The DROP TABLE IF EXISTS statement is used to drop an existing table in a database.
DROP TABLE IF EXISTS analyses cascade;
DROP TABLE IF EXISTS lineincident cascade;
DROP TABLE IF EXISTS incident cascade;
DROP TABLE IF EXISTS transformer  cascade;
DROP TABLE IF EXISTS line cascade;
DROP TABLE IF EXISTS busbar cascade;
DROP TABLE IF EXISTS element cascade;
DROP TABLE IF EXISTS substation cascade;
DROP TABLE IF EXISTS analyst cascade;
DROP TABLE IF EXISTS supervisor cascade;
DROP TABLE IF EXISTS person cascade;
-- The CREATE TABLE statement is used to create a new table in a database.

-- Entity : person (name,address,phone,taxid)
CREATE TABLE person(
    name VARCHAR(80),
    address VARCHAR(80),
    phone NUMERIC(9),
    taxid NUMERIC(20),
	PRIMARY KEY(name, address),
	UNIQUE(phone),
	UNIQUE(taxid)
);

-- Specialization,Entity : supervisor (name,address)
CREATE TABLE supervisor(
	name VARCHAR(80),
    address VARCHAR(80),
	PRIMARY KEY(name, address),
	FOREIGN KEY(name, address) REFERENCES person(name, address)
);

-- Specialization,Entity : analyst (name,address)
CREATE TABLE analyst(
	name VARCHAR(80),
    address VARCHAR(80),
	PRIMARY KEY(name, address),
	FOREIGN KEY(name, address) REFERENCES person(name, address)
);

-- Entity : substation (gpslat,gpslong,locality,sname,saddress)
CREATE TABLE substation(
    gpslat NUMERIC(9,6),
    gpslong NUMERIC(8,6),
    locality VARCHAR(80),
    sname VARCHAR(80),
    saddress VARCHAR(80),
    PRIMARY KEY(gpslat, gpslong),
    FOREIGN KEY(sname, saddress) REFERENCES supervisor(name, address)
);

-- Entity : element(id)
CREATE TABLE element(
    id VARCHAR(10),
    PRIMARY KEY(id)
);

-- Specialization, Entity : busbar(id,voltage)
CREATE TABLE busbar(
    id VARCHAR(10),
    voltage NUMERIC(7,4),
    PRIMARY KEY(id),
    FOREIGN KEY(id) REFERENCES element(id)
);

-- Specialization, Entity : transformer(id,pv,sv,gpslat,gpslong,pbbid,sbbid)
CREATE TABLE transformer(
    id VARCHAR(10),
    pv NUMERIC(7, 4),
    sv NUMERIC(7, 4),
    gpslat NUMERIC(9,6),
    gpslong NUMERIC(8,6),
    pbbid VARCHAR(10),
    sbbid VARCHAR(10),
    PRIMARY KEY(id),
    FOREIGN KEY(id) REFERENCES element(id),
    FOREIGN KEY(gpslat, gpslong) REFERENCES substation(gpslat, gpslong),
    FOREIGN KEY(pbbid) REFERENCES busbar(id),
    FOREIGN KEY(sbbid) REFERENCES busbar(id),
    CHECK(pbbid<>sbbid)
);

-- Specialization, Entity : line(id,impedance,pbbid,sbbid)
CREATE TABLE line(
    id VARCHAR(10),
    impedance NUMERIC(7,4),
    pbbid VARCHAR(10),
    sbbid VARCHAR(10),
    PRIMARY KEY(id),
    FOREIGN KEY(id) REFERENCES element(id),
    FOREIGN KEY(pbbid) REFERENCES busbar(id),
    FOREIGN KEY(sbbid) REFERENCES busbar(id),
    CHECK(pbbid<>sbbid)
);

-- Entity : incident(id,instant, description, severity)
CREATE TABLE incident(
    instant TIMESTAMP,
    id VARCHAR(10),
    description VARCHAR(250),
    severity VARCHAR(30),
    PRIMARY KEY(instant, id),
    FOREIGN KEY(id) REFERENCES element(id)
);

-- Specialization, Entity : lineincident(id,instant,point)
CREATE TABLE lineincident(
    instant TIMESTAMP,
    id VARCHAR(10),
    point FLOAT,
    PRIMARY KEY(instant, id),
    FOREIGN KEY(instant, id) REFERENCES incident(instant, id)
);

-- Association : analyzes(report,name,address,id,instant)
CREATE TABLE analyses(
    instant TIMESTAMP,
    id VARCHAR(10),
    report VARCHAR(255),
	name VARCHAR(80),
    address VARCHAR(80),
    PRIMARY KEY(instant, id),
    FOREIGN KEY(instant, id) REFERENCES incident(instant, id),
    FOREIGN KEY(name, address) REFERENCES analyst(name, address)
);