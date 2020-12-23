#!/usr/bin/python3

import psycopg2, cgi

import login

form = cgi.FieldStorage()


#getvalue uses the names from the form in previous page
gpslat = form.getvalue('gpslat')
gpslong = form.getvalue('gpslong')
name_atual=form.getvalue('sname')
address_atual=form.getvalue('saddress')


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
    print('<a href="index.cgi" class="button button2">Back to Main Page</a><br>')
    print('<h1>Changing the Supervisor associated to (Latitude,Longitude): ({},{})</h1>'.format(gpslat,gpslong))

    print('<h2>Matching results</h2>')
    print('<h3> Please, select a supervisor to change</h3>')
    sql = 'SELECT * FROM supervisor;'

    cursor.execute(sql)
    result = cursor.fetchall()
    num = len(result)
    # Displaying result
    print('<form action="updateSupervisor.cgi" method="post">')
    print('<table border="5">')
    print('<tr><td></td><td>Name</td><td>Address</td></tr>')
    i=0
    for row in result:
	    print('<tr>')
	    name_future = row[0]
	    address_future = row[1]
	    print('<td><input type="radio" name="substation" value = "{}" required></td>'.format(i))
	    print('<input type="hidden" name="name_future" value = "{}">'.format(row[0]))
	    print('<input type="hidden" name="address_future" value = "{}">'.format(row[1]))
	    print('<td>{}</td>'.format(name_future))
	    print('<td>{}</td>'.format(address_future))
	    i=i+1
	    print('</tr>')
    print('</table>')
    print('<input type="hidden" name="gpslat2" value = "{}">'.format(gpslat))
    print('<input type="hidden" name="gpslong2" value = "{}">'.format(gpslong))
    print('<button class="button button1" type="submit">Change Supervisor</button>')
    print('</form>')


    # Closing connection
    cursor.close()
except Exception as e:
	print('<h1>An error occurred.</h1>')
	print('<p>{}</p>'.format(e))
finally:
	if connection is not None:
		connection.close()



print('</body>')
print('</html>')
