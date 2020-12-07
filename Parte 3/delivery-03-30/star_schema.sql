/**********************************************************************
 *                               STAR_SCHEMA.SQL
 *
 * Description: File to create the multidimensional schema
 *
 * Subject: Information Systems and Databases
 * Laboratory Teacher: Ines Filipe
 * Senior Lecturer: Paulo Carreira
 *
 * Joao Pedro, 84096
 * Matilde, 84137
 * Duarte, 94192
 ***********************************************************************/
DROP TABLE IF EXISTS f_incident;
DROP TABLE IF EXISTS d_reporter;
DROP TABLE IF EXISTS d_time;
DROP TABLE IF EXISTS d_location;
DROP TABLE IF EXISTS d_element;

 CREATE TABLE d_reporter(
    id_reporter SERIAL,
    name VARCHAR(80) NOT NULL,
    address VARCHAR(80) NOT NULL,
    PRIMARY KEY(id_reporter)
 );

 CREATE TABLE d_time(
    id_time SERIAL,
    day INT NOT NULL,
    week_day INT NOT NULL,
    week INT NOT NULL,
    month INT NOT NULL,
    trimester INT NOT NULL,
    year INT NOT NULL,
    PRIMARY KEY(id_time)
 );

 CREATE TABLE d_location(
    id_location SERIAL,
    latitude NUMERIC(9,6) NOT NULL,
    longitude NUMERIC(8,6) NOT NULL,
    locality VARCHAR(80),
    PRIMARY KEY(id_location)
 );

 CREATE TYPE type_element AS ENUM ('BusBar','Line','Transformer');
 CREATE TABLE d_element(
     id_element SERIAL,
     element_id VARCHAR(10) NOT NULL,
     element_type type_element NOT NULL,
     PRIMARY KEY (id_element)
 );


 CREATE TABLE f_incident(
    id_reporter SERIAL,
    id_time SERIAL,
    id_location SERIAL,
    id_element SERIAL,
    PRIMARY KEY(id_reporter,id_time,id_location,id_element),
    FOREIGN KEY(id_reporter) REFERENCES d_reporter(id_reporter),
    FOREIGN KEY(id_time) REFERENCES d_time(id_time),
    FOREIGN KEY(id_location) REFERENCES d_location(id_location),
    FOREIGN KEY(id_element) REFERENCES d_element(id_element),
    severity VARCHAR(30)
 );


INSERT INTO d_reporter (name,address)
    SELECT *
    FROM analyst;

INSERT INTO d_time(day,week_day,week,month,trimester,year)



 CREATE TABLE d_time(
    id_time SERIAL,
    day INT NOT NULL,
    week_day VARCHAR(20) NOT NULL,
    week INT NOT NULL,
    month INT NOT NULL,
    trimester INT NOT NULL,
    year INT NOT NULL,
    PRIMARY KEY(id_time)
 );