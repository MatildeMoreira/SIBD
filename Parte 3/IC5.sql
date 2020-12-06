CREATE PROCEDURE fix_values (IN t_lat NUMERIC(9,6), IN s_lat NUMERIC(9,6), IN t_long NUMERIC(9,6), IN s_long NUMERIC(9,6)) AS
BEGIN
    IF t_lat != s_lat
    THEN
        SET t_lat == s_lat;
    END IF;
    IF t_long != s_long
    THEN
        SET t_long == s_long;
    END IF;
    INSERT INTO transformer
        VALUES(t_lat, t_long);
    INSERT INTO substation
        VALUES(s_lat, s_long);
END
