<!-- This page shows the user the mobile phones of all clients -->

<?php
	session_start();
?>

<html>
	<title> Dental Clinic - Group 42</title>
	<style>
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
	</style>
	<body>
	
		<?php
		
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
			
			
			$sql = "SELECT * FROM phone_number_client";
			$result = $connection->query($sql) or die(mysql_error());
			if ($result == FALSE)
			{
				$info = $connection->errorInfo();
				echo("<p>Error: {$info[2]}</p>");
				exit();
			}
            echo("<h1 style='text-align:center;'>Table of Mobile Phones:<em>client</em></h1>");
            $raw = $_POST['type']['info'];
            $info = explode(":",$raw,2);           
            $Name_Client = $info[0];
            $VAT_Client = $info[1];
            echo("<h3 style='text-align:center;'>Client VAT: ${VAT_Client}</h3>");
            echo("<h3 style='text-align:center;'>Client Name: ${Name_Client}</h3>");
			if($result->rowCount() > 0){
				echo("<table align='center' border=\"1\">");
				echo("<tr>");
				echo("<td><b>VAT</b></td>");
				echo("<td><b>phone</b></td>");
                echo("</tr>");
				foreach($result as $row)
				{
                    if ($row['VAT'] == $VAT_Client)
                    {
                        echo("<tr><td>");
                        echo($row['VAT']);
                        echo("</td><td>");
                        echo($row['phone']);
                        echo("</td></tr>");
                    }
				}
				echo("</table>");
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