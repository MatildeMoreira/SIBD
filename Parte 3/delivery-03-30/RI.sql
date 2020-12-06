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
