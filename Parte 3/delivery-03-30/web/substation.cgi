#!/usr/bin/python3
import psycopg2

import login
import cgi
form = cgi.FieldStorage()


print('Content-type:text/html\n\n')
print('<html>')
print('<head>')
print('<title>Power Grid - Group 30</title>')
print('</head>')
print('<style>')
print('h1 {color:black;}')
print('h1.a{')
print('font-style: italic;')
print('}')

print('td.hidden {')
print('visibility: hidden;')
print('}')

#BUTTON
print('/*background and button styling*/')
print('.button {')
print('background-color: #4CAF50; /* Green */')
print('border: none;')
print('color: white;')
print('padding: 16px 32px;')
print('text-align: center;')
print('text-decoration: none;')
print('display: inline-block;')
print('font-size: 16px;')
print('margin: 4px 2px;')
print('-webkit-transition-duration: 0.4s; /* Safari */')
print('transition-duration: 0.4s;')
print('cursor: pointer;')
print('box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);')
print('border-radius: 12px;')
print('width: 400px;')
print('}')

print('.button1 {')
print('background-color: white;')
print('color: black;')
print('border: 2px solid #4CAF50;')
print('}')

print('.button1:hover {')
print('background-color: #4CAF50;')
print('color: white;')
print('}')

print('.button2 {')
print('background-color: white;')
print('color: black;')
print('border: 2px solid #008CBA;')
print('}')

print('.button2:hover {')
print('background-color: #008CBA;')
print('color: white;')
print('}')

print('.button3 {')
print('background-color: white;')
print('color: black;')
print('border: 2px solid #f44336;')
print('}')

print('.button3:hover {')
print('background-color: #f44336;')
print('color: white;')
print('}')

print('.button4 {')
print('background-color: white;')
print('color: black;')
print('border: 2px solid orange;')
print('}')

print('.button4:hover {')
print('background-color: orange;')
print('color: white;')
print('}')


print('.cleanForm {')
print('width: 550px;')
print('}')
print('fieldset > label > input {')
print('display: block;')
print('}')
print('input[type="checkbox"] {')
print('display: inline;')
print('}')
print('label {')
print('margin: 10px;')
print('padding: 5px;')
print('}')
print('fieldset > label {')
print('float: left;')
print('width: 200px;')
print('}')
print('label:nth-child(2n+1) {')
print('clear: both;')
print('}')

print('input[type="text"]{')
print('-webkit-border-radius: 5px;')
print('-moz-border-radius: 5px;')
print('border-radius: 5px;')
print('-webkit-box-shadow: inset 2px 2px 3px rgba(0, 0, 0, 0.2);')
print('-moz-box-shadow: inset 2px 2px 3px rgba(0, 0, 0, 0.2);')
print('box-shadow: inset 2px 2px 3px rgba(0, 0, 0, 0.2);')
print('padding: 5px;')
print('}')

print('</style>')

print('<body style="background-color: #C0C0C0;">')

connection = None
try:
	# Creating connection
	connection = psycopg2.connect(login.credentials)
	cursor = connection.cursor()
	print('<b><h1 style="text-align:center;",class="a">List of Substations</h1><b>')

	print('<a href="index.cgi" class="button button2">Back to Main Page</a><br>')
	print('<h2>Insert Substation</h2>')
	# The form will send the info needed for the SQL query
	print('<form action="insertSubstation.cgi" method="post">')
	print('<p>Gps Latitude: <input type="text" name="gpslat" required/></p>')
	print('<p>Gps Longitude: <input type="text" name="gpslong" required/></p>')
	print('<p>Locality: <input type="text" name="locality" required/></p>')
	print('<p>Supervisor Name: <input type="text" name="sname" required/></p>')
	print('<p>Supervisor Address: <input type="text" name="saddress" required/></p>')
	print('<p><input type="submit" value="Submit"/></p>')
	print('</form>')

	# Making query
	print('<h2>Matching results</h2>')
	sql = 'SELECT * FROM substation;'
	cursor.execute(sql)
	result = cursor.fetchall()
	num = len(result)

	print('<p>Please, if you want to change the supervisor select a result (substation) from the table down below:</p>')

	# Displaying result
	print('<form action="supervisorChange.cgi" method="post">')
	print('<table border="5">')
	print('<tr><td>Latitude</td><td>Longitude</td><td>Locality</td><td>Name</td><td>Address</td></tr>')
	for row in result:
		print('<tr>')
		gpslat = row[0]
		gpslong = row[1]
		name = row[3]
		address = row[4]
		print('<input type="hidden" name="gpslong" value = "{}">'.format(row[1]))
		print('<input type="hidden" name="gpslat" value = "{}">'.format(row[0]))
		print('<input type="hidden" name="locality" value = "{}">'.format(row[2]))
		print('<input type="hidden" name="name" value = "{}">'.format(row[3]))
		print('<input type="hidden" name="address" value = "{}">'.format(row[4]))
		print('<td>{}</td>'.format(gpslat))
		print('<td>{}</td>'.format(gpslong))
		print('<td>{}</td>'.format(row[2]))
		print('<td>{}</td>'.format(row[3]))
		print('<td>{}</td>'.format(row[4]))
		print('<td><a href="deleteSubstation.cgi?gpslat={}&gpslong={}">Delete</a></td>'.format(gpslat,gpslong))
		print('<td><a href="supervisorChange.cgi?gpslat={}&gpslong={}&sname={}&saddress={}">Change Supervisor</a></td>'.format(gpslat,gpslong,row[3],row[4]))
		print('</tr>')
	print('</table>')
	print('</form>')

	print('<a href="index.cgi" class="button button2">Back to Main Page</a><br>')


	#Closing connection
	cursor.close()

	#print('<p>Connection closed.</p>')
	#print('<p>Test completed successfully.</p>')
except Exception as e:
	print('<h1>An error occurred.</h1>')
	print('<p>{}</p>'.format(e))
finally:
	if connection is not None:
		connection.close()

print('</body>')
print('</html>')
