#!/usr/bin/python3

#definition of variables to connect to DB
IST_ID = 'ist425437'
host = 'db.tecnico.ulisboa.pt'
port = 5432
password = 'plbu0161'
db_name = IST_ID
credentials = 'host={} port={} user={} password={} dbname={}'.format(host, port, IST_ID,
password, db_name)