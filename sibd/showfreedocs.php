<!-- This is the page that processes the information for
searching free doctors at a given time and makes the search in the DB -->
<?php
	session_start();
?>
<!DOCTYPE html>
<html>
	<title>Dental Clinic - Group 42</title>
	<script>
		function goBack() {
			window.history.back()
		}
	</script>
	<style>
		/* button and background styling */
		.cleanForm {
			width: 550px;
		}
		fieldset > label > input {
			display: block;
		}
		input[type="checkbox"] {
			display: inline;
		}
		label {
			margin: 10px;
			padding: 5px;
		}
		fieldset > label {
			float: left;
			width: 200px;
		}
		label:nth-child(2n+1) {
			clear: both;
		}
		#gender, .tos, button {
			clear: both;
		}
		.tos {
			width: 400px;
		}
		input[type="text"]{
			-webkit-border-radius: 5px;
			-moz-border-radius: 5px;
			border-radius: 5px;

			-webkit-box-shadow: inset 2px 2px 3px rgba(0, 0, 0, 0.2);
			-moz-box-shadow: inset 2px 2px 3px rgba(0, 0, 0, 0.2);
			box-shadow: inset 2px 2px 3px rgba(0, 0, 0, 0.2);

			padding: 5px;
		}
		td.hidden {
			visibility: hidden;
		}
		body {
			background-image: url('teeth.jpg');
			background-repeat: no-repeat;
			background-attachment: fixed;
			background-size: cover;
			justify-content: center;
		}
		.button {
			background-color: #4CAF50; /* Green */
			border: none;
			color: white;
			padding: 16px 32px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 16px;
			margin: 4px 2px;
			-webkit-transition-duration: 0.4s; /* Safari */
			transition-duration: 0.4s;
			cursor: pointer;
			box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
			border-radius: 12px;
			width: 300px;
		}

		.button1 {
			background-color: white; 
			color: black; 
			border: 2px solid #4CAF50;
		}

		.button1:hover {
			background-color: #4CAF50;
			color: white;
		}

		.button2 {
			background-color: white; 
			color: black; 
			border: 2px solid #008CBA;
		}

		.button2:hover {
			background-color: #008CBA;
			color: white;
		}

		.button3 {
		background-color: white; 
		color: black; 
		border: 2px solid #f44336;
		}

		.button3:hover {
		background-color: #f44336;
		color: white;
		}
		.button4 {
		background-color: white;
		color: black;
		border: 2px solid #555555;
		}

		.button4:hover {background-color: #555555;}
	</style>
	<head>
		<style>
			td.hidden {
  				visibility: hidden;
  			}
  		</style>
  	</head>
	<body>
	
		<?php
			/*definition of variables to connect to DB*/
			$host = "db.tecnico.ulisboa.pt";
			$user = $_SESSION['user'];
			$pass = $_SESSION['pass'];
			$dsn = "mysql:host=$host;dbname=$user";
			try {
				$connection = new PDO($dsn, $user, $pass);
			} catch(PDOException $exception) {
				echo("<p>Error: ");
				echo($exception->getMessage());
				echo("</p>");
				exit();
			}

			/*fetching of variables posted to this page by a form*/
			$description = $_REQUEST['description'];
			$client_name = $_REQUEST['name'];
			$client_VAT = $_REQUEST['VAT'];
			$date = $_REQUEST['date'];
			$time = $_REQUEST['formhour'];
			
			$date_time = "$date $time";

			/* selection of free doctors at the pretended time */
			$sql = "SELECT e.VAT, e.employee_name, d.specialization,d.biography,d.email
				FROM employee as e 
				INNER JOIN doctor as d ON e.VAT = d.VAT 
				WHERE e.VAT NOT IN
				(SELECT ap.VAT_doctor FROM appointment as ap WHERE timestampdiff(HOUR, '$date_time', ap.date_timestamp) = 0)";
			
			$result = $connection->query($sql) or die(mysql_error());
			if ($result == FALSE)
			{
				$info = $connection->errorInfo();
				echo("<p>Error: {$info[2]}</p>");
				exit();
			}

			if($result->rowCount() > 0){
				/* table of free doctors at the pretended time */
				/* the user may select one doctor */
				echo("<h1 style='text-align:center;'>List of Available Doctors</h1>");

				echo("<h3>Select the Pretended Doctor:</h3>");

				echo("<form action='addapp.php' method='post'>");
				echo("<table border=\"1\">");
				echo("<tr>");
				echo("<td class='hidden'></td>");
				echo("<td><b>VAT</b></td>");
				echo("<td><b>Doctor</b></td>");
				echo("<td><b>Specialization</b></td>");
				echo("<td><b>Biography</b></td>");
				echo("<td><b>Email</b></td>");
				echo("</tr>");
				foreach($result as $row)
				{
					$check_VAT = $row['VAT'];
					$check_name = $row['employee_name'];
					echo("<tr><td>");
					echo("<input type='radio' name='type[info]' value='$check_name:$check_VAT' required>");
					echo("</td><td>");
					echo($row['VAT']);
					echo("</td><td>");
					echo($row['employee_name']);
					echo("</td><td>");
					echo($row['specialization']);
					echo("</td><td>");
					echo($row['biography']);
					echo("</td><td>");
					echo($row['email']);
					echo("</td></tr>");

				}
				echo("</table>");

				echo("<p></p>");

				echo("<input type='hidden' id='client_VAT' name='client_VAT' value='$client_VAT'><br>");
				echo("<input type='hidden' id='client_name' name='client_name' value='$client_name'><br>");
				echo("<input type='hidden' id='date_time' name='date_time' value='$date_time'><br>");
				echo("<input type='hidden' id='description' name='description' value='$description'><br>");

				echo("<button class='button button1' type='submit'>Submeter</button>");
				echo("</form>");	
				echo("<button class='button button2'onclick='goBack()'>Go Back</button>");
		
			}
			else{
				/* message if no available doctor at that time */
				echo('<h3>No Available Doctors</h3>');
				echo("<form action='showfreedocsform.php' method='post'>");
					echo("<input type='hidden' id='VAT' name='VAT' value='$client_VAT'><br>");
					echo("<input type='hidden' id='name' name='name' value='$client_name'><br>");
					echo("<button class='button button3' type='submit'>Select another Date or Time</button>");
				echo("</form>");
			}
			
			$connection = null;
		?>
	</body>
</html>
