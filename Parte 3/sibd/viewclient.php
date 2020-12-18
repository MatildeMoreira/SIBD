<!-- This page shows the list of all clients in the DB -->
<?php
	session_start();
?>

<html>
	<title> Dental Clinic - Group 42</title>
	<style>
		/* button and background styling */
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
			
			/* selection of all rows of the table client */
			$sql = "SELECT * FROM client";
			$result = $connection->query($sql) or die(mysql_error());
			if ($result == FALSE)
			{
				$info = $connection->errorInfo();
				echo("<p>Error: {$info[2]}</p>");
				exit();
			}

			if($result->rowCount() > 0){
				/* table with all rows of the table client */
				echo("<h1 style='text-align:center;'>Table <em>client</em></h1>");
				echo("<form action='updateClientform.php' method='post'>");
				echo("<table align='center' border=\"1\">");
				echo("<tr>");
				echo("<td class='hidden'></td>");
				echo("<td><b>VAT</b></td>");
				echo("<td><b>client_name</b></td>");
				echo("<td><b>birth_date</b></td>");
				echo("<td><b>street</b></td>");
				echo("<td><b>city</b></td>");
				echo("<td><b>zip</b></td>");
				echo("<td><b>gender</b></td>");
				echo("<td><b>age</b></td>");
				echo("</tr>");
				foreach($result as $row)
				{
					$check_VAT=$row['VAT'];
					$check_name=$row['client_name'];
					echo("<tr><td>");
					echo("<input type='radio' name='type[info]' value='$check_name:$check_VAT' required>");
					echo("</td><td>");
					echo($row['VAT']);
					echo("</td><td>");
					echo($row['client_name']);
					echo("</td><td>");
					echo($row['birth_date']);
					echo("</td><td>");
					echo($row['street']);
					echo("</td><td>");
					echo($row['city']);
					echo("</td><td>");
					echo($row['zip']);
					echo("</td><td>");
					echo($row['gender']);
					echo("</td><td>");
					echo($row['age']);
					echo("</td></tr>");
				}
				echo("</table>");
				echo("<button class='button button1' type='submit'>Update Client</button>");
				echo("<br><br>");
				echo("<button class='button button3' formaction='mobilePhoneClient.php' type='submit'>Mobile Phones</button>");			
				echo("</form>");
			}
			else{
				echo("<h1 style='text-align:center'>Without Results at Clients Database!</h1>");
			}
			$connection = null;
		?>

		<p></p>
		<form action="index.php" method="post">
				<button class="button button2" type="submit">Back to the main page</button>
		</form>
	</body>
</html>