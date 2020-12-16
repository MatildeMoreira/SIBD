#!/usr/bin/python3
import psycopg2

import login

print('Content-type:text/html\n\n')
print('<html>')
print('<head>')
print('<title>Main Page</title>')
print('</head>')
print('<body>')

connection = None
try:
	# Creating connection
	connection = psycopg2.connect(login.credentials)
	cursor = connection.cursor()
	# Making query
	print('<h1> Welcome to the main Page!</h1><br>')
	print('<a href="person.cgi">Person</a><br>')
	print('<a href="supervisor.cgi">Supervisor</a><br>')
	print('<a href="analyst.cgi">Analyst</a><br>')
	print('<a href="substation.cgi">Substation</a><br>')
	print('<a href="transformer.cgi">Transformer</a><br>')
	print('<a href="busbar.cgi">Bus Bar</a><br>')
	print('<a href="element.cgi">Element</a><br>')
	print('<a href="line.cgi">Line</a><br>')
	print('<a href="line_incident.cgi">Line Incident</a><br>')
	print('<a href="incident.cgi">Incident</a><br>')
	print('<a href="analyses.cgi">Analyses</a><br>')
	#Closing connection
	cursor.close()
	print('<p>Connection closed.</p>')
	print('<p>Test completed successfully.</p>')
except Exception as e:
	print('<h1>An error occurred.</h1>')
	print('<p>{}</p>'.format(e))
finally:
	if connection is not None:
		connection.close()

print('</body>')
print('</html>')
