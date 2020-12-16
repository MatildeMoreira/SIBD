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

-- DROP TRIGGER removes an existing trigger definition.

 -- We also implemented the IC-1 and IC-2 with triggers but its in comments, since we found an easiest way without triggers
 -- DROP TRIGGER IF EXISTS check_pv_busbar_pbbid ON transformer CASCADE;
 -- DROP TRIGGER IF EXISTS check_sv_busbar_sbbid ON transformer CASCADE;

DROP TRIGGER IF EXISTS check_analystSubstation ON analyses CASCADE; -- (IC-5)

-- DROP FUNCTION removes the definition of an existing function.

 -- We also implemented the IC-1 and IC-2 with triggers but its in comments, since we found an easiest way without triggers
-- DROP FUNCTION IF EXISTS check_pv_busbar_pbbid_proc() CASCADE;
-- DROP FUNCTION IF EXISTS check_sv_busbar_sbbid_proc() CASCADE;
DROP FUNCTION IF EXISTS check_analystSubstation_proc() CASCADE; -- (IC-5)


-- (IC-1) AND (IC-2)
ALTER TABLE busbar ADD CONSTRAINT Unique_PairVoltageID UNIQUE (id,voltage);

 -- (IC1) For every transformer, pv must correspond to the voltage of the busbar identified by pbbid.
ALTER TABLE transformer DROP CONSTRAINT transformer_pbbid_fkey;
ALTER TABLE transformer ADD CONSTRAINT transformer_pbbid_fkey FOREIGN KEY (pbbid,pv) REFERENCES busbar (id,voltage);


-- Another Solution (IC-1) using Trigger
/*
CREATE OR REPLACE FUNCTION check_pv_busbar_pbbid_proc()
RETURNS TRIGGER AS
$BODY$
BEGIN
        IF (NEW.pv) NOT IN (SELECT b.voltage FROM busbar as b WHERE NEW.pbbid = b.id) THEN
        RAISE EXCEPTION 'The primary voltage of the transformer must correspond to the voltage of the busbar identified by pbbid.'
        USING HINT = 'Please check the primary voltage (pv) of the transformer and also check the primary busbar id (pbbid)';
        END IF;
        RETURN NEW;

END;
$BODY$ LANGUAGE plpgsql;


CREATE TRIGGER check_pv_busbar_pbbid
    BEFORE INSERT ON transformer
    FOR EACH ROW EXECUTE procedure check_pv_busbar_pbbid_proc();

*/



-- (IC2) For every transformer, sv must correspond to the voltage of the busbar identified by sbbid.
ALTER TABLE transformer DROP CONSTRAINT transformer_sbbid_fkey;
ALTER TABLE transformer ADD CONSTRAINT transformer_sbbid_fkey FOREIGN KEY (sbbid,sv) REFERENCES busbar (id,voltage);

-- Another Solution (IC-2) Using Trigger
/*
CREATE OR REPLACE FUNCTION check_sv_busbar_sbbid_proc()
RETURNS TRIGGER AS
$BODY$
BEGIN
        IF (NEW.sv) NOT IN (SELECT b.voltage FROM busbar as b WHERE NEW.sbbid = b.id) THEN
        RAISE EXCEPTION 'The secondary voltage of the transformer must correspond to the voltage of the busbar identified by sbbid.'
        USING HINT = 'Please check the secondary voltage (sv) of the transformer and also check the secondary busbar id (sbbid)';
        END IF;
        RETURN NEW;

END;
$BODY$ LANGUAGE plpgsql;


CREATE TRIGGER check_sv_busbar_sbbid
    BEFORE UPDATE OR INSERT ON transformer
    FOR EACH ROW EXECUTE procedure check_sv_busbar_sbbid_proc();
*/

-- (IC5) For every analysis concerning a transformer, the name, address values cannot coincide with sname, saddress
-- values of the substation where the transformer is located (i.e., gpslat and gpslong have the same values in
-- transformer and substation).

CREATE OR REPLACE FUNCTION check_analystSubstation_proc()
RETURNS TRIGGER AS
$BODY$
BEGIN
        IF (NEW.id,New.name,NEW.address) IN (SELECT id,sname,saddress FROM transformer LEFT OUTER JOIN substation s on s.gpslat = transformer.gpslat and s.gpslong = transformer.gpslong) THEN
            RAISE EXCEPTION 'The analyst cannot anlyse incidents regarding Elements of a Substation they supervises.'
            USING HINT = 'Please check the name and address of the analyst)';
        END IF;

        RETURN NEW;

END;
$BODY$ LANGUAGE plpgsql;

CREATE TRIGGER check_analystSubstation
    BEFORE UPDATE OR INSERT ON analyses
    FOR EACH ROW EXECUTE procedure check_analystSubstation_proc();

