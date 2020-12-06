/**********************************************************************
 *                               VIEW.SQL
 * Description: File to create the view
 *
 * Subject: Information Systems and Databases
 * Laboratory Teacher: Ines Filipe
 * Senior Lecturer: Paulo Carreira
 *
 * Joao Pedro, 84096
 * Matilde, 84137
 * Duarte, 94192
 ***********************************************************************/

 --View of the supervisors and the number of substations that each one of them supervises,
 --without including supervisors that do not supervise any substation.
DROP VIEW IF EXISTS supervisorsTheirSubst;
/* View considera somente os que têm substação agregada */
CREATE VIEW supervisorsTheirSubst(name,address,n_substations) AS SELECT s.name,s.address, count(*) as n_subs FROM supervisor s
    LEFT OUTER JOIN substation AS sub ON (s.name = sub.sname and s.address = sub.saddress)
    WHERE sub.sname IS NOT NULL AND sub.saddress IS NOT NULL
    GROUP BY (s.name,s.address)
ORDER BY name,address;




/* Dúvida -- View considera os que não têm substação */
CREATE VIEW supervisorsTheirSubst(name,address,n_substations) AS SELECT s.name,s.address, 0 as n_subs
FROM supervisor s LEFT OUTER JOIN substation as sub on s.name = sub.sname and s.address = sub.saddress
WHERE (sub.sname IS NULL AND sub.saddress IS NULL)
GROUP BY (s.name,s.address)
UNION
SELECT s.name,s.address, count(*) as n_subs
FROM supervisor s LEFT OUTER JOIN substation as sub on s.name = sub.sname and s.address = sub.saddress
WHERE (sub.sname IS NOT NULL AND sub.saddress IS NOT NULL)
GROUP BY (s.name,s.address)
ORDER BY name;