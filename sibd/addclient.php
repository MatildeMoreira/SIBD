<!-- This is the page that processes the information to add a new client
 and performs the INSERT into the DB -->
<?php
	session_start();
?>
<html>
	<title> Dental Clinic - Group 42</title>
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
			
			/*fetching of variables posted to this page by a form*/
			$VAT = $_REQUEST['VAT'];
			$name = $_REQUEST['name'];
			$birth_date = $_REQUEST['birth_date'];
			$street = $_REQUEST['street'];
			$city = $_REQUEST['city'];
			$zip = $_REQUEST['zip'];
			$sex = $_REQUEST['gender'];
			$phone = $_REQUEST['phone'];
			$result2 = 0;


			/*insertion of new client in the DB*/
			$sql = "INSERT INTO client VALUES 
					('$VAT','$name','$birth_date','$street','$city','$zip','$sex',timestampdiff(YEAR, birth_date, NOW()))";
			$result = $connection->exec($sql);
			echo("<p>VAT: ".$VAT."Name: ".$name."Birth Date: ".$birth_date."Street: ".$street."City: ".$city."Zip: ".$zip."Gender: ".$sex."</p>");
			if ($phone != null){
				/*insertion of client's phone number in the DB if provided*/
				$sql2 = "INSERT INTO phone_number_client VALUES ('$VAT','$phone')";
				$result2 = $connection->exec($sql2);					
			}

			echo("<p>'VAT:".$VAT."PhoneNumber:".$phone."</p>");
			if($result == 1 &&($result2==0||$result2 == 1)){
				/*output of success message if insertion successfull
				 and button to go back to client search*/
				echo("<h1 style='text-align:center;'>SUCCESS!</h1>");
				echo("<h3 style='text-align:center;'> Now you can search at Clients List!</h3>");
				echo("<form action='clientsearchform.php' method='post'>");
				echo("<button class='button button1' type='submit'>Search Client</button>");
				echo("</form>");

			}
			else {
				/*output of failure message if insertion failed
				 and button to go try again*/
				echo("<h1 style='text-align:center;'>FAILURE!</h1>");
				echo("<h3 style='text-align:center;'>The client already exists with the VAT!</h3>");
				if($result2 == 1){
					/*insertion may fail if client already exists, in that case
					if provided new phone number, adds to the list of existing*/
					echo("<h4 style='text-align:center;'>Inserted a new Mobile phone!</h3>");
				}
				echo("<form action='addclientform.php' method='post'>");
				echo("<button class='button button3' type='submit'>Try Again</button>");
				echo("</form>");
			}
		?>
		<p>
		<form action="index.php" method="post">
			<input type="hidden" name="all" value="1">
			<button class="button button2" type="submit"/>Back to the main page</button>
		</form>
		</p>
	</body>
</html>
