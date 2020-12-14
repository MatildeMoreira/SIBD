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
DROP TYPE IF EXISTS type_element;

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

 CREATE TABLE d_element(
     id_element SERIAL,
     element_id VARCHAR(10) NOT NULL,
     element_type CHAR NOT NULL,
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


CREATE OR REPLACE FUNCTION load_d_time()
    RETURNS VOID AS
$$
DECLARE time_val TIMESTAMP;
BEGIN
    time_val := '2020-01-01 00:00:00';
    WHILE time_val < '2020-12-31 00:00:00' LOOP
        INSERT INTO d_time(
            id_time,
            day,
            week_day,
            week,
            month,
            trimester,
            year
        ) VALUES (
              EXTRACT(YEAR FROM time_val) * 10000
              +   EXTRACT(MONTH FROM time_val)*100
              +   EXTRACT(DAY FROM time_val),
              EXTRACT(DAY FROM time_val),
              EXTRACT(DOW FROM time_val),
              EXTRACT(WEEK FROM time_val),
              EXTRACT(MONTH FROM time_val),
              CASE
                    WHEN EXTRACT(MONTH FROM time_val) BETWEEN 0 AND 3 THEN 1
                    WHEN EXTRACT(MONTH FROM time_val) BETWEEN 4 AND 6 THEN 2
                    WHEN EXTRACT(MONTH FROM time_val) BETWEEN 7 AND 9 THEN 3
                    ELSE 4
              END,
              EXTRACT(YEAR FROM time_val)
        );
        time_val := time_val + INTERVAL '1 DAY';
    END LOOP;
END;
$$ LANGUAGE plpgsql;

select load_d_time();

INSERT INTO d_location(latitude, longitude, locality)
    SELECT gpslat, gpslong, locality
    FROM substation;

INSERT INTO d_element(element_id, element_type)
    SELECT id, SUBSTRING(id, 0,2) AS element_type FROM element;

select * from d_element;