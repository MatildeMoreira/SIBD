#!/usr/bin/python3
import cgi
form = cgi.FieldStorage()

print('Content-type:text/html\n\n')
print('<html>')
print('<head>')
print('<title>Change Supervisor</title>')
print('</head>')
print('<body>')
# The string has the {}, the variables inside format() will replace the {}
print('<h3>Change Supervisor for Substation</h3>')
# The form will send the info needed for the SQL query
print('<form action="update_substation.cgi" method="post">')
#print('<p><input type="hidden" name="account_number" value="{}"/></p>'.format(account_number))
print('<p>New Supervisor Name: <input type="text" name="sname"/></p>')
print('<p>Substation Latitude: <input type="number" step=any name="gpslat"/></p>')
print('<p>Substation Longitude: <input type="number" step=any name="gpslong"/></p>')
print('<p><input type="submit" value="Submit"/></p>')
print('</form>')
print('</body>')
print('</html>')