/**********************************************************************
 *                               ETL.SQL
 *
 * Description: File with the script to load the star schema.
 *
 * Subject: Information Systems and Databases
 * Laboratory Teacher: Ines Filipe
 * Senior Lecturer: Paulo Carreira
 *
 * Joao Pedro, 84096
 * Matilde, 84137
 * Duarte, 94192
 ***********************************************************************/


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

SELECT load_d_time();

INSERT INTO d_location(latitude, longitude, locality)
    SELECT gpslat, gpslong, locality
    FROM substation;

INSERT INTO d_element(element_id, element_type)
    SELECT id, SUBSTRING(id, 0,2) AS element_type FROM element;

INSERT INTO f_incident
       SELECT id_reporter, id_time, id_location, id_element, severity
        FROM (analyses NATURAL JOIN incident NATURAL JOIN substation NATURAL JOIN element) t
        LEFT OUTER JOIN d_reporter dr ON
            dr.address = t.address AND dr.name = t.name
        LEFT OUTER JOIN d_time dt ON
            dt.year = EXTRACT(YEAR FROM t.instant)
            AND dt.month = EXTRACT(MONTH FROM t.instant)
            AND dt.day = EXTRACT(DAY FROM t.instant)
        LEFT OUTER JOIN d_location dl
            ON dl.latitude = t.gpslat AND dl.longitude = t.gpslong AND dl.locality = t.locality
        LEFT OUTER JOIN d_element de
            ON de.element_id = t.id
        WHERE severity = t.severity;

SELECT * from f_incident;
