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
SELECT name
FROM analyses
GROUP BY name,address
HAVING count(id) >= ALL (SELECT count(id)
                         FROM analyses
                         GROUP BY name,address);

-- C. List all substations with more than one transformer.
SELECT s.*
FROM substation s, transformer trans
WHERE trans.latitude=s.latitude and s.longitude=trans.longitude and (trans.latitude,trans.longitude) IN (SELECT latitude,longitude
                                                                    FROM transformer
                                                                    GROUP BY latitude,longitude
                                                                    HAVING count(*)>1)
GROUP BY s.latitude,s.longitude;



-- D. Find the names of the localities that have more substations than every other locality.
SELECT locality_name,count((longitude,latitude)) as Numb_Substations
FROM substation
GROUP BY locality_name
HAVING count((longitude,latitude)) >= ALL(SELECT count((latitude,longitude))
                                          FROM substation
                                          GROUP BY locality_name);

