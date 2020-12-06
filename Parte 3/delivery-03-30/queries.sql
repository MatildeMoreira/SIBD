/**********************************************************************
 *                               QUERIES.SQL
 *
 * Description: File with the SQL queries
 * Subject: Information Systems and Databases
 * Laboratory Teacher: Ines Filipe
 * Senior Lecturer: Paulo Carreira
 *
 * Joao Pedro, 84096
 * Matilde, 84137
 * Duarte, 94192
 ***********************************************************************/
-- Present the most succinct SQL query for each of the following questions. If appropriate, you can use the view created
-- previously.

-- 1. Who are the analysts that have analyzed every incident of element ‘B-789’?
SELECT name
FROM analyses
WHERE id = 'B-789';


-- 2. Who are the supervisors that do not supervise substations south of Rio Maior (Portugal) (Rio Maior
-- coordinates: 39.336775, -8.936379 (cf. Google Maps)?





-- 3. What are the elements with the smallest amount of incidents?





-- 4. How many substations does each supervisor supervise? (include supervisors that do not supervise any at the moment)
