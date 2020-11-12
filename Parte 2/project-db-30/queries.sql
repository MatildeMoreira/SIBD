/**********************************************************************
 *                               QUERIES.SQL
 *
 * Subject: Information Systems and Databases
 * Laboratory Teacher: Ines Filipe
 * Senior Lecturer: Paulo Carreira
 *
 * Joao Pedro, 84096
 * Matilde, 84137
 * Duarte, 94192
 ***********************************************************************/


-- A. List the names of all analysts that analysed element with id 'B-789'.
SELECT name
FROM analyses
WHERE id = 'B-789';


-- B. What is the name of the analyst that has reported more incidents.
SELECT name, count(name)
FROM analyses
HAVING count(name) >= ALL (SELECT count(name) FROM analyses);


SELECT count(distinct (name,address))
FROM analyses;


-- C. List all substations with more than one transformer.



-- D. Find the names of the localities that have more substations than every other locality.
SELECT max(counts)
FROM (SELECT locality_name, count((longitude,latitude)) as counts
        FROM substation
        GROUP BY locality_name);

