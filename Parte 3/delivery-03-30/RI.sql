/**********************************************************************
 *                               RI.SQL
 * Description: File to create the integrity constraints (triggers and stored procedures)
 *
 * Subject: Information Systems and Databases
 * Laboratory Teacher: Ines Filipe
 * Senior Lecturer: Paulo Carreira
 *
 * Joao Pedro, 84096
 * Matilde, 84137
 * Duarte, 94192
 ***********************************************************************/
DROP TRIGGER IF EXISTS check_pv_busbar_pbbid ON transformer CASCADE;
DROP TRIGGER IF EXISTS check_sv_busbar_sbbid ON transformer CASCADE;

 -- (IC1) For every transformer, pv must correspond to the voltage of the busbar identified by pbbid.
CREATE OR REPLACE FUNCTION check_pv_busbar_pbbid_proc()
RETURNS TRIGGER AS
$BODY$
BEGIN
        IF (NEW.pv) NOT IN (SELECT b.voltage FROM busbar as b WHERE NEW.pbbid = b.id) THEN
        RAISE EXCEPTION 'The primary voltage of the transformer must correspond to the voltage of the busbar identified by pbbid.';
        END IF;
        RETURN NEW;

END;
$BODY$ LANGUAGE plpgsql;

CREATE TRIGGER check_pv_busbar_pbbid
    BEFORE INSERT ON transformer
    FOR EACH ROW EXECUTE procedure check_pv_busbar_pbbid_proc();



-- (IC2) For every transformer, sv must correspond to the voltage of the busbar identified by sbbid.
CREATE OR REPLACE FUNCTION check_sv_busbar_sbbid_proc()
RETURNS TRIGGER AS
$BODY$
BEGIN
        IF (NEW.sv) NOT IN (SELECT b.voltage FROM busbar as b WHERE NEW.sbbid = b.id) THEN
        RAISE EXCEPTION 'The secondary voltage of the transformer must correspond to the voltage of the busbar identified by sbbid.';
        END IF;
        RETURN NEW;

END;
$BODY$ LANGUAGE plpgsql;


CREATE TRIGGER check_sv_busbar_sbbid
    BEFORE UPDATE OR INSERT ON transformer
    FOR EACH ROW EXECUTE procedure check_sv_busbar_sbbid_proc();


-- (IC5) For every analysis concerning a transformer, the name, address values cannot coincide with
-- sname, saddress values of the substation where the transformer is located (i.e., gpslat and gpslong
-- have the same values in transformer and substation).



CREATE PROCEDURE fix_values (IN t_lat NUMERIC(9,6), IN s_lat NUMERIC(9,6), IN t_long NUMERIC(9,6), IN s_long NUMERIC(9,6)) AS
$$
BEGIN
    IF t_lat == s_lat
    THEN
        IF
    END IF;

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
$$	LANGUAGE	plpgsql;