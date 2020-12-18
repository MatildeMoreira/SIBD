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

/*Inserting into the reporter dimension table which gets all values of the analyst table*/
INSERT INTO d_reporter (name,address)
    SELECT *
    FROM analyst;

/* Inserting into the time dimension table which create 365 time id's corresponding to every day of the year */
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

/* Call the function that creates de time id's */
SELECT load_d_time();

/* Inserting into the location dimension table which gets the coordinates and locality of substation table */
INSERT INTO d_location(latitude, longitude, locality)
    SELECT gpslat, gpslong, locality
    FROM substation;

/*Inserting into the element dimension table which gets the id of element table
  The element type corresponds to the first letter of the id of the element*/
INSERT INTO d_element(element_id, element_type)
    SELECT id, SUBSTRING(id, 0,2) AS element_type FROM element;

/*Inserting into the incident fact table*/
/*The operation table is: 'analyses NATURAL JOIN incident NATURAL JOIN transformer'
to get the info of each surrogate key and the severity*/
INSERT INTO f_incident
       SELECT id_reporter, id_time, id_location, id_element, severity
       FROM (analyses NATURAL JOIN incident NATURAL JOIN transformer) t
       LEFT OUTER JOIN d_reporter dr ON
           dr.address = t.address AND dr.name = t.name
       LEFT OUTER JOIN d_time dt ON
           dt.year = EXTRACT(YEAR FROM t.instant)
           AND dt.month = EXTRACT(MONTH FROM t.instant)
           AND dt.day = EXTRACT(DAY FROM t.instant)
       LEFT OUTER JOIN d_location dl
           ON (dl.latitude, dl.longitude) = (t.gpslat, t.gpslong)
       LEFT OUTER JOIN d_element de
           ON de.element_id = t.id
       WHERE severity = t.severity;

select * from f_incident;