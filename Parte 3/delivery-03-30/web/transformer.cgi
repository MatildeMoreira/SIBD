#!/usr/bin/python3
import psycopg2

import login

print('Content-type:text/html\n\n')
print('<html>')
print('<head>')
print('<title>Transformer</title>')
print('</head>')
print('<body>')

connection = None
try:
	# Creating connection
	connection = psycopg2.connect(login.credentials)
	cursor = connection.cursor()

	# Making query
	sql = 'SELECT * FROM transformer;'
	print('<p>{}</p>'.format(sql))
	cursor.execute(sql)
	result = cursor.fetchall()
	num = len(result)

    # The form will send the info needed for the SQL query
    print('<form action="insert_transformer.cgi" method="post">')

    print('<p><input type="hidden" name="transformer_id" value="{}"/></p>'.format(transformer_id))
    print('<p>ID: <input type="text" name="transformer_id"/></p>')

    print('<p><input type="hidden" name="pv"value="{}"/></p>'.format(pv))
    print('<p>Primary Voltage: <input type="text" name="pv"/></p>')

	print('<p><input type="hidden" name="sv" value="{}"/></p>'.format(sv))
    print('<p>Secondary Voltage: <input type="text" name="sv"/></p>')

	print('<p><input type="hidden" name="gpslat" value="{}"/></p>'.format(gpslat))
    print('<p>Latitude: <input type="text" name="gpslat"/></p>')

	print('<p><input type="hidden" name="gpslong" value="{}"/></p>'.format(gpslong))
    print('<p>Longitude: <input type="text" name="gpslong"/></p>')

    print('<p><input type="hidden" name="pbbid" value="{}"/></p>'.format(pbbid))
    print('<p>Primary Busbar ID: <input type="text" name="pbbid"/></p>')

    print('<p><input type="hidden" name="sbbid" value="{}"/></p>'.format(sbbid))
    print('<p>Secondary Busbar ID: <input type="text" name="sbbid"/></p>')

    print('<p><input type="submit" value="Insert"/></p>')
    print('</form>')


	# Displaying result
	print('<table border="5">')
	print('<tr><td>account_number</td><td>branch_name</td><td>balance</td></tr>')
	for row in result:
		print('<tr>')
		for value in row:
		# The string has the {}, the variables inside format() will replace the {}
			print('<td>{}</td>'.format(value))
		print('</tr>')
	print('</table>')

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
