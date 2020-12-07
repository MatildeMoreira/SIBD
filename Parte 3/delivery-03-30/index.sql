/**********************************************************************
 *                               INDEX.SQL
 * Description: File to create the index to improve the querying times
 * for each of the cases listed below
 *
 * Subject: Information Systems and Databases
 * Laboratory Teacher: Ines Filipe
 * Senior Lecturer: Paulo Carreira
 *
 * Joao Pedro, 84096
 * Matilde, 84137
 * Duarte, 94192
 ***********************************************************************/



 -- Return the number of transformers with a given primary voltage by locality

SELECT a.pv,COUNT(*) as number
FROM (SELECT *
FROM transformer) as a
GROUP BY a.pv
ORDER BY number DESC;

DROP INDEX IF EXISTS pv_idx;
DROP INDEX IF EXISTS locality_idx;
CREATE INDEX pv_idx ON transformer(pv);
CREATE INDEX locality_idx ON substation(locality);


SELECT locality, count(*)
FROM transformer
NATURAL JOIN substation
WHERE pv=668.7
GROUP BY locality;



-- List all descriptions of line incidents that start with a given prefix within two points in
-- time

SELECT id, description
FROM incident
WHERE instant BETWEEN <ts1> AND <ts2>
AND description LIKE '<SOME PATHERN>%'


