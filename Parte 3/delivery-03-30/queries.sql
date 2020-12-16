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
/*
    First, we will create the view of the supervisors and the number of substations that each one of them supervises,
    without including supervisors that do not supervise any substation.
    1. In SQL, a view is a virtual table based on the result-set of an SQL statement.
    2. When you drop a view, the definition of the view and other information about the view is deleted from the system
       catalog. All permissions for the view are also deleted.
    3. The CREATE VIEW command creates a view.
 */
DROP VIEW IF EXISTS supervisorsTheirSubst;
--/* View considera somente os que têm substação agregada */
CREATE VIEW supervisorsTheirSubst(name,address,n_substations) AS SELECT s.name,s.address, count(*) as n_subs FROM supervisor s
    LEFT OUTER JOIN substation AS sub ON (s.name = sub.sname and s.address = sub.saddress)
    WHERE sub.sname IS NOT NULL AND sub.saddress IS NOT NULL
    GROUP BY (s.name,s.address)
ORDER BY name,address;


-- Present the most succinct SQL query for each of the following questions. If appropriate, you can use the view created
-- previously.

-- 1. Who are the analysts that have analyzed every incident of element ‘B-789’?
SELECT name
FROM analyses
WHERE id = 'B-789';


-- 2. Who are the supervisors that do not supervise substations south of Rio Maior (Portugal) (Rio Maior
-- coordinates: 39.336775, -8.936379 (cf. Google Maps)?
SELECT sup.name,sup.address FROM supervisorstheirsubst as sup LEFT OUTER JOIN substation as s ON sup.address = s.saddress AND sup.name = s.sname
WHERE (sup.name,sup.address) NOT IN (SELECT sname,saddress FROM substation WHERE gpslat < 39.336775)
GROUP BY (sup.name,sup.address)
ORDER BY sup.name,sup.address;

-- 3. What are the elements with the smallest amount of incidents?
SELECT a.id,a.amount_incidents
FROM (SELECT id,count(*) as amount_incidents
FROM incident
GROUP BY id) as a
WHERE a.amount_incidents = (SELECT MIN(b.amount_incidents) FROM (SELECT id,count(*) as amount_incidents
FROM incident GROUP BY id) as b);

-- 4. How many substations does each supervisor supervise? (include supervisors that do not supervise any at the moment)
SELECT * FROM supervisorsTheirSubst
UNION
SELECT s.name,s.address, 0 as n_subs
FROM supervisor s LEFT OUTER JOIN substation as sub on s.name = sub.sname and s.address = sub.saddress
WHERE (sub.sname IS NULL AND sub.saddress IS NULL)
GROUP BY (s.name,s.address)
ORDER BY name;

