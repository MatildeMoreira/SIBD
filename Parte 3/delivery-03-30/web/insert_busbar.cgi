#!/usr/bin/python3
import psycopg2, cgi
import login
form = cgi.FieldStorage()

#getvalue uses the names from the form in previous page
busbar_id = form.getvalue('id')
busbar_voltage = form.getvalue('voltage')
print('Content-type:text/html\n\n')
print('<html>')
print('<head>')
print('<title>Insert Busbar</title>')
print('</head>')
print('<body>')
connection = None
try:
    # Creating connection
    connection = psycopg2.connect(login.credentials)
    cursor = connection.cursor()
    # Making query
    sql = 'UPDATE busbar SET id = %s, voltage = %f;'
    data = (busbar_id, busbar_voltage)
    # The string has the {}, the variables inside format() will replace the {}
    print('<p>{}</p>'.format(sql % data))
    # Feed the data to the SQL query as follows to avoid SQL injection
    cursor.execute(sql, data)
    # Commit the update (without this step the database will not change)
    connection.commit()
    # Closing connection
    cursor.close()
except Exception as e:
    # Print errors on the webpage if they occur
    print('<h1>An error occurred.</h1>')
    print('<p>{}</p>'.format(e))
finally:
    if connection is not None: 
        connection.close()

print('</body>')