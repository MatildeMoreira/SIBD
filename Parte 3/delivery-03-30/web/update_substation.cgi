#!/usr/bin/python3
import psycopg2, cgi
import login
form = cgi.FieldStorage()
#getvalue uses the names from the form in previous page
gpslat = form.getvalue('gpslat')
gpslat = float(gpslat)
gpslong = form.getvalue('gpslong')
gpslong = float(gpslong)
sname = form.getvalue('sname')
saddress=form.getvalue('saddress')
print('Content-type:text/html\n\n')
print('<html>')
print('<head>')
print('<title>Update Substation</title>')
print('</head>')
print('<body>')
connection = None
try:
    # Creating connection
    connection = psycopg2.connect(login.credentials)
    cursor = connection.cursor()
    # Making query
    sql = 'UPDATE substation SET sname = %s, saddress=%s WHERE gpslat= %s and gpslong=%s;'
    data = (sname,saddress,gpslat,gpslong)
    # The string has the {}, the variables inside format() will replace the {}
    print('<p>{}</p>'.format(sql % data))
    
    # Feed the data to the SQL query as follows to avoid SQL injection
    cursor.execute(sql, data)
    #cursor.execute("UPDATE substation SET sname = %s and saddress=%s WHERE gpslat= %s and gpslong=%s;", (sname,saddress,gpslat,gpslong))
    # Commit the update (without this step the database will not change)
    connection.commit()
    # Closing connection
    print('<p>Updated Succesfully</p>')
    print('<a href="substation.cgi">Back to Table</a>')

    cursor.close()
except Exception as e:
# Print errors on the webpage if they occur
    print('<h1>An error occurred.</h1>')
    print('<p>{}</p>'.format(e))
    print('<a href="new_supervisor.cgi">Back to Form</a>')
    print('<a href="substation.cgi">Back to Table</a>')

finally:
       if connection is not None: 
            connection.close()

print('</body>')
print('</html>')