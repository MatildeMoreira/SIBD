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

 -- (IC1) For every transformer, pv must correspond to the voltage of the busbar identified by pbbid.





-- (IC2) For every transformer, sv must correspond to the voltage of the busbar identified by sbbid.





-- (IC5) For every analysis concerning a transformer, the name, address values cannot coincide with
-- sname, saddress values of the substation where the transformer is located (i.e., gpslat and gpslong
-- have the same values in transformer and substation).

