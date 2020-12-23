<!-- This is the page that processes the information to add a new client
 and performs the INSERT into the DB -->
<?php
	session_start();
?>

<html>
	<head>
		<title> Dental Clinic - Group 42</title>
	</head>
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
		<b><h1 style="text-align:center;">List of Clients</h1><b>
		<?php
			/*definition of variables to connect to DB*/
			$host = "db.tecnico.ulisboa.pt";
			$user = $_SESSION['user'];
			$pass = $_SESSION['pass'];
			$dsn = "mysql:host=$host;dbname=$user";

			// Try to connect into a database
			try {
				$connection = new PDO($dsn, $user, $pass);
			} catch(PDOException $exception) {
				echo("<p>Error: ");
				echo($exception->getMessage());
				echo("</p>");
				exit();
			}
			/*fetching of variables posted to this page by a form*/
			$search_VAT = $_REQUEST['search_VAT'];
			$search_name = $_REQUEST['search_name'];
			$search_street = $_REQUEST['search_street'];
			$search_city = $_REQUEST['search_city'];
			$search_zip = $_REQUEST['search_zip'];	

			/* basic selection of clients if no search fileds were filled*/
			$sql = "SELECT c.VAT, c.client_name, c.street, c.city, c.zip 
					FROM client as c";

			$aux = 0;

			/* concatenation of client VAT search condition if VAT field was filled*/
			if(isset($_REQUEST['search_VAT']) && strlen(trim($_REQUEST['search_VAT'])) > 0){
			    $sql .= " WHERE c.VAT = '$search_VAT'";
			    $aux++;
			}

			/* concatenation of client name search condition if name field was filled*/
			if(isset($_REQUEST['search_name']) && strlen(trim($_REQUEST['search_name'])) > 0){
			    if($aux == 0){
			    	$sql .= " WHERE ";
			    	$aux++;
			    }
			    else if($aux > 0){
			    	$sql .= " AND ";
			    }
			    $sql .= "c.client_name LIKE '%$search_name%'";
			}

			/* concatenation of client street search condition if street field was filled*/
			if(isset($_REQUEST['search_street']) && strlen(trim($_REQUEST['search_street'])) > 0){
			    if($aux == 0){
			    	$sql .= " WHERE ";
			    	$aux++;
			    }
			    else if($aux > 0){
			    	$sql .= " AND ";
			    }
			    $sql .= "c.street LIKE '%$search_street%'";
			}

			/* concatenation of client city search condition if city field was filled*/
			if(isset($_REQUEST['search_city']) && strlen(trim($_REQUEST['search_city'])) > 0){
			    if($aux == 0){
			    	$sql .= " WHERE ";
			    	$aux++;
			    }
			    else if($aux > 0){
			    	$sql .= " AND ";
			    }
			    $sql .= "c.city LIKE '%$search_city%'";
			}

			/* concatenation of client zip search condition if zip field was filled*/
			if(isset($_REQUEST['search_zip']) && strlen(trim($_REQUEST['search_zip'])) > 0){
			    if($aux == 0){
			    	$sql .= " WHERE ";
			    	$aux++;
			    }
			    else if($aux > 0){
			    	$sql .= " AND ";
			    }
			    $sql .= "c.zip LIKE '%$search_zip%'";
			}
			
			$result = $connection->query($sql) or die(mysql_error());
			if ($result == FALSE)
			{
				/* query fail error message*/
				$info = $connection->errorInfo();
				echo("<p>Error: {$info[2]}</p>");
				exit();
			}

			if($result->rowCount() > 0){
				/* table of matching clients */
				echo("<h1>Matching results</h1>");
				echo("<h2>Select a result from the table down below:</h2>");

				echo("<form action='appshow.php' method='post'>");
				echo("<table border=\"1\">");
				echo("<tr>");
				echo("<td class='hidden'></td>");
				echo("<td><b>VAT</b></td>");
				echo("<td><b>Name</b></td>");
				echo("<td><b>Street</b></td>");
				echo("<td><b>City</b></td>");
				echo("<td><b>Zip</b></td>");
				echo("</tr>");
				foreach($result as $row)
				{
					$check_VAT = $row['VAT'];
					$check_name = $row['client_name'];
					echo("<tr><td>");
					echo("<input type='radio' name='type[info]' value='$check_name:$check_VAT' required>");
					echo("</td><td>");
					echo($row['VAT']);
					echo("</td><td>");
					echo($row['client_name']);
					echo("</td><td>");
					echo($row['street']);
					echo("</td><td>");
					echo($row['city']);
					echo("</td><td>");
					echo($row['zip']);
					echo("</td></tr>");
				}
				echo("</table>");

				echo("<p></p>");

				echo("<button class='button button4' type='submit'>Schedule an appointment</button>");
				echo("</form>");
			}
			else{
				/* message if input fields returned no results*/
				echo("<h3 style='text-align:center;'>There is no client for the given input!</h3>");
			}
			
			$connection = null;
		?>	

		<p></p>
		<form action="clientsearchform.php" method="post">
			<button class="button button3" type="submit">Search Again</button>
		</form>
		
		<form action="index.php" method="post">
			<button class="button button2" type="submit">Back to the main page</button>
		</form>
		
		<p></p>
		<form action="addclientform.php" method="post">
			<button class="button button1" type="submit">Register new client</button>
		</form>
			

	</body>
</html>