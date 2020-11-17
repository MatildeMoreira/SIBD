/**********************************************************************
 *                               SCHEMA.SQL
 *
 * Subject: Information Systems and Databases
 * Laboratory Teacher: Ines Filipe
 * Senior Lecturer: Paulo Carreira
 *
 * Joao Pedro, 84096
 * Matilde, 84137
 * Duarte, 94192
 ***********************************************************************/

-- The DROP TABLE IF EXISTS statement is used to drop an existing table in a database.
DROP TABLE IF EXISTS Person,Supervisor,Analyst,Element,Substation,Incident,
Line_Incident,line_connection,Line,Transformer,Bus_Bar,supervises,analyses CASCADE;


-- The CREATE TABLE statement is used to create a new table in a database.

-- Entity : Person (name,address,Phone,Tax_ID)
CREATE TABLE Person(
    name VARCHAR(80),
    address VARCHAR(255),
    Phone VARCHAR(15)  NOT NULL,
    Tax_ID INTEGER NOT NULL,
    UNIQUE(Phone),
    UNIQUE(Tax_ID),

    PRIMARY KEY (name,address)

    --	Every	Person	must	exist	either in	the	table	'Supervisor'
    --	or	in the	table	'Analyst'

);

-- (IC-5) Persons cannot analyse incidents regarding Elements of a Substation they supervises

-- Specialization,Entity : Supervisor (name,address)
CREATE TABLE Supervisor(
    name VARCHAR(80),
    address VARCHAR(255),
    PRIMARY KEY (name,address),
	FOREIGN	KEY(name,address) REFERENCES Person(name,address)
);

-- Specialization,Entity : Analyst (name,address)
CREATE TABLE Analyst(
    name VARCHAR(80),
    address VARCHAR(255),
    PRIMARY KEY (name,address),
	FOREIGN	KEY(name,address) REFERENCES Person(name,address)
);

-- Entity : Substation (latitude,longitude,locality_name,name,address)
CREATE TABLE Substation(
    latitude NUMERIC(9,6),
    longitude NUMERIC(8,6),
    locality_name VARCHAR(20) NOT NULL,
    PRIMARY KEY(latitude,longitude),
    name VARCHAR(80)  NOT NULL,
    address VARCHAR(255) NOT NULL,
    FOREIGN KEY(name,address) REFERENCES Supervisor(name, address)
    --	Every Substation must exist in the table ‘Transformer’
);

-- Entity : Element(id)
CREATE TABLE Element(
    id VARCHAR(6),
    PRIMARY KEY(id)
    -- Every Element must exist either in the table Line, Bus_Bar or
    -- in the table Transformer.
    -- No Element can exist at the same time in the three tables,
    -- this is, the table Line, Bus_Bar or in the table Transformer.
);

-- Specialization, Entity : Line(id,impedance)
CREATE TABLE Line(
    id VARCHAR(6),
    impedance NUMERIC(6,2) NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY(id) REFERENCES Element(id)
    -- Every Line must exist in	the	table ‘line_connection’
);

-- Specialization, Entity : Bus_Bar(id,voltage)
CREATE TABLE Bus_Bar(
    id VARCHAR(6),
    voltage NUMERIC(6,2) NOT NULL,
    UNIQUE (id,voltage), -- (IC-1) e (IC-2)
    PRIMARY KEY(id),
    FOREIGN KEY(id) REFERENCES Element(id)
);

-- Specialization, Entity : Transformer(id,primary_voltage,secondary_voltage,id_primary,id_secondary)
create table Transformer(
	id VARCHAR(6),
	primary_voltage NUMERIC(6,2) NOT NULL,
	secondary_voltage NUMERIC(6,2) NOT NULL,
	id_primary VARCHAR(6) NOT NULL,
	id_secondary VARCHAR(6) NOT NULL,
	latitude NUMERIC(9,6),
	longitude NUMERIC(8,6),
	FOREIGN KEY (latitude, longitude) REFERENCES Substation(latitude,longitude),
	CHECK (id_primary != id_secondary),
    PRIMARY KEY(id),
    FOREIGN KEY(id_primary,primary_voltage) REFERENCES Bus_Bar(id,voltage),
    FOREIGN KEY (id_secondary,secondary_voltage) REFERENCES Bus_Bar(id,voltage)
);


-- Entity : Incident(id,instant, description, severity)
CREATE TABLE Incident(
    id VARCHAR(6),
    instant TIMESTAMP,
    description TEXT NOT NULL,
    severity INTEGER NOT NULL,
    PRIMARY KEY(id,instant),
    FOREIGN KEY(id) REFERENCES Element(id)
);

-- Specialization, Entity : Line_Incident(id,instant,point)
CREATE TABLE Line_Incident(
    id VARCHAR(6),
    instant TIMESTAMP,
    point NUMERIC(3,2) NOT NULL,
    PRIMARY KEY(id,instant),
    FOREIGN KEY (id,instant) REFERENCES Incident(id,instant)
);

-- Association : analyzes(report,name,address,id,instant)
CREATE TABLE analyses(
    report TEXT,
    name VARCHAR(80) NOT NULL,
    address VARCHAR(255) NOT NULL ,
    id VARCHAR(6),
    instant TIMESTAMP,
    -- Once	an Incident is associated to an	analyst, it cannot be
    -- associated again (to	another	analyst)
    PRIMARY KEY(id,instant),
    FOREIGN KEY (id,instant) REFERENCES Incident(id,instant),
    FOREIGN KEY (name,address) REFERENCES Analyst(name,address)
);

-- Association : line_connection(id_line,id_primary,id_secondary)
CREATE TABLE line_connection(
  id_Line VARCHAR(6),
  id_primary VARCHAR(6),
  id_secondary VARCHAR(6),
  PRIMARY KEY (id_Line,id_primary,id_secondary),
  FOREIGN KEY(id_Line) REFERENCES Line(id),
  FOREIGN KEY (id_primary) REFERENCES Bus_Bar(id) ,
  FOREIGN KEY (id_secondary) REFERENCES Bus_Bar(id),
  CHECK ( id_primary != id_secondary )
);
