/**********************************************************************
 *                               INDEX.SQL
 *
 * Subject: Information Systems and Databases
 * Laboratory Teacher: Ines Filipe
 * Senior Lecturer: Paulo Carreira
 *
 * Joao Pedro, 84096
 * Matilde, 84137
 * Duarte, 94192
 ***********************************************************************/

-- 6.1. Return the number of transformers with a given primary voltage by locality:

--SELECT locality, COUNT (*)
--FROM transformer
  --  NATURAL JOIN substation s
   -- WHERE pv = '371.1000'
   -- group by locality;

DROP INDEX IF EXISTS t_p_idx;
CREATE INDEX t_p_idx ON transformer USING BTREE(pv);

-- 6.2. List all descriptions of line incidents that start with a given prefix within two points in time:

--SELECT id, description
--FROM incident
--WHERE instant BETWEEN '2020-10-14 08:39:42.000' AND '2020-10-18 06:36:52.000'
--AND description LIKE 'Burns and Fall';

DROP INDEX IF EXISTS description_of_incidents;
CREATE INDEX description_of_incidents ON incident USING BTREE(instant, description);

