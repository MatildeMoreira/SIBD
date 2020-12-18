#!/usr/bin/python3

import psycopg2, cgi

import login

form = cgi.FieldStorage()


#getvalue uses the names from the form in previous page
id_e = form.getvalue('id')

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
    # Making query
    sql = """ DELETE FROM line WHERE id = %s OR pbbid = %s OR sbbid = %s; """
    data = (id_e,id_e,id_e)
    cursor.execute(sql, data)
    connection.commit()
    sql = """ DELETE FROM transformer WHERE id = %s OR pbbid = %s OR sbbid = %s; """
    data = (id_e,id_e,id_e)
    cursor.execute(sql, data)
    connection.commit()
    sql = """ DELETE FROM busbar WHERE id = %s; """
    data = (id_e,)
    cursor.execute(sql, data)
    connection.commit()
    sql = """ DELETE FROM lineincident WHERE id = %s ; """
    data = (id_e,)
    cursor.execute(sql, data)
    connection.commit()
    sql = """ DELETE FROM analyses WHERE id = %s; """
    data = (id_e,)
    cursor.execute(sql, data)
    connection.commit()
    sql = """ DELETE FROM incident WHERE id = %s; """
    data = (id_e,)
    cursor.execute(sql, data)
    connection.commit()
    sql = """ DELETE FROM element WHERE id = %s; """
    data = (id_e,)
    cursor.execute(sql, data)
    connection.commit()
    print('<b><h1 style="text-align:center;",class="a">Element removed successfully!</h1><b>')
    print('<center><img src="elimination.png" style="width:500px;"></center>')

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
