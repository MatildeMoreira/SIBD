#!/usr/bin/python3

import psycopg2

import login

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
	print('<b><h1 style="text-align:center;",class="a">List of Transformer</h1><b>')
	print('<a href="index.cgi" class="button button2">Back to Main Page</a><br>')
	print('<h2>Insert Transformer</h2>')
	# The form will send the info needed for the SQL query
	print('<form action="insertTransformer.cgi" method="post">')
	print('<p>ID: <input type="text" name="id_t" required/></p>')
	print('<p>Primary Voltage: <input type="text" name="volt_pv_t" required/></p>')
	print('<p>Secondary Voltage: <input type="text" name="volt_sv_t" required/></p>')
	print('<p>GPS Latitude: <input type="text" name="gpslatitude" required/></p>')
	print('<p>GPS Longitude: <input type="text" name="gpslongitude" required/></p>')
	print('<p>PBBID: <input type="text" name="pbbid_bus" required/></p>')
	print('<p>SBBID: <input type="text" name="sbbid_bus" required/></p>')
	print('<p><input type="submit" value="Submit"/></p>')
	print('</form>')


	# Making query
	print('<h2>Matching results</h2>')
	sql = 'SELECT * FROM transformer;'

	cursor.execute(sql)
	result = cursor.fetchall()
	num = len(result)

	# Displaying result
	print('<table border="5">')
	print('<tr><td>ID</td><td>Primary Voltage</td><td>Secondary Voltage</td><td>Latitude</td><td>Longitude</td><td>PBBID</td><td>SBBID</td></tr>')
	for row in result:
		print('<tr>')
		id = row[0]
		print('<td>{}</td>'.format(id))
		print('<td>{}</td>'.format(row[1]))
		print('<td>{}</td>'.format(row[2]))
		print('<td>{}</td>'.format(row[3]))
		print('<td>{}</td>'.format(row[4]))
		print('<td>{}</td>'.format(row[5]))
		print('<td>{}</td>'.format(row[6]))
		print('<td><a href="deleteTransformer.cgi?id={}">Delete</a></td>'.format(id))
		print('</tr>')
	print('</table>')




	#Closing connection
	cursor.close()

except Exception as e:
	print('<h1>An error occurred.</h1>')
	print('<p>{}</p>'.format(e))
finally:
	if connection is not None:
		connection.close()

print('</body>')
print('</html>')
