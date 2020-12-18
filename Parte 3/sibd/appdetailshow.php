<!-- This is the page shows the details of an appointment/consultation
	allows the user to register an appointment as consultation 
	and allows the user to add info to a consultation, including a
	dental charting-->
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

			/*fetching of variables posted to this page by a form*/
			$raw = $_POST['type']['info'];
			$info = explode("?",$raw,3);		
			$VAT_doctor = $info[0];
			$date_timestamp = $info[1];
			$reg = $info[2];

			/*definition of variables to connect to DB*/
			$host = "db.tecnico.ulisboa.pt";
			$user = $_SESSION['user'];
			$pass = $_SESSION['pass'];
			$dsn = "mysql:host=$host;dbname=$user";

			$SOAP_S = "";
			$SOAP_O = "";
			$SOAP_A = "";
			$SOAP_P = "";

			if($reg == "N"){
				/*behaviour if appointment is not consultation*/
				echo("<b><h1 style='text-align:center;'>Information of Appointment</h1><b>");
				echo("<h2 style='text-align:center;'>Doctor VAT: " . $VAT_doctor . "</h2>");
				echo("<h2 style='text-align:center;'>Date and Hour: ". $date_timestamp. "</h2>");
				echo("<h3 style='text-align:center;'>This appointment has not yet been registered as a consultation!</h3>");
				echo("<p></p>");

				/* form that leads to page where the user can register this appointment as a consultation*/
				echo("<form action='registerconsultationform.php' method='post'>");
					echo("<input type='hidden' id='VAT_doctor' name='VAT_doctor' value='$VAT_doctor'><br>");
					echo("<input type='hidden' id='date_timestamp' name='date_timestamp' value='$date_timestamp'><br>");
					echo("<button class='button button2' type='submit'>Register as consultation</button>");
				echo("</form>");
			}
			else{
				/*behaviour if appointment is also consultation*/
				echo("<b><h1 style='text-align:center;'>Information of Consultation</h1><b>");
				echo("<h2 style='text-align:center;'>Doctor VAT: " . $VAT_doctor . "</h2>");
				echo("<h2 style='text-align:center;'>Date and Hour: ". $date_timestamp. "</h2>");
	

				try {
					$connection = new PDO($dsn, $user, $pass);
				} catch(PDOException $exception) {
					echo("<p>Error: ");
					echo($exception->getMessage());
					echo("</p>");
					exit();
				}

				############################################################################################
												#######################
												##### SOAP notes ######
												#######################
				/* selection of soap notes of this consultation*/
				$sql = "SELECT c.SOAP_S, c.SOAP_O, c.SOAP_A, c.SOAP_P
						FROM consultation as c
						WHERE c.VAT_doctor = '$VAT_doctor'
						AND timestampdiff(HOUR, c.date_timestamp, '$date_timestamp') = 0";

				$result = $connection->query($sql) or die(mysql_error());
				if ($result == FALSE)
				{
					$info = $connection->errorInfo();
					echo("<p>Error: {$info[2]}</p>");
					exit();
				}

				if($result->rowCount() > 0){
					/* table of soap notes of this consultation*/
					echo("<h2>SOAP Notes</h2>");
					echo("<table border=\"1\">");
					echo("<tr>");
					echo("<td><b>SOAP_S</b></td>");
					echo("<td><b>SOAP_O</b></td>");
					echo("<td><b>SOAP_A</b></td>");
					echo("<td><b>SOAP_P</b></td>");
					echo("</tr>");
					foreach($result as $row)
					{
						echo("<tr><td>");
						echo($row['SOAP_S']);
						echo("</td><td>");
						echo($row['SOAP_O']);
						echo("</td><td>");
						echo($row['SOAP_A']);
						echo("</td><td>");
						echo($row['SOAP_P']);
						echo("</td></tr>");
					}
					echo("</table>");

					echo("<p></p>");

					$SOAP_S = $row['SOAP_S'];
					$SOAP_O = $row['SOAP_O'];
					$SOAP_A = $row['SOAP_A'];
					$SOAP_P = $row['SOAP_P'];
				}
				else{
					echo("<h2>SOAP Notes</h2>");
					echo('<p>It was not possible to show SOAP notes for this consultation!</p>');
				}

				echo("<p></p>");

				############################################################################################
												#######################
												######## Nurses #######
												#######################

				/* selection of nurses who assisted this consultation*/
				$sql = "SELECT e.employee_name, e.VAT
						FROM employee as e INNER JOIN consultation_assistant as c ON e.VAT = c.VAT_nurse
						WHERE c.VAT_doctor = '$VAT_doctor'
						AND timestampdiff(HOUR, c.date_timestamp, '$date_timestamp') = 0
						ORDER BY e.employee_name";

				$result = $connection->query($sql) or die(mysql_error());
				if ($result == FALSE)
				{
					$info = $connection->errorInfo();
					echo("<p>Error: {$info[2]}</p>");
					exit();
				}

				if($result->rowCount() > 0){
					/* table of nurses who assisted this consultation*/
					echo("<br>");
					echo("<h2>Nurses that assisted</h2>");
					echo("<table border=\"1\">");
					echo("<tr>");
					echo("<td><b>Name</b></td>");
					echo("<td><b>VAT</b></td>");
					echo("</tr>");
					foreach($result as $row)
					{
						echo("<tr><td>");
						echo($row['employee_name']);
						echo("</td><td>");
						echo($row['VAT']);
						echo("</td></tr>");
					}
					echo("</table>");
				}
				else{
					echo("<h2>Nurses that assisted</h2>");
					echo('<p>No nurses</p>');
				}

				echo("<p></p>");

				############################################################################################
												#######################
												##### Diagnostics #####
												#######################

				/* selection of diagnostics made in this consultation*/
				$sql = "SELECT dc.ID, dc.description_diagnostic
						FROM diagnostic_code as dc INNER JOIN consultation_diagnostic as cd ON dc.ID = cd.ID
						WHERE cd.VAT_doctor = '$VAT_doctor'
						AND timestampdiff(HOUR, cd.date_timestamp, '$date_timestamp') = 0
						ORDER BY dc.ID";

				$result = $connection->query($sql) or die(mysql_error());
				if ($result == FALSE)
				{
					$info = $connection->errorInfo();
					echo("<p>Error: {$info[2]}</p>");
					exit();
				}

				if($result->rowCount() > 0){
					/* selection of diagnostics made in this consultation*/
					echo("<br>");
					echo("<h2>Diagnostics</h2>");

					echo("<table border=\"1\">");
					echo("<tr>");
					echo("<td><b>ID</b></td>");
					echo("<td><b>Description</b></td>");
					echo("</tr>");
					foreach($result as $row)
					{
						echo("<tr><td>");
						echo($row['ID']);
						echo("</td><td>");
						echo($row['description_diagnostic']);
						echo("</td></tr>");
					}
					echo("</table>");
				}
				else{
					echo("<h2>Diagnostics</h2>");
					echo('<p>No diagnostics to show</p>');
				}
				
				echo("<p></p>");

				############################################################################################
												#######################
												#### Prescriptions ####
												#######################

				/* selection of prescriptions associated to this consultation and respective diagnostics*/
				$sql = "SELECT p.name_medication, p.lab, p.dosage, p.description_prescription, dc.ID,
							   dc.description_diagnostic
						FROM diagnostic_code as dc INNER JOIN prescription as p ON dc.ID = p.ID
						WHERE p.VAT_doctor = '$VAT_doctor'
						AND timestampdiff(HOUR, p.date_timestamp, '$date_timestamp') = 0
						ORDER BY p.name_medication";

				$result = $connection->query($sql) or die(mysql_error());
				if ($result == FALSE)
				{
					$info = $connection->errorInfo();
					echo("<p>Error: {$info[2]}</p>");
					exit();
				}

				if($result->rowCount() > 0){
					/* table of prescriptions associated to this consultation and respective diagnostics*/
					echo("<h2>Prescriptions</h2>");

					echo("<table border=\"1\">");
					echo("<tr>");
					echo("<td><b>Medication</b></td>");
					echo("<td><b>Lab</b></td>");
					echo("<td><b>Dosage</b></td>");
					echo("<td><b>Prescription description</b></td>");
					echo("<td><b>Diagnostic ID</b></td>");
					echo("<td><b>Diagnostic description</b></td>");
					echo("</tr>");
					foreach($result as $row)
					{
						echo("<tr><td>");
						echo($row['name_medication']);
						echo("</td><td>");
						echo($row['lab']);
						echo("</td><td>");
						echo($row['dosage']);

						echo("</td><td>");
						echo($row['description_prescription']);
						echo("</td><td>");
						echo($row['ID']);
						echo("</td><td>");
						echo($row['description_diagnostic']);
						echo("</td></tr>");
					}
					echo("</table>");
				}
				else{
					echo("<h2>Prescriptions</h2>");
					echo('<p>No information to show</p>');
				}
				
				echo("<p></p>");

				#####################################################################################################



				$connection = null;

				echo("<p></p>");

				/* form that leads to page where user can add info to this consultation */
				echo("<form action='editappdetailform.php' method='post'>");
					echo("<input type='hidden' id='VAT_doctor' name='VAT_doctor' value='$VAT_doctor'>");
					echo("<input type='hidden' id='date_timestamp' name='date_timestamp' value='$date_timestamp'>");
					echo("<input type='hidden' id='SOAP_S' name='SOAP_S' value='$SOAP_S'><br>");
					echo("<input type='hidden' id='SOAP_O' name='SOAP_O' value='$SOAP_O'><br>");
					echo("<input type='hidden' id='SOAP_A' name='SOAP_A' value='$SOAP_A'><br>");
					echo("<input type='hidden' id='SOAP_P' name='SOAP_P' value='$SOAP_P'><br>");
					echo("<button class='button button2' type='submit'>Add information</button><br>");
				echo("</form>");

				/* form that leads to page where user can add dental charting to this consultation */
				echo("<form action='dentalchartform.php' method='post'>");
					echo("<input type='hidden' id='VAT_doctor' name='VAT_doctor' value='$VAT_doctor'>");
					echo("<input type='hidden' id='date_timestamp' name='date_timestamp' value='$date_timestamp'>");
					echo("<button class='button button2' type='submit'>Add Dental Charting</button><br>");
				echo("</form>");
			}
		?>
		<form action="clientsearchform.php" method="post">
			<button class="button button3" type="submit">Search Client Again</button>
		</form>
			<form action="index.php" method="post">
			<button class="button button4" type="submit">Back to the main page</button>
		</form>
	</body>
</html>