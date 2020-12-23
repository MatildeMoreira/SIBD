<!-- This is the page that show the all the past and future appointments
or consultations -->
<?php
	session_start();
?>
<html>
	<head>
		<title> Dental Clinic - Group 42</title>
	</head>	
	<style>
			/*background and button styling*/
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
	<body>
		<?php

			#####################################################################################################

			/*$raw is a string containing two fields separated by a ':'*/
			$raw = $_POST['type']['info'];
			/*separation of the two fields of $raw*/
			$info = explode(":",$raw,2);

			$name = $info[0];
			$VAT = $info[1];

			echo("<h1 style='text-align:center;'>Appointments & Consultations</h1>");
			echo("<h3 style='text-align:center;'>Client Name:" . $name . "</h3>");
			echo("<h3 style='text-align:center;'>Client VAT: " . $VAT . "</h3>");
			
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

			####################### | PREVIOUS APPOINTMENTS/CONSULTATIONS | #########################
			/*						V 									  V 						*/

			/*Selection of the appointments/consultations scheduled for a date previous to NOW()
			and addition of a column to identify if that record was registered as consultation or not*/
			$sql = "SELECT e.employee_name, e.VAT, a.date_timestamp, a.description_appointment,
						(SELECT CASE
							WHEN c.VAT_doctor IS NULL THEN 'Not registered as consultation'
							ELSE 'Registered as consultation'
						END) as 'Register'
					FROM appointment as a LEFT JOIN consultation as c ON a.VAT_doctor = c.VAT_doctor
					AND timestampdiff(HOUR, a.date_timestamp, c.date_timestamp) = 0
					INNER JOIN employee as e ON a.VAT_doctor = e.VAT
					WHERE a.VAT_client = '$VAT'
					AND timestampdiff(HOUR, a.date_timestamp, NOW()) >= 0
					ORDER BY a.date_timestamp";

			$result = $connection->query($sql) or die(mysql_error());
			if ($result == FALSE)
			{
				/*Query fail error message*/
				$info = $connection->errorInfo();
				echo("<p>Error: {$info[2]}</p>");
				exit();
			}

			echo("<h3><u>Previous Appointments</u></h3>");
			if($result->rowCount() > 0){
				/*Table of previous appointments if query succeeds and has rows to show*/
				echo("<form action='appdetailshow.php' method='post'>");
				echo("<table border=\"1\">");
				echo("<tr>");
				echo("<td class='hidden'></td>");
				echo("<td><b>Doctor</b></td>");
				echo("<td><b>VAT_doctor</b></td>");
				echo("<td><b>Date and Time</b></td>");
				echo("<td><b>Description</b></td>");
				echo("<td><b>Observations</b></td>");
				echo("</tr>");
				foreach($result as $row)
				{
					$check_VAT_doctor = $row['VAT'];
					$check_date_timestamp = $row['date_timestamp'];

					/*check variable to be passed through form*/
					/*Y: appointment is also consultation*/
					/*N: appointment is not consultation*/
					if($row['Register'] == 'Registered as consultation'){
						$reg = "Y";
					}
					else{
						$reg = "N";
					}
					echo("<tr><td>");

					echo("<input type='radio' name='type[info]' value='$check_VAT_doctor?$check_date_timestamp?$reg' required>");
					echo("</td><td>");
					echo($row['employee_name']);
					echo("</td><td>");
					echo($row['VAT']);
					echo("</td><td>");
					echo($row['date_timestamp']);
					echo("</td><td>");
					echo($row['description_appointment']);
					echo("</td><td>");
					echo($row['Register']);
					echo("</td></tr>");
				}
				echo("</table>");

				echo("<p></p>");

				echo("<button class='button button1' type='submit'>Information about Consultation</button>");
				echo("</form>");
			}
			else{
				echo('<h4>Does not have scheduling history!</h4>');
			}

			####################### | FUTURE APPOINTMENTS/CONSULTATIONS | #########################
			/*						V 									V 						*/

			/*Selection of the appointments/consultations scheduled for the future*/
			$sql = "SELECT e.employee_name, a.date_timestamp, a.description_appointment
					FROM appointment as a INNER JOIN employee as e ON a.VAT_doctor = e.VAT
					WHERE a.VAT_client = '$VAT'
					AND timestampdiff(HOUR, a.date_timestamp, NOW()) <= 0
					ORDER BY a.date_timestamp";

			$result = $connection->query($sql) or die(mysql_error());
			if ($result == FALSE)
			{
				/*Query fail error message*/
				$info = $connection->errorInfo();
				echo("<p>Error: {$info[2]}</p>");
				exit();
			}

			if($result->rowCount() > 0){
				/*Table of future appointments if query succeeds and has rows to show*/
				echo("<h3><u>Future Appointments</u></h3>");

				echo("<table border=\"1\">");
				echo("<tr>");
				echo("<td><b>Doctor</b></td>");
				echo("<td><b>Date and Hour</b></td>");
				echo("<td><b>Description</b></td>");
				echo("</tr>");
				foreach($result as $row)
				{
					echo("<tr><td>");
					echo($row['employee_name']);
					echo("</td><td>");
					echo($row['date_timestamp']);
					echo("</td><td>");
					echo($row['description_appointment']);
					echo("</td></tr>");
				}
				echo("</table>");
			}
			else{
				echo("<h3><u>Future Appointments</u></h3>");
				echo('<h4>Does not have scheduling history!</h4>');
			}

			#####################################################################################################

			echo("<form action='showfreedocsform.php' method='post'>");
				echo("<input type='hidden' id='VAT' name='VAT' value='$VAT'><br>");
				echo("<input type='hidden' id='name' name='name' value='$name'><br>");
				echo("<button class='button button4' type='submit'>New Appointment</button>");
			echo("</form>");

			$connection = null;
		?>

		<p></p>
		<form action="clientsearchform.php" method="post">
			<button class="button button3" type="submit">Search Again</button>
		</form>
		
		<p></p>		
		<form action="index.php" method="post">
			<button class="button button2" type="submit">Back to the main page</button>
		</form>
	</body>
</html>