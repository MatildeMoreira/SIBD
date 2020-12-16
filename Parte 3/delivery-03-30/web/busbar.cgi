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
	sql = 'SELECT * FROM busbar;'
	print('<p>{}</p>'.format(sql))
	cursor.execute(sql)
	result = cursor.fetchall()
	num = len(result)

	# Displaying result
	print('<table border="5">')
	print('<tr><td>ID</td><td>voltage</td></tr>')
	for row in result:
		print('<tr>')
		for value in row:
		# The string has the {}, the variables inside format() will replace the {}
			print('<td>{}</td>'.format(value))
		print('</tr>')
	print('</table>')
	print('<form action="insert_busbar.cgi" method="post">')
	print('<h2> Insert New Bus bar </h2>')
	print('<p> ID: <input type="text" name="id"/></p>')
	print('<p>Voltage: <input type="text" name="voltage"/></p>')
	print('<p><input type="submit" value="Submit"/></p>')
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
