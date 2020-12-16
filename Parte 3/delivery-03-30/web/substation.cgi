#!/usr/bin/python3
import psycopg2

import login

print('Content-type:text/html\n\n')
print('<html>')
print('<head>')
print('<title>Substation</title>')
print('</head>')
print('<body>')

connection = None
try:
	# Creating connection
	connection = psycopg2.connect(login.credentials)
	cursor = connection.cursor()

	# Making query
	sql = 'SELECT * FROM substation;'
	print('<p>{}</p>'.format(sql))
	cursor.execute(sql)
	result = cursor.fetchall()
	num = len(result)

	# Displaying result
	print('<table border="5">')
	print('<tr><td>Latitude</td><td>Longitude</td><td>Locality</td><td>Substation name</td><td>Substation address</td></tr>')
	for row in result:
		print('<tr>')
		for value in row:
		# The string has the {}, the variables inside format() will replace the {}
			print('<td>{}</td>'.format(value))
		print('</tr>')
	print('</table>')
	print('<a href="new_supervisor.cgi">Change Supervisor Name</a></td>')
	print('<a href="main_menu.cgi">Back to Main Page</a><br>')


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
