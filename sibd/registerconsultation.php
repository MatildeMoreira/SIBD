<!-- This is the page that processes the information to register an appointment
 as consultation and performs the INSERT into the DB -->
<?php
	session_start();
?>
<html>
	<title> Dental Clinic - Group 42</title>
	<style>
		/* button and background styling */
		textarea{
			resize: none;
		}
		body {
			background-image: url('dental_registration.jpg');
			background-repeat: no-repeat;
			background-attachment: fixed;
			background-size: cover;
			justify-content: center;
		}
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
		.button {
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
			width: 550px;
		}
		.button1 {
			background-color: white; 
			color: black; 
			border: 2px solid #008CBA;
		}

		.button1:hover {
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
			$n_nurses = $_REQUEST['n_nurses'];	
			$VAT_doctor = $_REQUEST['VAT_doctor'];
			$date_timestamp = $_REQUEST['date_timestamp'];
			$SOAP_S = $_REQUEST['SOAP_S'];
			$SOAP_O = $_REQUEST['SOAP_O'];
			$SOAP_A = $_REQUEST['SOAP_A'];
			$SOAP_P = $_REQUEST['SOAP_P'];
			echo("VAT_DOCTOR : ${VAT_doctor} || DateTimeStamp: ${date_timestamp} || SOAP_S: ${SOAP_S} || SOAP_O: ${SOAP_O} || SOAP_A: ${SOAP_A} ");

			/* insertion in consultation table */
			$sql = "INSERT INTO consultation VALUES ('$VAT_doctor','$date_timestamp','$SOAP_S','$SOAP_O','$SOAP_A','$SOAP_P')";

			/*check variable to be passed through form*/
			/*Y: appointment is also consultation*/
			/*N: appointment is not consultation*/
			$check = 'N';
		
			$result = $connection->exec($sql);
			if ($result == 0)
			{
				echo('<p>Error ocurred registering consultation!</p>');
				$check = "N";
			}
			else{
				/* if insertion in consultation table is successfull then inserts all the nursse appointed
				in the form of the previous page */
				for($i = 0; $i < $n_nurses; $i++){
					if(isset($_REQUEST[strval($i)]) && strlen(trim($_REQUEST[strval($i)])) > 0){
						$VAT_nurse = $_REQUEST[strval($i)];

						$sql = "INSERT INTO consultation_assistant VALUES 
						('$VAT_doctor','$date_timestamp','$VAT_nurse')";

						$result = $connection->query($sql) or die(mysql_error());
						if ($result == 0)
						{
							echo('<p>Error ocurred adding nurses!</p>');
						}
						else{
							/* if at least one nurse was appointed, then the consultation is consistent */
							$check = "Y";
						}
					}
				}
				echo("<p>Consultation registered!</p>");
			}

			echo("<form action='appdetailshow.php' method='post'>");
			echo("<input type='hidden' name='type[info]' value='$VAT_doctor?$date_timestamp?$check'>");
			echo("<button class='button button1' type='submit'>Back to appointment details</button>");
			echo("</form>");
		?>
		<p>
		<form action="index.php" method="post">
			<button class='button button3' type="submit">Back to main page</button>
		</form>
		</p>
	</body>
</html>