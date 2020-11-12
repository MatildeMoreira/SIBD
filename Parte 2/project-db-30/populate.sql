/**********************************************************************
 *                               POPULATE.SQL
 *
 * Subject: Information Systems and Databases
 * Laboratory Teacher: Ines Filipe
 * Senior Lecturer: Paulo Carreira
 *
 * Joao Pedro, 84096
 * Matilde, 84137
 * Duarte, 94192
 ***********************************************************************/
-- The INSERT INTO statement is used to insert new records in a specific table.

-- Table: Person
INSERT INTO Person (name,address,Phone,Tax_ID) VALUES ('Jane Sweettooth','Avenida Madre Andaluz 115,2070-374,Santarem','919430567',167747525);
INSERT INTO Person (name,address,Phone,Tax_ID) VALUES ('John Oliver','Rua Ciprestes 24,2790-139,Lisboa','969342409',305855662);
INSERT INTO Person (name,address,Phone,Tax_ID) VALUES ('Leonardo DiCaprio','Rua Goa 15,2420-118,Leiria','924560391',356371980);
INSERT INTO Person (name,address,Phone,Tax_ID) VALUES ('Lorena Wolf','Rua Nossa Senhora Graça 106,4620-430,Porto','963183502',311761763);
INSERT INTO Person (name,address,Phone,Tax_ID) VALUES ('Kelly Clarkson','Rua Forno 5,5130-125,Viseu','910284732',228008522);
INSERT INTO Person (name,address,Phone,Tax_ID) VALUES ('Jacob Pierre','Avenida Lago 99,2774-527,Lisboa','918305962',264174186);
INSERT INTO Person (name,address,Phone,Tax_ID) VALUES ('Joao Cardoso','Estrada Nacional 65,3830-209,Aveiro','938405813',191297615);
INSERT INTO Person (name,address,Phone,Tax_ID) VALUES ('Matilde Moreira','Rua Irene Lisboa 66,2675-373,Lisboa','968079281',112904777);
INSERT INTO Person (name,address,Phone,Tax_ID) VALUES ('Duarte Oliveira','Rua Palmeira 4,2485-068,Leiria','964029199',286892634);
INSERT INTO Person (name,address,Phone,Tax_ID) VALUES ('Oscar Wilde','Rua Doutor Teofilo Braga 52,7250-280,Evora','921884506',189735813);
INSERT INTO Person (name,address,Phone,Tax_ID) VALUES ('Rui Constantino','Rua Industria 94,3230-279,Coimbra','912805592',200891170);
INSERT INTO Person (name,address,Phone,Tax_ID) VALUES ('Angelina Jolie','Rua Sao Goncalo 45,7540-501,Setubal','934220598',303561718);
INSERT INTO Person (name,address,Phone,Tax_ID) VALUES ('Lionel Richie','Rua Condes Torre 116,7320-416,Portalegre','928104295',391196570);
INSERT INTO Person (name,address,Phone,Tax_ID) VALUES ('Elton John','Rua Engenheiro Duarte Pacheco 13,6000-691,Castelo Branco','938274021',123359694);
INSERT INTO Person (name,address,Phone,Tax_ID) VALUES ('Leonardo DiCaprio','Avenida Almirante Reis 109,2600-006,Lisboa','960398137',375347917);
INSERT INTO Person (name,address,Phone,Tax_ID) VALUES ('Jane Sweettooth','Rua Combatentes G Guerra 117,3080-502,Coimbra','913948753',204634946);
INSERT INTO Person (name,address,Phone,Tax_ID) VALUES ('Angelina Jolie','Rua Pescador Bacalhoeiro 18,4510-067,Porto','938271730',166360090);
INSERT INTO Person (name,address,Phone,Tax_ID) VALUES ('Pedro Antunes','Praceta Conde Arnoso 96,2635-389,Lisboa','929495824',246916761);


-- Table: Analyst
INSERT INTO Analyst (name,address) VALUES ('Jane Sweettooth','Avenida Madre Andaluz 115,2070-374,Santarem');
INSERT INTO Analyst (name,address) VALUES ('John Oliver','Rua Ciprestes 24,2790-139,Lisboa');
INSERT INTO Analyst (name,address) VALUES ('Lorena Wolf','Rua Nossa Senhora Graça 106,4620-430,Porto');
INSERT INTO Analyst (name,address) VALUES ('Jacob Pierre','Avenida Lago 99,2774-527,Lisboa');
INSERT INTO Analyst (name,address) VALUES ('Joao Cardoso','Estrada Nacional 65,3830-209,Aveiro');
INSERT INTO Analyst (name,address) VALUES ('Matilde Moreira','Rua Irene Lisboa 66,2675-373,Lisboa');
INSERT INTO Analyst (name,address) VALUES ('Angelina Jolie','Rua Sao Goncalo 45,7540-501,Setubal');
INSERT INTO Analyst (name,address) VALUES ('Oscar Wilde','Rua Doutor Teofilo Braga 52,7250-280,Evora');
INSERT INTO Analyst (name,address) VALUES ('Leonardo DiCaprio','Avenida Almirante Reis 109,2600-006,Lisboa');
INSERT INTO Analyst (name,address) VALUES ('Jane Sweettooth','Rua Combatentes G Guerra 117,3080-502,Coimbra');
INSERT INTO Analyst (name,address) VALUES ('Pedro Antunes','Praceta Conde Arnoso 96,2635-389,Lisboa');
INSERT INTO Analyst (name,address) VALUES ('Rui Constantino','Rua Industria 94,3230-279,Coimbra');


-- Table: Supervisor
INSERT INTO Supervisor (name,address) VALUES ('Jane Sweettooth','Avenida Madre Andaluz 115,2070-374,Santarem');
INSERT INTO Supervisor (name,address) VALUES ('Leonardo DiCaprio','Rua Goa 15,2420-118,Leiria');
INSERT INTO Supervisor (name,address) VALUES ('Joao Cardoso','Estrada Nacional 65,3830-209,Aveiro');
INSERT INTO Supervisor (name,address) VALUES ('Matilde Moreira','Rua Irene Lisboa 66,2675-373,Lisboa');
INSERT INTO Supervisor (name,address) VALUES ('Duarte Oliveira','Rua Palmeira 4,2485-068,Leiria');
INSERT INTO Supervisor (name,address) VALUES ('Oscar Wilde','Rua Doutor Teofilo Braga 52,7250-280,Evora');
INSERT INTO Supervisor (name,address) VALUES ('Lionel Richie','Rua Condes Torre 116,7320-416,Portalegre');
INSERT INTO Supervisor (name,address) VALUES ('Elton John','Rua Engenheiro Duarte Pacheco 13,6000-691,Castelo Branco');
INSERT INTO Supervisor (name,address) VALUES ('Angelina Jolie','Rua Pescador Bacalhoeiro 18,4510-067,Porto');


-- Table: Substation
INSERT INTO Substation (latitude,longitude,locality_name,name,address) VALUES (39.23333, -8.68333,'Santarem','Jane Sweettooth','Avenida Madre Andaluz 115,2070-374,Santarem');
INSERT INTO Substation (latitude,longitude,locality_name,name,address) VALUES (39.74362, -8.80705,'Leiria','Leonardo DiCaprio','Rua Goa 15,2420-118,Leiria');
INSERT INTO Substation (latitude,longitude,locality_name,name,address) VALUES (40.64427, -8.64554,'Aveiro','Joao Cardoso','Estrada Nacional 65,3830-209,Aveiro');
INSERT INTO Substation (latitude,longitude,locality_name,name,address) VALUES (38.71667, -9.13333,'Lisboa','Matilde Moreira','Rua Irene Lisboa 66,2675-373,Lisboa');
INSERT INTO Substation (latitude,longitude,locality_name,name,address) VALUES (39.74360, -8.80700,'Leiria','Duarte Oliveira','Rua Palmeira 4,2485-068,Leiria');
INSERT INTO Substation (latitude,longitude,locality_name,name,address) VALUES (38.56667, -7.9,'Evora','Oscar Wilde','Rua Doutor Teofilo Braga 52,7250-280,Evora');
INSERT INTO Substation (latitude,longitude,locality_name,name,address) VALUES (39.29379, -7.43122,'Portalegre','Lionel Richie','Rua Condes Torre 116,7320-416,Portalegre');
INSERT INTO Substation (latitude,longitude,locality_name,name,address) VALUES (39.82219, -7.49087,'Castelo Branco','Elton John','Rua Engenheiro Duarte Pacheco 13,6000-691,Castelo Branco');
INSERT INTO Substation (latitude,longitude,locality_name,name,address) VALUES (41.14961, -8.61099,'Porto','Angelina Jolie','Rua Pescador Bacalhoeiro 18,4510-067,Porto');
INSERT INTO Substation (latitude,longitude,locality_name,name,address) VALUES (41.55032, -8.42005,'Braga','Elton John','Rua Engenheiro Duarte Pacheco 13,6000-691,Castelo Branco');
INSERT INTO Substation (latitude,longitude,locality_name,name,address) VALUES (38.5244, -8.8882,'Setubal','Duarte Oliveira','Rua Palmeira 4,2485-068,Leiria');
INSERT INTO Substation (latitude,longitude,locality_name,name,address) VALUES (40.20564, -8.41955,'Coimbra','Joao Cardoso','Estrada Nacional 65,3830-209,Aveiro');
INSERT INTO Substation (latitude,longitude,locality_name,name,address) VALUES (38.75657, -9.25451,'Queluz','Oscar Wilde','Rua Doutor Teofilo Braga 52,7250-280,Evora');
INSERT INTO Substation (latitude,longitude,locality_name,name,address) VALUES (38.75382, -9.23083,'Amadora','Duarte Oliveira','Rua Palmeira 4,2485-068,Leiria');
INSERT INTO Substation (latitude,longitude,locality_name,name,address) VALUES (37.01869, -7.92716,'Faro','Matilde Moreira','Rua Irene Lisboa 66,2675-373,Lisboa');
INSERT INTO Substation (latitude,longitude,locality_name,name,address) VALUES (40.53733, -7.26575,'Guarda','Joao Cardoso','Estrada Nacional 65,3830-209,Aveiro');
INSERT INTO Substation (latitude,longitude,locality_name,name,address) VALUES (38.01506, -7.86323,'Beja','Matilde Moreira','Rua Irene Lisboa 66,2675-373,Lisboa');
INSERT INTO Substation (latitude,longitude,locality_name,name,address) VALUES (40.66101, -7.90971,'Viseu','Elton John','Rua Engenheiro Duarte Pacheco 13,6000-691,Castelo Branco');
INSERT INTO Substation (latitude,longitude,locality_name,name,address) VALUES (37.10202, -8.67422,'Lagos','Matilde Moreira','Rua Irene Lisboa 66,2675-373,Lisboa');
INSERT INTO Substation (latitude,longitude,locality_name,name,address) VALUES (38.71660, -9.13333,'Lisboa','Leonardo DiCaprio','Rua Goa 15,2420-118,Leiria');
INSERT INTO Substation (latitude,longitude,locality_name,name,address) VALUES (38.71666, -9.13330,'Lisboa','Matilde Moreira','Rua Irene Lisboa 66,2675-373,Lisboa');
INSERT INTO Substation (latitude,longitude,locality_name,name,address) VALUES (40.64425, -8.64550,'Aveiro','Joao Cardoso','Estrada Nacional 65,3830-209,Aveiro');
INSERT INTO Substation (latitude,longitude,locality_name,name,address) VALUES (39.82209, -7.49091,'Castelo Branco','Elton John','Rua Engenheiro Duarte Pacheco 13,6000-691,Castelo Branco');
INSERT INTO Substation (latitude,longitude,locality_name,name,address) VALUES (41.14964, -8.61093,'Porto','Lionel Richie','Rua Condes Torre 116,7320-416,Portalegre');
INSERT INTO Substation (latitude,longitude,locality_name,name,address) VALUES (39.82224, -7.49082,'Castelo Branco','Joao Cardoso','Estrada Nacional 65,3830-209,Aveiro');
INSERT INTO Substation (latitude,longitude,locality_name,name,address) VALUES (38.71663, -9.13342,'Lisboa','Jane Sweettooth','Avenida Madre Andaluz 115,2070-374,Santarem');

-- Table: Element
INSERT INTO Element (id) VALUES ('B-163');
INSERT INTO Element (id) VALUES ('B-190');
INSERT INTO Element (id) VALUES ('B-224');
INSERT INTO Element (id) VALUES ('B-233');
INSERT INTO Element (id) VALUES ('B-261');
INSERT INTO Element (id) VALUES ('B-275');
INSERT INTO Element (id) VALUES ('B-334');
INSERT INTO Element (id) VALUES ('B-336');
INSERT INTO Element (id) VALUES ('B-477');
INSERT INTO Element (id) VALUES ('B-544');
INSERT INTO Element (id) VALUES ('B-553');
INSERT INTO Element (id) VALUES ('B-641');
INSERT INTO Element (id) VALUES ('B-647');
INSERT INTO Element (id) VALUES ('B-664');
INSERT INTO Element (id) VALUES ('B-766');
INSERT INTO Element (id) VALUES ('B-789');
INSERT INTO Element (id) VALUES ('B-807');
INSERT INTO Element (id) VALUES ('B-864');
INSERT INTO Element (id) VALUES ('B-900');
INSERT INTO Element (id) VALUES ('B-901');
INSERT INTO Element (id) VALUES ('B-940');
INSERT INTO Element (id) VALUES ('L-144');
INSERT INTO Element (id) VALUES ('L-167');
INSERT INTO Element (id) VALUES ('L-173');
INSERT INTO Element (id) VALUES ('L-297');
INSERT INTO Element (id) VALUES ('L-298');
INSERT INTO Element (id) VALUES ('L-338');
INSERT INTO Element (id) VALUES ('L-398');
INSERT INTO Element (id) VALUES ('L-491');
INSERT INTO Element (id) VALUES ('L-497');
INSERT INTO Element (id) VALUES ('L-499');
INSERT INTO Element (id) VALUES ('L-519');
INSERT INTO Element (id) VALUES ('L-571');
INSERT INTO Element (id) VALUES ('L-611');
INSERT INTO Element (id) VALUES ('L-635');
INSERT INTO Element (id) VALUES ('L-684');
INSERT INTO Element (id) VALUES ('L-823');
INSERT INTO Element (id) VALUES ('L-851');
INSERT INTO Element (id) VALUES ('L-863');
INSERT INTO Element (id) VALUES ('L-890');
INSERT INTO Element (id) VALUES ('L-910');
INSERT INTO Element (id) VALUES ('L-956');
INSERT INTO Element (id) VALUES ('T-149');
INSERT INTO Element (id) VALUES ('T-162');
INSERT INTO Element (id) VALUES ('T-214');
INSERT INTO Element (id) VALUES ('T-303');
INSERT INTO Element (id) VALUES ('T-366');
INSERT INTO Element (id) VALUES ('T-371');
INSERT INTO Element (id) VALUES ('T-388');
INSERT INTO Element (id) VALUES ('T-424');
INSERT INTO Element (id) VALUES ('T-429');
INSERT INTO Element (id) VALUES ('T-463');
INSERT INTO Element (id) VALUES ('T-562');
INSERT INTO Element (id) VALUES ('T-650');
INSERT INTO Element (id) VALUES ('T-706');
INSERT INTO Element (id) VALUES ('T-739');
INSERT INTO Element (id) VALUES ('T-766');
INSERT INTO Element (id) VALUES ('T-783');
INSERT INTO Element (id) VALUES ('T-866');
INSERT INTO Element (id) VALUES ('T-959');

-- Table: Line
INSERT INTO Line (id,impedance) VALUES ('L-144',200.11);
INSERT INTO Line (id,impedance) VALUES ('L-167',849.75);
INSERT INTO Line (id,impedance) VALUES ('L-173',972.12);
INSERT INTO Line (id,impedance) VALUES ('L-297',524.7);
INSERT INTO Line (id,impedance) VALUES ('L-298',849.75);
INSERT INTO Line (id,impedance) VALUES ('L-338',158.58);
INSERT INTO Line (id,impedance) VALUES ('L-398',250.25);
INSERT INTO Line (id,impedance) VALUES ('L-491',692.41);
INSERT INTO Line (id,impedance) VALUES ('L-497',460.26);
INSERT INTO Line (id,impedance) VALUES ('L-499',620.83);
INSERT INTO Line (id,impedance) VALUES ('L-519',178.08);
INSERT INTO Line (id,impedance) VALUES ('L-571',374.21);
INSERT INTO Line (id,impedance) VALUES ('L-611',427.1);
INSERT INTO Line (id,impedance) VALUES ('L-635',308.61);
INSERT INTO Line (id,impedance) VALUES ('L-684',789.09);
INSERT INTO Line (id,impedance) VALUES ('L-823',178.08);
INSERT INTO Line (id,impedance) VALUES ('L-851',849.75);
INSERT INTO Line (id,impedance) VALUES ('L-863',535.2);
INSERT INTO Line (id,impedance) VALUES ('L-890',917.83);
INSERT INTO Line (id,impedance) VALUES ('L-910',250.25);
INSERT INTO Line (id,impedance) VALUES ('L-956',738.28);

-- Table: Bus_Bar
INSERT INTO Bus_Bar (id,voltage) VALUES ('B-163',3855.25);
INSERT INTO Bus_Bar (id,voltage) VALUES ('B-190',912.12);
INSERT INTO Bus_Bar (id,voltage) VALUES ('B-224',4668.74);
INSERT INTO Bus_Bar (id,voltage) VALUES ('B-233',3681.8);
INSERT INTO Bus_Bar (id,voltage) VALUES ('B-261',2768.24);
INSERT INTO Bus_Bar (id,voltage) VALUES ('B-275',1879.28);
INSERT INTO Bus_Bar (id,voltage) VALUES ('B-334',2105.4);
INSERT INTO Bus_Bar (id,voltage) VALUES ('B-336',2441.17);
INSERT INTO Bus_Bar (id,voltage) VALUES ('B-477',3251.74);
INSERT INTO Bus_Bar (id,voltage) VALUES ('B-544',4241.05);
INSERT INTO Bus_Bar (id,voltage) VALUES ('B-553',3276.17);
INSERT INTO Bus_Bar (id,voltage) VALUES ('B-641',3127.98);
INSERT INTO Bus_Bar (id,voltage) VALUES ('B-647',4961.22);
INSERT INTO Bus_Bar (id,voltage) VALUES ('B-664',3379.59);
INSERT INTO Bus_Bar (id,voltage) VALUES ('B-766',4652.88);
INSERT INTO Bus_Bar (id,voltage) VALUES ('B-789',4071.67);
INSERT INTO Bus_Bar (id,voltage) VALUES ('B-807',3802.74);
INSERT INTO Bus_Bar (id,voltage) VALUES ('B-864',4705.12);
INSERT INTO Bus_Bar (id,voltage) VALUES ('B-900',3814.89);
INSERT INTO Bus_Bar (id,voltage) VALUES ('B-901',2858.9);
INSERT INTO Bus_Bar (id,voltage) VALUES ('B-940',472.86);




-- Table: Transformer
INSERT INTO Transformer (id,primary_voltage,secondary_voltage,id_primary,id_secondary,latitude,longitude) VALUES ('T-149',4071.67,4241.05,'B-789','B-544',37.01869,-7.92716);
INSERT INTO Transformer (id,primary_voltage,secondary_voltage,id_primary,id_secondary,latitude,longitude) VALUES ('T-162',3855.25,912.12,'B-163','B-190',40.64425,-8.64550);
INSERT INTO Transformer (id,primary_voltage,secondary_voltage,id_primary,id_secondary,latitude,longitude) VALUES ('T-214',3802.74,3251.74,'B-807','B-477',41.55032,-8.42005);
INSERT INTO Transformer (id,primary_voltage,secondary_voltage,id_primary,id_secondary,latitude,longitude) VALUES ('T-303',472.86,4071.67,'B-940','B-789',38.71660,-9.13333);
INSERT INTO Transformer (id,primary_voltage,secondary_voltage,id_primary,id_secondary,latitude,longitude) VALUES ('T-366',3276.17,2441.17,'B-553','B-336',38.75382,-9.23083);
INSERT INTO Transformer (id,primary_voltage,secondary_voltage,id_primary,id_secondary,latitude,longitude) VALUES ('T-371',3379.59,4961.22,'B-664','B-647',37.01869,-7.92716);
INSERT INTO Transformer (id,primary_voltage,secondary_voltage,id_primary,id_secondary,latitude,longitude) VALUES ('T-388',3855.25,472.86,'B-163','B-940',41.14961,-8.61099);
INSERT INTO Transformer (id,primary_voltage,secondary_voltage,id_primary,id_secondary,latitude,longitude) VALUES ('T-424',2441.17,4071.67,'B-336','B-789',41.14961,-8.61099);
INSERT INTO Transformer (id,primary_voltage,secondary_voltage,id_primary,id_secondary,latitude,longitude) VALUES ('T-429',4668.74,2768.24,'B-224','B-261',40.64425,-8.64550);
INSERT INTO Transformer (id,primary_voltage,secondary_voltage,id_primary,id_secondary,latitude,longitude) VALUES ('T-463',4668.74,3814.89,'B-224','B-900',41.14964,-8.61093);
INSERT INTO Transformer (id,primary_voltage,secondary_voltage,id_primary,id_secondary,latitude,longitude) VALUES ('T-562',4071.67,1879.28,'B-789','B-275',38.71663,-9.13342);
INSERT INTO Transformer (id,primary_voltage,secondary_voltage,id_primary,id_secondary,latitude,longitude) VALUES ('T-650',3127.98,3379.59,'B-641','B-664',41.55032,-8.42005);
INSERT INTO Transformer (id,primary_voltage,secondary_voltage,id_primary,id_secondary,latitude,longitude) VALUES ('T-706',912.12,2105.4,'B-190','B-334',39.82209,-7.49091);
INSERT INTO Transformer (id,primary_voltage,secondary_voltage,id_primary,id_secondary,latitude,longitude) VALUES ('T-739',4071.67,4705.12,'B-789','B-864',38.75382,-9.23083);
INSERT INTO Transformer (id,primary_voltage,secondary_voltage,id_primary,id_secondary,latitude,longitude) VALUES ('T-766',1879.28,3855.25,'B-275','B-163',38.71663,-9.13342);
INSERT INTO Transformer (id,primary_voltage,secondary_voltage,id_primary,id_secondary,latitude,longitude) VALUES ('T-783',3127.98,4652.88,'B-641','B-766',41.55032,-8.42005);
INSERT INTO Transformer (id,primary_voltage,secondary_voltage,id_primary,id_secondary,latitude,longitude) VALUES ('T-866',4241.05,3251.74,'B-544','B-477',40.64425, -8.64550);
INSERT INTO Transformer (id,primary_voltage,secondary_voltage,id_primary,id_secondary,latitude,longitude) VALUES ('T-959',3814.89,1879.28,'B-900','B-275',41.14964,-8.61093);

-- Table: line_connection
INSERT INTO line_connection (id_line,id_primary,id_secondary) VALUES ('L-144','B-789','B-544');
INSERT INTO line_connection (id_line,id_primary,id_secondary) VALUES ('L-173','B-163','B-190');
INSERT INTO line_connection (id_line,id_primary,id_secondary) VALUES ('L-956','B-807','B-477');
INSERT INTO line_connection (id_line,id_primary,id_secondary) VALUES ('L-398','B-940','B-789');
INSERT INTO line_connection (id_line,id_primary,id_secondary) VALUES ('L-167','B-553','B-336');
INSERT INTO line_connection (id_line,id_primary,id_secondary) VALUES ('L-519','B-664','B-647');
INSERT INTO line_connection (id_line,id_primary,id_secondary) VALUES ('L-890','B-163','B-940');
INSERT INTO line_connection (id_line,id_primary,id_secondary) VALUES ('L-398','B-336','B-789');
INSERT INTO line_connection (id_line,id_primary,id_secondary) VALUES ('L-823','B-224','B-261');
INSERT INTO line_connection (id_line,id_primary,id_secondary) VALUES ('L-298','B-224','B-900');
INSERT INTO line_connection (id_line,id_primary,id_secondary) VALUES ('L-519','B-789','B-275');
INSERT INTO line_connection (id_line,id_primary,id_secondary) VALUES ('L-571','B-641','B-664');
INSERT INTO line_connection (id_line,id_primary,id_secondary) VALUES ('L-956','B-190','B-334');
INSERT INTO line_connection (id_line,id_primary,id_secondary) VALUES ('L-851','B-789','B-864');
INSERT INTO line_connection (id_line,id_primary,id_secondary) VALUES ('L-298','B-275','B-163');
INSERT INTO line_connection (id_line,id_primary,id_secondary) VALUES ('L-611','B-641','B-766');
INSERT INTO line_connection (id_line,id_primary,id_secondary) VALUES ('L-823','B-544','B-477');
INSERT INTO line_connection (id_line,id_primary,id_secondary) VALUES ('L-398','B-900','B-275');


-- Table: Incident
INSERT INTO Incident (id,instant,description,severity) VALUES ('B-163','2020-10-04 22:02:17.000','Stactic Electricity',2);
INSERT INTO Incident (id,instant,description,severity) VALUES ('B-163','2020-11-02 10:07:51.000','Loose wire connections',9);
INSERT INTO Incident (id,instant,description,severity) VALUES ('B-163','2020-11-12 10:14:11.000','Improperly maintained',5);
INSERT INTO Incident (id,instant,description,severity) VALUES ('B-224','2020-10-04 22:02:17.000','Carelessness',1);
INSERT INTO Incident (id,instant,description,severity) VALUES ('B-544','2020-11-05 10:14:11.000','Damaged Tools and equipment',5);
INSERT INTO Incident (id,instant,description,severity) VALUES ('B-647','2020-10-06 21:56:55.000','Expodsed live parts',1);
INSERT INTO Incident (id,instant,description,severity) VALUES ('B-789','2020-10-23 19:24:51.000','Obstructed discnect panels',7);
INSERT INTO Incident (id,instant,description,severity) VALUES ('B-789','2020-10-24 20:36:55.000','Obstructed discnect panels',9);
INSERT INTO Incident (id,instant,description,severity) VALUES ('B-864','2020-10-10 07:44:24.000','Improperly maintained',7);
INSERT INTO Incident (id,instant,description,severity) VALUES ('B-789','2020-11-02 17:46:28.000','High voltage cables',8);
INSERT INTO Incident (id,instant,description,severity) VALUES ('B-901','2020-11-04 22:08:05.000','High voltage cables',8);
INSERT INTO Incident (id,instant,description,severity) VALUES ('B-940','2020-10-07 16:25:02.000','Water or liquid near electrical equipment',5);
INSERT INTO Incident (id,instant,description,severity) VALUES ('B-940','2020-11-05 10:14:11.000','Stactic Electricity',6);
INSERT INTO Incident (id,instant,description,severity) VALUES ('B-940','2020-10-04 22:02:17.000','Water or liquid near electrical equipment',10);
INSERT INTO Incident (id,instant,description,severity) VALUES ('L-144','2020-10-06 21:56:55.000','Old and Poor wiring',5);
INSERT INTO Incident (id,instant,description,severity) VALUES ('L-144','2020-10-23 19:24:51.000','Electric cords running under carpeting.',4);
INSERT INTO Incident (id,instant,description,severity) VALUES ('L-144','2020-11-05 10:14:11.000','Flammable materials left near exposed electrical wiring in the workplace. Poor wiring',10);
INSERT INTO Incident (id,instant,description,severity) VALUES ('B-789','2020-11-12 10:14:11.000','Stactic Electricity',8);
INSERT INTO Incident (id,instant,description,severity) VALUES ('L-167','2020-10-10 07:44:24.000','Old and Poor wiring',7);
INSERT INTO Incident (id,instant,description,severity) VALUES ('L-173','2020-11-01 17:03:03.000','Poor wiring. Electrical Fire',9);
INSERT INTO Incident (id,instant,description,severity) VALUES ('L-173','2020-10-01 09:09:31.000','Poor wiring. Electrical Fire',8);
INSERT INTO Incident (id,instant,description,severity) VALUES ('L-173','2020-10-13 05:30:59.000','Electric cords running under carpeting.',2);
INSERT INTO Incident (id,instant,description,severity) VALUES ('L-499','2020-10-02 17:34:48.000','Electric Shock',10);
INSERT INTO Incident (id,instant,description,severity) VALUES ('L-571','2020-10-02 06:58:58.000','Electrical Fire',9);
INSERT INTO Incident (id,instant,description,severity) VALUES ('L-571','2020-10-31 13:07:44.000','Flammable materials left near exposed electrical wiring in the workplace. Poor wiring',8);
INSERT INTO Incident (id,instant,description,severity) VALUES ('L-571','2020-11-08 05:44:45.000','Flammable materials left near exposed electrical wiring in the workplace. Poor wiring',4);
INSERT INTO Incident (id,instant,description,severity) VALUES ('L-863','2020-10-06 21:56:55.000','Old and Poor wiring',5);
INSERT INTO Incident (id,instant,description,severity) VALUES ('L-910','2020-10-19 06:07:56.000','Old and Poor wiring',5);
INSERT INTO Incident (id,instant,description,severity) VALUES ('L-910','2020-10-01 09:09:31.000','Electric cords running under carpeting.',7);
INSERT INTO Incident (id,instant,description,severity) VALUES ('L-910','2020-10-13 05:30:59.000','Old and Poor wiring',9);
INSERT INTO Incident (id,instant,description,severity) VALUES ('L-910','2020-10-04 21:05:27.000','Flammable materials left near exposed electrical wiring in the workplace',10);
INSERT INTO Incident (id,instant,description,severity) VALUES ('T-214','2020-11-08 05:44:45.000','Burns and Fall',10);
INSERT INTO Incident (id,instant,description,severity) VALUES ('T-214','2020-10-31 13:07:44.000','Direct contact with exposed energized conductors',3);
INSERT INTO Incident (id,instant,description,severity) VALUES ('T-303','2020-10-06 22:45:21.000','Direct contact with exposed energized conductors',5);
INSERT INTO Incident (id,instant,description,severity) VALUES ('T-303','2020-10-28 16:20:36.000','Burns',9);
INSERT INTO Incident (id,instant,description,severity) VALUES ('T-303','2020-11-03 07:57:45.000','Electrocution',8);
INSERT INTO Incident (id,instant,description,severity) VALUES ('T-303','2020-10-12 22:17:06.000','Electrocution',9);
INSERT INTO Incident (id,instant,description,severity) VALUES ('T-371','2020-11-07 06:32:01.000','Direct contact with exposed energized conductors',5);
INSERT INTO Incident (id,instant,description,severity) VALUES ('T-463','2020-10-11 17:43:25.000','Direct contact with exposed energized conductors',3);
INSERT INTO Incident (id,instant,description,severity) VALUES ('T-463','2020-10-01 17:22:55.000','Burns and Fall',8);
INSERT INTO Incident (id,instant,description,severity) VALUES ('T-463','2020-10-23 06:33:06.000','Burns and Fall',7);
INSERT INTO Incident (id,instant,description,severity) VALUES ('T-706','2020-10-12 12:06:57.000','Electrocution',9);
INSERT INTO Incident (id,instant,description,severity) VALUES ('T-766','2020-11-12 12:48:00.000','Direct contact with exposed energized conductors',7);
INSERT INTO Incident (id,instant,description,severity) VALUES ('T-766','2020-10-14 08:39:42.000','Burns',5);
INSERT INTO Incident (id,instant,description,severity) VALUES ('T-766','2020-10-18 06:36:52.000','Electric Shock',10);
INSERT INTO Incident (id,instant,description,severity) VALUES ('T-766','2020-10-03 15:31:31.000','Fall and Burn',8);
INSERT INTO Incident (id,instant,description,severity) VALUES ('T-783','2020-10-13 05:30:59.000','Electric Shock',6);
INSERT INTO Incident (id,instant,description,severity) VALUES ('T-783','2020-11-06 00:34:50.000','Fall',6);
INSERT INTO Incident (id,instant,description,severity) VALUES ('T-783','2020-11-12 03:58:32.000','Direct contact with exposed energized conductors',4);




-- Table: Line_Incident
INSERT INTO Line_Incident (id,instant,point) VALUES ('L-144','2020-10-06 21:56:55.000',3.25);
INSERT INTO Line_Incident (id,instant,point) VALUES ('L-144','2020-10-23 19:24:51.000',4.33);
INSERT INTO Line_Incident (id,instant,point) VALUES ('L-144','2020-11-05 10:14:11.000',3.25);
INSERT INTO Line_Incident (id,instant,point) VALUES ('L-167','2020-10-10 07:44:24.000',3.25);
INSERT INTO Line_Incident (id,instant,point) VALUES ('L-173','2020-11-01 17:03:03.000',9.24);
INSERT INTO Line_Incident (id,instant,point) VALUES ('L-173','2020-10-01 09:09:31.000',3.5);
INSERT INTO Line_Incident (id,instant,point) VALUES ('L-173','2020-10-13 05:30:59.000',4.86);
INSERT INTO Line_Incident (id,instant,point) VALUES ('L-499','2020-10-02 17:34:48.000',1.22);
INSERT INTO Line_Incident (id,instant,point) VALUES ('L-571','2020-10-02 06:58:58.000',5.16);
INSERT INTO Line_Incident (id,instant,point) VALUES ('L-571','2020-10-31 13:07:44.000',3.15);
INSERT INTO Line_Incident (id,instant,point) VALUES ('L-571','2020-11-08 05:44:45.000',5.32);
INSERT INTO Line_Incident (id,instant,point) VALUES ('L-863','2020-10-06 21:56:55.000',3.2);
INSERT INTO Line_Incident (id,instant,point) VALUES ('L-910','2020-10-19 06:07:56.000',1.34);
INSERT INTO Line_Incident (id,instant,point) VALUES ('L-910','2020-10-01 09:09:31.000',4.33);
INSERT INTO Line_Incident (id,instant,point) VALUES ('L-910','2020-10-13 05:30:59.000',7.81);
INSERT INTO Line_Incident (id,instant,point) VALUES ('L-910','2020-10-04 21:05:27.000',4.75);




-- Table: analyzes
INSERT INTO analyses (id,instant,name,address,report) VALUES ('B-163','2020-10-04 22:02:17.000','Jane Sweettooth','Avenida Madre Andaluz 115,2070-374,Santarem','The problem is solved');
INSERT INTO analyses (id,instant,name,address,report) VALUES ('B-163','2020-11-02 10:07:51.000','Oscar Wilde','Rua Doutor Teofilo Braga 52,7250-280,Evora','The problem is not solved');
INSERT INTO analyses (id,instant,name,address,report) VALUES ('B-163','2020-11-12 10:14:11.000','John Oliver','Rua Ciprestes 24,2790-139,Lisboa','The problem is solved');
INSERT INTO analyses (id,instant,name,address,report) VALUES ('B-224','2020-10-04 22:02:17.000','Jacob Pierre','Avenida Lago 99,2774-527,Lisboa','The problem is solved');
INSERT INTO analyses (id,instant,name,address,report) VALUES ('B-544','2020-11-05 10:14:11.000','Leonardo DiCaprio','Avenida Almirante Reis 109,2600-006,Lisboa','The problem is solved');
INSERT INTO analyses (id,instant,name,address,report) VALUES ('B-647','2020-10-06 21:56:55.000','John Oliver','Rua Ciprestes 24,2790-139,Lisboa','The problem is solved');
INSERT INTO analyses (id,instant,name,address,report) VALUES ('B-789','2020-10-23 19:24:51.000','Matilde Moreira','Rua Irene Lisboa 66,2675-373,Lisboa','The problem is solved');
INSERT INTO analyses (id,instant,name,address,report) VALUES ('B-789','2020-10-24 20:36:55.000','Joao Cardoso','Estrada Nacional 65,3830-209,Aveiro','The problem is not solved');
INSERT INTO analyses (id,instant,name,address,report) VALUES ('B-789','2020-11-02 17:46:28.000','Angelina Jolie','Rua Sao Goncalo 45,7540-501,Setubal','The problem is not solved');
INSERT INTO analyses (id,instant,name,address,report) VALUES ('B-789','2020-11-12 10:14:11.000','Leonardo DiCaprio','Avenida Almirante Reis 109,2600-006,Lisboa','The problem is not solved');
INSERT INTO analyses (id,instant,name,address,report) VALUES ('B-864','2020-10-10 07:44:24.000','Pedro Antunes','Praceta Conde Arnoso 96,2635-389,Lisboa','The problem is not solved');
INSERT INTO analyses (id,instant,name,address,report) VALUES ('B-901','2020-11-04 22:08:05.000','John Oliver','Rua Ciprestes 24,2790-139,Lisboa','The problem is solved');
INSERT INTO analyses (id,instant,name,address,report) VALUES ('B-940','2020-10-07 16:25:02.000','Oscar Wilde','Rua Doutor Teofilo Braga 52,7250-280,Evora','The problem is not solved');
INSERT INTO analyses (id,instant,name,address,report) VALUES ('B-940','2020-11-05 10:14:11.000','Rui Constantino','Rua Industria 94,3230-279,Coimbra','The problem is not solved');
INSERT INTO analyses (id,instant,name,address,report) VALUES ('B-940','2020-10-04 22:02:17.000','Jacob Pierre','Avenida Lago 99,2774-527,Lisboa','The problem is not solved');
INSERT INTO analyses (id,instant,name,address,report) VALUES ('L-144','2020-10-06 21:56:55.000','Jane Sweettooth','Rua Combatentes G Guerra 117,3080-502,Coimbra','The problem is not solved');
INSERT INTO analyses (id,instant,name,address,report) VALUES ('L-144','2020-10-23 19:24:51.000','Lorena Wolf','Rua Nossa Senhora Graça 106,4620-430,Porto','The problem is not solved');
INSERT INTO analyses (id,instant,name,address,report) VALUES ('L-144','2020-11-05 10:14:11.000','Joao Cardoso','Estrada Nacional 65,3830-209,Aveiro','The problem is solved');
INSERT INTO analyses (id,instant,name,address,report) VALUES ('L-167','2020-10-10 07:44:24.000','Jane Sweettooth','Avenida Madre Andaluz 115,2070-374,Santarem','The problem is solved');
INSERT INTO analyses (id,instant,name,address,report) VALUES ('L-173','2020-11-01 17:03:03.000','Joao Cardoso','Estrada Nacional 65,3830-209,Aveiro','The problem is not solved');
INSERT INTO analyses (id,instant,name,address,report) VALUES ('L-173','2020-10-01 09:09:31.000','John Oliver','Rua Ciprestes 24,2790-139,Lisboa','The problem is not solved');
INSERT INTO analyses (id,instant,name,address,report) VALUES ('L-173','2020-10-13 05:30:59.000','Matilde Moreira','Rua Irene Lisboa 66,2675-373,Lisboa','The problem is solved');
INSERT INTO analyses (id,instant,name,address,report) VALUES ('L-499','2020-10-02 17:34:48.000','Rui Constantino','Rua Industria 94,3230-279,Coimbra','The problem is solved');
INSERT INTO analyses (id,instant,name,address,report) VALUES ('L-571','2020-10-02 06:58:58.000','Matilde Moreira','Rua Irene Lisboa 66,2675-373,Lisboa','The problem is not solved');
INSERT INTO analyses (id,instant,name,address,report) VALUES ('L-571','2020-10-31 13:07:44.000','Oscar Wilde','Rua Doutor Teofilo Braga 52,7250-280,Evora','The problem is not solved');
INSERT INTO analyses (id,instant,name,address,report) VALUES ('L-571','2020-11-08 05:44:45.000','Jane Sweettooth','Rua Combatentes G Guerra 117,3080-502,Coimbra','The problem is not solved');
INSERT INTO analyses (id,instant,name,address,report) VALUES ('L-863','2020-10-06 21:56:55.000','Jane Sweettooth','Avenida Madre Andaluz 115,2070-374,Santarem','The problem is solved');
INSERT INTO analyses (id,instant,name,address,report) VALUES ('L-910','2020-10-19 06:07:56.000','Leonardo DiCaprio','Avenida Almirante Reis 109,2600-006,Lisboa','The problem is solved');
INSERT INTO analyses (id,instant,name,address,report) VALUES ('L-910','2020-10-01 09:09:31.000','Angelina Jolie','Rua Sao Goncalo 45,7540-501,Setubal','The problem is solved');
INSERT INTO analyses (id,instant,name,address,report) VALUES ('L-910','2020-10-13 05:30:59.000','Rui Constantino','Rua Industria 94,3230-279,Coimbra','The problem is not solved');
INSERT INTO analyses (id,instant,name,address,report) VALUES ('L-910','2020-10-04 21:05:27.000','Pedro Antunes','Praceta Conde Arnoso 96,2635-389,Lisboa','The problem is solved');
INSERT INTO analyses (id,instant,name,address,report) VALUES ('T-214','2020-11-08 05:44:45.000','Angelina Jolie','Rua Sao Goncalo 45,7540-501,Setubal','The problem is not solved');
INSERT INTO analyses (id,instant,name,address,report) VALUES ('T-214','2020-10-31 13:07:44.000','Jane Sweettooth','Avenida Madre Andaluz 115,2070-374,Santarem','The problem is not solved');
INSERT INTO analyses (id,instant,name,address,report) VALUES ('T-303','2020-10-06 22:45:21.000','Jane Sweettooth','Rua Combatentes G Guerra 117,3080-502,Coimbra','The problem is solved');
INSERT INTO analyses (id,instant,name,address,report) VALUES ('T-303','2020-10-28 16:20:36.000','Leonardo DiCaprio','Avenida Almirante Reis 109,2600-006,Lisboa','The problem is not solved');
INSERT INTO analyses (id,instant,name,address,report) VALUES ('T-303','2020-11-03 07:57:45.000','Oscar Wilde','Rua Doutor Teofilo Braga 52,7250-280,Evora','The problem is not solved');
INSERT INTO analyses (id,instant,name,address,report) VALUES ('T-303','2020-10-12 22:17:06.000','Joao Cardoso','Estrada Nacional 65,3830-209,Aveiro','The problem is solved');
INSERT INTO analyses (id,instant,name,address,report) VALUES ('T-371','2020-11-07 06:32:01.000','Angelina Jolie','Rua Sao Goncalo 45,7540-501,Setubal','The problem is not solved');
INSERT INTO analyses (id,instant,name,address,report) VALUES ('T-463','2020-10-11 17:43:25.000','John Oliver','Rua Ciprestes 24,2790-139,Lisboa','The problem is solved');
INSERT INTO analyses (id,instant,name,address,report) VALUES ('T-463','2020-10-01 17:22:55.000','Oscar Wilde','Rua Doutor Teofilo Braga 52,7250-280,Evora','The problem is not solved');
INSERT INTO analyses (id,instant,name,address,report) VALUES ('T-463','2020-10-23 06:33:06.000','Lorena Wolf','Rua Nossa Senhora Graça 106,4620-430,Porto','The problem is solved');
INSERT INTO analyses (id,instant,name,address,report) VALUES ('T-706','2020-10-12 12:06:57.000','Rui Constantino','Rua Industria 94,3230-279,Coimbra','The problem is not solved');
INSERT INTO analyses (id,instant,name,address,report) VALUES ('T-766','2020-11-12 12:48:00.000','Pedro Antunes','Praceta Conde Arnoso 96,2635-389,Lisboa','The problem is not solved');
INSERT INTO analyses (id,instant,name,address,report) VALUES ('T-766','2020-10-14 08:39:42.000','Jacob Pierre','Avenida Lago 99,2774-527,Lisboa','The problem is not solved');
INSERT INTO analyses (id,instant,name,address,report) VALUES ('T-766','2020-10-18 06:36:52.000','Joao Cardoso','Estrada Nacional 65,3830-209,Aveiro','The problem is solved');
INSERT INTO analyses (id,instant,name,address,report) VALUES ('T-766','2020-10-03 15:31:31.000','Angelina Jolie','Rua Sao Goncalo 45,7540-501,Setubal','The problem is not solved');
INSERT INTO analyses (id,instant,name,address,report) VALUES ('T-783','2020-10-13 05:30:59.000','Matilde Moreira','Rua Irene Lisboa 66,2675-373,Lisboa','The problem is solved');
INSERT INTO analyses (id,instant,name,address,report) VALUES ('T-783','2020-11-06 00:34:50.000','Jacob Pierre','Avenida Lago 99,2774-527,Lisboa','The problem is solved');
INSERT INTO analyses (id,instant,name,address,report) VALUES ('T-783','2020-11-12 03:58:32.000','Jane Sweettooth','Rua Combatentes G Guerra 117,3080-502,Coimbra','The problem is solved');




