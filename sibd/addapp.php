<!-- This is the page that processes the information to shcedule an appointment
 and performs the INSERT into the DB -->
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
				background-image: url('teeth_dental.care.jpg');
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
			.button3 {
			background-color: white; 
			color: black; 
			border: 2px solid #f44336;
			}

			.button3:hover {
			background-color: #f44336;
			color: white;
			}
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

			/*$raw is a string containing two fields separated by a ':'*/
			$raw = $_POST['type']['info'];
			/*separation of the two fields of $raw*/
			$info = explode(":",$raw,2);

			/*fetching of variables posted to this page by a form*/
			$name = $info[0];
			$doctor_VAT = $info[1];
			$description = $_REQUEST['description'];
			$client_VAT = $_REQUEST['client_VAT'];
			$client_name = $_REQUEST['client_name'];
			$date_time = $_REQUEST['date_time'];
			
			/*insertion of new appointment record in the DB*/
			$sql = "INSERT INTO appointment VALUES 
					('$doctor_VAT', '$date_time', '$description', '$client_VAT')";
			
			$result = $connection->query($sql) or die(mysql_error());
			if ($result == 0)
			{
				/*Gives error message if insert fails*/
				echo("<h1 style='text-align:center;'>FAILURE!</h1>");
				echo("<h3 style='text-align:center;'>Appointment NOT scheduled!</h3>");
				echo("<form action='showfreedocsform.php' method='post'>");
				echo("<input type='hidden' id='VAT' name='VAT' value='$client_VAT'><br>");
				echo("<input type='hidden' id='name' name='name' value='$client_name'><br>");
				echo("<button class='button button3' type='submit'>Try again</button>");
				echo("</form>");
			}
			else if($result == 1){
				/*Gives success message if insert succeeds*/
				echo("<h1 style='text-align:center;'>SUCCESS!</h1>");
				echo("<h3 style='text-align:center;'>Appointment scheduled!</h3>");

				/*Form with button to go back to appointment history*/
				echo("<form action='appshow.php' method='post'>");
				echo("<input type='hidden' id='type[info]' name='type[info]' value='$client_name:$client_VAT'><br>");
				echo("<button class='button button1' type='submit'>See appointment/consultation history</button>");
				echo("</form>");

				/*Form with button to go back to main page*/
				echo("<form action='index.php' method='post'>");
				echo("<button class='button button3' type='submit'>Back to main page</button>");
				echo("</form>");
			}
		?>
	</body>
</html>