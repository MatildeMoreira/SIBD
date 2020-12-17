/**********************************************************************
 *                               OLAP.SQL
 *
 * Description: File with OLAP queries
 *
 * Subject: Information Systems and Databases
 * Laboratory Teacher: Ines Filipe
 * Senior Lecturer: Paulo Carreira
 *
 * Joao Pedro, 84096
 * Matilde, 84137
 * Duarte, 94192
 ***********************************************************************/


/* Total number of anomalies reported by severity, locality and day of the week*/
SELECT severity, NULL AS week_day, NULL AS locality, COUNT(severity) AS contagem
FROM f_incident
GROUP BY severity

UNION ALL

SELECT NULL, dt.week_day, NULL, COUNT(dt.week_day) AS contagem
FROM f_incident f, d_time dt
WHERE dt.id_time=f.id_time
GROUP BY dt.week_day

UNION ALL

SELECT NULL, NULL, dl.locality, COUNT(dl.locality)
FROM f_incident f, d_location dl
WHERE dl.id_location=f.id_location
GROUP BY dl.locality;

